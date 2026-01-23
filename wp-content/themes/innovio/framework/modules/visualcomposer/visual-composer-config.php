<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = MIKADO_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'innovio_mikado_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function innovio_mikado_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'innovio_mikado_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'innovio_mikado_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function innovio_mikado_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Mikado Row Content Width', 'innovio' ),
				'value'      => array(
					esc_html__( 'Full Width', 'innovio' ) => 'full-width',
					esc_html__( 'In Grid', 'innovio' )    => 'grid'
				),
				'group'      => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Mikado Anchor ID', 'innovio' ),
				'description' => esc_html__( 'For example "home"', 'innovio' ),
				'group'       => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Mikado Background Color', 'innovio' ),
				'group'      => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Mikado Background Image', 'innovio' ),
				'group'      => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Mikado Background Position', 'innovio' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'innovio' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);

        vc_add_param( 'vc_row',
            array(
                'type'        => 'dropdown',
                'param_name'  => 'enable_grid_lines',
                'heading'     => esc_html__( 'Grid Lines Style ', 'innovio' ),
                'value'       => array(
                    esc_html__( 'No grid Lines', 'innovio' )        	=> '',
                    esc_html__( 'Parallax Grid Line Right', 'innovio' ) => 'grid_line_right',
                    esc_html__( 'Parallax Grid Line Dual', 'innovio' ) 	=> 'grid_line_dual',
                ),
                'save_always' => true,
                'group'       => esc_html__( 'Mikado Settings', 'innovio' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'        => 'dropdown',
                'param_name'  => 'grid_lines_skin',
                'heading'     => esc_html__( 'Grid Lines Skin', 'innovio' ),
                'value'       => array(
                    esc_html__( 'Light', 'innovio' ) => 'grid_line_light',
                    esc_html__( 'Default', 'innovio' ) 	=> 'grid_line_default',
                ),
                'save_always' => true,
                'dependency'  => array( 'element' => 'enable_grid_lines', 'value' => array( 'grid_line_right', 'grid_line_dual' ) ),
                'group'       => esc_html__( 'Mikado Settings', 'innovio' )
            )
        );
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Mikado Disable Background Image', 'innovio' ),
				'value'       => array(
					esc_html__( 'Never', 'innovio' )        => '',
					esc_html__( 'Below 1280px', 'innovio' ) => '1280',
					esc_html__( 'Below 1024px', 'innovio' ) => '1024',
					esc_html__( 'Below 768px', 'innovio' )  => '768',
					esc_html__( 'Below 680px', 'innovio' )  => '680',
					esc_html__( 'Below 480px', 'innovio' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'innovio' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Mikado Parallax Background Image', 'innovio' ),
				'group'      => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Mikado Parallax Speed', 'innovio' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'innovio' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Mikado Parallax Section Height (px)', 'innovio' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Mikado Content Aligment', 'innovio' ),
				'value'      => array(
					esc_html__( 'Default', 'innovio' ) => '',
					esc_html__( 'Left', 'innovio' )    => 'left',
					esc_html__( 'Center', 'innovio' )  => 'center',
					esc_html__( 'Right', 'innovio' )   => 'right'
				),
				'group'      => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);

		do_action( 'innovio_mikado_action_additional_vc_row_params' );
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Mikado Row Content Width', 'innovio' ),
				'value'      => array(
					esc_html__( 'Full Width', 'innovio' ) => 'full-width',
					esc_html__( 'In Grid', 'innovio' )    => 'grid'
				),
				'group'      => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Mikado Background Color', 'innovio' ),
				'group'      => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Mikado Background Image', 'innovio' ),
				'group'      => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Mikado Background Position', 'innovio' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'innovio' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Mikado Disable Background Image', 'innovio' ),
				'value'       => array(
					esc_html__( 'Never', 'innovio' )        => '',
					esc_html__( 'Below 1280px', 'innovio' ) => '1280',
					esc_html__( 'Below 1024px', 'innovio' ) => '1024',
					esc_html__( 'Below 768px', 'innovio' )  => '768',
					esc_html__( 'Below 680px', 'innovio' )  => '680',
					esc_html__( 'Below 480px', 'innovio' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'innovio' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);

        vc_add_param( 'vc_row_inner',
            array(
                'type'        => 'dropdown',
                'param_name'  => 'enable_grid_lines',
                'heading'     => esc_html__( 'Grid Lines Style ', 'innovio' ),
                'value'       => array(
                    esc_html__( 'No grid Lines', 'innovio' )        	=> '',
                    esc_html__( 'Parallax Grid Line Right', 'innovio' ) => 'grid_line_right',
                    esc_html__( 'Parallax Grid Line Dual', 'innovio' ) 	=> 'grid_line_dual',
                ),
                'save_always' => true,
                'group'       => esc_html__( 'Mikado Settings', 'innovio' )
            )
        );

        vc_add_param( 'vc_row_inner',
            array(
                'type'        => 'dropdown',
                'param_name'  => 'grid_lines_skin',
                'heading'     => esc_html__( 'Grid Lines Skin', 'innovio' ),
                'value'       => array(
                    esc_html__( 'Light', 'innovio' ) => 'grid_line_light',
                    esc_html__( 'Default', 'innovio' ) 	=> 'grid_line_default',
                ),
                'save_always' => true,
                'dependency'  => array( 'element' => 'enable_grid_lines', 'value' => array( 'grid_line_right', 'grid_line_dual' ) ),
                'group'       => esc_html__( 'Mikado Settings', 'innovio' )
            )
        );
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Mikado Content Aligment', 'innovio' ),
				'value'      => array(
					esc_html__( 'Default', 'innovio' ) => '',
					esc_html__( 'Left', 'innovio' )    => 'left',
					esc_html__( 'Center', 'innovio' )  => 'center',
					esc_html__( 'Right', 'innovio' )   => 'right'
				),
				'group'      => esc_html__( 'Mikado Settings', 'innovio' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( innovio_mikado_revolution_slider_installed() ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Mikado Enable Passepartout', 'innovio' ),
					'value'       => array_flip( innovio_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Mikado Settings', 'innovio' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Mikado Passepartout Size', 'innovio' ),
					'value'       => array(
						esc_html__( 'Tiny', 'innovio' )   => 'tiny',
						esc_html__( 'Small', 'innovio' )  => 'small',
						esc_html__( 'Normal', 'innovio' ) => 'normal',
						esc_html__( 'Large', 'innovio' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'innovio' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Mikado Disable Side Passepartout', 'innovio' ),
					'value'       => array_flip( innovio_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'innovio' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Mikado Disable Top Passepartout', 'innovio' ),
					'value'       => array_flip( innovio_mikado_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Mikado Settings', 'innovio' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'innovio_mikado_vc_row_map' );
}