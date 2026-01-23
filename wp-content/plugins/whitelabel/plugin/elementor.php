<?php
function hide_elementor_page(){
    wp_enqueue_style( 'elementor_css',plugins_url('assets/css/elementor.css',__DIR__));
}
function hide_elementor_getting_started(){
    ?>
    <style>
        .e-getting-started__content--narrow p , .e-getting-started__video{display: none}
    </style>
<?php
}