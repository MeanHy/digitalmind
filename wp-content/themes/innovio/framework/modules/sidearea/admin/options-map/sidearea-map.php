<?php

if ( ! function_exists( 'innovio_mikado_sidearea_options_map' ) ) {
	function innovio_mikado_sidearea_options_map() {

        innovio_mikado_add_admin_page(
            array(
                'slug'  => '_side_area_page',
                'title' => esc_html__('Side Area', 'innovio'),
                'icon'  => 'fa fa-indent'
            )
        );

        $side_area_panel = innovio_mikado_add_admin_panel(
            array(
                'title' => esc_html__('Side Area', 'innovio'),
                'name'  => 'side_area',
                'page'  => '_side_area_page'
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_type',
                'default_value' => 'side-menu-slide-from-right',
                'label'         => esc_html__('Side Area Type', 'innovio'),
                'description'   => esc_html__('Choose a type of Side Area', 'innovio'),
                'options'       => array(
                    'side-menu-slide-from-right'       => esc_html__('Slide from Right Over Content', 'innovio'),
                    'side-menu-slide-with-content'     => esc_html__('Slide from Right With Content', 'innovio'),
                    'side-area-uncovered-from-content' => esc_html__('Side Area Uncovered from Content', 'innovio'),
                ),
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'text',
                'name'          => 'side_area_width',
                'default_value' => '',
                'label'         => esc_html__('Side Area Width', 'innovio'),
                'description'   => esc_html__('Enter a width for Side Area (px or %). Default width: 405px.', 'innovio'),
                'args'          => array(
                    'col_width' => 3,
                )
            )
        );

        $side_area_width_container = innovio_mikado_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_width_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_type' => 'side-menu-slide-from-right',
                    )
                )
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'color',
                'name'          => 'side_area_content_overlay_color',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Color', 'innovio'),
                'description'   => esc_html__('Choose a background color for a content overlay', 'innovio'),
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'text',
                'name'          => 'side_area_content_overlay_opacity',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Transparency', 'innovio'),
                'description'   => esc_html__('Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'innovio'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_icon_source',
                'default_value' => 'predefined',
                'label'         => esc_html__('Select Side Area Icon Source', 'innovio'),
                'description'   => esc_html__('Choose whether you would like to use icons from an icon pack or SVG icons', 'innovio'),
                'options'       => innovio_mikado_get_icon_sources_array()
            )
        );

        $side_area_icon_pack_container = innovio_mikado_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_icon_pack_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'icon_pack'
                    )
                )
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent'        => $side_area_icon_pack_container,
                'type'          => 'select',
                'name'          => 'side_area_icon_pack',
                'default_value' => 'font_elegant',
                'label'         => esc_html__('Side Area Icon Pack', 'innovio'),
                'description'   => esc_html__('Choose icon pack for Side Area icon', 'innovio'),
                'options'       => innovio_mikado_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'dripicons', 'simple_line_icons'))
            )
        );

        $side_area_svg_icons_container = innovio_mikado_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_svg_icons_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'svg_path'
                    )
                )
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_icon_svg_path',
                'label'       => esc_html__('Side Area Icon SVG Path', 'innovio'),
                'description' => esc_html__('Enter your Side Area icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'innovio'),
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_close_icon_svg_path',
                'label'       => esc_html__('Side Area Close Icon SVG Path', 'innovio'),
                'description' => esc_html__('Enter your Side Area close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'innovio'),
            )
        );

        $side_area_icon_style_group = innovio_mikado_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'side_area_icon_style_group',
                'title'       => esc_html__('Side Area Icon Style', 'innovio'),
                'description' => esc_html__('Define styles for Side Area icon', 'innovio')
            )
        );

        $side_area_icon_style_row1 = innovio_mikado_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row1'
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_color',
                'label'  => esc_html__('Color', 'innovio')
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_hover_color',
                'label'  => esc_html__('Hover Color', 'innovio')
            )
        );

        $side_area_icon_style_row2 = innovio_mikado_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row2',
                'next'   => true
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_color',
                'label'  => esc_html__('Close Icon Color', 'innovio')
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_hover_color',
                'label'  => esc_html__('Close Icon Hover Color', 'innovio')
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'color',
                'name'        => 'side_area_background_color',
                'label'       => esc_html__('Background Color', 'innovio'),
                'description' => esc_html__('Choose a background color for Side Area', 'innovio')
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'text',
                'name'        => 'side_area_padding',
                'label'       => esc_html__('Padding', 'innovio'),
                'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'innovio'),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        innovio_mikado_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'selectblank',
                'name'          => 'side_area_aligment',
                'default_value' => '',
                'label'         => esc_html__('Text Alignment', 'innovio'),
                'description'   => esc_html__('Choose text alignment for side area', 'innovio'),
                'options'       => array(
                    ''       => esc_html__('Default', 'innovio'),
                    'left'   => esc_html__('Left', 'innovio'),
                    'center' => esc_html__('Center', 'innovio'),
                    'right'  => esc_html__('Right', 'innovio')
                )
            )
        );
    }

    add_action('innovio_mikado_action_options_map', 'innovio_mikado_sidearea_options_map', innovio_mikado_set_options_map_position( 'sidearea' ) );
}