<?php
namespace InnovioCore\CPT\Shortcodes\Tabs;

use InnovioCore\Lib;

class Tabs implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_tabs';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Tabs', 'innovio-core' ),
					'base'            => $this->getBase(),
					'as_parent'       => array( 'only' => 'mkdf_tabs_item' ),
					'content_element' => true,
					'category'        => esc_html__( 'by INNOVIO', 'innovio-core' ),
					'icon'            => 'icon-wpb-tabs extended-custom-icon',
					'js_view'         => 'VcColumnView',
					'params'          => array(
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
								esc_html__( 'Boxed', 'innovio-core' )    => 'boxed',
								esc_html__( 'Simple Centered', 'innovio-core' )   => 'simple',
							),
							'save_always' => true
						),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'skin',
                            'heading'    => esc_html__( 'Skin', 'innovio-core' ),
                            'value'      => array(
                                esc_html__( 'Default', 'innovio-core' ) => '',
                                esc_html__( 'White', 'innovio-core' )   => 'white'
                            ),
                            'save_always' => true
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'color',
                            'heading'    => esc_html__( 'Border Color', 'innovio-core' ),
                            'dependency' => array( 'element' => 'type', 'value' => array( 'standard' ) )
                        ),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class' => '',
			'type'         => 'standard',
            'color'        => '',
            'skin'         => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		// Extract tab titles
		preg_match_all( '/tab_title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$tab_titles = array();
		
		/**
		 * get tab titles array
		 */
		if ( isset( $matches[0] ) ) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach ( $tab_titles as $tab ) {
			preg_match( '/tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
        $params['holder_styles']  = $this->getHolderStyles( $params );
		$params['tabs_titles']    = $tab_title_array;
		$params['content']        = $content;
		
		$output = innovio_core_get_shortcode_module_template_part( 'templates/tab-template', 'tabs', '', $params );
		
		return $output;
	}

    private function getHolderStyles( $params ) {
        $styles = array();

        if ( $params['color'] !== '' ) {
            $styles[] = 'border-color: ' . $params['color'];
        }

        return implode( ';', $styles );
    }
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = ! empty( $params['skin'] ) ? 'mkdf-' . esc_attr( $params['skin'] ) . '-skin' : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'mkdf-tabs-' . esc_attr( $params['type'] ) : 'mkdf-tabs-standard';
		
		return implode( ' ', $holderClasses );
	}
}