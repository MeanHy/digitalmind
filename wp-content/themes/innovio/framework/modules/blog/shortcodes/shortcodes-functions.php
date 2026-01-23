<?php

if ( ! function_exists( 'innovio_mikado_include_blog_shortcodes' ) ) {
	function innovio_mikado_include_blog_shortcodes() {
		foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	if ( innovio_mikado_core_plugin_installed() ) {
		add_action( 'innovio_core_action_include_shortcodes_file', 'innovio_mikado_include_blog_shortcodes' );
	}
}
