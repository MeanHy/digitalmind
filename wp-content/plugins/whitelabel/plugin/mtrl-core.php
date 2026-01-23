<?php
// Exit if accessed directly
if( !defined('ABSPATH') ) exit;

/*--Start Ecomyze Admin Theme Customizations--*/
/*--ALWAYS LEAVE ON TOP--*/
//Remove network admin wp widget and add new ones to use
add_action('admin_init', 'network_dashboard_customize', 100);
function network_dashboard_customize(){
	if (strpos($_SERVER['REQUEST_URI'], 'wp-admin/network/') !== FALSE){
		// remove Right now
		//remove_meta_box( 'network_dashboard_right_now', 'dashboard-network', 'core' );
		// remove WordPress Events and News
		remove_meta_box( 'dashboard_primary', 'dashboard-network', 'side' );
		//wp_add_dashboard_widget( 'welcome_guide_widget', 'Quy Định Quản Trị', 'welcome_guide_management');
		//add_meta_box('network_metabox_1', 'Quy Định Quản Trị', 'welcome_management_guide', 'dashboard-network', 'side', 'high' );
		//add_meta_box('network_metabox_2', 'Quy Trình Tạo Website', 'site_creation_guide', 'dashboard-network', 'column3', 'high' );
		//add_meta_box('network_metabox_3', 'Ghi Chú Kỹ Thuật', 'tech_convention_guide', 'dashboard-network', 'column4', 'high' );
	}
}

//Remove welcome widget on admin dashboard by default
remove_action('welcome_panel', 'wp_welcome_panel');


function general_admin_notice(){
    global $pagenow;

         echo '<div class="notice notice-warning is-dismissible" style="background-color:#1abc9c; color: #ffffff; display:block!important;">
             <p style="font-size: 18px; font-weight: 600; color: #ffffff;">Hướng Dẫn Thiết Lập Website Mới</p>
			 <p style=" color: #ffffff;">Xin vui lòng nhấn vào nút bên dưới để kích hoạt hướng dẫn thiết lập cho web. Tắt thông báo này khi/nếu bạn đã thực hiện hoàn tất quá trình thiết lập website mới!</p>
			 <p><input type="button" value="Bắt Đầu Thiết Lập Website" class="open-tour-1" style="background-color:#e90006; border:none; font-size: 15px; height: 35px; color: #ffffff; cursor: pointer;"></p>
         </div>';
    
}
// add_action('admin_notices', 'general_admin_notice', 102);



//kai
function hidden_box(){

//remove_dashboard_widgets()
global $wp_meta_boxes;
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health']);

	//wp_dashboard_setup stuff
remove_meta_box( 'e-dashboard-overview', 'dashboard', 'normal');
remove_meta_box('wc_admin_dashboard_setup', 'dashboard', 'normal');
remove_meta_box('reduk_dashboard_widget', 'dashboard', 'side');
remove_meta_box('dashboard_rediscache', 'dashboard', 'normal');
remove_meta_box('wdc_dashboard_widget', 'dashboard', 'normal');
remove_meta_box('mycred_overview', 'dashboard', 'normal');
remove_meta_box('fluentsmtp_reports_widget', 'dashboard', 'normal');
remove_meta_box('fsp-news', 'dashboard', 'normal');
remove_meta_box('hmwp_dashboard_widget','dashboard', 'normal');
remove_meta_box('wpseo-dashboard-overview', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'hidden_box');


// function remove_boxes() {
// 	//yith_dashboard_products_news yith_dashboard_blog_news
// remove_meta_box( 'e-dashboard-overview', 'dashboard', 'normal');
// remove_meta_box('wc_admin_dashboard_setup', 'dashboard', 'normal');
// remove_meta_box('reduk_dashboard_widget', 'dashboard', 'side');
// }
// add_action('admin_menu','remove_boxes');


//Change Admin Menu Order
//kai
function custom_admin_menu_order($menu_ord) {
	if (!$menu_ord) return true;
	if (strpos($_SERVER['REQUEST_URI'], 'wp-admin/network/') == FALSE){
		return array(
	'index.php', //Dashboard
	'dokan', //Dokan
	'woocommerce', //WooCommerce
	'edit.php?post_type=shop_order', //Woocommerce after changing link to coupon page
	'edit.php?post_type=product', //Product
	'woocommerce-marketing', //Marketing
	//'edit.php?post_type=shop_coupon', //Marketing after changing link to coupon page
	'wc-admin&path=/analytics/overview', //Analytics
	'b2bking', //B2Bking
	'salesking', //Salesking
	'edit.php', //Post
	'edit.php?post_type=page', //Page
	'upload.php', //Media
	'edit-tags.php?taxonomy=link_category', //Link
	'users.php', //Users
	'themes.php', //Appearance
	'revslider', //revolution slider
	'wpbingo',//WPBingo
	'wpclever',//WPClever
	'edit.php?post_type=elementor_library',//Mẫu giao diện
	'elementor',//elementor
	'vc-general',//WPBakery
	'plugins.php', //Plugin
	'tools.php', //Tools
	'options-general.php', //Settings
	'sitepress-multilingual-cms/menu/languages.php', //WPML
	'ns-cloner', //NS Cloner
	'_mtrloptions', //Admin Theme
	'mtrl_permission_settings', //Admin Theme Settings
	'wutb_menu', //Guide Buider
);
	}
}
add_action('custom_menu_order','custom_admin_menu_order', 984);
add_action('menu_order','custom_admin_menu_order', 985);

//Fix Menu for WP-Optimize on Network Admin
//kai
function customize_network_admin_menu_labels() {
	global $menu;
	global $submenu;
	if ((is_super_admin() && get_current_blog_id() == 1) || strpos($_SERVER['REQUEST_URI'], 'wp-admin/network/')) {
		if(is_plugin_active('wp-optimize/wp-optimize.php')){
		//Change translatable label for WP-Optimizer default menu to Network Optimize - language is in Admin Theme lang file
			$menu['102'][0] = esc_html__('Network Optimize', 'mtrl_framework');
		//Remove 'Support' and 'Plugins Family' from WP-Optimize top right menu
			remove_submenu_page('WP-Optimize','wpo_support');
			remove_submenu_page('WP-Optimize','wpo_mayalso');
		}
	}
	if (!is_super_admin()) {
        remove_submenu_page('index.php','my-sites.php');
    }
	//elementor
    if(is_plugin_active('elementor/elementor.php')) {
        remove_submenu_page('elementor','e-form-submissions');
        remove_submenu_page('elementor','elementor-system-info');
    }
	// mycred
	if(is_plugin_active('mycred/mycred.php')) {
        remove_submenu_page('mycred-main','mycred-membership');
        remove_submenu_page('mycred-main','mycred-treasures');
        remove_submenu_page('mycred-main','mycred-support');
        remove_submenu_page('mycred-main','support-screen');

        if (!is_super_admin()) {
            remove_submenu_page('mycred-main', 'mycred-about');
        }
    }
	 //Plugin plugin manager
	 if(is_plugin_active('wp-plugin-manager/plugin-main.php')) {
        if (!is_super_admin()) {
            remove_submenu_page('htpm-options', 'htpm_recommendations');
        }
    }
	//kbx-support
	if(!is_plugin_active('support-ticket-kbx/qcld-support-ticket-main.php')) {
		remove_submenu_page('qcld-kbx-support-tickets', 'qcld-supports');
        if (!is_super_admin()) {
            remove_submenu_page('qcld-kbx-support-tickets', 'qcld-kbx-support-license');
        }
    }
	//woowbot
	if(is_plugin_active('woowbot-woocommerce-chatbot-pro/qcld-woowbot.php')) {
		remove_submenu_page('woowbot', 'woowbot_support_page');
        if (!is_super_admin()) {
            remove_submenu_page('woowbot', 'woowbot_license_page');
        }
    }
	//live chat bot
	if(is_plugin_active('live-chat-addon/wpbot-chat-addon.php')) {
        if (!is_super_admin()) {
            remove_submenu_page('wbca-chat-page', 'qc-wplive-chat-help-license');
        }
    }
	//fluent crm
	  if(is_plugin_active('fluent-crm/fluent-crm.php')){
		if (!is_super_admin()) {
            remove_submenu_page('fluentcrm-admin', 'fluentcrm-admin#/documentation');
        }
	}
	//messenger chatbot
	if(is_plugin_active('messenger-chatbot-addon/wpbot-fb-messenger-addon.php')){
		if (!is_super_admin()) {
            remove_submenu_page('wbfb-botsetting-page', 'messenger-chatbot-help-license');
        }
	}
}
add_action( 'network_admin_menu', 'customize_network_admin_menu_labels', 977);

function hide_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_node('WPML_ALS_all');
    if (!is_super_admin()) {
        $wp_admin_bar->remove_node('my-sites');
		define('UPDRAFTPLUS_ADMINBAR_DISABLE', true);
    }
}
add_action( 'wp_before_admin_bar_render', 'hide_admin_bar' );

?>