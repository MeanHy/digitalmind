<?php

if ( ! function_exists( 'innovio_mikado_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function innovio_mikado_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'InnovioMikadoClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'innovio_core_filter_register_widgets', 'innovio_mikado_register_image_gallery_widget' );
}