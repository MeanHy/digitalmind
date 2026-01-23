<div class="mkdf-pricing-slider <?php echo esc_attr($holder_classes); ?>" <?php echo innovio_mikado_get_inline_attrs($slider_data); ?>>
    <div class="mkdf-pricing-slider-inner">
        <div class="mkdf-pricing-slider-button-holder">
            <?php
            if($price_period !== ''){ ?>
                <span class="mkdf-pricing-slider-button active" <?php echo innovio_mikado_get_inline_attrs($button_value); ?>>
                    <?php echo innovio_mikado_get_button_html(array(
                        'link' => 'javascript:void(0)',
                        'text' => $price_period,
                        'size' => 'small',
                        'custom_class' => 'button_first_period',
                        'html_type' => 'input',
                        'input_name' => 'monthly',
                    )); ?>
                </span>
            <?php } ?>
        </div>
        <div class="mkdf-pricing-slider-bar-holder" <?php echo innovio_mikado_inline_style($inactive_bar_style); ?>>
            <div class="mkdf-pricing-slider-bar" <?php echo innovio_mikado_inline_style($active_bar_style); ?>>
                <span class="mkdf-pricing-slider-drag">
                    <span aria-hidden="true" class="arrow_carrot-left"></span>
                    <span aria-hidden="true" class="arrow_carrot-right"></span>
                    <span class="mkdf-pricing-slider-value-holder">
                        <span class="mkdf-pricing-slider-value" <?php echo innovio_mikado_get_inline_style($unit_text_style); ?>>0 <?php echo esc_attr($unit_name) . 's'; ?></span>
                    </span>
                </span>
            </div>
        </div>
        <div class="mkdf-pricing-slider-info-holder">
            <?php
            print do_shortcode('[mkdf_pricing_info ' . $pricing_info_params . ']');
            ?>
        </div>
    </div>
</div>