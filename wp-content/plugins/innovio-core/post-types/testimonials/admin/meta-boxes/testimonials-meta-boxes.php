<?php

if ( ! function_exists( 'innovio_core_map_testimonials_meta' ) ) {
	function innovio_core_map_testimonials_meta() {
		$testimonial_meta_box = innovio_mikado_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'innovio-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'innovio-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'innovio-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'innovio-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'innovio-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'innovio-core' ),
				'description' => esc_html__( 'Enter author name', 'innovio-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'innovio-core' ),
				'description' => esc_html__( 'Enter author job position', 'innovio-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'innovio_mikado_action_meta_boxes_map', 'innovio_core_map_testimonials_meta', 95 );
}