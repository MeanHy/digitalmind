<?php

if ( ! function_exists( 'innovio_mikado_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function innovio_mikado_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'innovio' );
		
		return $templates;
	}
	
	add_filter( 'innovio_mikado_filter_register_blog_templates', 'innovio_mikado_register_blog_standard_template_file' );
}

if ( ! function_exists( 'innovio_mikado_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function innovio_mikado_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'innovio' );
		
		return $options;
	}
	
	add_filter( 'innovio_mikado_filter_blog_list_type_global_option', 'innovio_mikado_set_blog_standard_type_global_option' );
}