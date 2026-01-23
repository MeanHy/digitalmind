<?php

namespace InnovioCore\CPT\Shortcodes\ComparisonPricingTable;

use InnovioCore\Lib;

class ComparisonPricingItem implements Lib\ShortcodeInterface
{
    private $base;

    /**
     * ComparisonPricingTable constructor.
     */
    public function __construct() {
        $this->base = 'mkdf_comparison_pricing_item';

        add_action('vc_before_init', array($this, 'vcMap'));
    }


    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Comparison Pricing Item', 'innovio-core'),
            'base'                      => $this->base,
            'icon'                      => 'icon-wpb-cmp-pricing-item extended-custom-icon',
            'category'                  => 'by INNOVIO',
            'allowed_container_element' => 'vc_row',
            'as_child'                  => array('only' => 'mkdf_comparison_pricing_table_holder'),
            'params'                    => array(
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'set_active_item',
                    'heading'     => esc_html__('Set Item As Active', 'innovio-core'),
                    'value'       => array_flip(innovio_mikado_get_yes_no_select_array(false)),
                    'save_always' => true
                ),
                array(
                    'type'        => 'textfield',
                    'admin_label' => true,
                    'heading'     => esc_html__('Title', 'innovio-core'),
                    'param_name'  => 'title',
                    'value'       => esc_html__('Basic Plan', 'innovio-core'),
                    'description' => ''
                ),
                array(
                    'type'        => 'textarea_html',
                    'holder'      => 'div',
                    'class'       => '',
                    'heading'     => esc_html__('Content', 'innovio-core'),
                    'param_name'  => 'content',
                    'value'       => '<li>' . esc_html__('content content content', 'innovio-core') . '</li><li>' . esc_html__('content content content', 'innovio-core') . '</li><li>' . esc_html__('content content content', 'innovio-core') . '</li>',
                    'description' => '',
                    'admin_label' => false
                ),
            )
        ));
    }

    public function render($atts, $content = null) {
        $args = array(
            'set_active_item'  => 'no',
            'title'            => esc_html__('Basic', 'innovio-core'),
        );

        $args   = array_merge( $args, innovio_mikado_icon_collections()->getShortcodeParams() );
        $params = shortcode_atts($args, $atts);


        $params['content'] = $content;
        $params['table_classes'] = $this->getTableClasses($params);

        return innovio_core_get_shortcode_module_template_part('templates/cpt-item-template', 'comparison-pricing-table', '', $params);
    }

    private function getTableClasses($params) {
        $classes = array('mkdf-comparision-item-holder', 'mkdf-cpt-table');

        $classes[] = $params['set_active_item'] === 'yes' ? 'mkdf-cpt-active-item' : '';

        return $classes;
    }
}