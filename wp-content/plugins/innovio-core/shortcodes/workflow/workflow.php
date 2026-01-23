<?php
namespace InnovioCore\CPT\Shortcodes\Workflow;

use InnovioCore\Lib;

class Workflow implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'mkdf_workflow';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    'name'                      => esc_html__('Workflow', 'innovio-core'),
                    'base'                      => $this->base,
                    'as_parent'                 => array('only' => 'mkdf_workflow_item'),
                    'content_element'           => true,
                    'category'                  => esc_html__('by INNOVIO', 'innovio-core'),
                    'icon'                      => 'icon-wpb-workflow extended-custom-icon',
                    'show_settings_on_create'   => true,
                    'js_view'                   => 'VcColumnView',
                    'params' => array(
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__('Extra class name', 'innovio-core'),
                                'param_name' => 'custom_clas',
                                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'innovio-core')
                            ),
                            array(
                                'type'        => 'dropdown',
                                'param_name'  => 'skin',
                                'heading'     => esc_html__( 'Skin', 'innovio-core' ),
                                'value'		  => array(
                                    esc_html__('Light', 'innovio-core') => 'light',
                                    esc_html__('Default', 'innovio-core') => 'default',
                                )
                            ),
                            array(
                                'type' => 'colorpicker',
                                'heading' => esc_html__('Workflow line color', 'innovio-core'),
                                'param_name' => 'line_color',
                                'description' => esc_html__('Pick a color for the workflow line.', 'innovio-core')
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Animate Workflow', 'innovio-core'),
                                'param_name' => 'animate',
                                'value' => array(
                                    esc_html__('Yes', 'innovio-core') => 'yes',
                                    esc_html__('No', 'innovio-core') => 'no',
                                ),
                                'description' => esc_html__('Animate Workflow shortcode when it comes into viewport', 'innovio-core'),
                                'save_always' => true,
                            )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $default_atts = (array(
            'custom_clas'     => '',
            'line_color'   => '',
            'circle_color' => '',
            'skin'		   => 'light',
            'animate'      => 'yes',
        ));

        $params       = shortcode_atts($default_atts, $atts);
        $style_params = $this->getStyleProperties($params);
        $params       = array_merge($params, $style_params);
        extract($params);

        $params['custom_clas'] = $this->getHolderClasses($params);
        $params['content']  = $content;
        $output             = '';

        $output .= innovio_core_get_shortcode_module_template_part('templates/workflow-holder-template', 'workflow', '', $params);

        return $output;
    }

    private function getHolderClasses($params) {

        $holder_classes[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holder_classes[] = ( $params['skin'] === 'light' ) ? 'mkdf-workflow-skin-light' : '';
        $holder_classes[] = ( $params['animate'] === 'yes' ) ? 'mkdf-workflow-animate' : '';

        return implode( ' ', $holder_classes );
    }

    private function getStyleProperties($params) {

        $style                    = array();
        $style['main_line_style'] = '';

        if($params['line_color'] !== '') {
            $style['main_line_style'] = 'background-color:'.$params['line_color'].';';
        }

        return $style;
    }
}
