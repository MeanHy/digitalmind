<?php

if ( ! function_exists( 'innovio_mikado_register_header_vertical_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function innovio_mikado_register_header_vertical_type( $header_types ) {
		$header_type = array(
			'header-vertical' => 'InnovioMikadoNamespace\Modules\Header\Types\HeaderVertical'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'innovio_mikado_init_register_header_vertical_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function innovio_mikado_init_register_header_vertical_type() {
		add_filter( 'innovio_mikado_filter_register_header_type_class', 'innovio_mikado_register_header_vertical_type' );
	}
	
	add_action( 'innovio_mikado_action_before_header_function_init', 'innovio_mikado_init_register_header_vertical_type' );
}

if ( ! function_exists( 'innovio_mikado_include_header_vertical_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function innovio_mikado_include_header_vertical_menu( $menus ) {
		$menus['vertical-navigation'] = esc_html__( 'Vertical Navigation', 'innovio' );
		
		return $menus;
	}
	
	if ( innovio_mikado_check_is_header_type_enabled( 'header-vertical' ) ) {
		add_filter( 'innovio_mikado_filter_register_headers_menu', 'innovio_mikado_include_header_vertical_menu' );
	}
}

if ( ! function_exists( 'innovio_mikado_get_header_vertical_main_menu' ) ) {
	/**
	 * Loads vertical menu HTML
	 */
	function innovio_mikado_get_header_vertical_main_menu() {
		$menu_opening = innovio_mikado_options()->getOptionValue('vertical_menu_dropdown_opening');
		
		$params = array(
			'opening_class' => 'mkdf-vertical-dropdown-'. ( $menu_opening !== '' ? $menu_opening : 'below' )
		);

		innovio_mikado_get_module_template_part( 'templates/vertical-navigation', 'header/types/header-vertical', '', $params );
	}
}

if ( ! function_exists( 'innovio_mikado_vertical_header_holder_class' ) ) {
	/**
	 * Return holder class
	 */
	function innovio_mikado_vertical_header_holder_class() {
		$center_content = innovio_mikado_get_meta_field_intersect( 'vertical_header_center_content', innovio_mikado_get_page_id() );
		$holder_class   = $center_content === 'yes' ? 'mkdf-vertical-alignment-center' : 'mkdf-vertical-alignment-top';
		
		return $holder_class;
	}
}

if ( ! function_exists( 'innovio_mikado_header_vertical_per_page_custom_styles' ) ) {
	/**
	 * Return header per page styles
	 */
	function innovio_mikado_header_vertical_per_page_custom_styles( $style, $class_prefix, $page_id ) {
		$header_area_style    = array();
		$header_area_selector = array( $class_prefix . '.mkdf-header-vertical .mkdf-vertical-area-background' );
		
		$vertical_header_background_color  = get_post_meta( $page_id, 'mkdf_vertical_header_background_color_meta', true );
		$disable_vertical_background_image = get_post_meta( $page_id, 'mkdf_disable_vertical_header_background_image_meta', true );
		$vertical_background_image         = get_post_meta( $page_id, 'mkdf_vertical_header_background_image_meta', true );
		$vertical_shadow                   = get_post_meta( $page_id, 'mkdf_vertical_header_shadow_meta', true );
		$vertical_border                   = get_post_meta( $page_id, 'mkdf_vertical_header_border_meta', true );
		
		if ( ! empty( $vertical_header_background_color ) ) {
			$header_area_style['background-color'] = $vertical_header_background_color;
		}
		
		if ( $disable_vertical_background_image == 'yes' ) {
			$header_area_style['background-image'] = 'none';
		} elseif ( $vertical_background_image !== '' ) {
			$header_area_style['background-image'] = 'url(' . $vertical_background_image . ')';
		}
		
		if ( $vertical_shadow == 'yes' ) {
			$header_area_style['box-shadow'] = '1px 0 3px rgba(0, 0, 0, 0.05)';
		}
		
		if ( $vertical_border == 'yes' ) {
			$header_border_color = get_post_meta( $page_id, 'mkdf_vertical_header_border_color_meta', true );
			
			if ( $header_border_color !== '' ) {
				$header_area_style['border-right'] = '1px solid ' . $header_border_color;
			}
		}
		
		$current_style = '';
		
		if ( ! empty( $header_area_style ) ) {
			$current_style .= innovio_mikado_dynamic_css( $header_area_selector, $header_area_style );
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'innovio_mikado_filter_add_header_page_custom_style', 'innovio_mikado_header_vertical_per_page_custom_styles', 10, 3 );
}