<?php
namespace InnovioCore\CPT\Shortcodes\Button;

use InnovioCore\Lib;

class Button implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'mkdf_button';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Button', 'innovio-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by INNOVIO', 'innovio-core' ),
					'icon'                      => 'icon-wpb-button extended-custom-icon',
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
									esc_html__( 'Solid', 'innovio-core' )   => 'solid',
                                    esc_html__( 'Outline', 'innovio-core' ) => 'outline',
									esc_html__( 'Simple', 'innovio-core' )  => 'simple'
								),
								'admin_label' => true
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'size',
								'heading'    => esc_html__( 'Size', 'innovio-core' ),
								'value'      => array(
									esc_html__( 'Default', 'innovio-core' ) => '',
									esc_html__( 'Small', 'innovio-core' )   => 'small',
									esc_html__( 'Medium', 'innovio-core' )  => 'medium',
									esc_html__( 'Large', 'innovio-core' )   => 'large',
									esc_html__( 'Huge', 'innovio-core' )    => 'huge'
								),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'text',
								'heading'     => esc_html__( 'Text', 'innovio-core' ),
								'value'       => esc_html__( 'Button Text', 'innovio-core' ),
								'save_always' => true,
								'admin_label' => true
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'link',
								'heading'    => esc_html__( 'Link', 'innovio-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'target',
								'heading'     => esc_html__( 'Link Target', 'innovio-core' ),
								'value'       => array_flip( innovio_mikado_get_link_target_array() ),
								'save_always' => true
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
								'dependency' => array( 'element' => 'type', 'value' => array( 'simple' ) ),
								'save_always' => true
							),
                            array(
                                'type'        => 'dropdown',
                                'param_name'  => 'predefined_arrow',
                                'heading'     => esc_html__( 'Use our Predefined SVG arrow for solid/outline type', 'innovio-core' ),
                                'value'       => array_flip( innovio_mikado_get_yes_no_select_array( false, true ) ),
                                'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
                                'save_always' => true
                            )
						),
						innovio_mikado_icon_collections()->getVCParamsArray( array(), '', true ),
						array(
							array(
								'type'       => 'colorpicker',
								'param_name' => 'color',
								'heading'    => esc_html__( 'Color', 'innovio-core' ),
								'group'      => esc_html__( 'Design Options', 'innovio-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'hover_color',
								'heading'    => esc_html__( 'Hover Color', 'innovio-core' ),
								'group'      => esc_html__( 'Design Options', 'innovio-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'background_color',
								'heading'    => esc_html__( 'Background Color', 'innovio-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) ),
								'group'      => esc_html__( 'Design Options', 'innovio-core' )
							),
                            array(
                                'type'       => 'colorpicker',
                                'param_name' => 'hover_background_color',
                                'heading'    => esc_html__( 'Hover Background Color', 'innovio-core' ),
                                'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
                                'group'      => esc_html__( 'Design Options', 'innovio-core' )
                            ),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'border_color',
								'heading'    => esc_html__( 'Border Color', 'innovio-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
								'group'      => esc_html__( 'Design Options', 'innovio-core' )
							),
                            array(
                                'type'       => 'colorpicker',
                                'param_name' => 'hover_border_color',
                                'heading'    => esc_html__( 'Hover Border Color', 'innovio-core' ),
                                'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
                                'group'      => esc_html__( 'Design Options', 'innovio-core' )
                            ),
							array(
								'type'       => 'textfield',
								'param_name' => 'font_size',
								'heading'    => esc_html__( 'Font Size (px)', 'innovio-core' ),
								'group'      => esc_html__( 'Design Options', 'innovio-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'font_weight',
								'heading'     => esc_html__( 'Font Weight', 'innovio-core' ),
								'value'       => array_flip( innovio_mikado_get_font_weight_array( true ) ),
								'save_always' => true,
								'group'       => esc_html__( 'Design Options', 'innovio-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'text_transform',
								'heading'     => esc_html__( 'Text Transform', 'innovio-core' ),
								'value'       => array_flip( innovio_mikado_get_text_transform_array( true ) ),
								'save_always' => true
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'margin',
								'heading'     => esc_html__( 'Margin', 'innovio-core' ),
								'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'innovio-core' ),
								'group'       => esc_html__( 'Design Options', 'innovio-core' )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'padding',
								'heading'     => esc_html__( 'Button Padding', 'innovio-core' ),
								'description' => esc_html__( 'Insert padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'innovio-core' ),
								'dependency'  => array( 'element' => 'type', 'value' => array( 'solid' ) ),
								'group'       => esc_html__( 'Design Options', 'innovio-core' )
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'size'                   => '',
			'type'                   => 'solid',
			'text'                   => '',
			'link'                   => '',
			'target'                 => '_self',
			'color'                  => '',
			'hover_color'            => '',
			'background_color'       => '',
            'hover_background_color' => '',
			'border_color'           => '',
            'hover_border_color'     => '',
			'font_size'              => '',
			'font_weight'            => '',
			'text_transform'         => '',
			'margin'                 => '',
			'padding'                => '',
			'custom_class'           => '',
			'html_type'              => 'anchor',
			'input_name'             => '',
			'custom_attrs'           => array(),
			'predefined_icon'        => 'light_style',
            'predefined_arrow'       => 'yes'
		);
		$default_atts = array_merge( $default_atts, innovio_mikado_icon_collections()->getShortcodeParams() );
		$params       = shortcode_atts( $default_atts, $atts );
		
		if ( $params['html_type'] !== 'input' ) {
			$iconPackName   = innovio_mikado_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
			$params['icon'] = $iconPackName ? $params[ $iconPackName ] : '';
		}
		
		$params['size'] = ! empty( $params['size'] ) ? $params['size'] : 'medium';
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : 'solid';
		
		$params['link']   = ! empty( $params['link'] ) ? $params['link'] : '#';
		$params['target'] = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];
		
		$params['button_classes']      = $this->getButtonClasses( $params );
		$params['button_custom_attrs'] = ! empty( $params['custom_attrs'] ) ? $params['custom_attrs'] : array();
		$params['button_styles']       = $this->getButtonStyles( $params );
		$params['button_data']         = $this->getButtonDataAttr( $params );
		
		return innovio_core_get_shortcode_module_template_part( 'templates/' . $params['html_type'], 'button', '', $params );
	}
	
	private function getButtonStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		if ( ! empty( $params['border_color'] ) ) {
			$styles[] = 'border-color: ' . $params['border_color'];
		}
		
		if ( ! empty( $params['font_size'] ) ) {
			$styles[] = 'font-size: ' . innovio_mikado_filter_px( $params['font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['font_weight'] ) && $params['font_weight'] !== '' ) {
			$styles[] = 'font-weight: ' . $params['font_weight'];
		}
		
		if ( ! empty( $params['text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['text_transform'];
		}
		
		if ( $params['margin'] !== '' ) {
			$styles[] = 'margin: ' . $params['margin'];
		}
		
		if ( $params['padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['padding'];
		}
		
		return $styles;
	}
	
	private function getButtonDataAttr( $params ) {
		$data = array();

        if ( ! empty( $params['hover_color'] ) ) {
            $data['data-hover-color'] = $params['hover_color'];
        }

        if ( ! empty( $params['hover_background_color'] ) ) {
            $data['data-hover-bg-color'] = $params['hover_background_color'];
        }

        if ( ! empty( $params['hover_border_color'] ) ) {
            $data['data-hover-border-color'] = $params['hover_border_color'];
        }
		
		return $data;
	}
	
	private function getButtonClasses( $params ) {
		$buttonClasses = array(
			'mkdf-btn',
			'mkdf-btn-' . $params['size'],
			'mkdf-btn-' . $params['type']
		);

        if ( ! empty( $params['hover_background_color'] ) ) {
            $buttonClasses[] = 'mkdf-btn-custom-hover-bg';
        }

        if ( ! empty( $params['hover_border_color'] ) ) {
            $buttonClasses[] = 'mkdf-btn-custom-border-hover';
        }

        if ( ! empty( $params['hover_color'] ) ) {
            $buttonClasses[] = 'mkdf-btn-custom-hover-color';
        }

        if ( ! empty( $params['icon'] ) ) {
            $buttonClasses[] = 'mkdf-btn-icon';
        }

        if(empty( $params['icon'] ) && $params['predefined_arrow'] === 'yes' && $params['type'] !== 'simple') {
            $buttonClasses[] = 'mkdf-btn-predefined-arrow';
        }

        if ( ! empty( $params['custom_class'] ) ) {
            $buttonClasses[] = esc_attr( $params['custom_class'] );
        }

		if ( $params['type'] === 'simple' && ! empty( $params['predefined_icon'] ) ) {
			$buttonClasses[] = esc_attr( $params['predefined_icon'] );
		}
		
		return $buttonClasses;
	}
}