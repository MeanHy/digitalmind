<?php

if ( ! function_exists( 'innovio_mikado_logo_meta_box_map' ) ) {
	function innovio_mikado_logo_meta_box_map() {
		
		$logo_meta_box = innovio_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'innovio_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'innovio' ),
				'name'  => 'logo_meta'
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'innovio' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'innovio' ),
				'parent'      => $logo_meta_box
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'innovio' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'innovio' ),
				'parent'      => $logo_meta_box
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'innovio' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'innovio' ),
				'parent'      => $logo_meta_box
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'innovio' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'innovio' ),
				'parent'      => $logo_meta_box
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'innovio' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'innovio' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'innovio_mikado_action_meta_boxes_map', 'innovio_mikado_logo_meta_box_map', 47 );
}