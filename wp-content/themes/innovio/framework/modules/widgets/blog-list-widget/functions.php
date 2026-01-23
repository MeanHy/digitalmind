<?php

if ( ! function_exists( 'innovio_mikado_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function innovio_mikado_register_blog_list_widget( $widgets ) {
		$widgets[] = 'InnovioMikadoClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'innovio_core_filter_register_widgets', 'innovio_mikado_register_blog_list_widget' );
}