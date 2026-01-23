<?php

if ( ! function_exists( 'innovio_mikado_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function innovio_mikado_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'InnovioMikadoClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'innovio_core_filter_register_widgets', 'innovio_mikado_register_sticky_sidebar_widget' );
}