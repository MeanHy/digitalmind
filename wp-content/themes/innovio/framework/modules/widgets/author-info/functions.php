<?php

if ( ! function_exists( 'innovio_mikado_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function innovio_mikado_register_author_info_widget( $widgets ) {
		$widgets[] = 'InnovioMikadoClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'innovio_core_filter_register_widgets', 'innovio_mikado_register_author_info_widget' );
}