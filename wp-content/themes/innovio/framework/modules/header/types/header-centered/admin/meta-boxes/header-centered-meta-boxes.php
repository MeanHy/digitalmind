<?php

if ( ! function_exists( 'innovio_mikado_get_hide_dep_for_header_centered_meta_boxes' ) ) {
	function innovio_mikado_get_hide_dep_for_header_centered_meta_boxes() {
		$hide_dep_options = apply_filters( 'innovio_mikado_filter_header_centered_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'innovio_mikado_header_centered_meta_map' ) ) {
	function innovio_mikado_header_centered_meta_map( $parent ) {
		$hide_dep_options = innovio_mikado_get_hide_dep_for_header_centered_meta_boxes();
		
		innovio_mikado_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'text',
				'name'            => 'mkdf_logo_wrapper_padding_header_centered_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Logo Padding', 'innovio' ),
				'description'     => esc_html__( 'Insert padding in format: 0px 0px 1px 0px', 'innovio' ),
				'args'            => array(
					'col_width' => 3
				),
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'innovio_mikado_action_header_logo_area_additional_meta_boxes_map', 'innovio_mikado_header_centered_meta_map', 10, 1 );
}