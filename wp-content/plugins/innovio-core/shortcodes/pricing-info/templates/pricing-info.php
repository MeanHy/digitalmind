<div class="mkdf-pricing-info <?php  echo esc_attr($pricing_info_classes)?>">
    <div class="mkdf-pricing-info-inner">
        <<?php echo esc_attr($title_tag); ?> class="mkdf-pricing-info-title">
            <?php echo esc_html($title); ?>
        </<?php echo esc_attr($title_tag)?>>
        <div class="mkdf-pricing-info-description">
            <?php print $description; ?>
        </div>
        <div class="mkdf-pricing-info-pricing">
            <span class="mkdf-value"><?php echo esc_html($currency) ?></span>
            <span class="mkdf-price"><?php echo esc_html($price)?></span>
            <span class="mkdf-mark"><?php echo esc_html($price_period)?></span>
        </div>
        <?php
        if($show_button == "yes" && $button_text !== ''){ ?>
            <div class="mkdf-pricing-info-button">
                <?php echo innovio_mikado_get_button_html(array(
                    'link'                   => $link,
                    'text'                   => $button_text,
                    'size'                   => 'medium',
                    'color'                  => $button_color,
                    'background_color'       => $button_background_color,
                    'border_color'           => $button_border_color,
                    'hover_shadow'           => $button_hover_shadow
                )); ?>
            </div>
        <?php } ?>
    </div>
</div>