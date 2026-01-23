<?php

if ( ! function_exists( 'innovio_mikado_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function innovio_mikado_register_separator_widget( $widgets ) {
		$widgets[] = 'InnovioMikadoClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'innovio_core_filter_register_widgets', 'innovio_mikado_register_separator_widget' );
}