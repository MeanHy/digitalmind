<?php

if ( ! function_exists( 'innovio_mikado_map_post_link_meta' ) ) {
	function innovio_mikado_map_post_link_meta() {
		$link_post_format_meta_box = innovio_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'innovio' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'innovio' ),
				'description' => esc_html__( 'Enter link', 'innovio' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'innovio_mikado_action_meta_boxes_map', 'innovio_mikado_map_post_link_meta', 24 );
}