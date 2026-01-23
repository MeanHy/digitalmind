<?php

if ( ! function_exists( 'innovio_mikado_register_recent_posts_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function innovio_mikado_register_recent_posts_widget( $widgets ) {
		$widgets[] = 'InnovioMikadoClassRecentPosts';
		
		return $widgets;
	}
	
	add_filter( 'innovio_core_filter_register_widgets', 'innovio_mikado_register_recent_posts_widget' );
}