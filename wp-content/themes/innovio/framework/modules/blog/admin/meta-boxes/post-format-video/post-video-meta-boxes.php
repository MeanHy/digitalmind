<?php

if ( ! function_exists( 'innovio_mikado_map_post_video_meta' ) ) {
	function innovio_mikado_map_post_video_meta() {
		$video_post_format_meta_box = innovio_mikado_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'innovio' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'          => 'mkdf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'innovio' ),
				'description'   => esc_html__( 'Choose video type', 'innovio' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'innovio' ),
					'self'            => esc_html__( 'Self Hosted', 'innovio' )
				)
			)
		);
		
		$mkdf_video_embedded_container = innovio_mikado_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'mkdf_video_embedded_container'
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'innovio' ),
				'description' => esc_html__( 'Enter Video URL', 'innovio' ),
				'parent'      => $mkdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'innovio' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'innovio' ),
				'parent'      => $mkdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_video_type_meta' => 'self'
					)
				)
			)
		);
		
		innovio_mikado_create_meta_box_field(
			array(
				'name'        => 'mkdf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'innovio' ),
				'description' => esc_html__( 'Enter video image', 'innovio' ),
				'parent'      => $mkdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'mkdf_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'innovio_mikado_action_meta_boxes_map', 'innovio_mikado_map_post_video_meta', 22 );
}