<?php

if ( ! function_exists( 'innovio_mikado_register_header_standard_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function innovio_mikado_register_header_standard_type( $header_types ) {
		$header_type = array(
			'header-standard' => 'InnovioMikadoNamespace\Modules\Header\Types\HeaderStandard'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'innovio_mikado_init_register_header_standard_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function innovio_mikado_init_register_header_standard_type() {
		add_filter( 'innovio_mikado_filter_register_header_type_class', 'innovio_mikado_register_header_standard_type' );
	}
	
	add_action( 'innovio_mikado_action_before_header_function_init', 'innovio_mikado_init_register_header_standard_type' );
}