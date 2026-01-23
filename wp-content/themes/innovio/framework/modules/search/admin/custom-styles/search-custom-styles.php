<?php

if ( ! function_exists( 'innovio_mikado_search_opener_icon_size' ) ) {
	function innovio_mikado_search_opener_icon_size() {
		$icon_size = innovio_mikado_options()->getOptionValue( 'header_search_icon_size' );
		
		if ( ! empty( $icon_size ) ) {
			echo innovio_mikado_dynamic_css( '.mkdf-search-opener', array(
				'font-size' => innovio_mikado_filter_px( $icon_size ) . 'px'
			) );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic', 'innovio_mikado_search_opener_icon_size' );
}

if ( ! function_exists( 'innovio_mikado_search_opener_icon_colors' ) ) {
	function innovio_mikado_search_opener_icon_colors() {
		$icon_color       = innovio_mikado_options()->getOptionValue( 'header_search_icon_color' );
		$icon_hover_color = innovio_mikado_options()->getOptionValue( 'header_search_icon_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo innovio_mikado_dynamic_css( '.mkdf-search-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo innovio_mikado_dynamic_css( '.mkdf-search-opener:hover', array(
				'color' => $icon_hover_color
			) );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic', 'innovio_mikado_search_opener_icon_colors' );
}

if ( ! function_exists( 'innovio_mikado_search_opener_text_styles' ) ) {
	function innovio_mikado_search_opener_text_styles() {
		$item_styles = innovio_mikado_get_typography_styles( 'search_icon_text' );
		
		$item_selector = array(
			'.mkdf-search-icon-text'
		);
		
		echo innovio_mikado_dynamic_css( $item_selector, $item_styles );
		
		$text_hover_color = innovio_mikado_options()->getOptionValue( 'search_icon_text_color_hover' );
		
		if ( ! empty( $text_hover_color ) ) {
			echo innovio_mikado_dynamic_css( '.mkdf-search-opener:hover .mkdf-search-icon-text', array(
				'color' => $text_hover_color
			) );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic', 'innovio_mikado_search_opener_text_styles' );
}