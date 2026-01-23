<?php

if ( ! function_exists( 'innovio_core_register_widgets' ) ) {
    function innovio_core_register_widgets() {
        $widgets = apply_filters( 'innovio_core_filter_register_widgets', $widgets = array() );

        foreach ( $widgets as $widget ) {
            register_widget( $widget );
        }
    }

    add_action( 'widgets_init', 'innovio_core_register_widgets' );
}