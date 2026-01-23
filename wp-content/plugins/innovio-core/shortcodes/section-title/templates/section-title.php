<div class="mkdf-section-title-holder <?php echo esc_attr($holder_classes); ?>" <?php echo innovio_mikado_get_inline_style($holder_styles); ?>>
	<div class="mkdf-st-inner">
        <?php if(!empty($tagline)) { ?>
            <span class="mkdf-st-tagline" <?php echo innovio_mikado_get_inline_style($tagline_styles); ?>><?php echo esc_html($tagline); ?></span>
        <?php } ?>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="mkdf-st-title" <?php echo innovio_mikado_get_inline_style($title_styles); ?>>
				<?php print $title ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
        <?php if($separator === 'yes') { ?>
            <div class="mkdf-st-separator" <?php innovio_mikado_inline_style($separator_styles); ?>></div>
        <?php } ?>
		<?php if(!empty($text)) { ?>
			<<?php echo esc_attr($text_tag); ?> class="mkdf-st-text" <?php echo innovio_mikado_get_inline_style($text_styles); ?>>
				<?php echo wp_kses($text, array('br' => true)); ?>
			</<?php echo esc_attr($text_tag); ?>>
		<?php } ?>
	</div>
</div>