<?php

/*** Post Settings ***/

if ( ! function_exists( 'innovio_mikado_map_post_meta' ) ) {
	function innovio_mikado_map_post_meta() {
		
		$post_meta_box = innovio_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'innovio' ),
				'name'  => 'post-meta'
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'innovio' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'innovio' ),
				'parent'        => $post_meta_box,
				'options'       => innovio_mikado_get_yes_no_select_array()
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'innovio' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'innovio' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => innovio_mikado_get_custom_sidebars_options( true )
			)
		);
		
		$innovio_custom_sidebars = innovio_mikado_get_custom_sidebars();
		if ( count( $innovio_custom_sidebars ) > 0 ) {
			innovio_mikado_create_meta_box_field( array(
				'name'        => 'mkdf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'innovio' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'innovio' ),
				'parent'      => $post_meta_box,
				'options'     => innovio_mikado_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'innovio' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'innovio' ),
				'parent'      => $post_meta_box
			)
		);

        innovio_mikado_create_meta_box_field(
            array(
                'name'        => 'mkdf_blog_list_initial_background_color_meta',
                'type'        => 'color',
                'label'       => esc_html__( 'Initial Background Color', 'innovio' ),
                'description' => esc_html__( 'Set the appear color for the item. This will have effect in blog chequered page template.', 'innovio' ),
                'parent'      => $post_meta_box
            )
        );

		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_blog_single_skin_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Set Dark Skin ', 'innovio' ),
				'description' => esc_html__( 'Set Dark skin on the Blog lists', 'innovio' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
				'options'       => innovio_mikado_get_yes_no_select_array()
			)
		);

		do_action('innovio_mikado_action_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'innovio_mikado_action_meta_boxes_map', 'innovio_mikado_map_post_meta', 20 );
}
