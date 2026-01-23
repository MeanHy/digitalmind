<div class="mkdf-progress-bar-vertical <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-progress-bar-content-outer" <?php echo innovio_mikado_inline_style($inactive_bar_style); ?>>
        <div data-percentage="<?php echo esc_attr($percent); ?>" class="mkdf-progress-bar-progress-content" <?php echo innovio_mikado_inline_style($active_bar_style); ?>></div>
    </div>

    <<?php echo esc_attr($title_tag); ?> class="mkdf-progress-bar-title" <?php echo innovio_mikado_inline_style($title_styles); ?>>
    <?php echo esc_html($title); ?>
    </<?php echo esc_attr($title_tag); ?>>

    <span class="mkdf-progress-bar-number yes" <?php echo innovio_mikado_inline_style($percent_styles); ?>>
            <span><?php echo esc_html($percent); ?></span>
    </span>
</div>