<?php

namespace InnovioCore\CPT\Shortcodes\AccordionTab;

use InnovioCore\Lib;

class AccordionTab implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_accordion_tab';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					"name"                    => esc_html__( 'Accordion Tab', 'innovio-core' ),
					"base"                    => $this->base,
					"as_child"                => array( 'only' => 'mkdf_accordion' ),
					'is_container'            => true,
					"category"                => esc_html__( 'by INNOVIO', 'innovio-core' ),
					"icon"                    => "icon-wpb-accordion-tab extended-custom-icon",
					"show_settings_on_create" => true,
					"js_view"                 => 'VcColumnView',
					"params"                  => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'innovio-core' ),
							'description' => esc_html__( 'Enter accordion section title', 'innovio-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'innovio-core' ),
							'value'      => array_flip( innovio_mikado_get_title_tag( true, array( 'p' => 'p' ) ) ),
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'number',
                            'heading'     => esc_html__( 'Number', 'innovio-core' ),
                            'description' => esc_html__( 'Enter accordion section number', 'innovio-core' )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'label',
                            'heading'     => esc_html__( 'Label', 'innovio-core' ),
                            'description' => esc_html__( 'Enter accordion section number label', 'innovio-core' )
                        ),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'title'     => 'Section',
			'title_tag' => 'h5',
            'number'    => '',
            'label'     => ''
		);
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['content']   = $content;
		$params['title_tag'] = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		
		$output = innovio_core_get_shortcode_module_template_part( 'templates/accordion-template', 'accordions', '', $params );
		
		return $output;
	}
}