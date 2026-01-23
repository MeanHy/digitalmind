<?php

if ( ! function_exists( 'innovio_core_enqueue_scripts_for_pie_chart_shortcodes' ) ) {
	/**
	 * Function that includes all necessary 3rd party scripts for this shortcode
	 */
	function innovio_core_enqueue_scripts_for_pie_chart_shortcodes() {
		wp_enqueue_script( 'counter', INNOVIO_CORE_SHORTCODES_URL_PATH . '/pie-chart/assets/js/plugins/counter.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'easypiechart', INNOVIO_CORE_SHORTCODES_URL_PATH . '/pie-chart/assets/js/plugins/easypiechart.js', array( 'jquery' ), false, true );
	}
	
	add_action( 'innovio_mikado_action_enqueue_third_party_scripts', 'innovio_core_enqueue_scripts_for_pie_chart_shortcodes' );
}

if ( ! function_exists( 'innovio_core_add_pie_chart_shortcodes' ) ) {
	function innovio_core_add_pie_chart_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'InnovioCore\CPT\Shortcodes\PieChart\PieChart'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'innovio_core_filter_add_vc_shortcode', 'innovio_core_add_pie_chart_shortcodes' );
}

if ( ! function_exists( 'innovio_core_set_pie_chart_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for pie chart shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function innovio_core_set_pie_chart_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-pie-chart';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'innovio_core_filter_add_vc_shortcodes_custom_icon_class', 'innovio_core_set_pie_chart_icon_class_name_for_vc_shortcodes' );
}