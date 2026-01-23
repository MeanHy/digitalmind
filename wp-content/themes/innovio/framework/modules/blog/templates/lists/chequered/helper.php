<?php

if ( ! function_exists( 'innovio_mikado_get_blog_holder_params' ) ) {
	/**
	 * Function that generates params for holders on blog templates
	 */
	function innovio_mikado_get_blog_holder_params( $params ) {
		$params_list = array();
		
		$params_list['holder'] = 'mkdf-full-width';
		$params_list['inner']  = 'mkdf-full-width-inner clearfix';
		
		return $params_list;
	}
	
	add_filter( 'innovio_mikado_filter_blog_holder_params', 'innovio_mikado_get_blog_holder_params' );
}

if ( ! function_exists( 'innovio_mikado_get_blog_list_classes' ) ) {
	/**
	 * Function that generates blog list holder classes for blog list templates
	 */
	function innovio_mikado_get_blog_list_classes( $classes ) {
		$list_classes   = array();
		$list_classes[] = 'mkdf-grid-list mkdf-grid-masonry-list';
		
		$number_of_columns = innovio_mikado_get_meta_field_intersect( 'blog_masonry_number_of_columns' );
		if ( ! empty( $number_of_columns ) ) {
			$list_classes[] = 'mkdf-' . $number_of_columns . '-columns';
		}
		
		$list_classes[] = 'mkdf-blog-no-space';
		
		$masonry_layout = innovio_mikado_get_meta_field_intersect( 'blog_masonry_layout' );
		$list_classes[] = 'mkdf-blog-masonry-' . $masonry_layout;
		
		$classes = array_merge( $classes, $list_classes );
		
		return $classes;
	}
	
	add_filter( 'innovio_mikado_filter_blog_list_classes', 'innovio_mikado_get_blog_list_classes' );
}

if ( ! function_exists( 'innovio_mikado_blog_part_params' ) ) {
	function innovio_mikado_blog_part_params( $params ) {
		
		$part_params              = array();
		$part_params['title_tag'] = 'h5';
		$part_params['link_tag']  = 'h4';
		$part_params['quote_tag'] = 'h4';
		
		return array_merge( $params, $part_params );
	}
	
	add_filter( 'innovio_mikado_filter_blog_part_params', 'innovio_mikado_blog_part_params' );
}