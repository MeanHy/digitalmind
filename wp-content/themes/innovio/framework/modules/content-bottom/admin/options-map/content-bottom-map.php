<?php

if ( ! function_exists( 'innovio_mikado_content_bottom_options_map' ) ) {
	function innovio_mikado_content_bottom_options_map() {
		
		$panel_content_bottom = innovio_mikado_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content_bottom',
				'title' => esc_html__( 'Content Bottom Area Style', 'innovio' )
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'name'          => 'enable_content_bottom_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'innovio' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'innovio' ),
				'parent'        => $panel_content_bottom
			)
		);
		
		$enable_content_bottom_area_container = innovio_mikado_add_admin_container(
			array(
				'parent'          => $panel_content_bottom,
				'name'            => 'enable_content_bottom_area_container',
				'dependency' => array(
					'show' => array(
						'enable_content_bottom_area'  => 'yes'
					)
				)
			)
		);
		
		$innovio_custom_sidebars = innovio_mikado_get_custom_sidebars();
		
		innovio_mikado_add_admin_field(
			array(
				'type'          => 'selectblank',
				'name'          => 'content_bottom_sidebar_custom_display',
				'default_value' => '',
				'label'         => esc_html__( 'Widget Area to Display', 'innovio' ),
				'description'   => esc_html__( 'Choose a Content Bottom widget area to display', 'innovio' ),
				'options'       => $innovio_custom_sidebars,
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_bottom_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Display in Grid', 'innovio' ),
				'description'   => esc_html__( 'Enabling this option will place Content Bottom in grid', 'innovio' ),
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'content_bottom_background_color',
				'label'       => esc_html__( 'Background Color', 'innovio' ),
				'description' => esc_html__( 'Choose a background color for Content Bottom area', 'innovio' ),
				'parent'      => $enable_content_bottom_area_container
			)
		);
	}
	
	add_action( 'innovio_mikado_action_additional_page_options_map', 'innovio_mikado_content_bottom_options_map' );
}