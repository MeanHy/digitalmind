<?php

if ( ! function_exists( 'innovio_core_map_portfolio_settings_meta' ) ) {
	function innovio_core_map_portfolio_settings_meta() {
		$meta_box = innovio_mikado_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'innovio-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		innovio_mikado_create_meta_box_field( array(
			'name'        => 'mkdf_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'innovio-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'innovio-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'innovio-core' ),
				'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'innovio-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'innovio-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'innovio-core' ),
				'slider'            => esc_html__( 'Portfolio Slider', 'innovio-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'innovio-core' ),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'innovio-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'innovio-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'innovio-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'innovio-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'innovio-core' ),
				'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'innovio-core' )
			)
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = innovio_mikado_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'mkdf_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'mkdf_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'innovio-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'innovio-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => innovio_mikado_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'innovio-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'innovio-core' ),
				'default_value' => '',
				'options'       => innovio_mikado_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = innovio_mikado_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'mkdf_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'mkdf_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'innovio-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'innovio-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => innovio_mikado_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'innovio-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'innovio-core' ),
				'default_value' => '',
				'options'       => innovio_mikado_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'innovio-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'innovio-core' ),
				'parent'        => $meta_box,
				'options'       => innovio_mikado_get_yes_no_select_array()
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'innovio-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'innovio-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'innovio-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'innovio-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'innovio-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'innovio-core' ),
				'parent'      => $meta_box
			)
		);

        innovio_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_portfolio_hover_background_color_meta',
                'type'        => 'color',
                'label'       => esc_html__( 'Hover Background Color', 'innovio-core' ),
                'description' => esc_html__( 'Choose a hover background color for Portfolio List shortcode', 'innovio-core' ),
                'parent'      => $meta_box,
                'args'        => array(
                    'col_width' => 2
                )
            )
        );

        innovio_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_portfolio_hover_transparency_meta',
                'type'        => 'text',
                'label'       => esc_html__( 'Transparency', 'innovio-core' ),
                'description' => esc_html__( 'Choose a transparency for the hover background color (0 = fully transparent, 1 = opaque)', 'innovio-core' ),
                'parent'      => $meta_box,
                'args'        => array(
                    'col_width' => 2
                )
            )
        );
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'innovio-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'innovio-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'innovio-core' ),
					'small'              => esc_html__( 'Small', 'innovio-core' ),
					'large-width'        => esc_html__( 'Large Width', 'innovio-core' ),
					'large-height'       => esc_html__( 'Large Height', 'innovio-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'innovio-core' )
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'innovio-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'innovio-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''            => esc_html__( 'Default', 'innovio-core' ),
					'large-width' => esc_html__( 'Large Width', 'innovio-core' )
				)
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'innovio-core' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'innovio-core' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);

		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_portfolio_single_skin_meta',
				'type'          => 'select',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Light Skin', 'innovio-core' ),
				'description'   => esc_html__( 'Enabling this option will make single portfolio light skin', 'innovio-core' ),
				'parent'        => $meta_box,
				'options'       => innovio_mikado_get_yes_no_select_array(false, false)
			)
		);
	}
	
	add_action( 'innovio_mikado_action_meta_boxes_map', 'innovio_core_map_portfolio_settings_meta', 41 );
}