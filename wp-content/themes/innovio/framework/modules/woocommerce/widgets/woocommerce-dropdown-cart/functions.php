<?php

if ( ! function_exists( 'innovio_mikado_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function innovio_mikado_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'InnovioMikadoClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'innovio_core_filter_register_widgets', 'innovio_mikado_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'innovio_mikado_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function innovio_mikado_get_dropdown_cart_icon_class() {
		$classes = array(
			'mkdf-header-cart'
		);
		
		$classes[] = innovio_mikado_get_icon_sources_class( 'dropdown_cart', 'mkdf-header-cart' );
		
		return $classes;
	}
}