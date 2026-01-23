<?php
namespace InnovioCore\CPT\Shortcodes\Roadmap;

use InnovioCore\Lib;

class Roadmap implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_roadmap';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Roadmap', 'innovio-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-roadmap extended-custom-icon',
					'category'                  => esc_html__( 'by INNOVIO', 'innovio-core' ),
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
							'param_name'  => 'skin',
							'heading'     => esc_html__( 'Skin', 'innovio-core' ),
							'value'		  => array(
								esc_html__('Light', 'innovio-core') => 'light',
								esc_html__('Dark', 'innovio-core') => 'dark',
							)
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'start_label',
                            'heading'    => esc_html__( 'Start Label', 'innovio-core' ),
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'end_label',
                            'heading'    => esc_html__( 'End Label', 'innovio-core' ),
                        ),
						array(
							'type'       => 'param_group',
							'param_name' => 'stage',
							'heading'    => esc_html__( 'Roadmap Stage', 'innovio-core' ),
							'params'     => array(
								array(
									'type'       => 'textfield',
									'param_name' => 'stage_title',
									'heading'    => esc_html__( 'Stage Title', 'innovio-core' ),
								),
								array(
									'type'        => 'dropdown',
									'param_name'  => 'stage_reached',
									'heading'     => esc_html__( 'Stage Reached', 'innovio-core' ),
									'value'	      => array(
										esc_html__('No', 'innovio-core') => 'no',
										esc_html__('Yes', 'innovio-core') => 'yes'
									)
								)
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'    => '',
			'skin'			  => 'light',
			'stage'           => '',
			'start_label'     => '',
			'end_label'     => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['this_object']        = $this;
		$params['stage']         	  = json_decode( urldecode( $params['stage'] ), true );

		$html = innovio_core_get_shortcode_module_template_part( 'templates/roadmap-template', 'roadmap', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holder_classes = array();

		$holder_classes[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holder_classes[] = ! empty( $params['skin'] ) ? 'mkdf-roadmap-skin-'.esc_attr( $params['skin'] ) : 'mkdf-roadmap-skin-light';

		return implode( ' ', $holder_classes );
	}

	public function getItemAdditional( $stage_params ) {
		$additional = array();
		$additional['classes'] = 'mkdf-roadmap-item';
		$additional['style'] = '';

		if ( $stage_params['number']%2 == 0 ){
			$additional['classes'] .= ' mkdf-roadmap-item-below';
		} else {
			$additional['classes'] .= ' mkdf-roadmap-item-above';
		}

		if ($stage_params['stage_reached'] == 'yes') {
			$additional['classes'] .= ' mkdf-roadmap-reached-item';
		}

		return $additional;
	}
}