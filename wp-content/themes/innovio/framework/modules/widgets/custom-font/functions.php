<?php

if ( ! function_exists( 'innovio_mikado_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function innovio_mikado_register_custom_font_widget( $widgets ) {
		$widgets[] = 'InnovioMikadoClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'innovio_core_filter_register_widgets', 'innovio_mikado_register_custom_font_widget' );
}