<?php

if ( ! function_exists( 'innovio_mikado_get_hide_dep_for_header_menu_area_options' ) ) {
	function innovio_mikado_get_hide_dep_for_header_menu_area_options() {
		$hide_dep_options = apply_filters( 'innovio_mikado_filter_header_menu_area_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'innovio_mikado_header_menu_area_options_map' ) ) {
	function innovio_mikado_header_menu_area_options_map( $panel_header ) {
		$hide_dep_options = innovio_mikado_get_hide_dep_for_header_menu_area_options();
		
		$menu_area_container = innovio_mikado_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'menu_area_container',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				),
			)
		);
		
		innovio_mikado_add_admin_section_title(
			array(
				'parent' => $menu_area_container,
				'name'   => 'menu_area_style',
				'title'  => esc_html__( 'Menu Area Style', 'innovio' )
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area In Grid', 'innovio' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'innovio' ),
			)
		);
		
		$menu_area_in_grid_container = innovio_mikado_add_admin_container(
			array(
				'parent'          => $menu_area_container,
				'name'            => 'menu_area_in_grid_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_in_grid'  => 'no'
					)
				)
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'color',
				'name'          => 'menu_area_grid_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Color', 'innovio' ),
				'description'   => esc_html__( 'Set grid background color for menu area', 'innovio' ),
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'text',
				'name'          => 'menu_area_grid_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Transparency', 'innovio' ),
				'description'   => esc_html__( 'Set grid background transparency for menu area', 'innovio' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Shadow', 'innovio' ),
				'description'   => esc_html__( 'Set shadow on grid area', 'innovio' )
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Border', 'innovio' ),
				'description'   => esc_html__( 'Set border on grid area', 'innovio' )
			)
		);
		
		$menu_area_in_grid_border_container = innovio_mikado_add_admin_container(
			array(
				'parent'          => $menu_area_in_grid_container,
				'name'            => 'menu_area_in_grid_border_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_in_grid_border'  => 'no'
					)
				)
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_border_container,
				'type'          => 'color',
				'name'          => 'menu_area_in_grid_border_color',
				'default_value' => '',
				'label'         => esc_html__( 'Border Color', 'innovio' ),
				'description'   => esc_html__( 'Set border color for menu area', 'innovio' ),
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'color',
				'name'          => 'menu_area_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Background Color', 'innovio' ),
				'description'   => esc_html__( 'Set background color for menu area', 'innovio' )
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'text',
				'name'          => 'menu_area_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'innovio' ),
				'description'   => esc_html__( 'Set background transparency for menu area', 'innovio' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area Shadow', 'innovio' ),
				'description'   => esc_html__( 'Set shadow on menu area', 'innovio' ),
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'menu_area_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area Border', 'innovio' ),
				'description'   => esc_html__( 'Set border on menu area', 'innovio' ),
				'parent'        => $menu_area_container
			)
		);
		
		$menu_area_border_container = innovio_mikado_add_admin_container(
			array(
				'parent'          => $menu_area_container,
				'name'            => 'menu_area_border_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_border'  => 'no'
					)
				)
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'menu_area_border_color',
				'label'       => esc_html__( 'Border Color', 'innovio' ),
				'description' => esc_html__( 'Set border color for menu area', 'innovio' ),
				'parent'      => $menu_area_border_container
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'type'        => 'text',
				'name'        => 'menu_area_height',
				'label'       => esc_html__( 'Height', 'innovio' ),
				'description' => esc_html__( 'Enter header height', 'innovio' ),
				'parent'      => $menu_area_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		innovio_mikado_add_admin_field(
			array(
				'type'   => 'text',
				'name'   => 'menu_area_side_padding',
				'label'  => esc_html__( 'Menu Area Side Padding', 'innovio' ),
				'parent' => $menu_area_container,
				'args'   => array(
					'col_width' => 2,
					'suffix'    => esc_html__( 'px or %', 'innovio' )
				)
			)
		);
		
		do_action( 'innovio_mikado_header_menu_area_additional_options', $panel_header );
	}
	
	add_action( 'innovio_mikado_action_header_menu_area_options_map', 'innovio_mikado_header_menu_area_options_map', 10, 1 );
}