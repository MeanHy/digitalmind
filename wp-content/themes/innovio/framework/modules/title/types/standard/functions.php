<?php

if ( ! function_exists( 'innovio_mikado_set_title_standard_type_for_options' ) ) {
	/**
	 * This function set standard title type value for title options map and meta boxes
	 */
	function innovio_mikado_set_title_standard_type_for_options( $type ) {
		$type['standard'] = esc_html__( 'Standard', 'innovio' );
		
		return $type;
	}
	
	add_filter( 'innovio_mikado_filter_title_type_global_option', 'innovio_mikado_set_title_standard_type_for_options' );
	add_filter( 'innovio_mikado_filter_title_type_meta_boxes', 'innovio_mikado_set_title_standard_type_for_options' );
}

if ( ! function_exists( 'innovio_mikado_set_title_standard_type_as_default_options' ) ) {
    /**
     * This function set default title type value for global title option map
     */
    function innovio_mikado_set_title_standard_type_as_default_options( $type ) {
        $type = 'standard';

        return $type;
    }

    add_filter( 'innovio_mikado_filter_default_title_type_global_option', 'innovio_mikado_set_title_standard_type_as_default_options' );
}