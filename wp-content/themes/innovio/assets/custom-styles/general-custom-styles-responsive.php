<?php

if ( ! function_exists( 'innovio_mikado_content_responsive_styles' ) ) {
	/**
	 * Generates content responsive custom styles
	 */
	function innovio_mikado_content_responsive_styles() {
		$content_style = array();
		
		$padding_mobile = innovio_mikado_options()->getOptionValue( 'content_padding_mobile' );
		if ( $padding_mobile !== '' ) {
			$content_style['padding'] = $padding_mobile;
		}
		
		$content_selector = array(
			'.mkdf-content .mkdf-content-inner > .mkdf-container > .mkdf-container-inner',
			'.mkdf-content .mkdf-content-inner > .mkdf-full-width > .mkdf-full-width-inner',
		);
		
		echo innovio_mikado_dynamic_css( $content_selector, $content_style );
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_1024', 'innovio_mikado_content_responsive_styles' );
}

if ( ! function_exists( 'innovio_mikado_h1_responsive_styles3' ) ) {
	function innovio_mikado_h1_responsive_styles3() {
		$selector = array(
			'h1'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h1_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_768_1024', 'innovio_mikado_h1_responsive_styles3' );
}

if ( ! function_exists( 'innovio_mikado_h2_responsive_styles3' ) ) {
	function innovio_mikado_h2_responsive_styles3() {
		$selector = array(
			'h2'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h2_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_768_1024', 'innovio_mikado_h2_responsive_styles3' );
}

if ( ! function_exists( 'innovio_mikado_h3_responsive_styles3' ) ) {
	function innovio_mikado_h3_responsive_styles3() {
		$selector = array(
			'h3'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h3_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_768_1024', 'innovio_mikado_h3_responsive_styles3' );
}

if ( ! function_exists( 'innovio_mikado_h4_responsive_styles3' ) ) {
	function innovio_mikado_h4_responsive_styles3() {
		$selector = array(
			'h4'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h4_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_768_1024', 'innovio_mikado_h4_responsive_styles3' );
}

if ( ! function_exists( 'innovio_mikado_h5_responsive_styles3' ) ) {
	function innovio_mikado_h5_responsive_styles3() {
		$selector = array(
			'h5'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h5_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_768_1024', 'innovio_mikado_h5_responsive_styles3' );
}

if ( ! function_exists( 'innovio_mikado_h6_responsive_styles3' ) ) {
	function innovio_mikado_h6_responsive_styles3() {
		$selector = array(
			'h6'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h6_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_768_1024', 'innovio_mikado_h6_responsive_styles3' );
}

if ( ! function_exists( 'innovio_mikado_h1_responsive_styles' ) ) {
	function innovio_mikado_h1_responsive_styles() {
		$selector = array(
			'h1'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h1_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_680_768', 'innovio_mikado_h1_responsive_styles' );
}

if ( ! function_exists( 'innovio_mikado_h2_responsive_styles' ) ) {
	function innovio_mikado_h2_responsive_styles() {
		$selector = array(
			'h2'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h2_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_680_768', 'innovio_mikado_h2_responsive_styles' );
}

if ( ! function_exists( 'innovio_mikado_h3_responsive_styles' ) ) {
	function innovio_mikado_h3_responsive_styles() {
		$selector = array(
			'h3'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h3_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_680_768', 'innovio_mikado_h3_responsive_styles' );
}

if ( ! function_exists( 'innovio_mikado_h4_responsive_styles' ) ) {
	function innovio_mikado_h4_responsive_styles() {
		$selector = array(
			'h4'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h4_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_680_768', 'innovio_mikado_h4_responsive_styles' );
}

if ( ! function_exists( 'innovio_mikado_h5_responsive_styles' ) ) {
	function innovio_mikado_h5_responsive_styles() {
		$selector = array(
			'h5'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h5_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_680_768', 'innovio_mikado_h5_responsive_styles' );
}

if ( ! function_exists( 'innovio_mikado_h6_responsive_styles' ) ) {
	function innovio_mikado_h6_responsive_styles() {
		$selector = array(
			'h6'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h6_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_680_768', 'innovio_mikado_h6_responsive_styles' );
}

if ( ! function_exists( 'innovio_mikado_text_responsive_styles' ) ) {
	function innovio_mikado_text_responsive_styles() {
		$selector = array(
			'body',
			'p'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'text', '_res1' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_680_768', 'innovio_mikado_text_responsive_styles' );
}

if ( ! function_exists( 'innovio_mikado_h1_responsive_styles2' ) ) {
	function innovio_mikado_h1_responsive_styles2() {
		$selector = array(
			'h1'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h1_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_680', 'innovio_mikado_h1_responsive_styles2' );
}

if ( ! function_exists( 'innovio_mikado_h2_responsive_styles2' ) ) {
	function innovio_mikado_h2_responsive_styles2() {
		$selector = array(
			'h2'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h2_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_680', 'innovio_mikado_h2_responsive_styles2' );
}

if ( ! function_exists( 'innovio_mikado_h3_responsive_styles2' ) ) {
	function innovio_mikado_h3_responsive_styles2() {
		$selector = array(
			'h3'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h3_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_680', 'innovio_mikado_h3_responsive_styles2' );
}

if ( ! function_exists( 'innovio_mikado_h4_responsive_styles2' ) ) {
	function innovio_mikado_h4_responsive_styles2() {
		$selector = array(
			'h4'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h4_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_680', 'innovio_mikado_h4_responsive_styles2' );
}

if ( ! function_exists( 'innovio_mikado_h5_responsive_styles2' ) ) {
	function innovio_mikado_h5_responsive_styles2() {
		$selector = array(
			'h5'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h5_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_680', 'innovio_mikado_h5_responsive_styles2' );
}

if ( ! function_exists( 'innovio_mikado_h6_responsive_styles2' ) ) {
	function innovio_mikado_h6_responsive_styles2() {
		$selector = array(
			'h6'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'h6_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_680', 'innovio_mikado_h6_responsive_styles2' );
}

if ( ! function_exists( 'innovio_mikado_text_responsive_styles2' ) ) {
	function innovio_mikado_text_responsive_styles2() {
		$selector = array(
			'body',
			'p'
		);
		
		$styles = innovio_mikado_get_responsive_typography_styles( 'text', '_res2' );
		
		if ( ! empty( $styles ) ) {
			echo innovio_mikado_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'innovio_mikado_action_style_dynamic_responsive_680', 'innovio_mikado_text_responsive_styles2' );
}