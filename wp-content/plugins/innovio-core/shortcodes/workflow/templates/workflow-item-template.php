<div class="mkdf-workflow-item <?php echo esc_attr($item_classes) ?>">
    <span class="line" style="<?php echo esc_attr($line_color); ?>"></span>
    <span class="mkdf-workflow-curve mkdf-workflow-curve-1"></span>
    <span class="mkdf-workflow-curve mkdf-workflow-curve-2"></span>
    <span class="mkdf-workflow-curve mkdf-workflow-curve-3"></span>
    <div class="mkdf-workflow-item-inner">
        <div class="mkdf-workflow-image">
            <?php if(!empty($image)){
                echo wp_get_attachment_image($image, 'full');
            } ?>
        </div>
        <div class="mkdf-workflow-text">
            <span class="circle" style="<?php echo esc_attr($circle_border_color.$circle_background_color); ?>"></span>
            <?php if(!empty($subtitle)){ ?>
                <span class="mkdf-workflow-item-subtitle"><?php echo esc_attr($subtitle) ?></span>
            <?php } ?>
            <?php if(!empty($title)){ ?>
                <h5 class="mkdf-workflow-item-title"><?php echo esc_attr($title) ?></h5>
            <?php } ?>
            <?php if($separator === 'yes') { ?>
                <div class="mkdf-workflow-item-separator" <?php innovio_mikado_inline_style($separator_styles); ?>></div>
            <?php } ?>
            <?php if(!empty($text)){ ?>
                <p class="mkdf-workflow-item-text"><?php echo esc_attr($text) ?></p>
            <?php } ?>
        </div>
    </div>
</div>