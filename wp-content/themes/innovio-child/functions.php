<?php

/*** Child Theme Function  ***/

/**
 * Capture email from Nextend Social Login provider
 * Using multiple hooks to ensure we get the RIGHT email from provider
 */

// Hook to capture email from registration data (contains actual provider email)
add_filter('nsl_registration_user_data', 'digitalmind_capture_provider_email', 10, 2);
function digitalmind_capture_provider_email($user_data, $provider)
{
    // $user_data contains: username, email, first_name, last_name
    if (!empty($user_data['email'])) {
        // Store provider email in session/transient with a unique key
        set_transient('nsl_provider_email_pending', $user_data['email'], 5 * MINUTE_IN_SECONDS);
    }
    return $user_data;
}

// Hook after login to transfer email to user-specific transient
add_action('nsl_login', 'digitalmind_transfer_provider_email', 10, 1);
add_action('nsl_register_new_user', 'digitalmind_transfer_provider_email', 10, 1);

function digitalmind_transfer_provider_email($user_id)
{
    // Check if we have a pending provider email
    $provider_email = get_transient('nsl_provider_email_pending');

    if ($provider_email) {
        // Transfer to user-specific transient
        set_transient('nsl_social_email_' . $user_id, $provider_email, 5 * MINUTE_IN_SECONDS);
        delete_transient('nsl_provider_email_pending');
    } else {
        // Fallback: try to get from link data (for existing linked accounts)
        if (class_exists('NextendSocialLogin')) {
            // For existing users, we might need to get from provider's stored data
            // Get all linked providers
            $linked_providers = get_user_meta($user_id);
            foreach ($linked_providers as $key => $value) {
                if (strpos($key, 'nsl_') === 0 && strpos($key, '_id') !== false) {
                    $provider_name = str_replace(['nsl_', '_id'], '', $key);
                    // Check for stored email from this provider
                    $stored_email = get_user_meta($user_id, 'nsl_' . $provider_name . '_email', true);
                    if ($stored_email) {
                        set_transient('nsl_social_email_' . $user_id, $stored_email, 5 * MINUTE_IN_SECONDS);
                        break;
                    }
                }
            }
        }
    }
}

if (!function_exists('innovio_mikado_child_theme_enqueue_scripts')) {
    function innovio_mikado_child_theme_enqueue_scripts()
    {
        $parent_style = 'innovio-mikado-default-style';

        wp_enqueue_style('innovio-mikado-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style), '2.0.1');
        wp_enqueue_style('digitalmind-child-style-anne', get_stylesheet_directory_uri() . '/assets/css/style-anne.css');
        wp_enqueue_style('digitalmind-child-style-henry', get_stylesheet_directory_uri() . '/assets/css/style-henry.css');
        wp_enqueue_script('digitalmind-child-script-henry', get_stylesheet_directory_uri() . '/assets/js/script-henry.js', array('jquery'), '1.0.1', true);

        // Get email from social login transient or current user
        $user_email = '';
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            // First check if there's a social login email in transient
            $social_email = get_transient('nsl_social_email_' . $user_id);
            if ($social_email) {
                $user_email = $social_email;
                // Delete the transient after use
                delete_transient('nsl_social_email_' . $user_id);
            } else {
                $user_email = wp_get_current_user()->user_email;
            }
        }

        // Localize script with social login data for Brevo sync
        $social_login_data = array(
            'userEmail' => $user_email,
            'isLoggedIn' => is_user_logged_in(),
        );
        wp_localize_script('digitalmind-child-script-henry', 'socialLoginData', $social_login_data);
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
    if (!is_singular('post') || !has_category('research')) {
        return;
    }

    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';
    $form_id = ($current_lang === 'en') ? '4' : '3';
    $form_shortcode = do_shortcode('[sibwp_form id=' . $form_id . ']');

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
                <?php echo $form_shortcode; ?>

                <!-- Social Login Divider -->
                <div class="research-popup-divider">
                    <span><?php echo esc_html__('or', 'innovio_child'); ?></span>
                </div>

                <!-- Social Icons -->
                <?php
                $current_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                $redirect_url = add_query_arg('social_login', 'success', $current_url);
                $fb_login_url = site_url('/wp-login.php?loginSocial=facebook&redirect=' . urlencode($redirect_url));
                $google_login_url = site_url('/wp-login.php?loginSocial=google&redirect=' . urlencode($redirect_url));
                ?>
                <div class="research-popup-social">
                    <a href="<?php echo esc_url($fb_login_url); ?>" class="social-icon-btn social-facebook"
                        title="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="<?php echo esc_url($google_login_url); ?>" class="social-icon-btn social-gmail" title="Google">
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
 * Add Subscribe Popup to all pages
 * Shows popup with Brevo form when clicking "Đăng ký" menu item
 */
function digitalmind_add_subscribe_popup()
{
    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';
    $form_id = ($current_lang === 'en') ? '4' : '3';
    $form_shortcode = do_shortcode('[sibwp_form id=' . $form_id . ']');

    ?>
    <div class="subscribe-popup-overlay" id="subscribePopup">
        <div class="subscribe-popup-container">
            <button class="subscribe-popup-close" id="subscribePopupClose">&times;</button>
            <div class="subscribe-popup-content">
                <h3 class="subscribe-popup-title">
                    <?php echo esc_html__('Subscribe to Newsletter', 'innovio_child'); ?>
                </h3>
                <p class="subscribe-popup-desc">
                    <?php echo esc_html__('Stay updated with our latest news and offers', 'innovio_child'); ?>
                </p>
                <?php echo $form_shortcode; ?>
                <!-- Social Login Divider -->
                <div class="research-popup-divider">
                    <span><?php echo esc_html__('or', 'innovio_child'); ?></span>
                </div>

                <!-- Social Icons -->
                <?php
                $current_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                $redirect_url = add_query_arg('social_login', 'success', $current_url);
                $fb_login_url = site_url('/wp-login.php?loginSocial=facebook&redirect=' . urlencode($redirect_url));
                $google_login_url = site_url('/wp-login.php?loginSocial=google&redirect=' . urlencode($redirect_url));
                ?>
                <div class="research-popup-social">
                    <a href="<?php echo esc_url($fb_login_url); ?>" class="social-icon-btn social-facebook"
                        title="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="<?php echo esc_url($google_login_url); ?>" class="social-icon-btn social-gmail" title="Google">
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
add_action('wp_footer', 'digitalmind_add_subscribe_popup');

/**
 * Add Unsubscribe Popup to all pages
 * Shows popup when URL has ?email=resubscribe
 */
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

/**
 * Add "Đăng ký" menu item to main navigation
 */
function digitalmind_add_subscribe_menu_item($items, $args)
{
    if ($args->theme_location == 'main-navigation') {
        $subscribe_text = esc_html__('SIGN UP TO RECEIVE THE REPORT', 'innovio_child');

        $subscribe_item = '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-subscribe narrow">
            <a href="#subscribe-popup" target="_self" class="subscribe-btn">
                <span class="subscribe-btn-text">' . esc_html($subscribe_text) . '</span>
            </a>
        </li>';
        $items .= $subscribe_item;
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'digitalmind_add_subscribe_menu_item', 10, 2);
