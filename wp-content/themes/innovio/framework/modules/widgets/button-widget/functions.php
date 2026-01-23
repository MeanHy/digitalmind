<?php

if ( ! function_exists( 'innovio_mikado_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function innovio_mikado_register_button_widget( $widgets ) {
		$widgets[] = 'InnovioMikadoClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'innovio_core_filter_register_widgets', 'innovio_mikado_register_button_widget' );
}