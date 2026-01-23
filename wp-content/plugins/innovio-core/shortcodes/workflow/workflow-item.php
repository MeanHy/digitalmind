<?php

namespace InnovioCore\CPT\Shortcodes\WorkflowItem;

use InnovioCore\Lib;

class WorkflowItem implements  Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'mkdf_workflow_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    "name"                      => esc_html__('Workflow Item', 'innovio-core'),
                    "base"                      => $this->base,
                    "as_child"                  => array('only' => 'mkdf_workflow'),
                    "category"                  => esc_html__( 'by INNOVIO', 'innovio-core' ),
                    "icon"                      => "icon-wpb-workflow-item extended-custom-icon",
                    "show_settings_on_create"   => true,
                    'params'                    => array_merge(
                        array(
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__('Subtitle', 'innovio-core'),
                                'param_name' => 'subtitle',
                                'admin_label' => true,
                                'description' => esc_html__('Enter workflow item subtitle.', 'innovio-core')
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => esc_html__('Title', 'innovio-core'),
                                'param_name' => 'title',
                                'admin_label' => true,
                                'description' => esc_html__('Enter workflow item title.', 'innovio-core')
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
                                'type' => 'textarea',
                                'heading' => esc_html__('Text', 'innovio-core'),
                                'param_name' => 'text',
                                'description' => esc_html__('Enter workflow item text.', 'innovio-core')
                            ),
                            array(
                                'type' => 'attach_image',
                                'heading' => esc_html__('Image', 'innovio-core'),
                                'param_name' => 'image',
                                'description' => esc_html__('Insert workflow item image.', 'innovio-core')
                            ),
                            array(
                                'type' => 'colorpicker',
                                'heading' => esc_html__('Circle border color', 'innovio-core'),
                                'param_name' => 'circle_border_color',
                                'description' => esc_html__('Pick a color for the circle border color.', 'innovio-core')
                            ),
                            array(
                                'type' => 'colorpicker',
                                'heading' => esc_html__('Circle background color', 'innovio-core'),
                                'param_name' => 'circle_background_color',
                                'description' => esc_html__('Pick a color for the circle background color.', 'innovio-core')
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Featured Stage','innovio-core' ),
                                'param_name' => 'stage_featured',
                                'value'       => array_flip( innovio_mikado_get_yes_no_select_array( false, false ) ),
                                'save_always' => true,
                            ),
                            array(
                                'type' => 'dropdown',
                                'heading' => esc_html__('Stage Reached','innovio-core' ),
                                'param_name' => 'stage_reached',
                                'value'       => array_flip( innovio_mikado_get_yes_no_select_array( false, true ) ),
                                'save_always' => true,
                            ),
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $default_atts = (array(
            'title'                   => '',
            'separator'               => 'no',
            'separator_color'         => '',
            'subtitle'                => '',
            'text'                    => '',
            'image'                   => '',
            'circle_border_color'     => '',
            'circle_background_color' => '',
            'stage_reached'           => 'yes',
            'stage_featured'          => 'no',
        ));

        $params       = shortcode_atts($default_atts, $atts);
        $style_params = $this->getStyleProperties($params);
        $params       = array_merge($params, $style_params);
        extract($params);

        $params['item_classes']     = $this->getItemClasses( $params );
        $params['separator_styles']     = $this->getSeparatorStyles( $params );

        $output = '';
        $output .= innovio_core_get_shortcode_module_template_part('templates/workflow-item-template', 'workflow', '', $params);

        return $output;
    }

    private function getItemClasses( $params ) {
        $item_classes = array();

        $item_classes[] = ($params['stage_reached'] === 'yes') ? 'mkdf-workflow-item-reached' : '';
        $item_classes[] = ($params['stage_featured'] === 'yes') ? 'mkdf-workflow-item-featured' : '';

        return implode( ' ', $item_classes );
    }

    private function getSeparatorStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['separator_color'] ) ) {
            $styles[] = 'background-color: ' . $params['separator_color'];
        }

        return implode( ';', $styles );
    }

    private function getStyleProperties($params) {

        $style                            = array();
        $style['circle_border_color']     = '';
        $style['circle_background_color'] = '';
        $style['line_color']              = '';

        if($params['circle_border_color'] !== '') {
            $style['circle_border_color'] = 'border-color:'.$params['circle_border_color'].';';
        }
        if($params['circle_background_color'] !== '') {
            $style['circle_background_color'] = 'background-color:'.$params['circle_background_color'].';';
        }

        return $style;
    }
}
