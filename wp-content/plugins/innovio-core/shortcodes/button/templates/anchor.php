<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php innovio_mikado_inline_style($button_styles); ?> <?php innovio_mikado_class_attribute($button_classes); ?> <?php echo innovio_mikado_get_inline_attrs($button_data); ?> <?php echo innovio_mikado_get_inline_attrs($button_custom_attrs); ?>>
    <span class="mkdf-btn-text"><?php echo esc_html($text); ?></span>
    <?php if($type !== 'simple') {
	        echo innovio_mikado_icon_collections()->renderIcon( $icon, $icon_pack );
	        if(empty($icon) && $predefined_arrow === 'yes') { ?>
                <svg class="mkdf-btn-svg-one" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 26 9" style="enable-background:new 0 0 26 9;" xml:space="preserve">
                    <path d="M26,4.7C26,4.6,26,4.4,26,4.3c0-0.1-0.1-0.1-0.1-0.2l-3.5-3.5c-0.2-0.2-0.5-0.2-0.7,0s-0.2,0.5,0,0.7L24.3,4
                    H0.5C0.2,4,0,4.2,0,4.5S0.2,5,0.5,5h23.8l-2.7,2.7c-0.2,0.2-0.2,0.5,0,0.7c0.1,0.1,0.2,0.1,0.4,0.1s0.3,0,0.4-0.1l3.5-3.5
                    C25.9,4.8,25.9,4.8,26,4.7z"/>
                </svg>
                <svg class="mkdf-btn-svg-two" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 26 9" style="enable-background:new 0 0 26 9;" xml:space="preserve">
                    <path d="M26,4.7C26,4.6,26,4.4,26,4.3c0-0.1-0.1-0.1-0.1-0.2l-3.5-3.5c-0.2-0.2-0.5-0.2-0.7,0s-0.2,0.5,0,0.7L24.3,4
                    H0.5C0.2,4,0,4.2,0,4.5S0.2,5,0.5,5h23.8l-2.7,2.7c-0.2,0.2-0.2,0.5,0,0.7c0.1,0.1,0.2,0.1,0.4,0.1s0.3,0,0.4-0.1l3.5-3.5
                    C25.9,4.8,25.9,4.8,26,4.7z"/>
                </svg>
            <?php }
        } else { ?>
            <div class="mkdf-btn-plus">
                <span class="mkdf-btn-line-1"></span>
                <span class="mkdf-btn-line-2"></span>
            </div>
        <?php }
    ?>
</a>