<?php

if ( ! function_exists( 'innovio_mikado_sidebar_options_map' ) ) {
	function innovio_mikado_sidebar_options_map() {
		
		$sidebar_panel = innovio_mikado_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'innovio' ),
				'name'  => 'sidebar',
				'page'  => '_page_page'
			)
		);
		
		innovio_mikado_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'innovio' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'innovio' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => innovio_mikado_get_custom_sidebars_options()
		) );
		
		$innovio_custom_sidebars = innovio_mikado_get_custom_sidebars();
		if ( count( $innovio_custom_sidebars ) > 0 ) {
			innovio_mikado_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'innovio' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'innovio' ),
				'parent'      => $sidebar_panel,
				'options'     => $innovio_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'innovio_mikado_action_options_map', 'innovio_mikado_sidebar_options_map', innovio_mikado_set_options_map_position( 'sidebar' ) );
}