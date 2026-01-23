<?php

foreach ( glob( MIKADO_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'innovio_mikado_map_blog_meta' ) ) {
	function innovio_mikado_map_blog_meta() {
		$mkdf_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$mkdf_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = innovio_mikado_create_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'innovio' ),
				'name'  => 'blog_meta'
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'innovio' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'innovio' ),
				'parent'      => $blog_meta_box,
				'options'     => $mkdf_blog_categories
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'innovio' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'innovio' ),
				'parent'      => $blog_meta_box,
				'options'     => $mkdf_blog_categories,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'innovio' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'innovio' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'innovio' ),
					'in-grid'    => esc_html__( 'In Grid', 'innovio' ),
					'full-width' => esc_html__( 'Full Width', 'innovio' )
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'innovio' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'innovio' ),
				'parent'      => $blog_meta_box,
				'options'     => innovio_mikado_get_number_of_columns_array( true, array( 'one', 'six' ) )
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'innovio' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'innovio' ),
				'options'     => innovio_mikado_get_space_between_items_array( true ),
				'parent'      => $blog_meta_box
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'innovio' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'innovio' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'innovio' ),
					'fixed'    => esc_html__( 'Fixed', 'innovio' ),
					'original' => esc_html__( 'Original', 'innovio' )
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'innovio' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'innovio' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'innovio' ),
					'standard'        => esc_html__( 'Standard', 'innovio' ),
					'load-more'       => esc_html__( 'Load More', 'innovio' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'innovio' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'innovio' )
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'mkdf_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'innovio' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'innovio' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'innovio_mikado_action_meta_boxes_map', 'innovio_mikado_map_blog_meta', 30 );
}