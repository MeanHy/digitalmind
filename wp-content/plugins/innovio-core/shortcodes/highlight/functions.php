<?php

if ( ! function_exists( 'innovio_core_add_highlight_shortcodes' ) ) {
	function innovio_core_add_highlight_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'InnovioCore\CPT\Shortcodes\Highlight\Highlight'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'innovio_core_filter_add_vc_shortcode', 'innovio_core_add_highlight_shortcodes' );
}