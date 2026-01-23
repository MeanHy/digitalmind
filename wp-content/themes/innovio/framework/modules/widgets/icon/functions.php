<?php

if ( ! function_exists( 'innovio_mikado_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function innovio_mikado_register_icon_widget( $widgets ) {
		$widgets[] = 'InnovioMikadoClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'innovio_core_filter_register_widgets', 'innovio_mikado_register_icon_widget' );
}