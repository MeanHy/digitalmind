<div <?php innovio_mikado_class_attribute($holder_classes); ?>>
	<div class="mkdf-iwt-content" <?php innovio_mikado_inline_style($content_styles); ?>>
		<?php if(!empty($subtitle)) { ?>
            <<?php echo esc_attr($subtitle_tag); ?> class="mkdf-iwt-subtitle" <?php innovio_mikado_inline_style($subtitle_styles); ?>>
                <span class="mkdf-iwt-subtitle-text"><?php echo esc_html($subtitle); ?></span>
            </<?php echo esc_attr($subtitle_tag); ?>>
        <?php } ?>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="mkdf-iwt-title" <?php innovio_mikado_inline_style($title_styles); ?>>
				<?php if(!empty($link)) : ?>
					<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
				<?php endif; ?>
					<span class="mkdf-iwt-icon">
						<?php if(!empty($custom_icon)) : ?>
							<?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
						<?php else: ?>
							<?php echo innovio_core_get_shortcode_module_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
						<?php endif; ?>
					</span>
					<span class="mkdf-iwt-title-text"><?php echo esc_html($title); ?></span>
				<?php if(!empty($link)) : ?>
					</a>
				<?php endif; ?>
			</<?php echo esc_attr($title_tag); ?>>
            <?php if($separator === 'yes') { ?>
                <div class="mkdf-iwt-separator" <?php innovio_mikado_inline_style($separator_styles); ?>></div>
            <?php } ?>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="mkdf-iwt-text" <?php innovio_mikado_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>