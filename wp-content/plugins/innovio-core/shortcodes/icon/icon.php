<?php
namespace InnovioCore\CPT\Shortcodes\Icon;

use InnovioCore\Lib;

class Icon implements Lib\ShortcodeInterface {
	
    public function __construct() {
        $this->base = 'mkdf_icon';

        add_action('vc_before_init', array($this, 'vcMap'));
    }
	
    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
	    if(function_exists('vc_map')) {
		    vc_map(
		    	array(
				    'name'                      => esc_html__( 'Icon', 'innovio-core' ),
				    'base'                      => $this->base,
				    'category'                  => esc_html__( 'by INNOVIO', 'innovio-core' ),
				    'icon'                      => 'icon-wpb-icon extended-custom-icon',
				    'allowed_container_element' => 'vc_row',
				    'params'                    => array_merge(
				    	array(
						    array(
							    'type'        => 'textfield',
							    'param_name'  => 'custom_class',
							    'heading'     => esc_html__( 'Custom CSS Class', 'innovio-core' ),
							    'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'innovio-core' )
						    )
					    ),
					    innovio_mikado_icon_collections()->getVCParamsArray(),
					    array(
						    array(
							    'type'       => 'dropdown',
							    'param_name' => 'size',
							    'heading'    => esc_html__( 'Size', 'innovio-core' ),
							    'value'      => array(
								    esc_html__( 'Tiny', 'innovio-core' )   => 'mkdf-icon-tiny',
								    esc_html__( 'Small', 'innovio-core' )  => 'mkdf-icon-small',
								    esc_html__( 'Medium', 'innovio-core' ) => 'mkdf-icon-medium',
								    esc_html__( 'Large', 'innovio-core' )  => 'mkdf-icon-large',
								    esc_html__( 'Huge', 'innovio-core' )   => 'mkdf-icon-huge'
							    )
						    ),
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'custom_size',
							    'heading'    => esc_html__( 'Custom Size (px)', 'innovio-core' )
						    ),
						    array(
							    'type'       => 'dropdown',
							    'param_name' => 'type',
							    'heading'    => esc_html__( 'Type', 'innovio-core' ),
							    'value'      => array(
								    esc_html__( 'Normal', 'innovio-core' ) => 'mkdf-normal',
								    esc_html__( 'Circle', 'innovio-core' ) => 'mkdf-circle',
								    esc_html__( 'Square', 'innovio-core' ) => 'mkdf-square'
							    ),
							    'save_always' => true
						    ),
						    array(
							    'type'        => 'textfield',
							    'param_name'  => 'border_radius',
							    'heading'     => esc_html__( 'Border Radius', 'innovio-core' ),
							    'description' => esc_html__( 'Please insert border radius(Rounded corners) in px. For example: 4 ', 'innovio-core' ),
							    'dependency'  => array( 'element' => 'type', 'value' => array( 'mkdf-square' ) )
						    ),
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'shape_size',
							    'heading'    => esc_html__( 'Shape Size (px)', 'innovio-core' ),
							    'dependency' => array( 'element' => 'type', 'value' => array( 'mkdf-circle', 'mkdf-square' ) )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'icon_color',
							    'heading'    => esc_html__( 'Icon Color', 'innovio-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'border_color',
							    'heading'    => esc_html__( 'Border Color', 'innovio-core' ),
							    'dependency' => array( 'element' => 'type', 'value' => array( 'mkdf-circle', 'mkdf-square' ) )
						    ),
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'border_width',
							    'heading'    => esc_html__( 'Border Width', 'innovio-core' ),
							    'dependency' => array( 'element' => 'type', 'value'   => array( 'mkdf-circle', 'mkdf-square' ) )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'background_color',
							    'heading'    => esc_html__( 'Background Color', 'innovio-core' ),
							    'dependency' => array( 'element' => 'type', 'value' => array( 'mkdf-circle', 'mkdf-square' ) )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'hover_icon_color',
							    'heading'    => esc_html__( 'Hover Icon Color', 'innovio-core' )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'hover_border_color',
							    'heading'    => esc_html__( 'Hover Border Color', 'innovio-core' ),
							    'dependency' => array( 'element' => 'type', 'value' => array( 'mkdf-circle', 'mkdf-square' ) )
						    ),
						    array(
							    'type'       => 'colorpicker',
							    'param_name' => 'hover_background_color',
							    'heading'    => esc_html__( 'Hover Background Color', 'innovio-core' ),
							    'dependency' => array( 'element' => 'type', 'value' => array( 'mkdf-circle', 'mkdf-square' ) )
						    ),
						    array(
							    'type'        => 'textfield',
							    'param_name'  => 'margin',
							    'heading'     => esc_html__( 'Margin', 'innovio-core' ),
							    'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'innovio-core' )
						    ),
						    array(
							    'type'       => 'dropdown',
							    'param_name' => 'icon_animation',
							    'heading'    => esc_html__( 'Icon Animation', 'innovio-core' ),
							    'value'      => array_flip( innovio_mikado_get_yes_no_select_array( false ) )
						    ),
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'icon_animation_delay',
							    'heading'    => esc_html__( 'Icon Animation Delay (ms)', 'innovio-core' ),
							    'dependency' => array( 'element' => 'icon_animation', 'value' => 'yes' )
						    ),
						    array(
							    'type'       => 'textfield',
							    'param_name' => 'link',
							    'heading'    => esc_html__( 'Link', 'innovio-core' )
						    ),
						    array(
							    'type'        => 'checkbox',
							    'param_name'  => 'anchor_icon',
							    'heading'     => esc_html__( 'Use Link as Anchor', 'innovio-core' ),
							    'value'       => array( 'Use this icon as Anchor?' => 'yes' ),
							    'description' => esc_html__( 'Check this box to use icon as anchor link (eg. #contact)', 'innovio-core' ),
							    'dependency'  => Array( 'element' => 'link', 'not_empty' => true )
						    ),
						    array(
							    'type'       => 'dropdown',
							    'param_name' => 'target',
							    'heading'    => esc_html__( 'Target', 'innovio-core' ),
							    'value'      => array_flip( innovio_mikado_get_link_target_array() ),
							    'dependency' => array( 'element' => 'link', 'not_empty' => true )
						    )
					    )
				    )
			    )
		    );
	    }
    }
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'custom_class'           => '',
			'size'                   => '',
			'custom_size'            => '',
			'type'                   => 'mkdf-normal',
			'border_radius'          => '',
			'shape_size'             => '',
			'icon_color'             => '',
			'border_color'           => '',
			'border_width'           => '',
			'background_color'       => '',
			'hover_icon_color'       => '',
			'hover_border_color'     => '',
			'hover_background_color' => '',
			'margin'                 => '',
			'icon_animation'         => '',
			'icon_animation_delay'   => '',
			'link'                   => '',
			'anchor_icon'            => '',
			'target'                 => '_self'
		);
		$default_atts = array_merge( $default_atts, innovio_mikado_icon_collections()->getShortcodeParams() );
		$params       = shortcode_atts( $default_atts, $atts );
		
		$iconPackName = innovio_mikado_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
		
		$params['icon']                         = $params[ $iconPackName ];
		$params['icon_holder_classes']          = $this->generateIconHolderClasses( $params );
		$params['icon_holder_styles']           = $this->generateIconHolderStyles( $params );
		$params['icon_holder_data']             = $this->generateIconHolderData( $params );
		$params['icon_params']                  = $this->generateIconParams( $params );
		$params['icon_animation_holder']        = isset( $params['icon_animation'] ) && $params['icon_animation'] == 'yes';
		$params['icon_animation_holder_styles'] = $this->generateIconAnimationHolderStyles( $params );
		$params['link_class']                   = $this->getLinkClass( $params );
		$params['target']                       = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];
		
		$html = innovio_core_get_shortcode_module_template_part( 'templates/icon', 'icon', '', $params );
		
		return $html;
	}
	
	private function generateIconHolderClasses( $params ) {
		$holderClasses = array( 'mkdf-icon-shortcode', $params['type'] );
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['icon_animation'] == 'yes' ? 'mkdf-icon-animation' : '';
		$holderClasses[] = ! empty( $params['size'] ) ? $params['size'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function generateIconParams( $params ) {
		$iconParams = array( 'icon_attributes' => array() );
		
		$iconParams['icon_attributes']['style'] = $this->generateIconStyles( $params );
		$iconParams['icon_attributes']['class'] = 'mkdf-icon-element';
		
		return $iconParams;
	}
	
	private function generateIconStyles( $params ) {
		$iconStyles = array();
		
		if ( ! empty( $params['icon_color'] ) ) {
			$iconStyles[] = 'color: ' . $params['icon_color'];
		}
		
		if ( ( $params['type'] !== 'mkdf-normal' && ! empty( $params['shape_size'] ) ) || ( $params['type'] == 'mkdf-normal' ) ) {
			if ( ! empty( $params['custom_size'] ) ) {
				$iconStyles[] = 'font-size:' . innovio_mikado_filter_px( $params['custom_size'] ) . 'px';
			}
		}
		
		return implode( ';', $iconStyles );
	}
	
	private function generateIconHolderStyles( $params ) {
		$iconHolderStyles = array();
		
		if ( $params['margin'] !== '' ) {
			$iconHolderStyles[] = 'margin: ' . $params['margin'];
		}
		
		if ( $params['type'] !== 'mkdf-normal' ) {
			
			$shapeSize = '';
			if ( ! empty( $params['shape_size'] ) ) {
				$shapeSize = $params['shape_size'];
			} elseif ( ! empty( $params['custom_size'] ) ) {
				$shapeSize = $params['custom_size'];
			}
			
			if ( ! empty( $shapeSize ) ) {
				$iconHolderStyles[] = 'width: ' . innovio_mikado_filter_px( $shapeSize ) . 'px';
				$iconHolderStyles[] = 'height: ' . innovio_mikado_filter_px( $shapeSize ) . 'px';
				$iconHolderStyles[] = 'line-height: ' . innovio_mikado_filter_px( $shapeSize ) . 'px';
			}
			
			if ( ! empty( $params['background_color'] ) ) {
				$iconHolderStyles[] = 'background-color: ' . $params['background_color'];
			}
			
			if ( ! empty( $params['border_color'] ) && ( isset( $params['border_width'] ) && $params['border_width'] !== '' ) ) {
				$iconHolderStyles[] = 'border-style: solid';
				$iconHolderStyles[] = 'border-color: ' . $params['border_color'];
				$iconHolderStyles[] = 'border-width: ' . innovio_mikado_filter_px( $params['border_width'] ) . 'px';
			} else if ( isset( $params['border_width'] ) && $params['border_width'] !== '' ) {
				$iconHolderStyles[] = 'border-style: solid';
				$iconHolderStyles[] = 'border-width: ' . innovio_mikado_filter_px( $params['border_width'] ) . 'px';
			} else if ( ! empty( $params['border_color'] ) ) {
				$iconHolderStyles[] = 'border-color: ' . $params['border_color'];
			}
			
			if ( $params['type'] == 'mkdf-square' ) {
				if ( isset( $params['border_radius'] ) && $params['border_radius'] !== '' ) {
					$iconHolderStyles[] = 'border-radius: ' . innovio_mikado_filter_px( $params['border_radius'] ) . 'px';
				}
			}
		}
		
		return $iconHolderStyles;
	}
	
	private function generateIconHolderData( $params ) {
		$iconHolderData = array();
		
		if ( isset( $params['type'] ) && $params['type'] !== 'mkdf-normal' ) {
			if ( ! empty( $params['hover_border_color'] ) ) {
				$iconHolderData['data-hover-border-color'] = $params['hover_border_color'];
			}
			
			if ( ! empty( $params['hover_background_color'] ) ) {
				$iconHolderData['data-hover-background-color'] = $params['hover_background_color'];
			}
		}
		
		if ( ( isset( $params['icon_animation'] ) && $params['icon_animation'] == 'yes' )
		     && ( isset( $params['icon_animation_delay'] ) && $params['icon_animation_delay'] !== '' )
		) {
			$iconHolderData['data-animation-delay'] = $params['icon_animation_delay'];
		}
		
		if ( ! empty( $params['hover_icon_color'] ) ) {
			$iconHolderData['data-hover-color'] = $params['hover_icon_color'];
		}
		
		if ( ! empty( $params['icon_color'] ) ) {
			$iconHolderData['data-color'] = $params['icon_color'];
		}
		
		return $iconHolderData;
	}
	
	private function generateIconAnimationHolderStyles( $params ) {
		$styles = array();
		
		if ( ( isset( $params['icon_animation'] ) && $params['icon_animation'] == 'yes' ) && ( isset( $params['icon_animation_delay'] ) && $params['icon_animation_delay'] !== '' ) ) {
			$styles[] = '-webkit-transition-delay: ' . $params['icon_animation_delay'] . 'ms';
			$styles[] = '-moz-transition-delay: ' . $params['icon_animation_delay'] . 'ms';
			$styles[] = 'transition-delay: ' . $params['icon_animation_delay'] . 'ms';
		}
		
		return $styles;
	}
	
	private function getLinkClass( $params ) {
		$class = '';
		
		if ( $params['anchor_icon'] != '' && $params['anchor_icon'] == 'yes' ) {
			$class .= 'mkdf-anchor';
		}
		
		return $class;
	}
}