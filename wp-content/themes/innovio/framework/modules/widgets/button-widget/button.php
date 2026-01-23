<?php

if ( class_exists( 'InnovioCoreClassWidget' ) ) {
    class InnovioMikadoClassButtonWidget extends InnovioCoreClassWidget {
        public function __construct() {
            parent::__construct(
                'mkdf_button_widget',
                esc_html__( 'Innovio Button Widget', 'innovio' ),
                array( 'description' => esc_html__( 'Add button element to widget areas', 'innovio' ) )
            );

            $this->setParams();
        }

        protected function setParams() {
            $this->params = array(
                array(
                    'type'    => 'dropdown',
                    'name'    => 'type',
                    'title'   => esc_html__( 'Type', 'innovio' ),
                    'options' => array(
                        'solid'   => esc_html__( 'Solid', 'innovio' ),
                        'simple'  => esc_html__( 'Simple', 'innovio' )
                    )
                ),
                array(
                    'type'        => 'dropdown',
                    'name'        => 'size',
                    'title'       => esc_html__( 'Size', 'innovio' ),
                    'options'     => array(
                        'small'  => esc_html__( 'Small', 'innovio' ),
                        'medium' => esc_html__( 'Medium', 'innovio' ),
                        'large'  => esc_html__( 'Large', 'innovio' ),
                        'huge'   => esc_html__( 'Huge', 'innovio' )
                    ),
                    'description' => esc_html__( 'This option is only available for solid button type', 'innovio' )
                ),
                array(
                    'type'    => 'textfield',
                    'name'    => 'text',
                    'title'   => esc_html__( 'Text', 'innovio' ),
                    'default' => esc_html__( 'Button Text', 'innovio' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'link',
                    'title' => esc_html__( 'Link', 'innovio' )
                ),
                array(
                    'type'    => 'dropdown',
                    'name'    => 'target',
                    'title'   => esc_html__( 'Link Target', 'innovio' ),
                    'options' => innovio_mikado_get_link_target_array()
                ),
                array(
                    'type'  => 'colorpicker',
                    'name'  => 'color',
                    'title' => esc_html__( 'Color', 'innovio' )
                ),
                array(
                    'type'  => 'colorpicker',
                    'name'  => 'hover_color',
                    'title' => esc_html__( 'Hover Color', 'innovio' )
                ),
                array(
                    'type'        => 'colorpicker',
                    'name'        => 'background_color',
                    'title'       => esc_html__( 'Background Color', 'innovio' ),
                    'description' => esc_html__( 'This option is only available for solid button type', 'innovio' )
                ),
                array(
                    'type'        => 'colorpicker',
                    'name'        => 'hover_background_color',
                    'title'       => esc_html__( 'Hover Background Color', 'innovio' ),
                    'description' => esc_html__( 'This option is only available for solid button type', 'innovio' )
                ),
                array(
                    'type'        => 'colorpicker',
                    'name'        => 'border_color',
                    'title'       => esc_html__( 'Border Color', 'innovio' ),
                    'description' => esc_html__( 'This option is only available for solid button type', 'innovio' )
                ),
                array(
                    'type'        => 'colorpicker',
                    'name'        => 'hover_border_color',
                    'title'       => esc_html__( 'Hover Border Color', 'innovio' ),
                    'description' => esc_html__( 'This option is only available for solid button type', 'innovio' )
                ),
                array(
                    'type'        => 'textfield',
                    'name'        => 'margin',
                    'title'       => esc_html__( 'Margin', 'innovio' ),
                    'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'innovio' )
                )
            );
        }

        public function widget( $args, $instance ) {
            $params = '';

            if ( ! is_array( $instance ) ) {
                $instance = array();
            }

            // Filter out all empty params
            $instance = array_filter( $instance, function ( $array_value ) {
                return trim( $array_value ) != '';
            } );

            // Default values
            if ( ! isset( $instance['text'] ) ) {
                $instance['text'] = 'Button Text';
            }

            // Generate shortcode params
            foreach ( $instance as $key => $value ) {
                $params .= " $key='$value' ";
            }

            echo '<div class="widget mkdf-button-widget">';
            echo do_shortcode( "[mkdf_button $params]" ); // XSS OK
            echo '</div>';
        }
    }
}