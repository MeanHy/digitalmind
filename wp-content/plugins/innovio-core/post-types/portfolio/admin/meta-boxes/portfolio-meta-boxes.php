<?php

if ( ! function_exists( 'innovio_core_map_portfolio_meta' ) ) {
	function innovio_core_map_portfolio_meta() {
		global $innovio_mikado_global_Framework;
		
		$innovio_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$innovio_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$innovio_portfolio_images = new InnovioMikadoClassMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'innovio-core' ), '', '', 'portfolio_images' );
		$innovio_mikado_global_Framework->mkdMetaBoxes->addMetaBox( 'portfolio_images', $innovio_portfolio_images );
		
		$innovio_portfolio_image_gallery = new InnovioMikadoClassMultipleImages( 'mkdf-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'innovio-core' ), esc_html__( 'Choose your portfolio images', 'innovio-core' ) );
		$innovio_portfolio_images->addChild( 'mkdf-portfolio-image-gallery', $innovio_portfolio_image_gallery );
		
		//Portfolio Single Upload Images/Videos 
		
		$innovio_portfolio_images_videos = innovio_mikado_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'innovio-core' ),
				'name'  => 'mkdf_portfolio_images_videos'
			)
		);
		innovio_mikado_add_repeater_field(
			array(
				'name'        => 'mkdf_portfolio_single_upload',
				'parent'      => $innovio_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'innovio-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'innovio-core' ),
						'options' => array(
							'image' => esc_html__('Image','innovio-core'),
							'video' => esc_html__('Video','innovio-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'innovio-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'innovio-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'innovio-core'),
							'vimeo' => esc_html__('Vimeo', 'innovio-core'),
							'self' => esc_html__('Self Hosted', 'innovio-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'innovio-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'innovio-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'innovio-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);
		
		//Portfolio Additional Sidebar Items
		
		$innovio_additional_sidebar_items = innovio_mikado_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'innovio-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		innovio_mikado_add_repeater_field(
			array(
				'name'        => 'mkdf_portfolio_properties',
				'parent'      => $innovio_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'innovio-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'innovio-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'innovio-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'innovio-core' )
					)
				)
			)
		);
	}
	
	add_action( 'innovio_mikado_action_meta_boxes_map', 'innovio_core_map_portfolio_meta', 40 );
}