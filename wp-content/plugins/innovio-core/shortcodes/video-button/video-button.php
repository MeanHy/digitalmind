<?php

namespace InnovioCore\CPT\Shortcodes\VideoButton;

use InnovioCore\Lib;

class VideoButton implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_video_button';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Video Button', 'innovio-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by INNOVIO', 'innovio-core' ),
					'icon'                      => 'icon-wpb-video-button extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'innovio-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'innovio-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'video_link',
							'heading'    => esc_html__( 'Video Link', 'innovio-core' )
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'video_title',
                            'heading'    => esc_html__( 'Video Title', 'innovio-core' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'title_color',
                            'heading'    => esc_html__( 'Title Color', 'innovio-core' ),
                            'dependency' => array( 'element' => 'video_title', 'not_empty' => true )
                        ),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'video_image',
							'heading'     => esc_html__( 'Video Image', 'innovio-core' ),
							'description' => esc_html__( 'Select image from media library', 'innovio-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'play_button_color',
							'heading'    => esc_html__( 'Play Button Color', 'innovio-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'play_button_size',
							'heading'    => esc_html__( 'Play Button Size (px)', 'innovio-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'play_button_image',
							'heading'     => esc_html__( 'Play Button Custom Image', 'innovio-core' ),
							'description' => esc_html__( 'Select image from media library. If you use this field then play button color and button size options will not work', 'innovio-core' )
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'            => '',
			'video_link'              => '#',
			'video_image'             => '',
			'play_button_color'       => '',
			'play_button_size'        => '',
			'play_button_image'       => '',
            'video_title'             => '',
            'title_color'             => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['play_button_styles'] = $this->getPlayButtonStyles( $params );
        $params['title_color']       = $this->getTitleColor( $params );
		
		$html = innovio_core_get_shortcode_module_template_part( 'templates/video-button', 'video-button', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['video_image'] ) ? 'mkdf-vb-has-img' : '';
		
		return implode( ' ', $holderClasses );
	}

    private function getTitleColor( $params ) {
        $styles = '';

        if ( ! empty( $params['title_color'] ) ) {
            $styles = 'color: ' . $params['title_color'];
        }

        return $styles;
    }
	
	private function getPlayButtonStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['play_button_color'] ) ) {
			$styles[] = 'color: ' . $params['play_button_color'];
		}
		
		if ( ! empty( $params['play_button_size'] ) ) {
			$styles[] = 'font-size: ' . innovio_mikado_filter_px( $params['play_button_size'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}