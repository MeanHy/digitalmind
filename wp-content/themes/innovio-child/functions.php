<?php

/*** Child Theme Function  ***/

if (!function_exists('innovio_mikado_child_theme_enqueue_scripts')) {
    function innovio_mikado_child_theme_enqueue_scripts()
    {
        $parent_style = 'innovio-mikado-default-style';

        wp_enqueue_style('innovio-mikado-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style), '2.0.1');
        wp_enqueue_style('digitalmind-child-style-anne', get_stylesheet_directory_uri() . '/assets/css/style-anne.css');
        wp_enqueue_style('digitalmind-child-style-henry', get_stylesheet_directory_uri() . '/assets/css/style-henry.css');
        wp_enqueue_script('digitalmind-child-script-henry', get_stylesheet_directory_uri() . '/assets/js/script-henry.js', array('jquery'), '1.0.0', true);
    }

    add_action('wp_enqueue_scripts', 'innovio_mikado_child_theme_enqueue_scripts');
}

add_action('wp_footer', 'digitalmind_include_toast_notification');
function digitalmind_include_toast_notification()
{
    if (!is_singular('post') || !has_category('research')) {
        return;
    }
    include get_stylesheet_directory() . '/templates/toast-notification.php';
}

/**
 * Show Download Button at the end of Research category posts
 * Button triggers popup form if not verified
 */
add_filter('the_content', 'digitalmind_add_research_download_form');
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

/**
 * Add Popup Form to footer (only on research posts)
 */
add_action('wp_footer', 'digitalmind_add_research_popup_form');
function digitalmind_add_research_popup_form()
{
    if (!is_singular('post') || !has_category('research')) {
        return;
    }

    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';
    $form_id = ($current_lang === 'en') ? '6821' : '6822';
    $form_shortcode = do_shortcode('[contact-form-7 id="' . $form_id . '" title="Download Form"]');

    ?>
    <!-- Research Download Popup -->
    <div class="research-popup-overlay" id="researchPopup">
        <div class="research-popup-container">
            <button class="research-popup-close" id="researchPopupClose">&times;</button>
            <div class="research-popup-content">
                <h3 class="research-popup-title">
                    <?php echo esc_html__('Fill in to Download', 'innovio_child'); ?>
                </h3>
                <p class="research-popup-desc">
                    <?php echo esc_html__('Please provide your information to access the document', 'innovio_child'); ?>
                </p>
                <?php echo $form_shortcode; ?>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Add Subscribe Popup to all pages
 * Shows popup with Brevo form when clicking "Đăng ký" menu item
 */
add_action('wp_footer', 'digitalmind_add_subscribe_popup');
function digitalmind_add_subscribe_popup()
{
    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';
    $form_id = ($current_lang === 'en') ? '6' : '5';
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
            </div>
        </div>
    </div>
    <?php
}

/**
 * Add "Đăng ký" menu item to main navigation
 */
add_filter('wp_nav_menu_items', 'digitalmind_add_subscribe_menu_item', 10, 2);
function digitalmind_add_subscribe_menu_item($items, $args)
{
    if ($args->theme_location == 'main-navigation') {
        $subscribe_text = esc_html__('Subscribe', 'innovio_child');
        $svg_arrow = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 9" style="enable-background:new 0 0 26 9;" xml:space="preserve">
                    <path d="M26,4.7C26,4.6,26,4.4,26,4.3c0-0.1-0.1-0.1-0.1-0.2l-3.5-3.5c-0.2-0.2-0.5-0.2-0.7,0s-0.2,0.5,0,0.7L24.3,4
                    H0.5C0.2,4,0,4.2,0,4.5S0.2,5,0.5,5h23.8l-2.7,2.7c-0.2,0.2-0.2,0.5,0,0.7c0.1,0.1,0.2,0.1,0.4,0.1s0.3,0,0.4-0.1l3.5-3.5
                    C25.9,4.8,25.9,4.8,26,4.7z"></path>
                </svg>';

        $subscribe_item = '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-subscribe narrow">
            <a href="#subscribe-popup" class="">
                <span class="item_outer">
                    <span class="item_text">' . $svg_arrow . esc_html($subscribe_text) . '</span>
                </span>
            </a>
        </li>';
        $items .= $subscribe_item;
    }
    return $items;
}
