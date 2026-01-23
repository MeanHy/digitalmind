<?php

if ( ! function_exists( 'innovio_core_reviews_map' ) ) {
	function innovio_core_reviews_map() {
		
		$reviews_panel = innovio_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Reviews', 'innovio-core' ),
				'name'  => 'panel_reviews',
				'page'  => '_page_page'
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'text',
				'name'        => 'reviews_section_title',
				'label'       => esc_html__( 'Reviews Section Title', 'innovio-core' ),
				'description' => esc_html__( 'Enter title that you want to show before average rating on your page', 'innovio-core' ),
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'textarea',
				'name'        => 'reviews_section_subtitle',
				'label'       => esc_html__( 'Reviews Section Subtitle', 'innovio-core' ),
				'description' => esc_html__( 'Enter subtitle that you want to show before average rating on your page', 'innovio-core' ),
			)
		);
	}
	
	add_action( 'innovio_mikado_action_additional_page_options_map', 'innovio_core_reviews_map', 75 ); //one after elements
}