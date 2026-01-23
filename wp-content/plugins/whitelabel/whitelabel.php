<?php
/*
Plugin Name: Whitelabel
Plugin URI:
Description:
Version: 1.0.2
Author: Duane Do
*/
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
class Custom_Class
{
    public function __construct()
    {
        add_action('init', array($this, 'load_file'));
    }
    public function load_file()
    {
        $plugins_array = $this->load_files_client();
        // wp_enqueue_script( 'jquery3.6.0', plugins_url('assets/js/jquery-3.6.0.min.js',__FILE__), array ( 'jquery' ), 1.0, true);
        require_once plugin_dir_path(__FILE__) . "plugin/global.php";
        require_once plugin_dir_path(__FILE__) . "plugin/replace-admin-menu-icons.php";
        require_once plugin_dir_path(__FILE__) . "plugin/customize_post_admin_labels.php";
        if (in_array('admin-theme/mtrl-core.php', $plugins_array) || array_key_exists('admin-theme/mtrl-core.php', $plugins_array)) {
            require_once plugin_dir_path(__FILE__) . "plugin/mtrl-core.php";
        }
    }
    public static function load_files_client()
    {
        $site_plugin_active = get_option('active_plugins');
        $network_active_plugins = (array) get_site_option('active_sitewide_plugins', array());
        $network_active_plugins = array_keys($network_active_plugins);
        $plugin_active = array_merge($site_plugin_active, $network_active_plugins);
        return $plugin_active;
    }
}
new Custom_Class();

function allin1()
{
    global $menu;
    $plugins_array = Custom_Class::load_files_client();

    $user = wp_get_current_user();
    $allowed_roles = array('editor', 'author', 'shop_manager');
    $ver_css = '?ver=4.0.0';
    $link_css = 'assets/css';
    $main_link_css = plugin_dir_url(__FILE__) . $link_css;
    $link_js = 'wp-content/plugins/whitelabel/assets/js';
    $main_link_js = get_site_url(null, $link_js);

    /* admin translate */
    if (in_array('sitepress-multilingual-cms/sitepress.php', $plugins_array) || array_key_exists('sitepress-multilingual-cms/sitepress.php.php', $plugins_array)) {
        $current_language_code = apply_filters('wpml_current_language', null);
        if ($current_language_code == 'vi') {
            wp_enqueue_script('admin-lang', plugins_url('assets/js/admin-translate-vi.js', __FILE__), array('jquery'), 1.3, true);
        } elseif ($current_language_code == 'en') {
            wp_enqueue_script('admin-lang', plugins_url('assets/js/admin-translate-en.js', __FILE__), array('jquery'), 1.3, true);
        }
    }


    if (in_array('b2bking/b2bking.php', $plugins_array) || array_key_exists('b2bking/b2bking.php', $plugins_array)) {
        ?>
        <script>
            jQuery(function ($) {
                $(document).ready(function () {
                    $("#woocommerce-product-data .inside .panel-wrap.product_data .product_data_tabs.wc-tabs .b2bking_options a span").html("<?php echo __('B2BKing', 'mtrl_framework') ?>")
                })
            })
        </script>
        <?php
        if (strpos($_SERVER['REQUEST_URI'], 'b2bking') !== false) {
            // Account custom b2bking
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        }
        // Admin layout B2BKing plugin option
        // if (strpos($_SERVER['REQUEST_URI'], 'b2bking') !== false) {
        //   if (array_intersect($allowed_roles, $user->roles)) {
        //     wp_enqueue_style( 'customize-b2bking', plugins_url('/assets/css/b2bking.css',__FILE__ ));
        //   }
        // }
    }

    if (in_array('dokan-pro/dokan-pro.php', $plugins_array) || array_key_exists('dokan-pro/dokan-pro.php', $plugins_array)) {
        // if (array_intersect($allowed_roles, $user->roles)) {
        //   wp_enqueue_style( 'customize-salesking', plugins_url('/assets/css/salesking.css',__FILE__ ));
        // }
        // wp_enqueue_style( 'customize-salesking', plugins_url('/assets/css/salesking.css',__FILE__ ));
        //Admin layout Dokan plugin option
        if (strpos($_SERVER['REQUEST_URI'], 'dokan') !== false) {
            // if (array_intersect($allowed_roles, $user->roles)) {
            //   wp_enqueue_style( 'customize-salesking', plugins_url('/assets/css/salesking.css',__FILE__ ));
            // }
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
            ?>
            <style>
                #bulk-action-selector-top {
                    min-width: 200px !important;
                }

                .dokan-vendor-single .vendor-header .profile-banner,
                .dokan-vendor-single .vendor-header .profile-banner img {
                    height: 480px !important;
                }

                .tools-page div:nth-child(2) {
                    display: none;
                }
            </style>
            <?php
        }
    }

    if (in_array('hide-my-wp/index.php', $plugins_array) || array_key_exists('hide-my-wp/index.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'network') !== false) {
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        }
    }

    if (in_array('js_composer/js_composer.php', $plugins_array) || array_key_exists('js_composer/js_composer.php', $plugins_array)) {
        echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
    }

    if (in_array('login-by-zalo/login-by-zalo.php', $plugins_array) || array_key_exists('login-by-zalo/login-by-zalo.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'login-by-zalo') !== false) {
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        }
    }

    if (in_array('revslider/revslider.php', $plugins_array) || array_key_exists('revslider/revslider.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'revslider&view') !== false) {
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-two.css$ver_css'>";
            echo "<script src='$main_link_js/rebuil_overview_revslider.js'></script>";
        }
        if (strpos($_SERVER['REQUEST_URI'], 'revslider') !== false) {
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
            // wp_enqueue_style( 'customize-revslider', plugins_url('/assets/css/revslider.css',__FILE__ ));
            // wp_enqueue_script( 'script-cus-revsilder', plugin_dir_url(__FILE__). 'js/rebuil_overview_revslider.js', array ( 'jquery' ), 1.1, true);

            if (array_intersect($allowed_roles, $user->roles)) {
                echo "<link rel='stylesheet' href='$main_link_css/admin-global-two.css$ver_css'>";
            }
        }
    }

    if (in_array('salesking/salesking.php', $plugins_array) || array_key_exists('salesking/salesking.php', $plugins_array)) {
        // wp_enqueue_style( 'customize-salesking', plugins_url('/assets/css/salesking.css',__FILE__ ));
        //Admin layout SalesKing plugin option
        if (strpos($_SERVER['REQUEST_URI'], 'salesking') !== false) {
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        }
    }

    if (in_array('social-auto-poster/social-auto-poster.php', $plugins_array) || array_key_exists('social-auto-poster/social-auto-poster.php', $plugins_array)) {
        echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
    }

    if (in_array('updraftplus/updraftplus.php', $plugins_array) || array_key_exists('updraftplus/updraftplus.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'updraftplus') !== false) {
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        }
    }

    if (in_array('wordpress-seo/wp-seo.php', $plugins_array) || array_key_exists('wordpress-seo/wp-seo.php', $plugins_array)) {
        echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        //echo "<link rel='stylesheet' href='$main_link_js/wp-seo.js'>";
    }

    if (in_array('wp-optimize/wp-optimize.php', $plugins_array) || array_key_exists('wp-optimize/wp-optimize.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'WP-Optimize') !== false || strpos($_SERVER['REQUEST_URI'], 'wpo_') !== false) {
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        }
    }

    if (in_array('wp-ultimo/wp-ultimo.php', $plugins_array) || array_key_exists('wp-ultimo/wp-ultimo.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], '/network/')) {
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        }

        if (strpos($_SERVER['REQUEST_URI'], 'ec-admin') !== false) {
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        }
    }

    if (in_array('WP_UltimateToursBuilder/UltimateToursBuilder.php', $plugins_array) || array_key_exists('WP_UltimateToursBuilder/UltimateToursBuilder.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'wutb_menu') !== false) {
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        }
    }

    if (in_array('wpbingo/wpbingo.php', $plugins_array) || array_key_exists('wpbingo/wpbingo.php', $plugins_array)) {
        echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
    }


    if (in_array('woocommerce/woocommerce.php', $plugins_array) || array_key_exists('woocommerce/woocommerce.php', $plugins_array)) {
        require_once plugin_dir_path(__FILE__) . "plugin/woocommerce.php";
        echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        //if($pagenow == 'options-general.php'){}
        $target_pages = array("woocommerce-marketing", "shop_coupon", "wc-admin", "woocommerce", "shop_order", "coupons-moved", "wc-reports", "wc-settings", "wc-status", "wc-addons", "wpml-wcml", "post_type=product", "taxonomy=product_cat", "taxonomy=product_tag", "product_attributes", "product_importer", "product_exporter");
        foreach ($target_pages as $url) {
            if (strpos($_SERVER['REQUEST_URI'], $url) !== false) {
                echo "<link rel='stylesheet' href='$main_link_css/admin-global-two.css$ver_css'>";
            }
            break;
        }
    }

    //Plugin product import/export
    if (in_array('product-import-export-for-woo/product-import-export-for-woo.php', $plugins_array) || array_key_exists('product-import-export-for-woo/product-import-export-for-woo.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'admin.php?page=wt_import_export_for_woo_basic_export') !== false) {
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        }
    }

    //Plugin product import/export
    if (in_array('users-customers-import-export-for-wp-woocommerce/users-customers-import-export-for-wp-woocommerce.php', $plugins_array) || array_key_exists('users-customers-import-export-for-wp-woocommerce/users-customers-import-export-for-wp-woocommerce.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'admin.php?page=wt_import_export_for_woo_basic_import') !== false) {
            //use 1 css file
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        }
    }

    if (in_array('admin-theme/mtrl-core.php', $plugins_array) || array_key_exists('admin-theme/mtrl-core.php', $plugins_array)) {
        require_once plugin_dir_path(__FILE__) . "plugin/mtrl-core.php";
        //Hide notification for user whose role's not super/network admin and site_administrator
        //Hide_update_noticee_to_all_but_admin_users();
        //admin layout fix, customized
        // if (strpos($_SERVER['REQUEST_URI'], 'post') !== false) {
        //     wp_enqueue_style('customize-mtrl-js', plugins_url('/assets/js/mtrl.js', __FILE__));
        // }
        if (strpos($_SERVER['REQUEST_URI'], 'shop_coupon') !== FALSE) {
            ?>
            <style>
                #coupon-root {
                    display: none !important
                }
            </style>
            <?php
        }
        //replacing WC, WPML, and Maintain Multisite icons on Admin Menu within both Site Admin and Network Admin with appropriate icon within Dashicons font
        //remove_admin_footer_text();
        if (!is_super_admin()) {
            remove_all_actions('admin_notices');
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        }
    }

    /* Chat Bot */
    if (in_array('woowbot-woocommerce-chatbot-pro/qcld-woowbot.php', $plugins_array) || in_array('woowbot-woocommerce-chatbot-pro/qcld-woowbot.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'woowbot') !== false) {
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
            ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <?php
            wp_enqueue_script('script-lang', plugins_url('assets/js/live-chat.js', __FILE__), array('jquery'), 1.2, true);
        }
        if (strpos($_SERVER['REQUEST_URI'], 'admin.php?page=wbca-chat-page')) {
            ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script>
                $ = jQuery;
                $(document).ready(function () {
                    $('#wbca-chat-tabs li.wbca-current.wbca_dashboard').html('Bảng Tin');
                    $('#wbca-chat-tabs li.qct_no_client_msg').html('Không có khách hàng đang hoạt động. Tất cả các khách hàng đang hoạt động sẽ được liệt kê ở đây.');
                    $('.wbca-admin-wrap .wbca-admin-head .wbca-admin-head-right p').html('Vui lòng truy cập nếu bạn muốn tham dự cuộc trò chuyện trực tiếp');
                    $('.qchero_sliders_list_wrapper .sld_menu_title h2').html('Tất cả khách hàng');
                });
            </script>
            <?php
        }
    }

    if (strpos($_SERVER['REQUEST_URI'], 'dashboard') !== FALSE) {
        wp_enqueue_script('script-lang', plugins_url('assets/js/live-chat.js', __FILE__), array('jquery'), 1.1, true);
    }

    /* Automatewoo */
    if (in_array('automatewoo/automatewoo.php', $plugins_array) || array_key_exists('automatewoo/automatewoo.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'aw_workflow') !== false) {
            echo "<link rel='stylesheet' href='$main_link_css/admin-global-one.css$ver_css'>";
        }
    }

    /* Affiliate */
    if (in_array('affiliate-wp/affiliate-wp.php', $plugins_array) || array_key_exists('affiliate-wp/affiliate-wp.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'affiliate-wp-settings') !== false) {
            ?>
            <style type="text/css">
                #form_settings {
                    visibility: hidden !important;
                }
            </style>
            <?php
        }
        if (strpos($_SERVER['REQUEST_URI'], 'integrations') !== false || strpos($_SERVER['REQUEST_URI'], 'migration') !== false || strpos($_SERVER['REQUEST_URI'], 'system_info') !== false) {
            ?>
            <style type="text/css">
                #tab_container {
                    display: none !important;
                }
            </style>
            <?php
        }
    }
    /* FS-Poster */
    if (in_array('fs-poster/init.php', $plugins_array) || array_key_exists('fs-poster/init.php', $plugins_array)) {
        ?>
        <style>
            .fsp-notification-container {
                display: none !important;
            }
        </style>
        <?php
    }
    /* GHN */
    if (in_array('devvn-woo-ghn/devvn-woo-ghn.php', $plugins_array) || array_key_exists('devvn-woo-ghn/devvn-woo-ghn.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'devvn-woo-ghn') !== false) {
            ?>
            <style>
                .devvn_note {
                    display: none !important;
                }
            </style>
            <?php
        }
    }
    /* GHTK */
    if (in_array('devvn-woo-ghtk/devvn-woo-ghtk.php', $plugins_array) || array_key_exists('devvn-woo-ghtk/devvn-woo-ghtk.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'devvn-woo-ghtk') !== false) {
            ?>
            <style>
                .wrap.devvn_ghtk_wrap p a[href^="https://levantoan.com"] {
                    display: none !important;
                }
            </style>
            <?php
        }
    }
    //Plugin elementor
    if (in_array('elementor/elementor.php', $plugins_array) || array_key_exists('elementor/elementor.php', $plugins_array)) {
        require_once plugin_dir_path(__FILE__) . "plugin/elementor.php";
        if (strpos($_SERVER['REQUEST_URI'], 'elementor') !== FALSE) {
            hide_elementor_page();
        }
        if (strpos($_SERVER['REQUEST_URI'], 'elementor-getting-started') !== FALSE) {
            hide_elementor_getting_started();
        }
    }
    //Plugin Mycred
    if (in_array('mycred/mycred.php', $plugins_array) || array_key_exists('mycred/mycred.php', $plugins_array)) {
        require_once plugin_dir_path(__FILE__) . "plugin/mycred.php";
        hide_link_mycred();
        if (strpos($_SERVER['REQUEST_URI'], 'mycred-main') !== false) {
            hide_link_mycred_main();
        }
        if (strpos($_SERVER['REQUEST_URI'], 'mycred-addons') !== false) {
            hide_link_mycred_addon();
        }
        if (strpos($_SERVER['REQUEST_URI'], 'mycred-tools') !== false) {
            hide_link_mycred_tools();
        }
        if (strpos($_SERVER['REQUEST_URI'], 'mycred-gateways') !== false) {
            hide_link_mycred_gateways();
        }
        if (strpos($_SERVER['REQUEST_URI'], 'mycred-cashcreds') !== false) {
            hide_link_mycred_cashcreds();
        }
        if (strpos($_SERVER['REQUEST_URI'], 'mycred-settings') !== false) {
            hide_link_mycred_main();
        }
        if (strpos($_SERVER['REQUEST_URI'], 'mycred_rank&ctype=mycred_default') !== false) {
            hide_link_mycred_default();
        }
    }
    //Plugin support ticket kbx
    if (in_array('support-ticket-kbx/qcld-support-ticket-main.php', $plugins_array) || array_key_exists('support-ticket-kbx/qcld-support-ticket-main.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'qcld-kbx-support-license') !== FALSE) {
            ?>
            <style>
                .kbx-support-help-block {
                    display: none
                }
            </style>
            <?php
        }
    }

    if (in_array('woowbot-woocommerce-chatbot-pro/qcld-woowbot.php', $plugins_array) || array_key_exists('woowbot-woocommerce-chatbot-pro/qcld-woowbot.php', $plugins_array)) {
        require_once plugin_dir_path(__FILE__) . "plugin/qcld-woowbot.php";
        if (strpos($_SERVER['REQUEST_URI'], 'woowbot') !== FALSE) {
            hide_link_woowbot();
        }
        if (strpos($_SERVER['REQUEST_URI'], 'woowbot_license_page') !== FALSE) {
            hide_link_woowbot_license();
        }
    }
    if (in_array('cartflows/cartflows.php', $plugins_array) || array_key_exists('cartflows/cartflows.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'cartflows') !== FALSE) {
            ?>
            <style>
                .wcf-title {
                    visibility: hidden;
                }

                .wcf-top-links {
                    display: none;
                }

                div.wcf-metabox.wcf-user-info div.wcf-metabox__body {
                    display: none;
                }

                div.wcf-field.wcf-checkbox-field div.wcf-field__desc {
                    display: none;
                }

                div.wcf-regenerate-css div.wcf-regenerate-css__desc.wcf-field__desc {
                    display: none;
                }
            </style>
            <script>
                var $home = "<?php echo __('Home', 'cartflows') ?>";
            </script>
            <?php
            wp_enqueue_script('script-cus-cartflows', plugins_url('assets/js/cartflows.js', __FILE__), array('jquery'), 1.1, true);
            wp_enqueue_style('cartflows_css', plugins_url('assets/css/cartflows.css', __FILE__));
        }
    }
    if (in_array('automatewoo/automatewoo.php', $plugins_array) || array_key_exists('automatewoo/automatewoo.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'automatewoo') || strpos($_SERVER['REQUEST_URI'], 'aw_workflow') !== FALSE) {
            ?>
            <style>
                body.post-type-aw_workflow #wpbody-content h1:before,
                .automatewoo-page h1:before {
                    background-image: none !important
                }

                a[href^="https://automatewoo.com/"] {
                    display: none
                }
            </style>
            <?php
        }
    }
    if (in_array('fluent-crm/fluent-crm.php', $plugins_array) || array_key_exists('fluent-crm/fluent-crm.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'fluentcrm-admin') !== FALSE) {
            ?>
            <style>
                .fluentcrm_menu .fluentcrm_item_get_pro,
                .el-notification.right,
                a[href^="https://fluentcrm.com/"] {
                    display: none !important
                }

                .fluentcrm_menu_logo_holder {
                    opacity: 0;
                    visibility: hidden;
                }
            </style>
            <?php
        }
    }
    if (in_array('fluent-crm/fluent-crm.php', $plugins_array) || array_key_exists('fluentform/fluentform.php', $plugins_array)) {
        ?>
        <style>
            div.ff_form_main_nav {
                display: none !important
            }
        </style>
        <?php
    }
    if (in_array('messenger-chatbot-addon/wpbot-fb-messenger-addon.php', $plugins_array) || array_key_exists('messenger-chatbot-addon/wpbot-fb-messenger-addon.php', $plugins_array)) {
        require_once plugin_dir_path(__FILE__) . "plugin/wpbot-fb-messenger-addon.php";
        if (strpos($_SERVER['REQUEST_URI'], 'wbfb-botsetting-page') !== FALSE) {
            wbfb_botsetting_page();
        }
        if (strpos($_SERVER['REQUEST_URI'], 'messenger-chatbot-help-license') !== FALSE) {
            messenger_chatbot_help_license();
        }
    }
    if (strpos($_SERVER['REQUEST_URI'], 'post_type=page') !== FALSE) {
        ?>
        <style>
            span#icl_mcs_details p {
                display: none !important;
            }
        </style>
        <?php
    }
    if (in_array('autoptimize/autoptimize.php', $plugins_array) || array_key_exists('autoptimize/autoptimize.php', $plugins_array)) {
        require_once plugin_dir_path(__FILE__) . "plugin/autoptimize.php";
        if (strpos($_SERVER['REQUEST_URI'], 'autoptimize') !== FALSE) {
            autoptimize_page();
        }
        if (strpos($_SERVER['REQUEST_URI'], 'autoptimize_imgopt') !== FALSE) {
            autoptimize_imgopt_page();
        }
        if (strpos($_SERVER['REQUEST_URI'], 'ao_critcss') !== FALSE) {
            autoptimize_ao_critcss_page();
        }
        if (strpos($_SERVER['REQUEST_URI'], 'autoptimize_extra') !== FALSE) {
            autoptimize_autoptimize_extra_page();
        }
    }
    //wp fusion
    if (in_array('wp-fusion/wp-fusion.php', $plugins_array) || array_key_exists('wp-fusion/wp-fusion.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'options-general.php?page=wpf-settings') !== false) {
            $global = '#wpbody-content #wpf-settings .settings_page_wpf-settings-tab-content ';
            $main = $global . '#main';
            $contact = $global . '#contact-fields';
            $integrations = $global . '#integrations';
            $addons = $global . '#addons';
            $logins = $global . '#logins';
            $setup = $global . '#setup';
            $advanced = $global . '#advanced';
            ?>
            <style>
                <?= $main ?>
                p:nth-child(3),
                <?= $main ?>
                h4>a,
                <?= $main ?>
                p:nth-last-child(4),
                <?= $main ?>
                table:nth-last-child(3) tbody tr:nth-child(2) td span,
                <?= $main ?>
                table:nth-last-child(1) tbody tr:nth-last-child(1) td span.description,
                <?= $contact ?>
                table:nth-child(2) tbody tr td p,
                <?= $contact ?>
                a.table-header-docs-link,
                <?= $integrations ?>
                table:nth-child(2),
                <?= $integrations ?>
                a.header-docs-link,
                <?= $logins ?>
                p:nth-child(3),
                <?= $setup ?>
                p:nth-child(4) {
                    <?php echo !is_super_admin() ? 'display:none!important' : ''; ?>
                }

                <?= $addons ?>
                a[href^="https://wpfusion.com/documentation/"],
                <?= $addons ?>
                a[href^="https://wpfusionplugin.com/documentation/"],
                <?= $advanced ?>
                a[href^="https://wpfusion.com/documentation"] {
                    <?php echo !is_super_admin() ? 'pointer-events: none;cursor: default;text-decoration: none;color: #9e9e9e !important;' : ''; ?>
                }
            </style>
            <?php
        }
        if (strpos($_SERVER['REQUEST_URI'], 'tools.php?page=wpf-settings-logs') !== false) {
            ?>
            <style>
                #mainform .description {
                    display: none !important
                }
            </style>
            <?php
        }
    }

    //plugin dokan
    if (in_array('dokan/dokan.php', $plugins_array) || array_key_exists('dokan/dokan.php', $plugins_array)) {
        if (strpos($_SERVER['REQUEST_URI'], 'page=dokan') !== FALSE) {
            ?>
            <style>
                #vue-backend-app .dokan-vendor-single .vendor-profile section.vendor-header .profile-banner .action-links {
                    display: flex;
                }

                #vue-backend-app .dokan-vendor-single .vendor-profile section.vendor-header .profile-banner .action-links a.button.visit-store {
                    display: flex;
                    align-items: center
                }

                #vue-backend-app .dokan-vendor-single .vendor-profile section.vendor-header .profile-banner .action-links a.button.visit-store span.dashicons.dashicons-arrow-right-alt {
                    margin-top: unset;
                }

                #vue-backend-app .dokan-vendor-single .vendor-profile section.vendor-header .profile-info .store-info .actions button.button.message span.dashicons.dashicons-email {
                    position: relative;
                }

                #vue-backend-app .dokan-vendor-single .vendor-profile section.vendor-header .profile-info .store-info .actions button.button.message span.dashicons.dashicons-email::before {
                    position: absolute;
                    top: 50%;
                    left: 0;
                    transform: translateY(-50%);
                }
            </style>
            <?php
        }
    }
}
add_action('admin_enqueue_scripts', 'allin1');

function login_css()
{
    if (strpos($_SERVER['REQUEST_URI'], 'signin') !== false) {
        ?>
        <style type="text/css">
            .language-switcher {
                display: none !important
            }
        </style>
        <?php
    }

    if (strpos($_SERVER['REQUEST_URI'], 'signin?action=confirm_admin_email') !== false) {
        ?>
        <style>
            .login h1 {
                top: 78px !important;
            }

            .login-action-confirm_admin_email #login {
                max-width: 992px !important;
                margin-top: -40vh !important;
            }

            .login form {
                max-width: 100% !important;
            }

            .login h1.admin-email__heading {
                height: 28px;
                width: 355px;
                padding: 0px 20px;
                position: relative;
                top: 0px !important;
            }

            p.admin-email__details {
                float: left;
            }

            .admin-email__actions {
                float: left;
            }

            a.button.button-large {
                margin: 10px 0px;
            }
        </style>
        <?php
    }
}
add_action('init', 'login_css', 957);

/**
 * WooCommerce My Account Page Logout Redirect
 */
add_action('wp_logout', 'owp_redirect_after_logout');
function owp_redirect_after_logout()
{
    wp_redirect(home_url());
    exit();
}

add_action('admin_head', 'custom_css_dokan');
function custom_css_dokan()
{
    if (strpos($_SERVER['REQUEST_URI'], 'page=dokan') !== false) {
        ?>
        <style>
            /* Vendor table */
            .store_name {
                width: 20% !important;
                word-break: break-all;
            }

            .email {
                width: 15% !important;
                word-break: break-all;
            }

            .categories {
                width: 15% !important;
                word-break: break-all;
            }

            th.phone,
            td.phone {
                width: 20% !important;
                word-break: break-all;
            }

            th.registered,
            td.registered {
                width: 15% !important;
                word-break: break-all;
            }

            .enabled {
                width: 15% !important;
                word-break: break-all;
            }

            /* Report table */
            .order_id {
                width: 120px !important;
            }

            .vendor_id {
                width: 200px !important;
            }

            .order_total {
                width: 100px !important;
            }

            .vendor_earning {
                width: 200px !important;
            }

            th.column.commission,
            td.column.commission {
                width: 100px !important;
            }

            .dokan_gateway_fee {
                width: 200px !important;
            }

            .shipping_total {
                width: 100px !important;
            }

            .tax_total {
                width: 100px !important;
            }

            .status {
                width: 100px !important;
            }

            .date {
                width: 100px !important;
            }

            /* Module table */
            .name {
                width: 500px !important;
            }

            .description {
                width: 900px !important;
            }

            .active {
                width: 200px !important;
            }

            /* Customer table */
            .full_name {
                width: 20% !important;
            }

            .username {
                width: 20% !important;
            }

            .role {
                width: 20% !important;
            }

            /* Vendor details */
            span.dashicons.dashicons-email,
            .status>.dashicons {
                line-height: 15px !important;
            }

            .action-links {
                display: flex !important;
            }

            a.button.visit-store {
                display: flex !important;
                align-items: center !important;
            }

            .actions>.status {
                background: #0f72f9 !important;
            }

            .dashicons-backup {
                line-height: 23px;
            }

            /* Modules page */
            .filter-items ul li a {
                width: 110px !important;
            }

            .filter-items ul li.active {
                width: unset !important;
            }
        </style>
        <?php
        if (!is_super_admin()) {
            ?>
            <style>
                .module-content {
                    display: none !important;
                }
            </style>
            <?php
        }
    }
    // B2BKing dropbox width
    if (strpos($_SERVER['REQUEST_URI'], 'page=b2bking_customers') !== false) {
        ?>
        <style>
            .wp-core-ui select {
                width: 70px !important;
            }
        </style>
        <?php
    }
    // SaleKing message table
    if (strpos($_SERVER['REQUEST_URI'], 'post_type=salesking_message') !== false) {
        ?>
        <style>
            .column-title {
                width: 40% !important;
            }

            .column-salesking_agent {
                width: 40% !important;
            }

            .column-salesking_lastreplydate {
                width: 20% !important;
            }
        </style>
        <?php
    }
    // SaleKing earnings and payouts tables
    if (strpos($_SERVER['REQUEST_URI'], 'page=salesking_earnings') !== false || strpos($_SERVER['REQUEST_URI'], 'page=salesking_payouts') !== false) {
        ?>
        <style>
            .wp-admin select {
                width: 70px !important;
            }
        </style>
        <?php
    }
    // SaleKing earnings and payouts details tables
    if (strpos($_SERVER['REQUEST_URI'], 'page=salesking_view_earnings') !== false || strpos($_SERVER['REQUEST_URI'], 'page=salesking_view_payouts') !== false) {
        ?>
        <style>
            .salesking_above_top_title_button_left {
                color: black !important;
            }

            .wp-admin select {
                width: 60px !important;
            }

            button.salesking_above_top_title_button_right_button {
                text-align: center !important;
                text-transform: capitalize !important;
            }
        </style>
        <?php
    }
    // Create new product
    if (strpos($_SERVER['REQUEST_URI'], 'post-new.php?post_type=product') !== false) {
        ?>
        <style>
            #icl_post_language {
                width: 100px !important;
            }

            #icl_translation_priority {
                width: 100px !important;
            }

            .sc-dlVyqM.sc-kfPtPH.cDNlyh.cJssHP.sc-bUhGej.iTsbA-d:nth-child(2) .sc-hGPAah.CoLgZ.collapsible_content {
                display: none !important;
            }

            p.sc-khQdMy.fLhdEg>a {
                display: none !important;
            }

            #rocket_post_exclude {
                display: none !important;
            }

            .sc-jWa-DWe.hJPNqB>p>a {
                display: none !important;
            }

            .sc-ksdxAp.jfsRWN.sc-bxDcbH.jvTPEt {
                display: none !important;
            }
        </style>
        <?php
    }
    // B2BKing Back button 
    if (strpos($_SERVER['REQUEST_URI'], 'page=b2bking_logged_out_users') !== false || strpos($_SERVER['REQUEST_URI'], 'page=b2bking_b2c_users') !== false) {
        ?>
        <style>
            .b2bking_above_top_title_button_left {
                color: black !important;
            }

            .b2bking_above_top_title_button_right_button {
                text-align: center !important;
                text-transform: capitalize !important;
            }
        </style>
        <?php
    }
    // B2BKing conversation
    if (strpos($_SERVER['REQUEST_URI'], 'post_type=b2bking_conversation') !== false) {
        ?>
        <style>
            .column-b2bking_user,
            .column-title,
            .column-b2bking_type,
            .column-b2bking_status,
            .column-b2bking_lastreplydate {
                width: 20% !important;
            }
        </style>
        <?php
    }
    // Brands table
    if (strpos($_SERVER['REQUEST_URI'], 'taxonomy=product_brand&post_type=product') !== false || strpos($_SERVER['REQUEST_URI'], 'taxonomy=product_cat&post_type=product') !== false || strpos($_SERVER['REQUEST_URI'], 'taxonomy=product_tag&post_type=product') !== false) {
        ?>
        <style>
            .column-name {
                width: 20% !important;
            }

            .column-description {
                width: 30% !important;
            }

            .column-wpseo-score {
                width: 10% !important;
            }

            .column-wpseo-score-readability {
                width: 10% !important;
            }

            .column-slug {
                width: 20% !important;
            }

            .column-posts {
                width: 10% !important;
            }
        </style>
        <?php
    }
    // B2BKing offer
    if (strpos($_SERVER['REQUEST_URI'], 'post_type=b2bking_offer') !== false) {
        ?>
        <style>
            .column-title,
            .column-b2bking_offer_price,
            .column-b2bking_offer_number_items {
                width: 30% !important;
            }
        </style>
        <?php
    }
    // product attributes
    if (strpos($_SERVER['REQUEST_URI'], 'post_type=product&page=product_attributes') !== false) {
        ?>
        <style>
            .attributes-table .attribute-terms {
                width: unset !important
            }

            .widefat thead th,
            .widefat tbody td {
                width: 180px !important;
            }
        </style>
        <?php
    }
    // Hide woocommerce-marketing
    if (is_plugin_active('woocommerce/woocommerce.php')) {
        remove_submenu_page('woocommerce-marketing', 'admin.php?page=wc-admin&path=/marketing');
    }
    // Shop coupon table
    if (strpos($_SERVER['REQUEST_URI'], 'post_type=shop_coupon') !== false) {
        ?>
        <style>
            .column-coupon_code {
                width: 10% !important;
            }

            .column-type {
                width: 10% !important;
            }

            .column-amount {
                width: 10% !important;
            }

            .column-description {
                width: 10% !important;
            }

            .column-products {
                width: 40% !important;
            }

            .column-usage {
                width: 10% !important;
            }

            .column-expiry_date {
                width: 10% !important;
            }
        </style>
        <?php
    }
    // user custom
    if (strpos($_SERVER['REQUEST_URI'], 'wp_http_referer=%2Fdashboard%2Fusers.php') !== false) {
        ?>
        <style>
            /* tuỳ chọn cá nhân */
            tr.user-rich-editing-wrap,
            tr.user-comment-shortcuts-wrap,
            tr.show-admin-bar.user-admin-bar-front-wrap,
            tr.user-language-wrap:nth-child(6),
            tr.user-language-wrap:nth-child(7),
            tr.user-language-wrap:nth-child(8) {
                width: 33.33% !important;
            }

            /* tên */
            tr.user-user-login-wrap,
            tr.user-first-name-wrap,
            tr.user-last-name-wrap {
                width: 50% !important;
            }

            tr.user-role-wrap {
                width: 50% !important;
            }

            tr.user-nickname-wrap,
            tr.user-display-name-wrap {
                width: 50% !important;
            }

            /* thông tin liên hệ */
            tr.user-aim-wrap,
            tr.user-yim-wrap,
            tr.user-jabber-wrap,
            tr.user-facebook-wrap,
            tr.user-instagram-wrap,
            tr.user-linkedin-wrap,
            tr.user-myspace-wrap,
            tr.user-pinterest-wrap,
            tr.user-soundcloud-wrap,
            tr.user-tumblr-wrap,
            tr.user-twitter-wrap,
            tr.user-youtube-wrap,
            tr.user-wikipedia-wrap {
                width: 25% !important;
            }

            /* xung quanh thành viên */
            tr.user-description-wrap {
                width: 50% !important;
                float: right;
            }

            tr.user-profile-picture {
                width: 50% !important;
            }

            /* địa chỉ thanh toán của khách hàng */
            table#fieldset-billing tbody tr:first-child,
            table#fieldset-billing tbody tr:nth-child(2),
            table#fieldset-billing tbody tr:nth-child(4),
            table#fieldset-billing tbody tr:nth-child(5) {
                width: 50% !important;
            }

            table#fieldset-billing tbody tr:nth-child(6),
            table#fieldset-billing tbody tr:nth-child(7),
            table#fieldset-billing tbody tr:nth-child(8),
            table#fieldset-billing tbody tr:nth-child(9),
            table#fieldset-billing tbody tr:nth-child(10),
            table#fieldset-billing tbody tr:nth-child(11) {
                width: 33.33% !important;
            }

            /* địa chỉ giao hàng của khách hàng */
            table#fieldset-shipping tbody tr:nth-child(2),
            table#fieldset-shipping tbody tr:nth-child(3),
            table#fieldset-shipping tbody tr:nth-child(5),
            table#fieldset-shipping tbody tr:nth-child(6) {
                width: 50% !important;
            }

            table#fieldset-shipping tbody tr:nth-child(7),
            table#fieldset-shipping tbody tr:nth-child(8),
            table#fieldset-shipping tbody tr:nth-child(9),
            table#fieldset-shipping tbody tr:nth-child(10),
            table#fieldset-shipping tbody tr:nth-child(11) {
                width: 33.33% !important;
            }

            /* bảng điều khiển */
            table.form-table:nth-child(26) tbody tr:nth-child(2),
            table.form-table:nth-child(26) tbody tr:nth-child(3) {
                width: 50% !important;
            }

            table.form-table:nth-child(26) tbody tr:nth-child(4),
            table.form-table:nth-child(26) tbody tr:nth-child(5),
            table.form-table:nth-child(26) tbody tr:nth-child(6),
            table.form-table:nth-child(26) tbody tr:nth-child(16),
            table.form-table:nth-child(26) tbody tr:nth-child(17),
            table.form-table:nth-child(26) tbody tr:nth-child(18),
            table.form-table:nth-child(26) tbody tr:nth-child(19),
            table.form-table:nth-child(26) tbody tr:nth-child(20),
            table.form-table:nth-child(26) tbody tr:nth-child(21),
            table.form-table:nth-child(26) tbody tr:nth-child(22) {
                width: 33.3% !important;
            }

            table.form-table:nth-child(26) tbody tr:nth-child(10),
            table.form-table:nth-child(26) tbody tr:nth-child(11),
            table.form-table:nth-child(26) tbody tr:nth-child(12),
            table.form-table:nth-child(26) tbody tr:nth-child(13) {
                width: 25% !important;
            }

            /* tuỳ chọn thanh toán */
            table.form-table:nth-child(26) tbody tr:nth-child(24),
            table.form-table:nth-child(26) tbody tr:nth-child(25),
            table.form-table:nth-child(26) tbody tr:nth-child(26) {
                width: 33.3% !important;
            }

            table.form-table:nth-child(26) tbody tr:nth-child(27),
            table.form-table:nth-child(26) tbody tr:nth-child(28),
            table.form-table:nth-child(26) tbody tr:nth-child(29),
            table.form-table:nth-child(26) tbody tr:nth-child(30) {
                width: 25% !important;
            }

            table.form-table:nth-child(26) tbody tr:nth-child(31),
            table.form-table:nth-child(26) tbody tr:nth-child(32),
            table.form-table:nth-child(26) tbody tr:nth-child(33) {
                float: left !important;
                width: 50% !important;
            }

            table.form-table:nth-child(26) tbody tr:nth-child(34),
            table.form-table:nth-child(26) tbody tr:nth-child(35),
            table.form-table:nth-child(26) tbody tr:nth-child(36) {
                float: right !important;
                width: 50% !important;
            }

            /* saleking setting */
            .salesking_user_shipping_payment_methods_container {
                width: 50% !important;
            }

            /* b2b setting */
            .b2bking_user_shipping_payment_methods_container {
                width: 35%;
                float: left;
                display: block;
                /* margin: 0px 10px; */
                margin-left: 10px;
                min-height: 240px;
                margin-bottom: 10px;
            }

            /* custom br, th */
            th {
                color: black !important;
            }

            .yoast.yoast-settings br {
                display: block !important;
            }

            form#your-profile br {
                display: none;
            }

            /* custom form */
            form#your-profile {
                width: 1250px !important;
            }

            .form-table tr:hover {
                transform: unset !important;
                box-shadow: unset !important;
                background-color: unset !important;
            }

            table.form-table {
                border-radius: 5px;
                background: #ffffff;
                max-width: 1170px;
                border-color: #e9ebec;
                box-shadow: 0 3px 6px rgb(0 0 0 / 7%);
                padding-bottom: 12px;
                margin-bottom: 40px;
                display: block;
                /* width: 100%; */
            }
        </style>
        <?php
    }
}

add_action('admin_enqueue_scripts', 'translate_dokan_b2b_salesking');
function translate_dokan_b2b_salesking()
{
    if (strpos($_SERVER['REQUEST_URI'], 'page=dokan') !== false) {
        // Search for vendor in withdrawals of Dokan
        wp_enqueue_script('cs_functions_js_', get_site_url() . '/wp-content/plugins/woocommerce/assets/js/selectWoo/selectWoo.full.min.js', array(), '', true);
        // Bulk actions button in Module of Dokan
        wp_enqueue_script('cs_functions_js', get_site_url() . '/wp-content/plugins/dokan/assets/js/vue-vendor.js', array(), '', true);
        // New Notificationin Dokan
        wp_enqueue_script('cs_functions_js', get_template_directory_uri() . '/wp-includes/js/tinymce/themes/modern/theme.min.js', array(), '', true);
        // New Notificationin Dokan
        wp_enqueue_script('cs_functions_js', get_template_directory_uri() . '/wp-includes/js/tinymce/plugins/wplink/plugin.min.js', '', '', true);
        // New Notificationin Dokan
        wp_enqueue_script('cs_functions_js', get_template_directory_uri() . '/wp-includes/js/tinymce/plugins/wordpress/plugin.min.js', '', '', true);
        // New Notificationin Dokan
        wp_enqueue_script('cs_functions_js', get_template_directory_uri() . '/wp-content/plugins/dokan/assets/vendors/tinymce/code/plugin.min.js', '', '', true);
    }

    if (strpos($_SERVER['REQUEST_URI'], 'page=b2bking_customers') !== false) {
        // B2bking tables
        wp_enqueue_script('cs_functions_js', get_site_url() . '/wp-content/plugins/b2bking/includes/assets/lib/dataTables/jquery.dataTables.min.js', '', '', true);
    }

    if (strpos($_SERVER['REQUEST_URI'], 'page=salesking_earnings') !== false || strpos($_SERVER['REQUEST_URI'], 'page=salesking_view_earnings') !== false || strpos($_SERVER['REQUEST_URI'], 'page=salesking_payouts') !== false || strpos($_SERVER['REQUEST_URI'], 'salesking_view_payouts') !== false) {
        // SalesKing tables
        wp_enqueue_script('cs_functions_js', get_template_directory_uri() . '/wp-content/plugins/salesking/includes/assets/lib/dataTables/jquery.dataTables.min.js', '', '', true);
    }


    $translation_array = array(
        // Search for vendor in withdrawals
        'not_loaded' => __('The results could not be loaded.', 'dokan-lite'),
        'searching' => __('Searching...', 'dokan-lite'),
        'not_found' => __('No Result Found', 'dokan-lite'),
        // Bulk actions button
        'bulk_actions' => __('Bulk Actions', 'dokan-lite'),
        'apply' => __('Apply', 'dokan-lite'),
        // New Notificationin Dokan
        'bold' => __('Bold', 'dokan-lite'),
        'italic' => __('Italic', 'dokan-lite'),
        'underline' => __('Underline', 'dokan-lite'),
        'align_left' => __('Align left', 'dokan-lite'),
        'align_right' => __('Align rigth', 'dokan-lite'),
        'align_center' => __('Align center', 'dokan-lite'),
        'justify' => __('Justify', 'dokan-lite'),
        'font_family' => __('Font family', 'dokan-lite'),
        'font_sizes' => __('Font sizes', 'dokan-lite'),
        'clear_formatting' => __('Clear formatting', 'dokan-lite'),
        'undo' => __('Undo', 'dokan-lite'),
        'redo' => __('Redo', 'dokan-lite'),
        'blockquote' => __('Blockquote', 'dokan-lite'),
        'insert_edit_link' => __('Insert/edit link', 'dokan-lite'),
        'toolbar_toggle' => __('Toolbar Toggle', 'dokan-lite'),
        'text_color' => __('Text color', 'dokan-lite'),
        'background_color' => __('Background color', 'dokan-lite'),
        'horizontal_line' => __('Horizontal line', 'dokan-lite'),
        'source_code' => __('Source code', 'dokan-lite'),
        // Items Dokan
        'items' => __('items', 'dokan-lite'),
        // B2BKing and SalesKing tables
        'first' => __('First', 'b2bking'),
        'last' => __('Last', 'b2bking'),
        'next' => __('Next', 'b2bking'),
        'previous' => __('Previous', 'b2bking'),
        'no_data' => __('No data available in table', 'b2bking'),
        'show_from_to' => __('Showing _START_ to _END_ of _TOTAL_ entries', 'b2bking'),
        'no_entries' => __('Showing 0 to 0 of 0 entries', 'b2bking'),
        'show_entries' => __('Show _MENU_ entries', 'b2bking'),
        'search' => __('Search:', 'b2bking'),
        'loading' => __('Loading...', 'b2bking'),
        'processing' => __('Processing...', 'b2bking'),
        'no_match' => __('No matching records found', 'b2bking'),
    );

    wp_localize_script('cs_functions_js', 'langvars', $translation_array);
}

function ideapro_remove_admin_bar_items($wp_admin_bar)
{
    //hide tab Yoast SEO in admin bar menu with all user
    if (is_plugin_active('wordpress-seo/wp-seo.php')) {
        $wp_admin_bar->remove_node('wpseo-menu');

        if (strpos($_SERVER['REQUEST_URI'], 'page=wpseo_tools') !== false) {
            ?>
            <style>
                ul.ul-disc>li:last-child #yoast-seo-indexing-action .sc-fFehDp.iuWOul {
                    display: none;
                }
            </style>
            <?php
        }
    }

}
add_action('admin_bar_menu', 'ideapro_remove_admin_bar_items', 800);


/*
 ** TL-Translate plugin WooCommerce-Multi-Locations not's variable
 */
if (strpos($_SERVER['REQUEST_URI'], 'page=multi-location-inventory-management') !== false) {
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

        //     $('#main').mousemove(function() {
        $('document').ready(function () {
            var myElement = document.getElementById("wcmlim_exclude_locations_from_frontend");
            console.log(myElement);
            myElement.setAttribute("data-placeholder", "<?= __('Select Some Locations', 'wcmlim') ?>");
            setTimeout(function () {
                $("#general_setting_form .chosen-choices").click(function () {
                    $('.exclude_prod_onfront .exclude_prod_onfront1').html(function () {
                        return $(this).html().replace("You can't add all locations to exclude", "<?= __("You can't add all locations to exclude", 'wcmlim') ?>");
                    });
                });
            });

            setTimeout(function () {
                $("#general_setting_form .chosen-choices").keyup(function () {
                    $('.exclude_prod_onfront .exclude_prod_onfront1').html(function () {
                        return $(this).html().replace("You can't add all locations to exclude", "<?= __("You can't add all locations to exclude", 'wcmlim') ?>");
                    });
                });
            });


            setTimeout(function () {
                $("#wcmlim_select_loc_val").html(function () {
                    return $(this).html().replace("Please select location.", "<?= __('Please select location.', 'wcmlim') ?>");
                });

                $("#wcmlim_prod_instock_valid").html(function () {
                    return $(this).html().replace("You can’t have more than items in cart", "<?= __('You can’t have more than items in cart', 'wcmlim') ?>");
                });

                $("#wcmlim_pickup_valid").html(function () {
                    return $(this).html().replace("Pickup At Store Unavailable", "<?= __('Pickup At Store Unavailable', 'wcmlim') ?>");
                });

                $("#wcmlim_valid_cart_message").html(function () {
                    return $(this).html().replace("You can only order from 1 location, do you want to clear the cart?", "<?= __('You can only order from 1 location, do you want to clear the cart?', 'wcmlim') ?>");
                });

                $("#wcmlim_cart_popup_message").html(function () {
                    return $(this).html().replace("our cart has been cleared, re-add from new location!", "<?= __('our cart has been cleared, re-add from new location!', 'wcmlim') ?>");
                });

                $("#wcmlim_var_message2").html(function () {
                    return $(this).html().replace("Sorry, no products matched your selection. Please choose a different combination.", "<?= __('Sorry, no products matched your selection. Please choose a different combination.', 'wcmlim') ?>");
                });

                $("#wcmlim_var_message3").html(function () {
                    return $(this).html().replace("Please select some product options before adding this product to your cart.", "<?= __('Please select some product options before adding this product to your cart.', 'wcmlim') ?>");
                });

                $("#wcmlim_var_message4").html(function () {
                    return $(this).html().replace("Sorry, this product is unavailable. Please choose a different combination.", "<?= __('Sorry, this product is unavailable. Please choose a different combination.', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim .form-table a").html(function () {
                    return $(this).html().replace("Click Here", "<?= __('Click Here', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim .form-table tr:nth-child(14) td").html(function () {
                    return $(this).html().replace("or Every", "<?= __('or Every', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim .form-table tr:nth-child(14) td").html(function () {
                    return $(this).html().replace("Minute", "<?= __('Minute', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim .form-table tr:nth-child(15) td").html(function () {
                    return $(this).html().replace("Make Sure Distance unit has been selected.", "<?= __('Make Sure Distance unit has been selected.', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim #general_setting_form tr:nth-child(12) .wcmlim-setting-option-des b").html(function () {
                    return $(this).html().replace("Rule description : ", "<?= __('Rule description : ', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim #general_setting_form tr:nth-child(12) .wcmlim-setting-option-des b").html(function () {
                    return $(this).html().replace("0. None selected rule :", "<?= __('0. None selected rule :', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim #general_setting_form tr:nth-child(12) .wcmlim-setting-option-des ").html(function () {
                    return $(this).html().replace("For administration manually adding order, Location list dropdown under each item.", "<?= __('For administration manually adding order, Location list dropdown under each item.', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim #general_setting_form tr:nth-child(12) .wcmlim-setting-option-des ").html(function () {
                    return $(this).html().replace("The location is automatically chosen with availability of most number of stock .", "<?= __('The location is automatically chosen with availability of most number of stock .', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim #general_setting_form tr:nth-child(12) .wcmlim-setting-option-des ").html(function () {
                    return $(this).html().replace("Assign location as per priority set and availability stock is automatically chosen. ", "<?= __('Assign location as per priority set and availability stock is automatically chosen. ', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim #general_setting_form tr:nth-child(12) .wcmlim-setting-option-des ").html(function () {
                    return $(this).html().replace("i. The location belonging to the shipping zone from the order is automatically selected. ", "<?= __('i. The location belonging to the shipping zone from the order is automatically selected. ', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim #general_setting_form tr:nth-child(12) .wcmlim-setting-option-des ").html(function () {
                    return $(this).html().replace("The location that is closest to the shipping address is automatically selected, even if the order is placed from a different location. ", "<?= __('The location that is closest to the shipping address is automatically selected, even if the order is placed from a different location. ', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim #general_setting_form tr:nth-child(12) .wcmlim-setting-option-des p").html(function () {
                    return $(this).html().replace("ii. Prerequisite: To enable and use this setting you need to enable shipping zone and shipping method settings first.", "<?= __('ii. Prerequisite: To enable and use this setting you need to enable shipping zone and shipping method settings first.', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim #general_setting_form tr:nth-child(12) .wcmlim-setting-option-des b").html(function () {
                    return $(this).html().replace("Closest location to Customers shipping address :", "<?= __('Closest location to Customers shipping address :', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim #general_setting_form tr:nth-child(12) .wcmlim-setting-option-des b").html(function () {
                    return $(this).html().replace("4. Location as per Shipping Zones : ", "<?= __('4. Location as per Shipping Zones : ', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim #general_setting_form tr:nth-child(12) .wcmlim-setting-option-des b").html(function () {
                    return $(this).html().replace("Location as per priority in stock:", "<?= __('Location as per priority in stock:', 'wcmlim') ?>");
                });

                $(".admin-menu-setting-wcmlim #general_setting_form tr:nth-child(12) .wcmlim-setting-option-des b").html(function () {
                    return $(this).html().replace("Location with most inventory in stock :", "<?= __('Location with most inventory in stock :', 'wcmlim') ?>");
                });

                $('.chosen-choices .search-field .chosen-search-input default').click(function () {
                    return $(this).html().replace("You can't add all locations to exclude", "<?= __("You can't add all locations to exclude", 'wcmlim') ?>");
                });

                $("#wcmlim_btn_cartclear").html(function () {
                    return $(this).val("<?= __('Yes, clear cart!', 'wcmlim') ?>");
                });

                $("#wcmlim_cart_popup_heading").html(function () {
                    return $(this).val("<?= __('Updated Cart!', 'wcmlim') ?>");
                });

                $(".chosen-container-multi .chosen-choices li.search-field input[type='text'] ").html(function () {
                    return $(this).attr("placeholder", "<?= __('Select Some Locations', 'wcmlim') ?>");
                });

                $(".chosen-container-multi .chosen-choices li.search-field input[type='text'] ").html(function () {
                    return $(this).attr("value", "<?= __('Select Some Locations', 'wcmlim') ?>");
                });
            }, 50)
        })
        // })
    </script>
    <?php
}

function whitelabel_register_admin_styles($hook)
{
    $plugin_url = plugin_dir_url(__FILE__);
    $version = '1.0.0';

    wp_register_style(
        'whitelabel-admin-henry',
        $plugin_url . 'assets/css/admin-henry.css',
        array(),
        $version
    );

    wp_enqueue_style('whitelabel-admin-henry');
}
add_action('admin_enqueue_scripts', 'whitelabel_register_admin_styles');


