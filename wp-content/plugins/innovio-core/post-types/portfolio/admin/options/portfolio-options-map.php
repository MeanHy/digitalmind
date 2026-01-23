<?php

if ( ! function_exists( 'innovio_mikado_portfolio_options_map' ) ) {
	function innovio_mikado_portfolio_options_map() {
		
		innovio_mikado_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'innovio-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = innovio_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'innovio-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'innovio-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'innovio-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'innovio-core' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is Four columns', 'innovio-core' ),
				'parent'        => $panel_archive,
				'options'       => innovio_mikado_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'innovio-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'innovio-core' ),
				'default_value' => 'normal',
				'options'       => innovio_mikado_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'innovio-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'innovio-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'innovio-core' ),
					'landscape' => esc_html__( 'Landscape', 'innovio-core' ),
					'portrait'  => esc_html__( 'Portrait', 'innovio-core' ),
					'square'    => esc_html__( 'Square', 'innovio-core' )
				)
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'innovio-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'innovio-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'innovio-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'innovio-core' )
				)
			)
		);
		
		$panel = innovio_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'innovio-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'innovio-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'innovio-core' ),
				'parent'        => $panel,
				'options'       => array(
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
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = innovio_mikado_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'innovio-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'innovio-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => innovio_mikado_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'innovio-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'innovio-core' ),
				'default_value' => 'normal',
				'options'       => innovio_mikado_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = innovio_mikado_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'innovio-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'innovio-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => innovio_mikado_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'innovio-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'innovio-core' ),
				'default_value' => 'normal',
				'options'       => innovio_mikado_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		innovio_mikado_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'innovio-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'innovio-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'innovio-core' ),
					'yes' => esc_html__( 'Yes', 'innovio-core' ),
					'no'  => esc_html__( 'No', 'innovio-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'innovio-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'innovio-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'innovio-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'innovio-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'innovio-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'innovio-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);

		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_related_posts',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Related posts', 'innovio-core' ),
				'description'   => esc_html__( 'Enabling this option will enable related posts on single projects', 'innovio-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'innovio-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'innovio-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'innovio-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'innovio-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'innovio-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'innovio-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'innovio-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'innovio-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = innovio_mikado_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'innovio-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'innovio-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'innovio-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'innovio-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'innovio_mikado_action_options_map', 'innovio_mikado_portfolio_options_map', innovio_mikado_set_options_map_position( 'portfolio' ) );
}