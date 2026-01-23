<?php

if ( ! function_exists( 'innovio_mikado_portfolio_category_additional_fields' ) ) {
	function innovio_mikado_portfolio_category_additional_fields() {
		
		$fields = innovio_mikado_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		innovio_mikado_add_taxonomy_field(
			array(
				'name'   => 'mkdf_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'innovio-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'innovio_mikado_action_custom_taxonomy_fields', 'innovio_mikado_portfolio_category_additional_fields' );
}