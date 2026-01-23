<?php
    // Exit if accessed directly
    if( !defined('ABSPATH') ) exit;
    
function customize_post_admin_menu_labels() {
 global $menu;
 global $submenu;
 $user = wp_get_current_user();
//for debugging to get all admin menu ids
// echo '<pre>'; print_r( $menu ); echo '</pre>'; // TOP LEVEL MENUS
// echo '<pre>'; print_r( $submenu ); echo '</pre>'; // SUBMENUS
// exit();
//affiliate
if(is_plugin_active('wolmart-core/wolmart-core.php')){
    remove_submenu_page('wolmart','wolmart');
    remove_submenu_page('wolmart','wolmart-version-control');
    remove_submenu_page('wolmart','wolmart-setup-wizard');
    remove_submenu_page('wolmart', 'customize.php');
}

if(is_plugin_active('pwa-for-wp/pwa-for-wp')) {
    remove_submenu_page('pwaforwp', 'javasctipt:void(0);');
}

if(is_plugin_active('affiliate-wp/affiliate-wp.php')){
    remove_submenu_page('affiliate-wp','affiliate-wp-add-ons');
}
//Zalo hack
if(is_plugin_active('login-by-zalo/login-by-zalo.php')){
    $menu[103][0] = esc_html__('Social Login', 'mtrl_framework');
}
//B2BKing hack
if(is_plugin_active('b2bking/b2bking.php')){
    if($menu['57'][0] == 'B2BKing'){
        $menu['57'][0] = esc_html__('B2BKing', 'mtrl_framework'); 
    }
    
}
//Digixon theme hack
$theme = wp_get_theme();
if ( 'Digixon' == $theme->name || 'Digixon' == $theme->parent_theme ) {
    $submenu['themes.php'][24][0] = esc_html__('Digixon Theme Options', 'mtrl_framework');
    $submenu['themes.php'][25][0] = esc_html__('Import Demo Content', 'mtrl_framework');
}
//WPBakery hack
if(is_plugin_active('elementor/elementor.php')){
    $allowed_roles = array('editor','author','shop_manager');
    if(array_intersect($allowed_roles, $user->roles )) {
        remove_menu_page('vc-welcome');
    }
}
//Elementor hack
if(is_plugin_active('elementor/elementor.php')){
    //Change Text for Elementor
    remove_submenu_page('elementor','go_elementor_pro');
    remove_submenu_page('elementor','elementor_custom_icons');
    remove_submenu_page('elementor','elementor_custom_fonts');
    remove_submenu_page('elementor','go_knowledge_base_site');
    if ( !is_admin() ) {
        remove_submenu_page('elementor','elementor-system-info');
    }
    $user = wp_get_current_user();
            $allowed_roles = array('editor','author','shop_manager');
            // if ( !is_admin() ) {
                if( array_intersect($allowed_roles, $user->roles ) ) {
                    remove_submenu_page('elementor','elementor-system-info');
                }

}
//Slider Revolution hack
if(is_plugin_active('revslider/revslider.php')){
    //Change Text for Slider Revolution
    if($menu['104'][0] == "Slider Revolution")
    {
        $menu['104'][0] = esc_html__('Slider Revolution', 'mtrl_framework');
    }

}

 //WPClever menu hack
    if(is_plugin_active('woo-smart-wishlist/wpc-smart-wishlist.php') || is_plugin_active('woo-smart-compare/wpc-smart-compare.php')){
        //Change Text for WPClever
        $menu['26.60602'][0] = esc_html__('Store Options', 'mtrl_framework');
        //Remove About from Menu
        remove_submenu_page('wpclever','wpclever');
        //Remove Essential Kit from Menu
        remove_submenu_page('wpclever','wpclever-kit');
        //Change Text for Smart Wishlist
        $submenu['wpclever'][3][0] = esc_html__('Smart Wishlist', 'mtrl_framework');
    }
 //Change text for media Menu
 $menu[10][0] = esc_html__('Media', 'mtrl_framework');
 if(is_plugin_active('woocommerce/woocommerce.php')){
     //Change translatable label for Analytics (some how untranslatable in Woocommerce) default menu to Analytics - language is in Admin Theme lang file
     //$menu[56][0] = esc_html__('Analytics', 'mtrl_framework');
     //Change translatable label for Woocommerce default menu to Language Management - language is in Admin Theme lang file
     $menu['55.5'][0] = esc_html__('Ecommerce', 'mtrl_framework');
     //Remove 'Settings -> Installer' the installer page for Woocommerce from Settings menu
     remove_submenu_page('options-general.php','installer');
     remove_submenu_page('woocommerce','wc-addons');
     if ( !is_admin() ) {
        remove_submenu_page('woocommerc','wc-status');
    }
 }
 if(is_plugin_active('WP_UltimateToursBuilder/UltimateToursBuilder.php')){
    //Change translatable label for Tours Builder default menu to Guide Builder - language is in Admin Theme lang file
    if($menu[101][0] == "Guides Buider"){
        $menu[101][0] = esc_html__('Guides Buider', 'mtrl_framework');
    }
 }
 if(is_plugin_active('sitepress-multilingual-cms/sitepress.php')){
    //Change translatable label for WPML to Multilingual - language is in Admin Theme lang file
    //$menu[102][0] = esc_html__('Multilingual', 'mtrl_framework');
    //Remove 'Support' from WPML menu
    remove_submenu_page('sitepress-multilingual-cms/menu/languages.php','sitepress-multilingual-cms/menu/support.php');
 }
 if(is_plugin_active('sitepress-multilingual-cms/sitepress.php') && is_plugin_active('woocommerce-multilingual/wpml-woocommerce.php') && is_plugin_active('woocommerce/woocommerce.php')){
    //Change translatable label for WPML Woocommerce default menu, displayed under Woocommerce (now Ecommerce) menu, to Language Management - language is in Admin Theme lang file
    $submenu['woocommerce'][7][0] = esc_html__('Language Management', 'mtrl_framework');
 }
 //mycred
 if(is_plugin_active('mycred/mycred.php')){
    //Change translatable label for WPML Woocommerce default menu, displayed under Woocommerce (now Ecommerce) menu, to Language Management - language is in Admin Theme lang file
    $menu[100][0] = esc_html__('myCred', 'mycred');
    $submenu['mycred-main'][0][0] = esc_html__('General Settings', 'mycred');
    $submenu['mycred-main'][2][0] = esc_html__('Tools', 'mycred');
 }
 //woowbot pro
 if(is_plugin_active('woowbot-woocommerce-chatbot-pro/qcld-woowbot.php')){
     if(get_current_blog_id() == 12) {
    $menu['6'][0] = esc_html__('WoowBot Pro', 'woochatbot');
    $submenu['woowbot'][0][0] = esc_html__('WoowBot Pro', 'woochatbot');
    $submenu['woowbot'][1][0] = esc_html__('Email Subscription', 'woochatbot');
    $submenu['woowbot'][2][0] = esc_html__('Export/import', 'woochatbot');
    $submenu['woowbot'][4][0] = esc_html__('Help & License', 'woochatbot');
     }
    if(get_current_blog_id() == 4) {
        $menu['6.64008'][0] = esc_html__( 'WoowBot Pro', 'woochatbot' );
    }
 }
 //cartflows
 if(is_plugin_active('cartflows/cartflows.php')){
	 if (is_super_admin()) {
    $menu[40][0] = esc_html__('CartFlows', 'cartflows');
	 }
 }
 //fs poster
 if(is_plugin_active('fs-poster/init.php')){
    $menu[90][0] = esc_html__('FS Poster', 'fs-poster');
 }
  //bot - live chat
  if(is_plugin_active('live-chat-addon/wpbot-chat-addon.php')){
    $menu[7][0] = esc_html__('Bot - Live Chat', 'wbca');
    $submenu['wbca-chat-page'][0][0] = esc_html__('Bot - Live Chat', 'wbca');
    $submenu['wbca-chat-page'][1][0] = esc_html__('Chat History', 'wbca');
    $submenu['wbca-chat-page'][2][0] = esc_html__('Live Chat Options', 'wbca');
    $submenu['wbca-chat-page'][3][0] = esc_html__('Help & License', 'wbca');
 }
//messenger bot chat
if(is_plugin_active('messenger-chatbot-addon/wpbot-fb-messenger-addon.php')){
    // $menu[9][0] = esc_html__('FS Poster', 'fs-poster');
    $submenu['wbfb-botsetting-page'][1][0] = esc_html__('Manage FB Pages', 'wpfb');
    $submenu['wbfb-botsetting-page'][2][0] = esc_html__('Help & License', 'wbca');
 }

 //remove the update tab of the plugin dokan
if(is_plugin_active('dokan/dokan.php')){
    remove_submenu_page('index.php','update-core.php');
}

 //if ((is_super_admin() && get_current_blog_id() == 1) || strpos($_SERVER['REQUEST_URI'], 'wp-admin/network/')) {
    //Change translatable label for NS Cloner default menu to Site Copier - language is in Admin Theme lang file
    //$menu['100.20024'][0] = esc_html__('Site Copier', 'mtrl_framework');
 //}
 //$menu['58'][2] = $submenu['woocommerce-marketing'][1][2];
 //$menu['55.5'][2] = $submenu['woocommerce'][1][2];
// if user can see tools menu and the wp-control plugin is installed and active, change the text of Scheduled Actions to a shorter one to avoid changing Worpdres translation for better updates later on. The label is controlled within Admin-Theme (Material Admin)
if (current_user_can( 'manage_options') && is_plugin_active('wp-crontrol/wp-crontrol.php')) {
    //there is no Site Deletion Menu for the main site (id=1) so the submenu id is lower
    if (get_current_blog_id() == 1) {
        $submenu['tools.php'][38][0] = esc_html__('Scheduled Actions', 'mtrl_framework');
    }else{
        $submenu['tools.php'][43][0] = esc_html__('Scheduled Actions', 'mtrl_framework');
    }
} else {
    //there is no Site Deletion Menu for the main site (id=1) so the submenu id is lower
    if (get_current_blog_id() == 1) {
        $submenu['tools.php'][37][0] = esc_html__('Scheduled Actions', 'mtrl_framework');
    }else{
        $submenu['tools.php'][42][0] = esc_html__('Scheduled Actions', 'mtrl_framework');
    }
}

        if (array_intersect(array('marketplace'), $user->roles )) { 
            //remove_menu_page('woocommerce');
            //remove_menu_page('woocommerce-marketing');
            //remove_menu_page('edit.php');
            //remove_menu_page('wpclever');
            //remove_menu_page('edit.php?post_type=elementor_library');
            //remove_menu_page('tools.php');
            //remove_menu_page('dokan');
            //remove_menu_page('edit.php?post_type=product');

        }
        // remove 'update core'
        remove_menu_page('update-core.php');
}
add_action( 'admin_menu', 'customize_post_admin_menu_labels', 986);
?>