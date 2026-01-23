<?php

if ( ! function_exists( 'innovio_mikado_map_footer_meta' ) ) {
	function innovio_mikado_map_footer_meta() {
		
		$footer_meta_box = innovio_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'innovio_mikado_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'footer_meta' ),
				'title' => esc_html__( 'Footer', 'innovio' ),
				'name'  => 'footer_meta'
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_disable_footer_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Disable Footer For This Page', 'innovio' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'innovio' ),
				'options'       => innovio_mikado_get_yes_no_select_array(),
				'parent'        => $footer_meta_box
			)
		);
		
		$show_footer_meta_container = innovio_mikado_add_admin_container(
			array(
				'name'       => 'mkdf_show_footer_meta_container',
				'parent'     => $footer_meta_box,
				'dependency' => array(
					'hide' => array(
						'mkdf_disable_footer_meta' => 'yes'
					)
				)
			)
		);
		
			innovio_mikado_create_meta_box_field(
				array(
					'name'          => 'mkdf_footer_in_grid_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Footer in Grid', 'innovio' ),
					'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'innovio' ),
					'options'       => innovio_mikado_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
			
			innovio_mikado_create_meta_box_field(
				array(
					'name'          => 'mkdf_uncovering_footer_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Uncovering Footer', 'innovio' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'innovio' ),
					'options'       => innovio_mikado_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			innovio_mikado_create_meta_box_field(
				array(
					'name'          => 'mkdf_show_footer_top_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Top', 'innovio' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'innovio' ),
					'options'       => innovio_mikado_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			$footer_top_styles_group = innovio_mikado_add_admin_group(
				array(
					'name'        => 'footer_top_styles_group',
					'title'       => esc_html__( 'Footer Top Styles', 'innovio' ),
					'description' => esc_html__( 'Define style for footer top area', 'innovio' ),
					'parent'      => $show_footer_meta_container,
					'dependency'  => array(
						'hide' => array(
							'mkdf_show_footer_top_meta' => 'no'
						)
					)
				)
			);
			
			$footer_top_styles_row_1 = innovio_mikado_add_admin_row(
				array(
					'name'   => 'footer_top_styles_row_1',
					'parent' => $footer_top_styles_group
				)
			);
		
				innovio_mikado_create_meta_box_field(
					array(
						'name'   => 'mkdf_footer_top_background_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Background Color', 'innovio' ),
						'parent' => $footer_top_styles_row_1
					)
				);
		
				innovio_mikado_create_meta_box_field(
					array(
						'name'   => 'mkdf_footer_top_border_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Border Color', 'innovio' ),
						'parent' => $footer_top_styles_row_1
					)
				);
		
				innovio_mikado_create_meta_box_field(
					array(
						'name'   => 'mkdf_footer_top_border_width_meta',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Border Width', 'innovio' ),
						'parent' => $footer_top_styles_row_1,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
			
			innovio_mikado_create_meta_box_field(
				array(
					'name'          => 'mkdf_show_footer_bottom_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Bottom', 'innovio' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'innovio' ),
					'options'       => innovio_mikado_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			$footer_bottom_styles_group = innovio_mikado_add_admin_group(
				array(
					'name'        => 'footer_bottom_styles_group',
					'title'       => esc_html__( 'Footer Bottom Styles', 'innovio' ),
					'description' => esc_html__( 'Define style for footer bottom area', 'innovio' ),
					'parent'      => $show_footer_meta_container,
					'dependency'  => array(
						'hide' => array(
							'mkdf_show_footer_bottom_meta' => 'no'
						)
					)
				)
			);
			
			$footer_bottom_styles_row_1 = innovio_mikado_add_admin_row(
				array(
					'name'   => 'footer_bottom_styles_row_1',
					'parent' => $footer_bottom_styles_group
				)
			);
			
				innovio_mikado_create_meta_box_field(
					array(
						'name'   => 'mkdf_footer_bottom_background_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Background Color', 'innovio' ),
						'parent' => $footer_bottom_styles_row_1
					)
				);
				
				innovio_mikado_create_meta_box_field(
					array(
						'name'   => 'mkdf_footer_bottom_border_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Border Color', 'innovio' ),
						'parent' => $footer_bottom_styles_row_1
					)
				);
				
				innovio_mikado_create_meta_box_field(
					array(
						'name'   => 'mkdf_footer_bottom_border_width_meta',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Border Width', 'innovio' ),
						'parent' => $footer_bottom_styles_row_1,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
	}
	
	add_action( 'innovio_mikado_action_meta_boxes_map', 'innovio_mikado_map_footer_meta', 70 );
}