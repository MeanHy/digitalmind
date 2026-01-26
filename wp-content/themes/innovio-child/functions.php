<?php
require_once get_stylesheet_directory() . '/constant.php';
add_action('after_setup_theme', function () {
    if (is_user_logged_in() && !current_user_can('administrator')) {
        show_admin_bar(false);
    }
});
if (!function_exists('innovio_mikado_child_theme_enqueue_scripts')) {
    function innovio_mikado_child_theme_enqueue_scripts()
    {
        $parent_style = 'innovio-mikado-default-style';

        wp_enqueue_style('innovio-mikado-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style), '2.0.1');
        wp_enqueue_style('digitalmind-child-style-anne', get_stylesheet_directory_uri() . '/assets/css/style-anne.css');
        wp_enqueue_style('digitalmind-child-style-henry', get_stylesheet_directory_uri() . '/assets/css/style-henry.css');
        wp_enqueue_script('digitalmind-child-script-henry', get_stylesheet_directory_uri() . '/assets/js/script-henry.js', array('jquery'), '1.0.1', true);

        $report_link = '';
        if (is_page('dang-ky-thanh-cong') || is_page('thanks-you-for-subscribe')) {
            $report_id = isset($_GET['report_id']) ? intval($_GET['report_id']) : 0;
            if ($report_id) {
                $report_link = get_field('link_for_report', $report_id);
                $report_link = trim((string) $report_link);
            }
        }

        $social_login_data = array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'download_nonce' => wp_create_nonce('dm_download_nonce'),
            'current_report_id' => isset($_GET['report_id']) ? intval($_GET['report_id']) : 0,
            'is_logged_in' => is_user_logged_in(),
            'lang_key' => array(
                'confirm' => esc_html__('Confirm', 'innovio_child'),
                'cancel' => esc_html__('Cancel', 'innovio_child'),
                'processing' => esc_html__('Processing...', 'innovio_child'),
                'server_error' => esc_html__('Server error. Please try again.', 'innovio_child'),
                'thank_you_downloading' => esc_html__('Thank you! Downloading document...', 'innovio_child'),
                'fill_all_fields' => esc_html__('Please fill in all fields!', 'innovio_child'),
                'login_success_reloading' => esc_html__('Login successful! Reloading...', 'innovio_child'),
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
 * Add "Đăng ký" menu item to main navigation
 */
function digitalmind_add_subscribe_menu_item($items, $args)
{
    if ($args->theme_location == 'main-navigation') {
        $subscribe_text = esc_html__('SIGN UP TO RECEIVE THE REPORT', 'innovio_child');

        $subscribe_item = '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-subscribe narrow">
            <a href="#research-popup" target="_self" class="subscribe-btn">
                <span class="subscribe-btn-text">' . esc_html($subscribe_text) . '</span>
            </a>
        </li>';
        $items .= $subscribe_item;
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'digitalmind_add_subscribe_menu_item', 10, 2);

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
            <button type="button" class="btn-download-research" id="btnDownloadResearch">
                <span class="download-icon">⬇</span>
                ' . esc_html__('Download Now', 'innovio_child') . '
            </button>
        </div>
    </div>';
    return $content . $download_section;
}
add_filter('the_content', 'digitalmind_add_research_download_form');

/**
 * Add Popup Form to footer (only on research posts)
 */
function digitalmind_add_research_popup_form()
{
    ?>
    <div class="research-popup-overlay" id="researchPopup">
        <div class="research-popup-container">
            <button class="research-popup-close" id="researchPopupClose">&times;</button>
            <div class="research-popup-content">
                <h3 class="research-popup-title">
                    <?php echo esc_html__('Sign up to download', 'innovio_child'); ?>
                </h3>
                <p class="research-popup-desc">
                    <?php echo esc_html__('Please provide your information to access the document', 'innovio_child'); ?>
                </p>
                <!-- Custom Registration Form -->
                <form id="dm-research-register-form" class="dm-register-form" method="post">
                    <div class="form-group">
                        <input type="text" name="user_name"
                            placeholder="<?php echo esc_attr__('Full Name', 'innovio_child'); ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="user_email"
                            placeholder="<?php echo esc_attr__('Email Address', 'innovio_child'); ?>" required>
                    </div>

                    <input type="hidden" name="current_post_id" value="<?php echo get_the_ID(); ?>">
                    <?php wp_nonce_field('dm_register_action', 'dm_register_nonce'); ?>

                    <button type="submit" class="dm-submit-btn">
                        <?php echo esc_html__('Sign Up & Download', 'innovio_child'); ?>
                    </button>
                </form>

                <!-- Social Login Divider -->
                <div class="research-popup-divider">
                    <span><?php echo esc_html__('or', 'innovio_child'); ?></span>
                </div>

                <!-- Social Icons -->
                <?php
                $popup_redirect_url = site_url('?social_login_mode=popup');

                $fb_login_url = site_url('/wp-login.php?loginSocial=facebook&redirect=' . urlencode($popup_redirect_url));
                $google_login_url = site_url('/wp-login.php?loginSocial=google&redirect=' . urlencode($popup_redirect_url));
                ?>
                <div class="research-popup-social">
                    <a href="<?php echo esc_url($fb_login_url); ?>" class="social-icon-btn social-facebook popup-trigger"
                        title="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="<?php echo esc_url($google_login_url); ?>" class="social-icon-btn social-gmail popup-trigger"
                        title="Google">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.91 1.528-1.145C21.69 2.28 24 3.434 24 5.457z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'digitalmind_add_research_popup_form');

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

        $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';
        $redirect_path = ($current_lang === 'en') ? '/en/thanks-you-for-subscribe/' : '/dang-ky-thanh-cong/';
        $redirect_url = site_url($redirect_path);

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
            <script>         if (window.opener) { window.opener.postMessage('social_login_success', '*'); window.close(); } else { window.location.href = '<?php echo esc_url($redirect_url); ?>'; }
            </script>
        </body>

        </html>
        <?php
        exit;
    }
}
add_action('template_redirect', 'dm_social_login_callback');

/**
 * Handle AJAX User Registration
 */
function dm_register_user()
{
    check_ajax_referer('dm_register_action', 'dm_register_nonce');

    if (is_user_logged_in() && isset($_POST['is_logged_in_action']) && $_POST['is_logged_in_action'] === '1') {
        $current_post_id = isset($_POST['current_post_id']) ? intval($_POST['current_post_id']) : 0;

        $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';
        $redirect_path = ($current_lang === 'en') ? '/en/thanks-you-for-subscribe/' : '/dang-ky-thanh-cong/';
        $redirect_url = site_url($redirect_path);

        if ($current_post_id) {
            $redirect_url = add_query_arg('report_id', $current_post_id, $redirect_url);
        }

        wp_send_json_success(['message' => esc_html__('Confirmed! Redirecting...', 'innovio_child'), 'redirect_url' => $redirect_url]);
    }

    $name = sanitize_text_field($_POST['user_name']);
    $email = sanitize_email($_POST['user_email']);
    $password = wp_generate_password();

    if (empty($name) || empty($email)) {
        wp_send_json_error(['message' => esc_html__('Please fill in all fields.', 'innovio_child')]);
    }

    $existing_user_id = email_exists($email);

    dm_sync_brevo_contact($email, $name);
    $current_post_id = isset($_POST['current_post_id']) ? intval($_POST['current_post_id']) : 0;
    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';
    $redirect_path = ($current_lang === 'en') ? '/en/thanks-you-for-subscribe/' : '/dang-ky-thanh-cong/';
    $redirect_url = site_url($redirect_path);

    if ($current_post_id) {
        $redirect_url = add_query_arg('report_id', $current_post_id, $redirect_url);
    }

    if ($existing_user_id) {
        wp_set_current_user($existing_user_id);
        wp_set_auth_cookie($existing_user_id);
        wp_send_json_success(['message' => esc_html__('Login successful! Redirecting...', 'innovio_child'), 'redirect_url' => $redirect_url]);
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
    wp_send_json_success(['message' => esc_html__('Registration successful! Redirecting...', 'innovio_child'), 'redirect_url' => $redirect_url]);
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

    $data = [
        'email' => $email,
        'updateEnabled' => true,
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

    // Uncomment for debugging
    if (is_wp_error($response)) {
        error_log('Brevo Sync Error: ' . $response->get_error_message());
    }
}



/**
 * Handle Email Link Trigger
 * Checks for trigger=mail params, sets cookies, and redirects to clean URL.
 * Hooked to 'init' to run before headers are sent.
 */
function dm_handle_email_trigger()
{
    if (isset($_GET['trigger']) && $_GET['trigger'] === 'mail' && isset($_GET['email']) && isset($_GET['user_name'])) {
        $name = sanitize_text_field($_GET['user_name']);
        $email = sanitize_email($_GET['email']);

        setcookie('dm_user_name', $name, time() + 31536000, '/');
        setcookie('dm_user_email', $email, time() + 31536000, '/');

        $current_url = remove_query_arg(['trigger', 'email', 'user_name']);

        if (wp_redirect($current_url)) {
            exit;
        }
    }
}
add_action('init', 'dm_handle_email_trigger');
function digitalmind_add_unsubscribe_popup()
{
    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';
    $form_id = ($current_lang === 'en') ? 'b5b7d98' : '14a4451';
    $form_shortcode = do_shortcode('[contact-form-7 id="' . $form_id . '"]');

    ?>
    <div class="unsubscribe-popup-overlay" id="unsubscribePopup">
        <div class="unsubscribe-popup-container">
            <button class="unsubscribe-popup-close" id="unsubscribePopupClose">&times;</button>
            <div class="unsubscribe-popup-content">
                <h3 class="unsubscribe-popup-title">
                    <?php echo esc_html__('Unsubscribe', 'innovio_child'); ?>
                </h3>
                <p class="unsubscribe-popup-desc">
                    <?php echo esc_html__('We are sorry to see you go. Please confirm your email to unsubscribe.', 'innovio_child'); ?>
                </p>
                <?php echo $form_shortcode; ?>
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
    // Verify nonce
    check_ajax_referer('dm_download_nonce', 'nonce');

    // Must be "logged in" (have verified email cookie)
    $is_verified = isset($_COOKIE['research_email_verified']) && $_COOKIE['research_email_verified'] === 'true';
    if (!$is_verified && !is_user_logged_in()) {
        wp_send_json_error(['message' => __('Please register to download', 'innovio_child')]);
    }

    $report_id = intval($_POST['report_id'] ?? 0);
    if (empty($report_id)) {
        wp_send_json_error(['message' => __('Invalid report', 'innovio_child')]);
    }

    // Verify report exists and has download link
    $download_url = get_field('link_for_report', $report_id);
    if (empty($download_url)) {
        wp_send_json_error(['message' => __('Download not available', 'innovio_child')]);
    }

    // Generate unique token
    $token = wp_generate_password(32, false);

    // Get user identifier (email from cookie or user ID)
    $user_identifier = '';
    if (is_user_logged_in()) {
        $user_identifier = 'user_' . get_current_user_id();
    } elseif (isset($_COOKIE['dm_user_email'])) {
        $user_identifier = 'email_' . sanitize_email($_COOKIE['dm_user_email']);
    }

    // Store token data in transient (expires in 5 minutes)
    $token_data = [
        'report_id' => $report_id,
        'user_identifier' => $user_identifier,
        'created_at' => time()
    ];
    set_transient('dm_download_token_' . $token, $token_data, 5 * MINUTE_IN_SECONDS);

    // Build download URL
    $download_page_url = get_stylesheet_directory_uri() . '/dm-download.php?token=' . $token;

    wp_send_json_success(['download_url' => $download_page_url]);
}
add_action('wp_ajax_dm_get_secure_download_link', 'dm_get_secure_download_link');
add_action('wp_ajax_nopriv_dm_get_secure_download_link', 'dm_get_secure_download_link');

