<?php

if ( ! function_exists( 'innovio_mikado_register_sidebars' ) ) {
	/**
	 * Function that registers theme's sidebars
	 */
	function innovio_mikado_register_sidebars() {
		
		register_sidebar(
			array(
				'id'            => 'sidebar',
				'name'          => esc_html__( 'Sidebar', 'innovio' ),
				'description'   => esc_html__( 'Default Sidebar area. In order to display this area you need to enable it through global theme options or on page meta box options.', 'innovio' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="mkdf-widget-title-holder"><h6 class="mkdf-widget-title">',
				'after_title'   => '</h6></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'innovio_mikado_register_sidebars', 1 );
}

if ( ! function_exists( 'innovio_mikado_add_support_custom_sidebar' ) ) {
	/**
	 * Function that adds theme support for custom sidebars. It also creates InnovioMikadoClassSidebar object
	 */
	function innovio_mikado_add_support_custom_sidebar() {
		add_theme_support( 'InnovioMikadoClassSidebar' );
		
		if ( get_theme_support( 'InnovioMikadoClassSidebar' ) ) {
			new InnovioMikadoClassSidebar();
		}
	}
	
	add_action( 'after_setup_theme', 'innovio_mikado_add_support_custom_sidebar' );
}