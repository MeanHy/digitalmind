<?php

if ( ! function_exists( 'innovio_mikado_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function innovio_mikado_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'innovio_mikado_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'innovio_mikado_header_standard_meta_map' ) ) {
	function innovio_mikado_header_standard_meta_map( $parent ) {
		$hide_dep_options = innovio_mikado_get_hide_dep_for_header_standard_meta_boxes();
		
		innovio_mikado_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'mkdf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'innovio' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'innovio' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'innovio' ),
					'left'   => esc_html__( 'Left', 'innovio' ),
					'right'  => esc_html__( 'Right', 'innovio' ),
					'center' => esc_html__( 'Center', 'innovio' )
				),
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'innovio_mikado_action_additional_header_area_meta_boxes_map', 'innovio_mikado_header_standard_meta_map' );
}