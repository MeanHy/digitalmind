<?php

if ( ! function_exists( 'innovio_mikado_get_hide_dep_for_header_standard_options' ) ) {
	function innovio_mikado_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'innovio_mikado_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'innovio_mikado_header_standard_map' ) ) {
	function innovio_mikado_header_standard_map( $parent ) {
		$hide_dep_options = innovio_mikado_get_hide_dep_for_header_standard_options();
		
		innovio_mikado_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'innovio' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'innovio' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'innovio' ),
					'left'   => esc_html__( 'Left', 'innovio' ),
					'center' => esc_html__( 'Center', 'innovio' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'innovio_mikado_action_additional_header_menu_area_options_map', 'innovio_mikado_header_standard_map' );
}