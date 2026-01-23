<?php
// Exit if accessed directly
if( !defined('ABSPATH') ) exit;



// function admin_bar_remove_logo() {
//     global $wp_admin_bar;
//     $wp_admin_bar->remove_menu( 'wp-logo' );
//     remove_meta_box('dashboard_primary', 'dashboard', 'side');
// 	wp_enqueue_style( 'customize-admin_bar_remove_logo', plugins_url('/assets/css/global.css',__FILE__ ));
// }
// add_action( 'admin_enqueue_scripts', 'admin_bar_remove_logo', 0 );

function mytheme_remove_help_tabs() {
    $screen = get_current_screen();
    $screen->remove_help_tabs();
}
add_action('admin_enqueue_scripts', 'mytheme_remove_help_tabs', 997);


function custom_login_title($origtitle) {
    return get_bloginfo('name');
}
add_action('login_title', 'custom_login_title', 990);
add_action( 'use_block_editor_for_post', '__return_false', 989);

/* Themes Start */

// //Admin layout digixon theme option
// function digixon_theme_option_layout_adjustment() {
//     if (strpos($_SERVER['REQUEST_URI'], 'digixon-theme-option') !== false) {
//         wp_enqueue_style( 'customize-digixon-theme-option', get_stylesheet_directory_uri() . "/assets/css/digixon-admin.css",'1.0','all' );
//     }
//     $theme = wp_get_theme();
// 	if ( 'Digixon' == $theme->name || 'Digixon' == $theme->parent_theme ) {
// 		$user = wp_get_current_user();
// 		$allowed_roles = array('editor','author','shop_manager');
//         if(array_intersect($allowed_roles, $user->roles )) {
//             wp_enqueue_style( 'customize-digixon-theme-option', get_stylesheet_directory_uri() . "/assets/css/digixon-admin.css",'1.0','all' );
//         }
// 	}
// }
// add_action( 'admin_enqueue_scripts', 'digixon_theme_option_layout_adjustment', 966);

// //Admin UI Fixing for econis theme
// function econis_layout_adjustment() {
//     wp_enqueue_style( 'customize-econis-theme-option', get_stylesheet_directory_uri() . "/assets/css/econis-admin.css",'1.0','all' );
// 	$theme = wp_get_theme();
//     if ('Econis Child' == $theme->name || 'Econis' == $theme->parent_theme) {
//         if (strpos($_SERVER['REQUEST_URI'], 'econis') !== false) {
//             wp_enqueue_style( 'customize-econis-theme-option', get_stylesheet_directory_uri() . "/assets/css/econis-admin.css",'1.0','all' );
//         }
//     }
// }
// add_action( 'admin_enqueue_scripts', 'econis_layout_adjustment', 971);

?>
