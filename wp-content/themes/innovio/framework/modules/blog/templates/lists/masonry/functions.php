<?php

if ( ! function_exists( 'innovio_mikado_register_blog_masonry_template_file' ) ) {
	/**
	 * Function that register blog masonry template
	 */
	function innovio_mikado_register_blog_masonry_template_file( $templates ) {
		$templates['blog-masonry'] = esc_html__( 'Blog: Masonry', 'innovio' );
		
		return $templates;
	}
	
	add_filter( 'innovio_mikado_filter_register_blog_templates', 'innovio_mikado_register_blog_masonry_template_file' );
}

if ( ! function_exists( 'innovio_mikado_set_blog_masonry_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function innovio_mikado_set_blog_masonry_type_global_option( $options ) {
		$options['masonry'] = esc_html__( 'Blog: Masonry', 'innovio' );
		
		return $options;
	}
	
	add_filter( 'innovio_mikado_filter_blog_list_type_global_option', 'innovio_mikado_set_blog_masonry_type_global_option' );
}