<?php

if ( ! function_exists( 'innovio_mikado_register_social_icons_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function innovio_mikado_register_social_icons_widget( $widgets ) {
		$widgets[] = 'InnovioMikadoClassClassIconsGroupWidget';
		
		return $widgets;
	}
	
	add_filter( 'innovio_core_filter_register_widgets', 'innovio_mikado_register_social_icons_widget' );
}