<?php
namespace InnovioCore\CPT\Shortcodes\IconWithText;

use InnovioCore\Lib;

class IconWithText implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_icon_with_text';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Icon With Text', 'innovio-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-icon-with-text extended-custom-icon',
					'category'                  => esc_html__( 'by INNOVIO', 'innovio-core' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
						array(
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
									esc_html__( 'Icon Left From Text', 'innovio-core' )  => 'icon-left',
									esc_html__( 'Icon Left From Title', 'innovio-core' ) => 'icon-left-from-title',
									esc_html__( 'Icon Top', 'innovio-core' )             => 'icon-top'
								),
								'save_always' => true
							)
						),
						innovio_mikado_icon_collections()->getVCParamsArray(),
						array(
							array(
								'type'       => 'attach_image',
								'param_name' => 'custom_icon',
								'heading'    => esc_html__( 'Custom Icon', 'innovio-core' )
							),
                            array(
                                'type'       => 'attach_image',
                                'param_name' => 'additional_custom_icon',
                                'heading'    => esc_html__( 'Additional Custom Icon', 'innovio-core' )
                            ),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_type',
								'heading'    => esc_html__( 'Icon Type', 'innovio-core' ),
								'value'      => array(
									esc_html__( 'Normal', 'innovio-core' ) => 'mkdf-normal',
									esc_html__( 'Circle', 'innovio-core' ) => 'mkdf-circle',
									esc_html__( 'Square', 'innovio-core' ) => 'mkdf-square'
								),
								'group'      => esc_html__( 'Icon Settings', 'innovio-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_size',
								'heading'    => esc_html__( 'Icon Size', 'innovio-core' ),
								'value'      => array(
									esc_html__( 'Tiny', 'innovio-core' )       => 'mkdf-icon-tiny',
									esc_html__( 'Small', 'innovio-core' )      => 'mkdf-icon-small',
                                    esc_html__( 'Medium', 'innovio-core' )     => 'mkdf-icon-medium',
									esc_html__( 'Large', 'innovio-core' )      => 'mkdf-icon-large',
									esc_html__( 'Very Large', 'innovio-core' ) => 'mkdf-icon-huge'
								),
								'group'      => esc_html__( 'Icon Settings', 'innovio-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'custom_icon_size',
								'heading'    => esc_html__( 'Custom Icon Size (px)', 'innovio-core' ),
								'group'      => esc_html__( 'Icon Settings', 'innovio-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'shape_size',
								'heading'    => esc_html__( 'Shape Size (px)', 'innovio-core' ),
								'group'      => esc_html__( 'Icon Settings', 'innovio-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_color',
								'heading'    => esc_html__( 'Icon Color', 'innovio-core' ),
								'group'      => esc_html__( 'Icon Settings', 'innovio-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_hover_color',
								'heading'    => esc_html__( 'Icon Hover Color', 'innovio-core' ),
								'group'      => esc_html__( 'Icon Settings', 'innovio-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_background_color',
								'heading'    => esc_html__( 'Icon Background Color', 'innovio-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'innovio-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_hover_background_color',
								'heading'    => esc_html__( 'Icon Hover Background Color', 'innovio-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'innovio-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_border_color',
								'heading'    => esc_html__( 'Icon Border Color', 'innovio-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'innovio-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_border_hover_color',
								'heading'    => esc_html__( 'Icon Border Hover Color', 'innovio-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'innovio-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_border_width',
								'heading'    => esc_html__( 'Border Width (px)', 'innovio-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'mkdf-square', 'mkdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'innovio-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_animation',
								'heading'    => esc_html__( 'Icon Animation', 'innovio-core' ),
								'value'      => array_flip( innovio_mikado_get_yes_no_select_array( false ) ),
								'group'      => esc_html__( 'Icon Settings', 'innovio-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_animation_delay',
								'heading'    => esc_html__( 'Icon Animation Delay (ms)', 'innovio-core' ),
								'dependency' => array( 'element' => 'icon_animation', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Icon Settings', 'innovio-core' )
							),
                            array(
                                'type'       => 'textfield',
                                'param_name' => 'subtitle',
                                'heading'    => esc_html__( 'Subtitle', 'innovio-core' ),
                                'dependency'  => array( 'element' => 'type', 'value'   => array( 'icon-top', 'icon-left' ) ),
                            ),
                            array(
                                'type'        => 'dropdown',
                                'param_name'  => 'subtitle_tag',
                                'heading'     => esc_html__( 'Subtitle Tag', 'innovio-core' ),
                                'value'       => array_flip( innovio_mikado_get_title_tag( true, array('span' => 'span') ) ),
                                'save_always' => true,
                                'dependency'  => array( 'element' => 'subtitle', 'not_empty' => true ),
                                'group'       => esc_html__( 'Text Settings', 'innovio-core' )
                            ),
                            array(
                                'type'       => 'colorpicker',
                                'param_name' => 'subtitle_color',
                                'heading'    => esc_html__( 'Subtitle Color', 'innovio-core' ),
                                'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
                                'group'      => esc_html__( 'Text Settings', 'innovio-core' )
                            ),
                            array(
                                'type'       => 'textfield',
                                'param_name' => 'subtitle_top_margin',
                                'heading'    => esc_html__( 'Subtitle Top Margin (px)', 'innovio-core' ),
                                'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
                                'group'      => esc_html__( 'Text Settings', 'innovio-core' )
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
								'value'       => array_flip( innovio_mikado_get_title_tag( true ) ),
								'save_always' => true,
								'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
								'group'       => esc_html__( 'Text Settings', 'innovio-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'title_color',
								'heading'    => esc_html__( 'Title Color', 'innovio-core' ),
								'dependency' => array( 'element' => 'title', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'innovio-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'title_top_margin',
								'heading'    => esc_html__( 'Title Top Margin (px)', 'innovio-core' ),
								'dependency' => array( 'element' => 'title', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'innovio-core' )
							),
                            array(
                                'type'        => 'dropdown',
                                'param_name'  => 'separator',
                                'heading'     => esc_html__( 'Enable Separator under title', 'innovio-core' ),
                                'value'       => array_flip( innovio_mikado_get_yes_no_select_array( false, false ) ),
                                'dependency' => array( 'element' => 'title', 'not_empty' => true ),
                                'save_always' => true
                            ),
                            array(
                                'type'       => 'colorpicker',
                                'param_name' => 'separator_color',
                                'heading'    => esc_html__( 'Separator Color', 'innovio-core' ),
                                'dependency' => array( 'element' => 'separator', 'value' => array('yes') ),
                                'group'      => esc_html__( 'Text Settings', 'innovio-core' )
                            ),
                            array(
                                'type'       => 'textfield',
                                'param_name' => 'separator_top_margin',
                                'heading'    => esc_html__( 'Separator Top Margin (px)', 'innovio-core' ),
                                'dependency' => array( 'element' => 'separator', 'value' => array('yes') ),
                                'group'      => esc_html__( 'Text Settings', 'innovio-core' )
                            ),
							array(
								'type'       => 'textarea',
								'param_name' => 'text',
								'heading'    => esc_html__( 'Text', 'innovio-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'text_color',
								'heading'    => esc_html__( 'Text Color', 'innovio-core' ),
								'dependency' => array( 'element' => 'text', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'innovio-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'text_top_margin',
								'heading'    => esc_html__( 'Text Top Margin (px)', 'innovio-core' ),
								'dependency' => array( 'element' => 'text', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'innovio-core' )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'link',
								'heading'     => esc_html__( 'Link', 'innovio-core' ),
								'description' => esc_html__( 'Set link around icon and title', 'innovio-core' )
							),
                            array(
                                'type'        => 'textfield',
                                'param_name'  => 'link_text',
                                'heading'     => esc_html__('Link Text', 'innovio-core'),
                                'save_always' => true,
                                'dependency'  => array( 'element' => 'type', 'value'   => array( 'icon-top', 'icon-left' ) ),
                            ),
                            array(
                                'type'        => 'dropdown',
                                'param_name'  => 'predefined_icon',
                                'heading'     => esc_html__( 'Predefined Simple Button Icon', 'innovio-core' ),
                                'value'       => array(
                                    esc_html__( 'Predefined 1', 'innovio-core' ) => 'light_style',
                                    esc_html__( 'Predefined 2', 'innovio-core' ) => 'blue_style',
                                    esc_html__( 'Predefined 3', 'innovio-core' ) => 'grey_style',
                                ),
                                'dependency' => array( 'element' => 'link_text', 'not_empty' => true ),
                                'save_always' => true
                            ),
                            array(
                                'type'       => 'colorpicker',
                                'param_name' => 'button_color',
                                'heading'    => esc_html__('Link Color', 'innovio-core'),
                                'dependency' => array( 'element' => 'link_text', 'not_empty' => true ),
                            ),
                            array(
                                'type'       => 'colorpicker',
                                'param_name' => 'button_hover_color',
                                'heading'    => esc_html__('Link Hover Color', 'innovio-core'),
                                'dependency' => array( 'element' => 'link_text', 'not_empty' => true ),
                            ),
							array(
								'type'       => 'dropdown',
								'param_name' => 'target',
								'heading'    => esc_html__( 'Target', 'innovio-core' ),
								'value'      => array_flip( innovio_mikado_get_link_target_array() ),
								'dependency' => array( 'element' => 'link', 'not_empty' => true ),
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'text_padding',
								'heading'     => esc_html__( 'Text Padding (px)', 'innovio-core' ),
								'description' => esc_html__( 'Set left or top padding dependence of type for your text holder. Default value is 32 for left type and 25 for top icon with text type', 'innovio-core' ),
								'dependency'  => array( 'element' => 'type', 'value'   => array( 'icon-left', 'icon-top' ) ),
								'group'       => esc_html__( 'Text Settings', 'innovio-core' )
							),
                            array(
                                'type'       => 'dropdown',
                                'param_name' => 'hover_shadow',
                                'heading'    => esc_html__( 'Hover Shadow', 'innovio-core' ),
                                'value'      => array(
                                    esc_html__( 'No', 'innovio-core' ) => 'no-hover-shadow',
                                    esc_html__( 'Yes', 'innovio-core' ) => 'with-hover-shadow',
                                ),
                            ),
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'custom_class'                => '',
			'type'                        => 'icon-left',
			'custom_icon'                 => '',
			'additional_custom_icon'      => '',
			'icon_type'                   => 'mkdf-normal',
			'icon_size'                   => 'mkdf-icon-tiny',
			'custom_icon_size'            => '',
			'shape_size'                  => '',
			'icon_color'                  => '',
			'icon_hover_color'            => '',
			'icon_background_color'       => '',
			'icon_hover_background_color' => '',
			'icon_border_color'           => '',
			'icon_border_hover_color'     => '',
			'icon_border_width'           => '',
			'icon_animation'              => '',
			'icon_animation_delay'        => '',
            'subtitle'                    => '',
            'subtitle_tag'                => 'span',
            'subtitle_color'              => '',
            'subtitle_top_margin'         => '',
			'title'                       => '',
			'title_tag'                   => 'h5',
			'title_color'                 => '',
			'title_top_margin'            => '',
			'separator'                   => 'no',
			'separator_color'             => '',
			'separator_top_margin'        => '',
			'text'                        => '',
			'text_color'                  => '',
			'text_top_margin'             => '',
			'link'                        => '',
			'link_text'                   => '',
			'target'                      => '_self',
            'predefined_icon'             => 'light_style',
            'button_color'                => '',
            'button_hover_color'          => '',
			'text_padding'                => '',
            'hover_shadow'                => 'no-hover-shadow'
		);
		$default_atts = array_merge( $default_atts, innovio_mikado_icon_collections()->getShortcodeParams() );
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];
		
		$params['icon_parameters'] = $this->getIconParameters( $params );
		$params['holder_classes']  = $this->getHolderClasses( $params );
		$params['content_styles']  = $this->getContentStyles( $params );
        $params['subtitle_styles']    = $this->getSubtitleStyles( $params );
        $params['subtitle_tag']       = ! empty( $params['subtitle_tag'] ) ? $params['subtitle_tag'] : $default_atts['subtitle_tag'];
		$params['title_styles']    = $this->getTitleStyles( $params );
		$params['title_tag']       = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['separator_styles']     = $this->getSeparatorStyles( $params );
		$params['text_styles']     = $this->getTextStyles( $params );
		$params['target']          = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];

		return innovio_core_get_shortcode_module_template_part( 'templates/iwt', 'icon-with-text', $params['type'], $params );
	}
	
	private function getIconParameters( $params ) {
		$params_array = array();
		
		if ( empty( $params['custom_icon'] ) ) {
			$iconPackName = innovio_mikado_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
			
			$params_array['icon_pack']     = $params['icon_pack'];
			$params_array[ $iconPackName ] = $params[ $iconPackName ];
			
			if ( ! empty( $params['icon_size'] ) ) {
				$params_array['size'] = $params['icon_size'];
			}
			
			if ( ! empty( $params['custom_icon_size'] ) ) {
				$params_array['custom_size'] = innovio_mikado_filter_px( $params['custom_icon_size'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_type'] ) ) {
				$params_array['type'] = $params['icon_type'];
			}
			
			if ( ! empty( $params['shape_size'] ) ) {
				$params_array['shape_size'] = innovio_mikado_filter_px( $params['shape_size'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_border_color'] ) ) {
				$params_array['border_color'] = $params['icon_border_color'];
			}
			
			if ( ! empty( $params['icon_border_hover_color'] ) ) {
				$params_array['hover_border_color'] = $params['icon_border_hover_color'];
			}
			
			if ( $params['icon_border_width'] !== '' ) {
				$params_array['border_width'] = innovio_mikado_filter_px( $params['icon_border_width'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_background_color'] ) ) {
				$params_array['background_color'] = $params['icon_background_color'];
			}
			
			if ( ! empty( $params['icon_hover_background_color'] ) ) {
				$params_array['hover_background_color'] = $params['icon_hover_background_color'];
			}
			
			$params_array['icon_color'] = $params['icon_color'];
			
			if ( ! empty( $params['icon_hover_color'] ) ) {
				$params_array['hover_icon_color'] = $params['icon_hover_color'];
			}
			
			$params_array['icon_animation']       = $params['icon_animation'];
			$params_array['icon_animation_delay'] = $params['icon_animation_delay'];
		}
		
		return $params_array;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array( 'mkdf-iwt', 'clearfix' );

        if (!empty($params['custom_icon'])){
            $holderClasses[] = 'mkdf-iwt-with-custom-icon';
        }
        $holderClasses[] = ! empty( $params['hover_shadow'] ) ? 'mkdf-iwt-' . $params['hover_shadow'] : '';
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-iwt-' . $params['type'] : '';
		$holderClasses[] = ! empty( $params['icon_size'] ) ? 'mkdf-iwt-' . str_replace( 'mkdf-', '', $params['icon_size'] ) : '';
		
		return $holderClasses;
	}
	
	private function getContentStyles( $params ) {
		$styles = array();
		
		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-left' ) {
			$styles[] = 'padding-left: ' . innovio_mikado_filter_px( $params['text_padding'] ) . 'px';
		}
		
		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-top' ) {
			$styles[] = 'padding-top: ' . innovio_mikado_filter_px( $params['text_padding'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}

    private function getSubtitleStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['subtitle_color'] ) ) {
            $styles[] = 'color: ' . $params['subtitle_color'];
        }

        if ( $params['subtitle_top_margin'] !== '' ) {
            $styles[] = 'margin-top: ' . innovio_mikado_filter_px( $params['subtitle_top_margin'] ) . 'px';
        }

        return implode( ';', $styles );
    }
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( $params['title_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . innovio_mikado_filter_px( $params['title_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}

    private function getSeparatorStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['separator_color'] ) ) {
            $styles[] = 'background-color: ' . $params['separator_color'];
        }

        if ( $params['separator_top_margin'] !== '' ) {
            $styles[] = 'margin-top: ' . innovio_mikado_filter_px( $params['separator_top_margin'] ) . 'px';
        }

        return implode( ';', $styles );
    }
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . innovio_mikado_filter_px( $params['text_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}