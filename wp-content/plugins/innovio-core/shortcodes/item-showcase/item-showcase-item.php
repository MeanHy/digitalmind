<?php
namespace InnovioCore\CPT\Shortcodes\ItemShowcase;

use InnovioCore\Lib;

class ItemShowcaseItem implements Lib\ShortcodeInterface
{
    private $base;

    function __construct() {
        $this->base = 'mkdf_item_showcase_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name'                    => esc_html__('Item Showcase List Item', 'innovio-core'),
                    'base'                    => $this->base,
                    'as_child'                => array('only' => 'mkdf_item_showcase'),
                    'as_parent'               => array('except' => 'vc_row'),
                    'content_element'         => true,
                    'category'                => esc_html__('by INNOVIO', 'innovio-core'),
                    'icon'                    => 'icon-wpb-item-showcase-item extended-custom-icon',
                    'show_settings_on_create' => true,
                    'params'                  => array_merge(
                        innovio_mikado_icon_collections()->getVCParamsArray(),
                        array(
                            array(
                                'type'        => 'dropdown',
                                'heading'     => esc_html__('Icon Type', 'innovio-core'),
                                'param_name'  => 'icon_type',
                                'value'       => array(
                                    esc_html__('Normal', 'innovio-core') => 'mkdf-normal',
                                    esc_html__('Circle', 'innovio-core') => 'mkdf-circle',
                                    esc_html__('Square', 'innovio-core') => 'mkdf-square',
                                ),
                                'save_always' => true,
                                'admin_label' => true,
                            ),
                            array(
                                'type'       => 'colorpicker',
                                'heading'    => esc_html__('Icon Color', 'innovio-core'),
                                'param_name' => 'icon_color',
                                'dependency'  => array(
                                    'element' => 'icon_type',
                                    'value'   => array('mkdf-normal', 'mkdf-square', 'mkdf-circle')
                                )
                            ),
							array(
								'type'       => 'attach_image',
								'param_name' => 'custom_icon',
								'heading'    => esc_html__( 'Custom Icon', 'innovio-core' )
							),
                            array(
                                'type'        => 'dropdown',
                                'param_name'  => 'item_position',
                                'heading'     => esc_html__('Item Position', 'innovio-core'),
                                'value'       => array(
                                    esc_html__('Left', 'innovio-core')  => 'left',
                                    esc_html__('Right', 'innovio-core') => 'right'
                                ),
                                'save_always' => true,
                                'admin_label' => true
                            ),
                            array(
                                'type'        => 'textfield',
                                'param_name'  => 'item_title',
                                'heading'     => esc_html__('Item Title', 'innovio-core'),
                                'admin_label' => true
                            ),
                            array(
                                'type'       => 'textfield',
                                'param_name' => 'item_link',
                                'heading'    => esc_html__('Item Link', 'innovio-core'),
                                'dependency' => array('element' => 'item_title', 'not_empty' => true)
                            ),
                            array(
                                'type'        => 'dropdown',
                                'param_name'  => 'item_target',
                                'heading'     => esc_html__('Item Target', 'innovio-core'),
                                'value'       => array_flip(innovio_mikado_get_link_target_array()),
                                'dependency'  => array('element' => 'item_link', 'not_empty' => true),
                                'save_always' => true
                            ),
                            array(
                                'type'        => 'dropdown',
                                'param_name'  => 'item_title_tag',
                                'heading'     => esc_html__('Item Title Tag', 'innovio-core'),
                                'value'       => array_flip(innovio_mikado_get_title_tag(true)),
                                'save_always' => true,
                                'dependency'  => array('element' => 'item_title', 'not_empty' => true)
                            ),
                            array(
                                'type'       => 'colorpicker',
                                'param_name' => 'item_title_color',
                                'heading'    => esc_html__('Item Title Color', 'innovio-core'),
                                'dependency' => array('element' => 'item_title', 'not_empty' => true)
                            ),
                            array(
                                'type'       => 'textarea',
                                'param_name' => 'item_text',
                                'heading'    => esc_html__('Item Text', 'innovio-core')
                            ),
                            array(
                                'type'       => 'colorpicker',
                                'param_name' => 'item_text_color',
                                'heading'    => esc_html__('Item Text Color', 'innovio-core'),
                                'dependency' => array('element' => 'item_text', 'not_empty' => true)
                            )
                        )

                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'icon_type'        => '',
            'icon_color'       => '',
			'custom_icon'      => '',
            'item_position'    => 'left',
            'item_title'       => '',
            'item_link'        => '',
            'item_target'      => '_self',
            'item_title_tag'   => 'h5',
            'item_title_color' => '',
            'item_text'        => '',
            'item_text_color'  => ''
        );

        $args = array_merge($args, innovio_mikado_icon_collections()->getShortcodeParams());

        $params = shortcode_atts($args, $atts);

        $params['icon_params'] = $this->getIconParameters($params);
        $params['showcase_item_class'] = $this->getShowcaseItemClasses($params);
        $params['item_target'] = !empty($params['item_target']) ? $params['item_target'] : $args['item_target'];
        $params['item_title_tag'] = !empty($params['item_title_tag']) ? $params['item_title_tag'] : $args['item_title_tag'];
        $params['item_title_styles'] = $this->getTitleStyles($params);
        $params['item_text_styles'] = $this->getTextStyles($params);

        $html = innovio_core_get_shortcode_module_template_part('templates/item-showcase-item', 'item-showcase', '', $params);

        return $html;
    }

    private function getShowcaseItemClasses($params) {
        $itemClass = array();

        if (!empty($params['item_position'])) {
            $itemClass[] = 'mkdf-is-' . $params['item_position'];
        }

        return implode(' ', $itemClass);
    }

    private function getTitleStyles($params) {
        $styles = array();

        if (!empty($params['item_title_color'])) {
            $styles[] = 'color: ' . $params['item_title_color'];
        }

        return implode(';', $styles);
    }

    private function getTextStyles($params) {
        $styles = array();

        if (!empty($params['item_text_color'])) {
            $styles[] = 'color: ' . $params['item_text_color'];
        }

        return implode(';', $styles);
    }

    /**
     * Returns parameters for icon shortcode as a string
     *
     * @param $params
     *
     * @return array
     */
    private function getIconParameters($params) {
        $params_array = array();

		if ( empty( $params['custom_icon'] ) ) {
        $iconPackName = innovio_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

        $params_array['icon_pack']   = $params['icon_pack'];
        $params_array['icon_color']  = $params['icon_color'];

        if (!empty($params['icon_type'])) {
            $params_array['type'] = $params['icon_type'];
        }

        $params_array[$iconPackName] = $params[$iconPackName];

        $params_array['size'] = 'mkdf-icon-medium';

		}

        return $params_array;

    }
}
