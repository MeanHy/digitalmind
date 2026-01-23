<?php

if ( ! function_exists( 'innovio_mikado_get_hide_dep_for_top_header_area_meta_boxes' ) ) {
	function innovio_mikado_get_hide_dep_for_top_header_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'innovio_mikado_filter_top_header_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'innovio_mikado_header_top_area_meta_options_map' ) ) {
	function innovio_mikado_header_top_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = innovio_mikado_get_hide_dep_for_top_header_area_meta_boxes();
		
		$top_header_container = innovio_mikado_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'mkdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
		
		innovio_mikado_add_admin_section_title(
			array(
				'parent' => $top_header_container,
				'name'   => 'top_area_style',
				'title'  => esc_html__( 'Top Area', 'innovio' )
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_top_bar_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Top Bar', 'innovio' ),
				'description'   => esc_html__( 'Enabling this option will show header top bar area', 'innovio' ),
				'parent'        => $top_header_container,
				'options'       => innovio_mikado_get_yes_no_select_array(),
			)
		);
		
		$top_bar_container = innovio_mikado_add_admin_container_no_style(
			array(
				'name'            => 'top_bar_container_no_style',
				'parent'          => $top_header_container,
				'dependency' => array(
					'show' => array(
						'mkdf_top_bar_meta' => 'yes'
					)
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_top_bar_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar In Grid', 'innovio' ),
				'description'   => esc_html__( 'Set top bar content to be in grid', 'innovio' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => innovio_mikado_get_yes_no_select_array()
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'   => 'mkdf_top_bar_background_color_meta',
				'type'   => 'color',
				'label'  => esc_html__( 'Top Bar Background Color', 'innovio' ),
				'parent' => $top_bar_container
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_top_bar_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Top Bar Background Color Transparency', 'innovio' ),
				'description' => esc_html__( 'Set top bar background color transparenct. Value should be between 0 and 1', 'innovio' ),
				'parent'      => $top_bar_container,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_top_bar_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar Border', 'innovio' ),
				'description'   => esc_html__( 'Set border on top bar', 'innovio' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => innovio_mikado_get_yes_no_select_array()
			)
		);
		
		$top_bar_border_container = innovio_mikado_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'top_bar_border_container',
				'parent'          => $top_bar_container,
				'dependency' => array(
					'show' => array(
						'mkdf_top_bar_border_meta' => 'yes'
					)
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_top_bar_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'innovio' ),
				'description' => esc_html__( 'Choose color for top bar border', 'innovio' ),
				'parent'      => $top_bar_border_container
			)
		);
	}
	
	add_action( 'innovio_mikado_action_additional_header_area_meta_boxes_map', 'innovio_mikado_header_top_area_meta_options_map' );
}