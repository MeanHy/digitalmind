<?php
namespace InnovioCore\CPT\Shortcodes\PricingSlider;

use InnovioCore\Lib;

class PricingSlider implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'mkdf_pricing_slider';
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
                'name' => esc_html__('Pricing Slider', 'innovio-core'),
                'base' => $this->base,
                'category'=> esc_html__( 'by INNOVIO', 'innovio-core' ),
                'icon' => 'icon-wpb-pricing-slider extended-custom-icon',
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
                        'type' => 'textfield',
                        'param_name' => 'unit_name',
                        'heading'     => esc_html__( 'Unit Name', 'innovio-core' ),
                        'description'     => esc_html__( 'Enter singular name of unit you will charge for (ex. unit)', 'innovio-core' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'units_range',
                        'heading'     => esc_html__( 'Units range', 'innovio-core' ),
                        'description'     => esc_html__( 'Enter maximum number of units you will charge (ex. 1000)', 'innovio-core' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'units_breakpoints',
                        'heading'     => esc_html__( 'Units breakpoints', 'innovio-core' ),
                        'description'     => esc_html__( 'Enter breakpoint value where price per unit will be reduced (ex. 100)', 'innovio-core' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'price_per_unit',
                        'heading'     => esc_html__( 'Price Per Unit', 'innovio-core' ),
                        'description'     => esc_html__( 'Enter value of price that will be charged per unit (ex. 5)', 'innovio-core' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Price Reduce Per Breakpoint', 'innovio-core' ),
                        'param_name' => 'price_reduce_per_breakpoint',
                        'description' => esc_html__('Enter value for which price will be reduced on each breakpoint (ex. 0.2)','innovio-core' ),
                    ),
                    /* Pricing info parameters */
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => esc_html__('Title','innovio-core' ),
                        'param_name' => 'title',
                        'value' => esc_html__('Pay what you need','innovio-core' ),
                        'description' => '',
                        'group' => esc_html__('Pricing Info','innovio-core' ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => esc_html__('Title Tag','innovio-core' ),
                        'param_name' => 'title_tag',
                        'value' => array(
                            '' => '',
                            'h2' => 'h2',
                            'h3' => 'h3',
                            'h4' => 'h4',
                            'h5' => 'h5',
                            'h6' => 'h6',
                        ),
                        'description' => '',
                        'group' => esc_html__('Pricing Info','innovio-core' ),
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => esc_html__('Description','innovio-core' ),
                        'param_name' => 'description',
                        'group' => esc_html__('Pricing Info','innovio-core' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => esc_html__('Currency','innovio-core' ),
                        'param_name' => 'currency',
                        'description' => esc_html__('Default mark is $','innovio-core' ),
                        'group' => esc_html__('Pricing Info','innovio-core' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => esc_html__('Price Period','innovio-core' ),
                        'param_name' => 'price_period_info',
                        'description' => esc_html__('Default label is monthly','innovio-core' ),
                        'group' => esc_html__('Pricing Info','innovio-core' ),
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => esc_html__('Show Button','innovio-core' ),
                        'param_name' => 'show_button',
                        'value'       => array_flip( innovio_mikado_get_yes_no_select_array( false, true ) ),
                        'description' => '',
                        'save_always' => true,
                        'group' => esc_html__('Pricing Info','innovio-core' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => esc_html__('Button Text','innovio-core' ),
                        'param_name' => 'button_text',
                        'dependency' => array('element' => 'show_button', 'value' => 'yes'),
                        'group' => esc_html__('Pricing Info','innovio-core' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => esc_html__('Button Link','innovio-core' ),
                        'param_name' => 'link',
                        'dependency' => array('element' => 'show_button', 'value' => 'yes'),
                        'group' => esc_html__('Pricing Info','innovio-core' ),
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'color_active',
                        'heading'    => esc_html__( 'Active Color', 'innovio-core' ),
                        'group' => esc_html__('Design Options','innovio-core' ),
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'param_name' => 'color_inactive',
                        'heading'    => esc_html__( 'Inactive Color', 'innovio-core' ),
                        'group' => esc_html__('Design Options','innovio-core' ),
                    ),
                    array(
                        'type' => 'colorpicker',
                        'admin_label' => true,
                        'heading' => esc_html__('Unit Text Color','innovio-core' ),
                        'param_name' => 'unit_text_color',
                        'group' => esc_html__('Design Options','innovio-core' ),
                    )
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
        $default_atts = array(
            'skin'            => '',
            'unit_name'         		        => 'unit',
            'units_range'         		        => '0',
            'units_breakpoints'      	        => '0',
            'price_per_unit'      	            => '0',
            'price_reduce_per_breakpoint'       => '0',
            'price_period'                      => 'Monthly',
            'title'         			        => 'Pay what you need',
            'description'      			        => '',
            'title_tag'                         => 'h5',
            'currency'      			        => '$',
            'price_period_info'			        => 'Monthly',
            'show_button'				        => 'yes',
            'link'          			        => '',
            'button_text'   			        => 'button',
            'unit_text_color'   			    => '',
            'color_active'                      => '',
            'color_inactive'                    => ''
        );

        $params = shortcode_atts($default_atts, $atts);
        //Extract params for use in method
        extract($params);

        $params['holder_classes'] = $this->getHolderClasses( $params );
        $params['button_value'] = $this->getButtonData($params);
        $params['pricing_info_params'] = $this->getPricingInfoParams($params);
        $params['slider_data'] = $this->getSliderData($params);
        $params['unit_text_style'] = $this->getStyleForUnitText($params);
        $params['active_bar_style']   = $this->getActiveColor( $params );
        $params['inactive_bar_style'] = $this->getInactiveColor( $params );

        $html = innovio_core_get_shortcode_module_template_part('templates/pricing-slider', 'pricing-slider', '', $params);

        return $html;
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['skin'] ) ? $params['skin'] : '';

        return implode( ' ', $holderClasses );
    }

    /**
     * Return data attributes for button
     *
     * @param $params
     * @return array
     */
    private function getButtonData($params) {

        $buttonData = array();

        if( $params['price_per_unit'] !== '' ) {
            $buttonData['data-price-per-unit'] = $params['price_per_unit'];
        }

        if( $params['price_reduce_per_breakpoint'] !== '' ) {
            $buttonData['data-price-reduce-per-breakpoint'] = $params['price_reduce_per_breakpoint'];
        }


        return $buttonData;

    }

    private function getActiveColor( $params ) {
        $styles = array();

        if ( ! empty( $params['color_active'] ) ) {
            $styles[] = 'background-color: ' . $params['color_active'];
        }

        $styles[] = 'width: 0';

        return $styles;
    }

    private function getInactiveColor( $params ) {
        $styles = array();

        if ( ! empty( $params['color_inactive'] ) ) {
            $styles[] = 'background-color: ' . $params['color_inactive'];
        }

        return $styles;
    }

    /**
     * Return data attributes for slider
     *
     * @param $params
     * @return array
     */
    private function getSliderData($params) {

        $sliderData = array();

        if( $params['units_range'] !== '' ) {
            $sliderData['data-units-range'] = $params['units_range'];
        }

        if( $params['units_breakpoints'] !== '' ) {
            $sliderData['data-units-breakpoints'] = $params['units_breakpoints'];
        }

        if( $params['unit_name'] !== '' ) {
            $sliderData['data-unit-name'] = $params['unit_name'];
        }


        return $sliderData;

    }

    /**
     * Return data attributes for button
     *
     * @param $params
     * @return string
     */
    private function getPricingInfoParams($params) {

        $shortcodeParams = '';
        //$price = $params['extra_initially_active'] === 'yes' ? $params['price_per_unit_extra'] : $params['price_per_unit'];
        //$price_period = $params['extra_initially_active'] === 'yes' ? $params['price_period_extra'] : $params['price_period'];

        $shortcodeParams .= ' show_button="' .$params["show_button"] .'" ';
        $shortcodeParams .= ' description="' .$params["description"] .'" ';
        $shortcodeParams .= ' title_tag="' .$params["title_tag"] .'" ';
        $shortcodeParams .= ' title="' .$params["title"] .'" ';
        $shortcodeParams .= ' currency="' .$params["currency"] .'" ';
        $shortcodeParams .= ' price="0"';
        $shortcodeParams .= ' price_period="' . $params['price_period_info'] .'" ';
        $shortcodeParams .= ' button_text="' .$params["button_text"] .'" ';
        $shortcodeParams .= ' link="' .$params["link"] .'" ';

        return $shortcodeParams;
    }

    /**
     * Return string with styles for unit text
     *
     * @param $params
     * @return string
     */
    private function getStyleForUnitText($params) {
        $unitStyle = array();

        if($params['unit_text_color'] !== '') {
            $unitStyle[] = "color: " . $params['unit_text_color'];
        }

        return implode(';', $unitStyle);
    }
}