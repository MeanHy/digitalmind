<?php
namespace InnovioCore\CPT\Shortcodes\Banner;

use InnovioCore\Lib;

class Banner implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_banner';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Banner', 'innovio-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by INNOVIO', 'innovio-core' ),
					'icon'                      => 'icon-wpb-banner extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'innovio-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'innovio-core' )
						),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'type',
                            'heading'     => esc_html__( 'Type', 'innovio-core' ),
                            'value'       => array(
                                esc_html__( 'Standard', 'innovio-core' ) => 'standard',
                                esc_html__( 'Button showing on hover', 'innovio-core' )    => 'button-on-hover',
                            ),
                            'save_always' => true
                        ),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'innovio-core' )
						),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'hover_background_color',
                            'heading'    => esc_html__( 'Background Hover Color', 'innovio-core' )
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'info_content_padding',
							'heading'     => esc_html__( 'Info Content Padding', 'innovio-core' ),
							'description' => esc_html__( 'Please insert padding in format top right bottom left', 'innovio-core' )
						),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_shadow',
                            'heading'     => esc_html__( 'Enable Shadow', 'innovio-core' ),
                            'value'       => array_flip( innovio_mikado_get_yes_no_select_array( false, true ) ),
                            'save_always' => true
                        ),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle',
							'heading'    => esc_html__( 'Subtitle', 'innovio-core' )
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'subtitle_highlight_words',
                            'heading'     => esc_html__( 'Words with First Main Color', 'innovio-core' ),
                            'description' => esc_html__( 'Enter the positions of the words you would like to display in a first main color. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a first main color, you would enter "1,3,4")', 'innovio-core' ),
                            'dependency'  => array( 'element' => 'subtitle', 'not_empty' => true )
                        ),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'subtitle_tag',
							'heading'     => esc_html__( 'Subtitle Tag', 'innovio-core' ),
							'value'       => array_flip( innovio_mikado_get_title_tag( true, array( 'span' => 'span' ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'subtitle', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'subtitle_color',
							'heading'    => esc_html__( 'Subtitle Color', 'innovio-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true )
						),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'subtitle_hover_color',
                            'heading'    => esc_html__( 'Subtitle Hover Color', 'innovio-core' ),
                            'dependency' => array( 'element' => 'subtitle', 'not_empty' => true )
                        ),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'innovio-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'innovio-core' ),
							'value'       => array_flip( innovio_mikado_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'innovio-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'title_hover_color',
                            'heading'    => esc_html__( 'Title Hover Color', 'innovio-core' ),
                            'dependency' => array( 'element' => 'title', 'not_empty' => true )
                        ),
						array(
							'type'       => 'textfield',
							'param_name' => 'title_top_margin',
							'heading'    => esc_html__( 'Title Top Margin (px)', 'innovio-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'title_bottom_margin',
                            'heading'    => esc_html__( 'Title Bottom Margin (px)', 'innovio-core' ),
                            'dependency' => array( 'element' => 'title', 'not_empty' => true )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'button_text',
                            'heading'     => esc_html__('Button Text', 'innovio-core'),
                            'value'       => esc_html__('BUY NOW', 'innovio-core'),
                            'save_always' => true,
                            'group'      => esc_html__('Button', 'innovio-core')
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'link',
                            'heading'    => esc_html__('Button Link', 'innovio-core'),
                            'dependency' => array('element' => 'button_text', 'not_empty' => true),
                            'group'      => esc_html__('Button', 'innovio-core')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'button_type',
                            'heading'     => esc_html__('Button Type', 'innovio-core'),
                            'value'       => array(
                                esc_html__('Solid', 'innovio-core')   => 'solid',
                                esc_html__('Simple', 'innovio-core') => 'simple'
                            ),
                            'save_always' => true,
                            'dependency'  => array('element' => 'button_text', 'not_empty' => true),
                            'group'      => esc_html__('Button', 'innovio-core')
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_color',
                            'heading'    => esc_html__('Button Color', 'innovio-core'),
                            'group'      => esc_html__('Button', 'innovio-core')
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_hover_color',
                            'heading'    => esc_html__('Button Hover Color', 'innovio-core'),
                            'group'      => esc_html__('Button', 'innovio-core'),
                            'dependency' => array( 'element' => 'button_type', 'value' => array( 'simple' ) ),
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_background_color',
                            'heading'    => esc_html__('Button Background Color', 'innovio-core'),
                            'dependency' => array('element' => 'button_type', 'value' => array('solid')),
                            'group'      => esc_html__('Button', 'innovio-core')
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_border_color',
                            'heading'    => esc_html__('Button Border Color', 'innovio-core'),
                            'dependency' => array('element' => 'button_type', 'value' => array('solid')),
                            'group'      => esc_html__('Button', 'innovio-core')
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'param_name'  => 'button_hover_shadow',
                            'heading'     => esc_html__( 'Button Hover Shadow Color', 'innovio-core' ),
                            'dependency' => array( 'element' => 'button_type', 'value' => array( 'solid') ),
                            'group'      => esc_html__( 'Button', 'innovio-core' )
                        ),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'         => '',
			'type'                 => '',
			'background_color'     => '',
			'hover_background_color' => '',
			'info_content_padding' => '',
			'subtitle'             => '',
			'subtitle_tag'         => 'span',
			'subtitle_color'       => '',
            'subtitle_hover_color'    => '',
			'title'                => '',
			'title_tag'            => 'h5',
			'subtitle_highlight_words'    => '',
			'title_color'          => '',
			'title_hover_color'    => '',
			'title_top_margin'     => '',
			'title_bottom_margin'  => '',
            'button_text'                   => '',
            'link'                          => '',
            'button_type'                   => 'simple',
            'button_color'                  => '',
            'button_hover_color'            => '',
            'button_background_color'       => '',
            'button_border_color'           => '',
            'button_hover_shadow'           => '',
            'enable_shadow' => 'yes',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']  = $this->getHolderClasses( $params, $args );
		$params['background_styles']  = $this->getBackgroundStyles( $params );
		$params['subtitle_tag']    = ! empty( $params['subtitle_tag'] ) ? $params['subtitle_tag'] : $args['subtitle_tag'];
		$params['subtitle_styles'] = $this->getSubitleStyles( $params );
		$params['subtitle']           = $this->getModifiedSubtitle( $params );
		$params['title_tag']       = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']    = $this->getTitleStyles( $params );
        $params['button_type'] = !empty($params['button_type']) ? $params['button_type'] : $args['button_type'];
        $params['banner_data']         = $this->getBannerDataAttr( $params );
        $params['title_data']         = $this->getBannerTitleDataAttr( $params );
        $params['subtitle_data']         = $this->getBannerSubtitleDataAttr( $params );
        $params['button_data']         = $this->getBannerButtonDataAttr( $params );

		$html = innovio_core_get_shortcode_module_template_part( 'templates/banner', 'banner', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();

        $holderClasses[] = $params['button_hover_color'] != '' ? 'mkdf-has-custom-btn-hover' : '';
        $holderClasses[] = $params['enable_shadow'] === 'yes' ? 'mkdf-has-shadow' : '';
        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ?  'mkdf-banner-' . $params['type'] : '';

		return implode( ' ', $holderClasses );
	}
	
	private function getBackgroundStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		if ( ! empty( $params['info_content_padding'] ) ) {
			$styles[] = 'padding: ' . $params['info_content_padding'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getSubitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['subtitle_color'] ) ) {
			$styles[] = 'color: ' . $params['subtitle_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getModifiedSubtitle( $params ) {
		$subtitle             = $params['subtitle'];
		$subtitle_highlight_words = str_replace( ' ', '', $params['subtitle_highlight_words'] );
		
		if ( ! empty( $subtitle ) ) {
			$highlight_words = explode( ',', $subtitle_highlight_words );
			$split_subtitle = explode( ' ', $subtitle );
			
			if ( ! empty( $subtitle_highlight_words ) ) {
				foreach ( $highlight_words as $value ) {
					if ( ! empty( $split_subtitle[ $value - 1 ] ) ) {
						$split_subtitle[ $value - 1 ] = '<span class="mkdf-banner-subtitle-light">' . $split_subtitle[ $value - 1 ] . '</span>';
					}
				}
			}
			
			$subtitle = implode( ' ', $split_subtitle );
		}
		
		return $subtitle;
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( ! empty( $params['title_top_margin'] ) ) {
			$styles[] = 'margin-top: ' . innovio_mikado_filter_px( $params['title_top_margin'] ) . 'px';
		}

        if ( ! empty( $params['title_bottom_margin'] ) ) {
            $styles[] = 'margin-bottom: ' . innovio_mikado_filter_px( $params['title_bottom_margin'] ) . 'px';
        }
		
		return implode( ';', $styles );
	}
	
	private function getLinkStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['link_color'] ) ) {
			$styles[] = 'color: ' . $params['link_color'];
		}
		
		if ( ! empty( $params['link_top_margin'] ) ) {
			$styles[] = 'margin-top: ' . innovio_mikado_filter_px( $params['link_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}

    private function getBannerDataAttr( $params ) {
        $data = array();

        if ( ! empty( $params['hover_background_color'] ) ) {
            $data['data-hover-bg-color'] = $params['hover_background_color'];
        }


        return $data;
    }

    private function getBannerTitleDataAttr( $params ) {
        $data = array();

        if ( ! empty( $params['title_hover_color'] ) ) {
            $data['data-title-hover-color'] = $params['title_hover_color'];
        }


        return $data;
    }

    private function getBannerSubtitleDataAttr( $params ) {
        $data = array();

        if ( ! empty( $params['subtitle_hover_color'] ) ) {
            $data['data-subtitle-hover-color'] = $params['subtitle_hover_color'];
        }


        return $data;
    }

    private function getBannerButtonDataAttr( $params ) {
        $data = array();

        if ( ! empty( $params['button_hover_color'] ) ) {
            $data['data-button-hover-color'] = $params['button_hover_color'];
        }


        return $data;
    }
}