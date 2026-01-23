<?php

if ( ! function_exists( 'innovio_mikado_get_hide_dep_for_header_vertical_area_options' ) ) {
	function innovio_mikado_get_hide_dep_for_header_vertical_area_options() {
		$hide_dep_options = apply_filters( 'innovio_mikado_filter_header_vertical_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'innovio_mikado_header_vertical_options_map' ) ) {
	function innovio_mikado_header_vertical_options_map( $panel_header ) {
		$hide_dep_options = innovio_mikado_get_hide_dep_for_header_vertical_area_options();
		
		$vertical_area_container = innovio_mikado_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'header_vertical_area_container',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
		
		innovio_mikado_add_admin_section_title(
			array(
				'parent' => $vertical_area_container,
				'name'   => 'menu_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'innovio' )
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'        => 'vertical_header_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'innovio' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'innovio' ),
				'parent'      => $vertical_area_container
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'vertical_header_background_image',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'innovio' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'innovio' ),
				'parent'        => $vertical_area_container
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Shadow', 'innovio' ),
				'description'   => esc_html__( 'Set shadow on vertical header', 'innovio' ),
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Vertical Area Border', 'innovio' ),
				'description'   => esc_html__( 'Set border on vertical area', 'innovio' )
			)
		);
		
		$vertical_header_shadow_border_container = innovio_mikado_add_admin_container(
			array(
				'parent'          => $vertical_area_container,
				'name'            => 'vertical_header_shadow_border_container',
				'dependency' => array(
					'hide' => array(
						'vertical_header_border'  => 'no'
					)
				)
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'        => $vertical_header_shadow_border_container,
				'type'          => 'color',
				'name'          => 'vertical_header_border_color',
				'default_value' => '',
				'label'         => esc_html__( 'Border Color', 'innovio' ),
				'description'   => esc_html__( 'Set border color for vertical area', 'innovio' ),
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_center_content',
				'default_value' => 'no',
				'label'         => esc_html__( 'Center Content', 'innovio' ),
				'description'   => esc_html__( 'Set content in vertical center', 'innovio' ),
			)
		);
		
		do_action( 'innovio_mikado_header_vertical_area_additional_options', $panel_header );
	}
	
	add_action( 'innovio_mikado_action_additional_header_menu_area_options_map', 'innovio_mikado_header_vertical_options_map' );
}