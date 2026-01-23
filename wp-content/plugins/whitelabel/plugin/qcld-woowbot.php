<?php
function hide_link_woowbot(){
    ?>
        <style>
            a[href^="https://www.quantumcloud.com/"],.modal-backdrop.fade.in,#section-flip-15,.woo-chatbot-tabs.woo-chatbot-tabs-style-flip nav ul li:nth-last-child(2){display: none!important}
        </style>
    <?php
}
function hide_link_woowbot_license(){
    ?>
        <style>
            .wrap.swpm-admin-menu-wrap .content{display: none!important}
        </style>
    <?php
}