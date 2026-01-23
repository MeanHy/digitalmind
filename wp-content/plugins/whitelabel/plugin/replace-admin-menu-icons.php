<?php
	// Exit if accessed directly
	if( !defined('ABSPATH') ) exit;

	function replace_admin_menu_icons_css() {
		wp_enqueue_style( 'customize-replace-admin-menu-icons', plugins_url('/assets/css/replace-admin-menu-icons.css',__FILE__ ),array(),'2.0');

	}
	add_action( 'admin_enqueue_scripts', 'replace_admin_menu_icons_css', 998);
?>