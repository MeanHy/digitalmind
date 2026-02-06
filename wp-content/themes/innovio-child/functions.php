<?php
require_once get_stylesheet_directory() . '/constant.php';
require_once get_stylesheet_directory() . '/includes/linkedin-oauth.php';
require_once get_stylesheet_directory() . '/includes/popup-templates.php';

add_action('after_setup_theme', function () {
    if (is_user_logged_in() && !current_user_can('administrator')) {
        show_admin_bar(false);
    }
});
/**
 * Redirect thank you pages - save report_id to transient and redirect to clean URL
 * Chỉ cho phép truy cập trang cảm ơn khi user đã đăng nhập
 */
function dm_redirect_thank_you_without_report_id()
{
    $is_thank_you_vi = is_page('dang-ky-thanh-cong');
    $is_thank_you_en = is_page('thanks-you-for-subscribe');

    if (!$is_thank_you_vi && !$is_thank_you_en) {
        return;
    }

    if (!is_user_logged_in()) {
        $redirect_url = $is_thank_you_en ? '/en/category/news/research/' : '/category/tin-tuc/research/';
        wp_redirect(site_url($redirect_url), 302);
        exit;
    }

    if (isset($_GET['report_id']) && !empty($_GET['report_id'])) {
        $report_id = intval($_GET['report_id']);
        $user_key = 'user_' . get_current_user_id();
        set_transient('dm_report_id_' . $user_key, $report_id, 5 * MINUTE_IN_SECONDS);

        $source = isset($_COOKIE['dm_source']) ? sanitize_text_field($_COOKIE['dm_source']) : 'download';
        set_transient('dm_source_' . $user_key, $source, 5 * MINUTE_IN_SECONDS);

        $clean_url = $is_thank_you_en ? '/en/thanks-you-for-subscribe/' : '/dang-ky-thanh-cong/';
        wp_redirect(site_url($clean_url), 302);
        exit;
    }
}
add_action('template_redirect', 'dm_redirect_thank_you_without_report_id');

/**
 * Get dm_source from transient or cookie
 */
function dm_get_source_from_transient()
{
    if (isset($_COOKIE['dm_source']) && !empty($_COOKIE['dm_source'])) {
        return sanitize_text_field($_COOKIE['dm_source']);
    }

    if (is_user_logged_in()) {
        $user_key = 'user_' . get_current_user_id();
        $source = get_transient('dm_source_' . $user_key);
        if ($source) {
            return $source;
        }
    }

    return '';
}
if (!function_exists('innovio_mikado_child_theme_enqueue_scripts')) {
    function innovio_mikado_child_theme_enqueue_scripts()
    {
        $parent_style = 'innovio-mikado-default-style';

        wp_enqueue_style('innovio-mikado-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style), '2.0.1');
        wp_enqueue_style('digitalmind-child-style-anne', get_stylesheet_directory_uri() . '/assets/css/style-anne.css');
        wp_enqueue_style('digitalmind-child-style-henry', get_stylesheet_directory_uri() . '/assets/css/style-henry.css');
        wp_enqueue_script('digitalmind-child-script-henry', get_stylesheet_directory_uri() . '/assets/js/script-henry.js', array('jquery'), '1.0.2', true);

        $report_link = '';
        $current_report_id = 0;

        if (is_singular('post')) {
            $current_report_id = get_the_ID();
        }

        if (is_page('dang-ky-thanh-cong') || is_page('thanks-you-for-subscribe')) {
            $user_key = is_user_logged_in() ? 'user_' . get_current_user_id() : 'ip_' . md5($_SERVER['REMOTE_ADDR']);
            $current_report_id = get_transient('dm_report_id_' . $user_key);

            if ($current_report_id) {
                $report_link = get_field('link_for_report', $current_report_id);
                $report_link = trim((string) $report_link);
            }
        }

        $social_login_data = array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'download_nonce' => wp_create_nonce('dm_download_nonce'),
            'register_nonce' => wp_create_nonce('dm_register_action'),
            'unsub_nonce' => wp_create_nonce('dm_unsub_nonce'),
            'current_report_id' => $current_report_id ? intval($current_report_id) : 0,
            'is_logged_in' => is_user_logged_in(),
            'dm_source' => dm_get_source_from_transient(),
            'lang_key' => array(
                'confirm' => esc_html__('Confirm', 'innovio_child'),
                'cancel' => esc_html__('Cancel', 'innovio_child'),
                'processing' => esc_html__('Processing...', 'innovio_child'),
                'server_error' => esc_html__('Server error. Please try again.', 'innovio_child'),
                'thank_you_downloading' => esc_html__('Thank you! Downloading document...', 'innovio_child'),
                'fill_all_fields' => esc_html__('Please fill in all fields!', 'innovio_child'),
                'login_success_reloading' => esc_html__('Login successful! Reloading...', 'innovio_child'),
                'subscribe' => esc_html__('Subscribe', 'innovio_child'),
                'download' => esc_html__('Download', 'innovio_child'),
                'sent_successfully' => esc_html__('Sent successfully', 'innovio_child'),
                'report_downloading' => esc_html__('The report is being downloaded.', 'innovio_child'),
                'download_complete' => esc_html__('The report has been downloaded successfully.', 'innovio_child'),
                'download_complete_title' => esc_html__('Download complete!', 'innovio_child'),
                'fill_info_to_download' => esc_html__('Fill in the information to download the report', 'innovio_child'),
                'newsletter_title' => esc_html__('Marketing Reports & Trends', 'innovio_child'),
                'subscribe_btn' => esc_html__('Đăng ký nhận báo cáo', 'innovio_child'),
            )
        );
        wp_localize_script('digitalmind-child-script-henry', 'subscribeEmail', $social_login_data);
    }

    add_action('wp_enqueue_scripts', 'innovio_mikado_child_theme_enqueue_scripts');
}


function digitalmind_include_toast_notification()
{
    include get_stylesheet_directory() . '/templates/toast-notification.php';
}
add_action('wp_footer', 'digitalmind_include_toast_notification');

/**
 * Show Download Button at the end of Research category posts
 * Button triggers popup form if not verified
 */
function digitalmind_add_research_download_form($content)
{
    if (!is_singular('post')) {
        return $content;
    }
    if (!has_category('research')) {
        return $content;
    }
    $download_section = '
    <div class="research-download-section" data-verified="false">
        <div class="research-download-box">
            <h3 class="research-download-title">' . esc_html__('Download Research Paper', 'innovio_child') . '</h3>
            <p class="research-download-desc">' . esc_html__('Get full access to this research document', 'innovio_child') . '</p>
            <button type="button" class="btn-download-research" id="btnDownloadResearch" data-report-id="' . get_the_ID() . '">
                <span class="download-icon">⬇</span>
                ' . esc_html__('Download Now', 'innovio_child') . '
            </button>
        </div>
    </div>';
    return $content . $download_section;
}
add_filter('the_content', 'digitalmind_add_research_download_form');

/**
 * Handle Social Login Popup Callback
 */
function dm_social_login_callback()
{
    if (isset($_GET['social_login_mode']) && $_GET['social_login_mode'] === 'popup') {
        setcookie('research_email_verified', 'true', time() + 31536000, '/');

        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            $user_name = $current_user->display_name;
            $user_email = $current_user->user_email;

            setcookie('dm_user_name', $user_name, time() + 31536000, '/');
            setcookie('dm_user_email', $user_email, time() + 31536000, '/');
        }

        $post_id = isset($_COOKIE['dm_social_login_post_id']) ? intval($_COOKIE['dm_social_login_post_id']) : 0;

        setcookie('dm_social_login_post_id', '', time() - 3600, '/');

        $source = isset($_COOKIE['dm_source']) ? sanitize_text_field($_COOKIE['dm_source']) : 'download';
        if ($source === 'subscribe') {
            $post_id = 0;
        }

        $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';

        $path_success = ($current_lang === 'en') ? '/en/thanks-you-for-subscribe/' : '/dang-ky-thanh-cong/';

        $redirect_url = site_url($path_success);

        if ($post_id) {
            $redirect_url = add_query_arg('report_id', $post_id, $redirect_url);
        }
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Login Success</title>
        </head>

        <body>
            <script>
                if (window.opener && !window.opener.closed) {
                    try {
                        window.opener.location.href = '<?php echo esc_url($redirect_url); ?>';
                        window.close();
                    } catch (e) {
                        window.opener.postMessage('social_login_success', '*');
                        window.close();
                    }
                } else {
                    window.location.href = '<?php echo esc_url($redirect_url); ?>';
                }
            </script>
        </body>

        </html>
        <?php
        exit;
    }
}
add_action('template_redirect', 'dm_social_login_callback');

/**
 * Helper function to generate secure download URL with token
 */
function dm_generate_download_url($report_id, $user_identifier = '')
{
    if (empty($report_id)) {
        return '';
    }

    $download_link = get_field('link_for_report', $report_id);
    if (empty($download_link)) {
        return '';
    }

    $token = wp_generate_password(32, false);

    $token_data = [
        'report_id' => $report_id,
        'user_identifier' => $user_identifier,
        'created_at' => time()
    ];
    set_transient('dm_download_token_' . $token, $token_data, 5 * MINUTE_IN_SECONDS);

    return get_stylesheet_directory_uri() . '/dm-download.php?token=' . $token;
}

/**
 * Handle AJAX User Registration
 */
function dm_register_user()
{
    check_ajax_referer('dm_register_action', 'dm_register_nonce');

    if (is_user_logged_in() && isset($_POST['is_logged_in_action']) && $_POST['is_logged_in_action'] === '1') {
        $current_post_id = isset($_POST['current_post_id']) ? intval($_POST['current_post_id']) : 0;

        $current_user = wp_get_current_user();
        $name = $current_user->display_name ?: $current_user->user_login;
        $email = $current_user->user_email;
        // $brevo_sync = dm_sync_brevo_contact($email, $name);
        // $crm_sync = dm_sync_crm_leads($email, $name);
        $brevo_sync = true;
        $crm_sync = true;

        $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';

        $path_success = ($current_lang === 'en') ? '/en/thanks-you-for-subscribe/' : '/dang-ky-thanh-cong/';

        $redirect_url = site_url($path_success);

        if ($current_post_id) {
            $redirect_url = add_query_arg('report_id', $current_post_id, $redirect_url);
        }

        wp_send_json_success(['message' => esc_html__('Confirmed! Redirecting...', 'innovio_child'), 'redirect_url' => $redirect_url, 'brevo_sync' => $brevo_sync, 'crm_sync' => $crm_sync]);
    }

    $name = sanitize_text_field($_POST['user_name']);
    $email = sanitize_email($_POST['user_email']);
    $password = wp_generate_password();

    if (empty($name) || empty($email)) {
        wp_send_json_error(['message' => esc_html__('Please fill in all fields.', 'innovio_child')]);
    }

    $existing_user_id = email_exists($email);

    // $brevo_sync = dm_sync_brevo_contact($email, $name);
    // $crm_sync = dm_sync_crm_leads($email, $name);
    $brevo_sync = true;
    $crm_sync = true;
    $current_post_id = isset($_POST['current_post_id']) ? intval($_POST['current_post_id']) : 0;
    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';

    $source = isset($_COOKIE['dm_source']) ? sanitize_text_field($_COOKIE['dm_source']) : 'download';
    if ($source === 'subscribe') {
        $current_post_id = 0;
    }

    $path_success = ($current_lang === 'en') ? '/en/thanks-you-for-subscribe/' : '/dang-ky-thanh-cong/';
    $redirect_url = site_url($path_success);

    if ($current_post_id) {
        $redirect_url = add_query_arg('report_id', $current_post_id, $redirect_url);
    }

    if ($existing_user_id) {
        wp_set_current_user($existing_user_id);
        wp_set_auth_cookie($existing_user_id);

        $download_url = '';
        if (isset($_COOKIE['dm_from_email_download']) && !empty($_COOKIE['dm_from_email_download'])) {
            $report_id = intval($_COOKIE['dm_from_email_download']);
            $download_url = dm_generate_download_url($report_id, 'user_' . $existing_user_id);
        }

        wp_send_json_success([
            'message' => esc_html__('Login successful! Redirecting...', 'innovio_child'),
            'redirect_url' => $redirect_url,
            'download_url' => $download_url,
            'brevo_sync' => $brevo_sync,
            'crm_sync' => $crm_sync
        ]);
    }

    $username = sanitize_user(current(explode('@', $email)));

    $i = 1;
    $original_username = $username;
    while (username_exists($username)) {
        $username = $original_username . $i;
        $i++;
    }

    $user_id = wp_create_user($username, $password, $email);

    if (is_wp_error($user_id)) {
        wp_send_json_error(['message' => $user_id->get_error_message()]);
    }

    wp_update_user([
        'ID' => $user_id,
        'first_name' => $name,
        'display_name' => $name
    ]);

    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);

    $download_url = '';
    if (isset($_COOKIE['dm_from_email_download']) && !empty($_COOKIE['dm_from_email_download'])) {
        $report_id = intval($_COOKIE['dm_from_email_download']);
        $download_url = dm_generate_download_url($report_id, 'user_' . $user_id);
    }

    wp_send_json_success([
        'message' => esc_html__('Registration successful! Redirecting...', 'innovio_child'),
        'redirect_url' => $redirect_url,
        'download_url' => $download_url,
        'brevo_sync' => $brevo_sync,
        'crm_sync' => $crm_sync
    ]);
}
add_action('wp_ajax_nopriv_dm_register_user', 'dm_register_user');
add_action('wp_ajax_dm_register_user', 'dm_register_user');

/**
 * Sync Contact to Brevo API
 */
function dm_sync_brevo_contact($email, $name)
{
    $api_key = defined('DM_BREVO_API_KEY') ? DM_BREVO_API_KEY : '';
    $url = 'https://api.brevo.com/v3/contacts';

    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';
    $list_id = ($current_lang === 'en') ? 15 : 10;

    $data = [
        'email' => $email,
        'updateEnabled' => true,
        'listIds' => [$list_id],
        'attributes' => [
            'FIRSTNAME' => $name
        ]
    ];

    $response = wp_remote_post($url, [
        'headers' => [
            'Content-Type' => 'application/json',
            'api-key' => $api_key
        ],
        'body' => json_encode($data),
        'method' => 'POST',
        'data_format' => 'body'
    ]);

    if (is_wp_error($response)) {
        return ['success' => false, 'message' => $response->get_error_message()];
    }

    $response_code = wp_remote_retrieve_response_code($response);
    $response_body = wp_remote_retrieve_body($response);

    if ($response_code >= 200 && $response_code < 300) {
        return ['success' => true, 'message' => 'Synced to Brevo'];
    } else {
        $error_data = json_decode($response_body, true);
        $error_msg = $error_data['message'] ?? 'HTTP ' . $response_code;
        return ['success' => false, 'message' => $error_msg];
    }
}

/**
 * Sync Lead to CRM API
 */
function dm_sync_crm_leads($email, $name)
{
    $api_url = defined('DM_CRM_API_URL') ? DM_CRM_API_URL : '';
    $authtoken = defined('DM_CRM_API_AUTHTOKEN') ? DM_CRM_API_AUTHTOKEN : '';

    if (empty($api_url) || empty($authtoken)) {
        return ['success' => false, 'message' => 'Missing API URL or Auth Token'];
    }

    $body = [
        'source' => DM_CRM_SOURCE,
        'status' => DM_CRM_STATUS,
        'assigned' => DM_CRM_ASSIGNED,
        'name' => $name,
        'email' => $email,
    ];

    $response = wp_remote_post($api_url, [
        'method' => 'POST',
        'headers' => [
            'authtoken' => $authtoken,
        ],
        'body' => $body,
        'timeout' => 20,
    ]);

    if (is_wp_error($response)) {
        return ['success' => false, 'message' => $response->get_error_message()];
    }

    $response_body = wp_remote_retrieve_body($response);
    $response_data = json_decode($response_body, true);

    if (isset($response_data['status']) && $response_data['status']) {
        return ['success' => true, 'message' => $response_data['message'] ?? 'Synced to CRM'];
    } else {
        $error_msg = $response_data['message'] ?? 'Unknown error';
        return ['success' => false, 'message' => $error_msg];
    }
}



/**
 * Handle Email Link Trigger
 * Checks for trigger=mail params, sets cookies, and redirects to clean URL.
 * Hooked to 'init' to run before headers are sent.
 */
function dm_handle_email_trigger()
{

    if (isset($_GET['utm_source']) && $_GET['utm_source'] === 'unsubscribe' && isset($_GET['email'])) {
        $email = sanitize_email($_GET['email']);

        setcookie('dm_user_email_unsubscribe', $email, time() + 31536000, '/');
        setcookie('dm_from_email_unsubscribe', 'true', time() + 60, '/');

        $current_url = remove_query_arg(['utm_source', 'email']);
        if (wp_redirect($current_url)) {
            exit;
        }
    }

    if (isset($_GET['utm_source']) && $_GET['utm_source'] === 'mail' && isset($_GET['email']) && isset($_GET['user_name'])) {
        $name = sanitize_text_field($_GET['user_name']);
        $email = sanitize_email($_GET['email']);

        setcookie('utm_source', 'mail', time() + 60, '/');
        setcookie('dm_user_name', $name, time() + 31536000, '/');
        setcookie('dm_user_email', $email, time() + 31536000, '/');

        $current_url = remove_query_arg(['utm_source', 'email', 'user_name']);
        $post_id = url_to_postid($current_url);

        if ($post_id && has_category('research', $post_id)) {
            $existing_user_id = email_exists($email);

            if ($existing_user_id) {
                wp_set_current_user($existing_user_id);
                wp_set_auth_cookie($existing_user_id, true);
                $user_identifier = 'user_' . $existing_user_id;
            } else {
                $username = sanitize_user(current(explode('@', $email)));
                $i = 1;
                $original_username = $username;
                while (username_exists($username)) {
                    $username = $original_username . $i;
                    $i++;
                }

                $password = wp_generate_password();
                $user_id = wp_create_user($username, $password, $email);

                if (!is_wp_error($user_id)) {
                    wp_update_user([
                        'ID' => $user_id,
                        'first_name' => $name,
                        'display_name' => $name
                    ]);
                    wp_set_current_user($user_id);
                    wp_set_auth_cookie($user_id, true);
                    $user_identifier = 'user_' . $user_id;
                } else {
                    $user_identifier = 'email_' . $email;
                }
            }

            $download_url = dm_generate_download_url($post_id, $user_identifier);

            if ($download_url) {
                setcookie('dm_auto_download_url', $download_url, time() + 60, '/');
                setcookie('dm_show_thankyou', 'true', time() + 60, '/');

                if (wp_redirect($current_url)) {
                    exit;
                }
            }
        }

        setcookie('dm_from_email', 'true', time() + 60, '/');
        if (wp_redirect($current_url)) {
            exit;
        }
    }
}
add_action('init', 'dm_handle_email_trigger');
function digitalmind_add_unsubscribe_popup()
{
    ?>
    <div class="unsubscribe-popup-overlay" id="unsubscribePopup">
        <div class="unsubscribe-popup-container">
            <button class="unsubscribe-popup-close" id="unsubscribePopupClose">&times;</button>
            <div class="unsubscribe-popup-content">
                <h3 class="unsubscribe-popup-title">
                    <?php echo esc_html__('Unsubscribe', 'innovio_child'); ?>
                </h3>
                <p class="unsubscribe-popup-desc">
                    <?php echo esc_html__('We’re sorry to see you go. Could you tell us why you decided to leave?', 'innovio_child'); ?>
                </p>

                <form id="dm_unsub_form" class="dm-unsub-form">
                    <?php wp_nonce_field('dm_unsub_nonce', 'dm_unsub_nonce_field'); ?>

                    <div class="dm-radio-group">
                        <label class="dm-radio-option">
                            <input type="radio" name="unsub_reason" value="too_many_morning_brew">
                            <span>
                                <?php echo esc_html__('I was getting too many newsletters from Morning Brew brands', 'innovio_child'); ?>
                            </span>
                        </label>
                        <label class="dm-radio-option">
                            <input type="radio" name="unsub_reason" value="too_many_general">
                            <span>
                                <?php echo esc_html__('I get too many newsletters in general', 'innovio_child'); ?>
                            </span>
                        </label>
                        <label class="dm-radio-option">
                            <input type="radio" name="unsub_reason" value="not_useful">
                            <span>
                                <?php echo esc_html__('I did not find the content useful', 'innovio_child'); ?>
                            </span>
                        </label>
                        <label class="dm-radio-option">
                            <input type="radio" name="unsub_reason" value="not_expected">
                            <span>
                                <?php echo esc_html__('The content is not what I expected it to be when I signed up', 'innovio_child'); ?>
                            </span>
                        </label>
                        <label class="dm-radio-option">
                            <input type="radio" name="unsub_reason" value="biased">
                            <span>
                                <?php echo esc_html__('I found the content to be too politically biased', 'innovio_child'); ?>
                            </span>
                        </label>
                        <label class="dm-radio-option">
                            <input type="radio" name="unsub_reason" value="switched_email">
                            <span>
                                <?php echo esc_html__('I switched my subscription email', 'innovio_child'); ?>
                            </span>
                        </label>
                        <label class="dm-radio-option">
                            <input type="radio" name="unsub_reason" value="podcast">
                            <span>
                                <?php echo esc_html__('I am now listening to the podcast instead', 'innovio_child'); ?>
                            </span>
                        </label>
                        <label class="dm-radio-option">
                            <input type="radio" name="unsub_reason" value="Other">
                            <span>
                                <?php echo esc_html__('Other', 'innovio_child'); ?>
                            </span>
                        </label>
                    </div>

                    <!-- Hidden input for "Other" text -->
                    <div class="dm-other-reason-input" style="display:none; margin-top: 10px;">
                        <input type="text" name="other_reason_text"
                            placeholder="<?php echo esc_attr__('Please specify...', 'innovio_child'); ?>"
                            style="width: 100%; padding: 8px;">
                    </div>

                    <div class="dm-form-actions" style="margin-top: 20px; text-align: center;">
                        <button type="submit" class="dm-submit-btn dm-unsub-submit-btn">
                            <?php echo esc_html__('Hủy', 'innovio_child'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'digitalmind_add_unsubscribe_popup');
function dm_filter_archive_header_widget_meta($value, $object_id, $meta_key, $single)
{
    if (!is_archive() && !is_search() && !is_home() && !is_single()) {
        return $value;
    }

    if ($meta_key !== 'mkdf_custom_header_widget_area_one_meta') {
        return $value;
    }

    return $single ? 'shop-widget' : ['shop-widget'];
}
add_filter('get_post_metadata', 'dm_filter_archive_header_widget_meta', 10, 4);

/**
 * AJAX: Generate one-time secure download token
 * Token expires in 5 minutes and can only be used once
 */
function dm_get_secure_download_link()
{
    check_ajax_referer('dm_download_nonce', 'nonce');

    $has_email_verified = isset($_COOKIE['dm_user_email']) && !empty($_COOKIE['dm_user_email']);

    if (!is_user_logged_in() && !$has_email_verified) {
        wp_send_json_error(['message' => __('Please login to download', 'innovio_child')]);
    }

    $report_id = intval($_POST['report_id'] ?? 0);
    if (empty($report_id)) {
        wp_send_json_error(['message' => __('Invalid report', 'innovio_child')]);
    }

    $download_url = get_field('link_for_report', $report_id);
    if (empty($download_url)) {
        wp_send_json_error(['message' => __('Download not available', 'innovio_child')]);
    }

    $token = wp_generate_password(32, false);

    $user_identifier = '';
    if (is_user_logged_in()) {
        $user_identifier = 'user_' . get_current_user_id();
    } elseif (isset($_COOKIE['dm_user_email'])) {
        $user_identifier = 'email_' . sanitize_email($_COOKIE['dm_user_email']);
    }

    $token_data = [
        'report_id' => $report_id,
        'user_identifier' => $user_identifier,
        'created_at' => time()
    ];
    set_transient('dm_download_token_' . $token, $token_data, 5 * MINUTE_IN_SECONDS);

    $download_page_url = get_stylesheet_directory_uri() . '/dm-download.php?token=' . $token;

    wp_send_json_success(['download_url' => $download_page_url]);
}
add_action('wp_ajax_dm_get_secure_download_link', 'dm_get_secure_download_link');
add_action('wp_ajax_nopriv_dm_get_secure_download_link', 'dm_get_secure_download_link');
