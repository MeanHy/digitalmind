<?php
namespace InnovioCore\CPT\Shortcodes\PricingTable;

use InnovioCore\Lib;

class PricingTable implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_pricing_table';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Pricing Table', 'innovio-core' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'mkdf_pricing_table_item' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by INNOVIO', 'innovio-core' ),
					'icon'                    => 'icon-wpb-pricing-table extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'innovio-core' ),
							'value'       => array_flip( innovio_mikado_get_number_of_columns_array( true, array('four', 'five', 'six') ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'innovio-core' ),
							'value'       => array_flip( innovio_mikado_get_space_between_items_array() ),
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
                        ),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'number_of_columns'   => 'three',
			'space_between_items' => 'normal',
            'skin'         => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$holder_class = $this->getHolderClasses( $params, $args );
		
		$html = '<div class="mkdf-pricing-tables mkdf-grid-list mkdf-disable-bottom-space clearfix ' . esc_attr( $holder_class ) . '">';
			$html .= '<div class="mkdf-pt-wrapper mkdf-outer-space">';
				$html .= do_shortcode( $content );
			$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();

        $holderClasses[] = ! empty( $params['skin'] ) ? 'mkdf-pt-' . esc_attr( $params['skin'] ) . '-skin' : '';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'mkdf-' . $params['number_of_columns'] . '-columns' : 'mkdf-' . $args['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'mkdf-' . $params['space_between_items'] . '-space' : 'mkdf-' . $args['space_between_items'] . '-space';
		
		return implode( ' ', $holderClasses );
	}
}