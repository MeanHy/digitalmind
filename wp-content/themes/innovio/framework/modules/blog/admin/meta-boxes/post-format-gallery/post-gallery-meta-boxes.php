<?php

if ( ! function_exists( 'innovio_mikado_map_post_gallery_meta' ) ) {
	
	function innovio_mikado_map_post_gallery_meta() {
		$gallery_post_format_meta_box = innovio_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'innovio' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		innovio_mikado_add_multiple_images_field(
			array(
				'name'        => 'mkdf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'innovio' ),
				'description' => esc_html__( 'Choose your gallery images', 'innovio' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'innovio_mikado_action_meta_boxes_map', 'innovio_mikado_map_post_gallery_meta', 21 );
}
