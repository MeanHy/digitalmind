<?php
namespace InnovioCore\CPT\Shortcodes\PricingInfo;

use InnovioCore\Lib;

class PricingInfo implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'mkdf_pricing_info';
        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(array(
                'name' => esc_html__('Pricing Info', 'innovio-core'),
                'base' => $this->base,
                'category' => 'by INNOVIO',
                'icon' => 'icon-wpb-pricing-info extended-custom-icon',
                'allowed_container_element' => 'vc_row',
                'params' => array(
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'skin',
                        'heading'    => esc_html__( 'Skin', 'innovio-core' ),
                        'value'      => array(
                            esc_html__( 'Default', 'innovio-core' ) => '',
                            esc_html__( 'Light', 'innovio-core' )   => 'mkdf-light-skin',
                        ),
                        'save_always' => true
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'background_color',
                        'heading'    => esc_html__( 'Background Color', 'innovio-core' )
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'title',
                        'heading' => esc_html__( 'Title', 'innovio-core' ),
                        'value' => esc_html__( 'Basic', 'innovio-core' ),
                        'description' => ''
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
                        'type' => 'textarea',
                        'param_name' => 'description',
                        'heading' => esc_html__( 'Description', 'innovio-core' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'price',
                        'heading'     => esc_html__( 'Price', 'innovio-core' ),
                        'description' => esc_html__( 'Default value is 100', 'innovio-core' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading'     => esc_html__( 'Currency', 'innovio-core' ),
                        'param_name' => 'currency',
                        'description' => esc_html__( 'Default mark is $', 'innovio-core' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading'     => esc_html__( 'Price Period', 'innovio-core' ),
                        'param_name' => 'price_period',
                        'description' => esc_html__( 'Default label is monthly', 'innovio-core' ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading'     => esc_html__('Show Button', 'innovio-core'),
                        'param_name' => 'show_button',
                        'value'       => array_flip(innovio_mikado_get_yes_no_select_array(false, true)),
                        'save_always' => true
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
                        'type'       => 'colorpicker',
                        'param_name' => 'button_color',
                        'heading'    => esc_html__('Button Color', 'innovio-core'),
                        'group'      => esc_html__('Button', 'innovio-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'button_background_color',
                        'heading'    => esc_html__('Button Background Color', 'innovio-core'),
                        'group'      => esc_html__('Button', 'innovio-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'button_border_color',
                        'heading'    => esc_html__('Button Border Color', 'innovio-core'),
                        'group'      => esc_html__('Button', 'innovio-core')
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'button_hover_shadow',
                        'heading'    => esc_html__('Button Hover Shadow', 'innovio-core'),
                        'group'      => esc_html__('Button', 'innovio-core')
                    ),
                )
            ));
        }
    }

    /**
     * Renders HTML for product list shortcode
     *
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
            'skin'            => '',
            'background_color'             => '',
            'title'         			   => 'Basic',
            'description'      			   => '',
            'title_tag'                    => 'h5',
            'price'         			   => '100',
            'currency'      			   => '$',
            'price_period'  			   => 'Monthly',
            'show_button'				   => 'yes',
            'link'          			   => '',
            'button_text'   			   => 'button',
            'button_color'                 => '',
            'button_background_color'      => '',
            'button_border_color'          => '',
            'button_hover_shadow'          => '',
        );

        $params = shortcode_atts( $args, $atts );

        extract($params);

        $pricing_info_clasess = ! empty( $params['skin'] ) ? $params['skin'] : '';

        $params['pricing_info_classes'] = $pricing_info_clasess;
        $params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];

        return innovio_core_get_shortcode_module_template_part('templates/pricing-info', 'pricing-info', '', $params);
    }
}