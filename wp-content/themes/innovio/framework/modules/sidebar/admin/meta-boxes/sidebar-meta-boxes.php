<?php

if ( ! function_exists( 'innovio_mikado_map_sidebar_meta' ) ) {
	function innovio_mikado_map_sidebar_meta() {
		$mkdf_sidebar_meta_box = innovio_mikado_create_meta_box(
			array(
				'scope' => apply_filters( 'innovio_mikado_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'innovio' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'innovio' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'innovio' ),
				'parent'      => $mkdf_sidebar_meta_box,
                'options'       => innovio_mikado_get_custom_sidebars_options( true )
			)
		);
		
		$mkdf_custom_sidebars = innovio_mikado_get_custom_sidebars();
		if ( count( $mkdf_custom_sidebars ) > 0 ) {
			innovio_mikado_create_meta_box_field(
				array(
					'name'        => 'mkdf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'innovio' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'innovio' ),
					'parent'      => $mkdf_sidebar_meta_box,
					'options'     => $mkdf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'innovio_mikado_action_meta_boxes_map', 'innovio_mikado_map_sidebar_meta', 31 );
}