<?php

if ( ! function_exists( 'innovio_mikado_dropdown_cart_icon_styles' ) ) {
	/**
	 * Generates styles for dropdown cart icon
	 */
	function innovio_mikado_dropdown_cart_icon_styles() {
		$icon_color       = innovio_mikado_options()->getOptionValue( 'dropdown_cart_icon_color' );
		$icon_hover_color = innovio_mikado_options()->getOptionValue( 'dropdown_cart_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo innovio_mikado_dynamic_css( '.mkdf-shopping-cart-holder .mkdf-header-cart a', array( 'color' => $icon_color ) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo innovio_mikado_dynamic_css( '.mkdf-shopping-cart-holder .mkdf-header-cart a:hover', array( 'color' => $icon_hover_color ) );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic', 'innovio_mikado_dropdown_cart_icon_styles' );
}