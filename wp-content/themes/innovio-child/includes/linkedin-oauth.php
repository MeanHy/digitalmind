<?php
/**
 * LinkedIn OAuth Handler
 * Implements LinkedIn OAuth 2.0 with OpenID Connect
 */

class DM_LinkedIn_OAuth
{
    private static $auth_url = 'https://www.linkedin.com/oauth/v2/authorization';
    private static $token_url = 'https://www.linkedin.com/oauth/v2/accessToken';
    private static $userinfo_url = 'https://api.linkedin.com/v2/userinfo';

    /**
     * Get LinkedIn Authorization URL
     */
    public static function get_auth_url($post_id = 0, $source = 'download')
    {
        $state = wp_create_nonce('linkedin_oauth_state');

        // Store post_id and source in transient for later use
        $data = [
            'post_id' => $post_id,
            'source' => $source
        ];
        set_transient('dm_linkedin_data_' . $state, $data, 10 * MINUTE_IN_SECONDS);

        $params = [
            'response_type' => 'code',
            'client_id' => DM_LINKEDIN_CLIENT_ID,
            'redirect_uri' => DM_LINKEDIN_REDIRECT_URI,
            'state' => $state,
            'scope' => 'openid profile email'
        ];

        return self::$auth_url . '?' . http_build_query($params);
    }

    /**
     * Exchange authorization code for access token
     */
    public static function get_access_token($code)
    {
        $response = wp_remote_post(self::$token_url, [
            'body' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => DM_LINKEDIN_REDIRECT_URI,
                'client_id' => DM_LINKEDIN_CLIENT_ID,
                'client_secret' => DM_LINKEDIN_CLIENT_SECRET,
            ],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'timeout' => 30,
        ]);

        if (is_wp_error($response)) {
            return ['error' => $response->get_error_message()];
        }

        $body = json_decode(wp_remote_retrieve_body($response), true);

        if (isset($body['access_token'])) {
            return $body;
        }

        return ['error' => $body['error_description'] ?? 'Failed to get access token'];
    }

    /**
     * Get user profile from LinkedIn
     */
    public static function get_user_profile($access_token)
    {
        $response = wp_remote_get(self::$userinfo_url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
            ],
            'timeout' => 30,
        ]);

        if (is_wp_error($response)) {
            return ['error' => $response->get_error_message()];
        }

        $body = json_decode(wp_remote_retrieve_body($response), true);

        if (isset($body['sub'])) {
            return [
                'id' => $body['sub'],
                'name' => trim(($body['given_name'] ?? '') . ' ' . ($body['family_name'] ?? '')),
                'email' => $body['email'] ?? '',
                'picture' => $body['picture'] ?? '',
            ];
        }

        return ['error' => 'Failed to get user profile'];
    }

    /**
     * Process LinkedIn OAuth callback and create/login user
     */
    public static function process_callback()
    {
        if (!isset($_GET['linkedin_oauth_callback']) || $_GET['linkedin_oauth_callback'] !== '1') {
            return;
        }

        // Check for OAuth error
        if (isset($_GET['error'])) {
            $error_desc = sanitize_text_field($_GET['error_description'] ?? 'Authorization cancelled');
            self::redirect_with_error($error_desc);
            return;
        }

        // Verify state
        $state = sanitize_text_field($_GET['state'] ?? '');
        if (!wp_verify_nonce($state, 'linkedin_oauth_state')) {
            self::redirect_with_error('Invalid state parameter');
            return;
        }

        // Get authorization code
        $code = sanitize_text_field($_GET['code'] ?? '');
        if (empty($code)) {
            self::redirect_with_error('No authorization code received');
            return;
        }

        // Exchange code for access token
        $token_response = self::get_access_token($code);
        if (isset($token_response['error'])) {
            self::redirect_with_error($token_response['error']);
            return;
        }

        // Get user profile
        $profile = self::get_user_profile($token_response['access_token']);
        if (isset($profile['error'])) {
            self::redirect_with_error($profile['error']);
            return;
        }

        // Create or login user
        $user_id = self::create_or_login_user($profile);
        if (is_wp_error($user_id)) {
            self::redirect_with_error($user_id->get_error_message());
            return;
        }

        // Set cookies
        setcookie('research_email_verified', 'true', time() + 31536000, '/');
        setcookie('dm_user_name', $profile['name'], time() + 31536000, '/');
        setcookie('dm_user_email', $profile['email'], time() + 31536000, '/');

        // Get stored data (post_id)
        $data = get_transient('dm_linkedin_data_' . $state);
        delete_transient('dm_linkedin_data_' . $state);

        $post_id = $data['post_id'] ?? 0;

        // Get source from cookie
        $source = isset($_COOKIE['dm_source']) ? sanitize_text_field($_COOKIE['dm_source']) : 'download';

        // If subscribe flow, ignore post_id (treat as 0) to force redirect to Category
        if ($source === 'subscribe') {
            $post_id = 0;
        }

        // Determine redirect URL based on post_id
        $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';

        // Define paths
        // $path_category = ($current_lang === 'en') ? '/en/category/news/research/' : '/category/tin-tuc/research/';
        $path_success = ($current_lang === 'en') ? '/en/thanks-you-for-subscribe/' : '/dang-ky-thanh-cong/';

        // Logic:
        // Always redirect to Success Page
        // 1. If post_id exists -> Download flow -> Success page with report_id
        // 2. If no post_id -> Subscribe flow -> Success page without report_id

        $redirect_url = site_url($path_success);

        if ($post_id) {
            $redirect_url = add_query_arg('report_id', $post_id, $redirect_url);
        }

        // Output success page that closes popup
        self::output_success_page($redirect_url);
    }

    /**
     * Create or login WordPress user from LinkedIn profile
     */
    private static function create_or_login_user($profile)
    {
        $email = sanitize_email($profile['email']);
        $name = sanitize_text_field($profile['name']);

        if (empty($email)) {
            return new WP_Error('no_email', 'Email not provided by LinkedIn');
        }

        // Check if user exists
        $existing_user_id = email_exists($email);

        if ($existing_user_id) {
            // Login existing user
            wp_set_current_user($existing_user_id);
            wp_set_auth_cookie($existing_user_id);
            return $existing_user_id;
        }

        // Create new user
        $username = sanitize_user(current(explode('@', $email)));
        $i = 1;
        $original_username = $username;
        while (username_exists($username)) {
            $username = $original_username . $i;
            $i++;
        }

        $password = wp_generate_password();
        $user_id = wp_create_user($username, $password, $email);

        if (is_wp_error($user_id)) {
            return $user_id;
        }

        // Update user meta
        wp_update_user([
            'ID' => $user_id,
            'first_name' => $name,
            'display_name' => $name,
        ]);

        // Store LinkedIn ID
        update_user_meta($user_id, 'linkedin_id', $profile['id']);

        // Login new user
        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id);

        return $user_id;
    }

    /**
     * Output success page that closes popup window
     */
    private static function output_success_page($redirect_url)
    {
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>LinkedIn Login Success</title>
        </head>

        <body>
            <script>
                if (window.opener && !window.opener.closed) {
                    try {
                        // Set cookies in parent window context
                        window.opener.document.cookie = 'research_email_verified=true; max-age=31536000; path=/';

                        // Redirect parent window directly
                        window.opener.location.href = '<?php echo esc_url($redirect_url); ?>';

                        // Close popup
                        window.close();
                    } catch (e) {
                        // Cross-origin error, send message instead
                        window.opener.postMessage({
                            type: 'linkedin_login_success',
                            redirect_url: '<?php echo esc_url($redirect_url); ?>'
                        }, '*');
                        window.close();
                    }
                } else {
                    // No opener, redirect in current window
                    window.location.href = '<?php echo esc_url($redirect_url); ?>';
                }
            </script>
            <p>Login successful! Redirecting...</p>
        </body>

        </html>
        <?php
        exit;
    }

    /**
     * Redirect with error message
     */
    private static function redirect_with_error($message)
    {
        $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';
        $redirect_url = ($current_lang === 'en') ? '/en/' : '/';
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>LinkedIn Login Error</title>
        </head>

        <body>
            <script>
                if (window.opener) {
                    window.opener.postMessage({ type: 'social_login_error', message: '<?php echo esc_js($message); ?>' }, '*');
                    window.close();
                } else {
                    alert('<?php echo esc_js($message); ?>');
                    window.location.href = '<?php echo esc_url(site_url($redirect_url)); ?>';
                }
            </script>
            <p>Error:
                <?php echo esc_html($message); ?>
            </p>
        </body>

        </html>
        <?php
        exit;
    }
}

// Initialize callback handler
add_action('template_redirect', ['DM_LinkedIn_OAuth', 'process_callback'], 5);
