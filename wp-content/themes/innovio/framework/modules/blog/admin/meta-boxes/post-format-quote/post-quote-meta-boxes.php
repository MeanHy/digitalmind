<?php

if ( ! function_exists( 'innovio_mikado_map_post_quote_meta' ) ) {
	function innovio_mikado_map_post_quote_meta() {
		$quote_post_format_meta_box = innovio_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'innovio' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'innovio' ),
				'description' => esc_html__( 'Enter Quote text', 'innovio' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'innovio' ),
				'description' => esc_html__( 'Enter Quote author', 'innovio' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'innovio_mikado_action_meta_boxes_map', 'innovio_mikado_map_post_quote_meta', 25 );
}