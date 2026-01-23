<?php

if ( ! function_exists( 'innovio_mikado_skewed_section_title_meta' ) ) {
	function innovio_mikado_skewed_section_title_meta( $show_title_area_container ) {
		
		innovio_mikado_add_admin_section_title(
			array(
				'parent' => $show_title_area_container,
				'name'   => 'skewed_section_container',
				'title'  => esc_html__( 'Skewed Section', 'innovio' )
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_enable_skewed_section_on_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Skewed Section', 'innovio' ),
				'description'   => esc_html__( 'This option will enable/disable Skew Section on Title Area', 'innovio' ),
				'options'       => innovio_mikado_get_yes_no_select_array(),
				'parent'        => $show_title_area_container
			)
		);
		
		$show_skewed_section_title_area_container = innovio_mikado_add_admin_container(
			array(
				'parent'     => $show_title_area_container,
				'name'       => 'show_skewed_section_title_area_container',
				'dependency' => array(
					'show' => array(
						'mkdf_enable_skewed_section_on_title_area_meta' => 'yes'
					)
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_title_area_skewed_section_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Position', 'innovio' ),
				'description'   => esc_html__( 'Specify skewed section position', 'innovio' ),
				'parent'        => $show_skewed_section_title_area_container,
				'options'       => array(
					''        => esc_html__( 'Default', 'innovio' ),
					'outline' => esc_html__( 'Outline', 'innovio' ),
					'inset'   => esc_html__( 'Inset', 'innovio' )
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_title_area_container,
				'type'        => 'textarea',
				'name'        => 'mkdf_title_area_skewed_section_svg_path_meta',
				'label'       => esc_html__( 'Skewed Section On Title Area SVG Path', 'innovio' ),
				'description' => esc_html__( 'Enter your Section On Title Area SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'innovio' ),
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_title_area_container,
				'type'        => 'color',
				'name'        => 'mkdf_title_area_skewed_section_svg_color_meta',
				'label'       => esc_html__( 'Skewed Section Color', 'innovio' ),
				'description' => esc_html__( 'Choose a background color for Skewed Section', 'innovio' ),
			)
		);
	}
	
	add_action( 'innovio_mikado_action_additional_title_area_meta_boxes', 'innovio_mikado_skewed_section_title_meta', 20 );
}

if ( ! function_exists( 'innovio_mikado_skewed_section_header_meta' ) ) {
	function innovio_mikado_skewed_section_header_meta( $show_header_area_container ) {
		
		innovio_mikado_add_admin_section_title(
			array(
				'parent' => $show_header_area_container,
				'name'   => 'skewed_section_container',
				'title'  => esc_html__( 'Skewed Section', 'innovio' )
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_enable_skewed_section_on_header_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Skewed Section', 'innovio' ),
				'description'   => esc_html__( 'This option will enable/disable Skew Section on Header Area', 'innovio' ),
				'options'       => innovio_mikado_get_yes_no_select_array(),
				'parent'        => $show_header_area_container
			)
		);
		
		$show_skewed_section_header_area_container = innovio_mikado_add_admin_container(
			array(
				'parent'     => $show_header_area_container,
				'name'       => 'show_skewed_section_header_area_container',
				'dependency' => array(
					'show' => array(
						'mkdf_enable_skewed_section_on_header_area_meta' => 'yes'
					)
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_header_area_container,
				'type'        => 'textarea',
				'name'        => 'mkdf_header_area_skewed_section_svg_path_meta',
				'label'       => esc_html__( 'Skewed Section On Header Area SVG Path', 'innovio' ),
				'description' => esc_html__( 'Enter your Section On Header Area SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'innovio' ),
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_header_area_container,
				'type'        => 'color',
				'name'        => 'mkdf_header_area_skewed_section_svg_color_meta',
				'label'       => esc_html__( 'Skewed Section Color', 'innovio' ),
				'description' => esc_html__( 'Choose a background color for Skewed Section', 'innovio' ),
			)
		);
	}
	
	add_action( 'innovio_mikado_action_additional_header_area_meta_boxes', 'innovio_mikado_skewed_section_header_meta', 20 );
}