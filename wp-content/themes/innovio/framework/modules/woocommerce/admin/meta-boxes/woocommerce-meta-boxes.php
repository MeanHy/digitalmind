<?php

if ( ! function_exists( 'innovio_mikado_map_woocommerce_meta' ) ) {
	function innovio_mikado_map_woocommerce_meta() {
		
		$woocommerce_meta_box = innovio_mikado_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'innovio' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'innovio' ),
				'description' => esc_html__( 'Choose image layout when it appears in Mikado Product List - Masonry layout shortcode', 'innovio' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'innovio' ),
					'small'              => esc_html__( 'Small', 'innovio' ),
					'large-width'        => esc_html__( 'Large Width', 'innovio' ),
					'large-height'       => esc_html__( 'Large Height', 'innovio' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'innovio' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'innovio' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'innovio' ),
				'options'       => innovio_mikado_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'innovio' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'innovio' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'innovio_mikado_action_meta_boxes_map', 'innovio_mikado_map_woocommerce_meta', 99 );
}