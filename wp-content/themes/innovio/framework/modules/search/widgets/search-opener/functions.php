<?php

if ( ! function_exists( 'innovio_mikado_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function innovio_mikado_register_search_opener_widget( $widgets ) {
		$widgets[] = 'InnovioMikadoClassSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'innovio_core_filter_register_widgets', 'innovio_mikado_register_search_opener_widget' );
}