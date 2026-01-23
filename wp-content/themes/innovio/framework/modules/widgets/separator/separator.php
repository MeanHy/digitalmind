<?php

if ( class_exists( 'InnovioCoreClassWidget' ) ) {
    class InnovioMikadoClassSeparatorWidget extends InnovioCoreClassWidget {
        public function __construct() {
            parent::__construct(
                'mkdf_separator_widget',
                esc_html__( 'Innovio Separator Widget', 'innovio' ),
                array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'innovio' ) )
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
                        'normal'     => esc_html__( 'Normal', 'innovio' ),
                        'full-width' => esc_html__( 'Full Width', 'innovio' )
                    )
                ),
                array(
                    'type'    => 'dropdown',
                    'name'    => 'position',
                    'title'   => esc_html__( 'Position', 'innovio' ),
                    'options' => array(
                        'center' => esc_html__( 'Center', 'innovio' ),
                        'left'   => esc_html__( 'Left', 'innovio' ),
                        'right'  => esc_html__( 'Right', 'innovio' )
                    )
                ),
                array(
                    'type'    => 'dropdown',
                    'name'    => 'border_style',
                    'title'   => esc_html__( 'Style', 'innovio' ),
                    'options' => array(
                        'solid'  => esc_html__( 'Solid', 'innovio' ),
                        'dashed' => esc_html__( 'Dashed', 'innovio' ),
                        'dotted' => esc_html__( 'Dotted', 'innovio' )
                    )
                ),
                array(
                    'type'  => 'colorpicker',
                    'name'  => 'color',
                    'title' => esc_html__( 'Color', 'innovio' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'width',
                    'title' => esc_html__( 'Width (px or %)', 'innovio' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'thickness',
                    'title' => esc_html__( 'Thickness (px)', 'innovio' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'top_margin',
                    'title' => esc_html__( 'Top Margin (px or %)', 'innovio' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'bottom_margin',
                    'title' => esc_html__( 'Bottom Margin (px or %)', 'innovio' )
                )
            );
        }

        public function widget( $args, $instance ) {
            if ( ! is_array( $instance ) ) {
                $instance = array();
            }

            //prepare variables
            $params = '';

            //is instance empty?
            if ( is_array( $instance ) && count( $instance ) ) {
                //generate shortcode params
                foreach ( $instance as $key => $value ) {
                    $params .= " $key='$value' ";
                }
            }

            echo '<div class="widget mkdf-separator-widget">';
            echo do_shortcode( "[mkdf_separator $params]" ); // XSS OK
            echo '</div>';
        }
    }
}