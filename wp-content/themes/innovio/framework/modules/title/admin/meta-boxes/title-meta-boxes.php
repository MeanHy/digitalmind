<?php

if ( ! function_exists( 'innovio_mikado_get_title_types_meta_boxes' ) ) {
	function innovio_mikado_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'innovio_mikado_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'innovio' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'innovio_mikado_map_title_meta' ) ) {
	function innovio_mikado_map_title_meta() {
		$title_type_meta_boxes = innovio_mikado_get_title_types_meta_boxes();
		
		$title_meta_box = innovio_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'innovio_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'innovio' ),
				'name'  => 'title_meta'
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'innovio' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'innovio' ),
				'parent'        => $title_meta_box,
				'options'       => innovio_mikado_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = innovio_mikado_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'mkdf_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'mkdf_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				innovio_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'innovio' ),
						'description'   => esc_html__( 'Choose title type', 'innovio' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				innovio_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'innovio' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'innovio' ),
						'options'       => innovio_mikado_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				innovio_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'innovio' ),
						'description' => esc_html__( 'Set a height for Title Area', 'innovio' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				innovio_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'innovio' ),
						'description' => esc_html__( 'Choose a background color for title area', 'innovio' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				innovio_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'innovio' ),
						'description' => esc_html__( 'Choose an Image for title area', 'innovio' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				innovio_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'innovio' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'innovio' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'innovio' ),
							'hide'                => esc_html__( 'Hide Image', 'innovio' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'innovio' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'innovio' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'innovio' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'innovio' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'innovio' )
						)
					)
				);
				
				innovio_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'innovio' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'innovio' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'innovio' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'innovio' ),
							'window-top'    => esc_html__( 'From Window Top', 'innovio' )
						)
					)
				);
				
				innovio_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'innovio' ),
						'options'       => innovio_mikado_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				innovio_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'innovio' ),
						'description' => esc_html__( 'Choose a color for title text', 'innovio' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				innovio_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'innovio' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'innovio' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				innovio_mikado_create_meta_box_field(
					array(
						'name'          => 'mkdf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'innovio' ),
						'options'       => innovio_mikado_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				innovio_mikado_create_meta_box_field(
					array(
						'name'        => 'mkdf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'innovio' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'innovio' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'innovio_mikado_action_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'innovio_mikado_action_meta_boxes_map', 'innovio_mikado_map_title_meta', 60 );
}