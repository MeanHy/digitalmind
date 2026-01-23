<?php

if ( ! function_exists( 'innovio_mikado_centered_title_type_options_meta_boxes' ) ) {
	function innovio_mikado_centered_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_subtitle_side_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Subtitle Side Padding', 'innovio' ),
				'description' => esc_html__( 'Set left/right padding for subtitle area', 'innovio' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);
	}
	
	add_action( 'innovio_mikado_action_additional_title_area_meta_boxes', 'innovio_mikado_centered_title_type_options_meta_boxes', 5 );
}