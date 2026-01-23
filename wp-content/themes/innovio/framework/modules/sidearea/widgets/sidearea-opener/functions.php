<?php

if ( ! function_exists( 'innovio_mikado_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function innovio_mikado_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'InnovioMikadoClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'innovio_core_filter_register_widgets', 'innovio_mikado_register_sidearea_opener_widget' );
}