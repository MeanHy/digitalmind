<div <?php innovio_mikado_class_attribute($holder_classes); ?>>
    <?php if($hover_shadow === 'with-hover-shadow') { ?>
        <div class="mkdf-iwt-inner">
    <?php } ?>
	<div class="mkdf-iwt-icon">
		<?php if(!empty($link) && $link_text === '') : ?>
			<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
		<?php endif; ?>
			<?php if(!empty($custom_icon)) : ?>
				<?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
                <?php if(!empty($additional_custom_icon)) : ?>
                    <?php echo wp_get_attachment_image($additional_custom_icon, 'full'); ?>
                <?php endif; ?>
			<?php else: ?>
				<?php echo innovio_core_get_shortcode_module_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
			<?php endif; ?>
		<?php if(!empty($link) && $link_text === '') : ?>
			</a>
		<?php endif; ?>
	</div>
	<div class="mkdf-iwt-content" <?php innovio_mikado_inline_style($content_styles); ?>>
        <?php if(!empty($subtitle)) { ?>
            <<?php echo esc_attr($subtitle_tag); ?> class="mkdf-iwt-subtitle" <?php innovio_mikado_inline_style($subtitle_styles); ?>>
                <span class="mkdf-iwt-subtitle-text"><?php echo esc_html($subtitle); ?></span>
            </<?php echo esc_attr($subtitle_tag); ?>>
        <?php } ?>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="mkdf-iwt-title" <?php innovio_mikado_inline_style($title_styles); ?>>
				<?php if(!empty($link) && $link_text === '') : ?>
					<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
				<?php endif; ?>
				<span class="mkdf-iwt-title-text"><?php echo esc_html($title); ?></span>
				<?php if(!empty($link) && $link_text === '') : ?>
					</a>
				<?php endif; ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
        <?php if($separator === 'yes') { ?>
            <div class="mkdf-iwt-separator" <?php innovio_mikado_inline_style($separator_styles); ?>></div>
        <?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="mkdf-iwt-text" <?php innovio_mikado_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
        <?php if(!empty($link) && $link_text !== '') : ?>
            <div class="mkdf-iwt-link-button">
                <?php echo innovio_mikado_get_button_html(array(
                    'link'                   => $link,
                    'text'                   => $link_text,
                    'type'                   => 'simple',
                    'size'                   => 'large',
                    'predefined_icon'        => $predefined_icon,
                    'color'                  => $button_color,
                    'hover_color'            => $button_hover_color,
                )); ?>
            </div>
        <?php endif; ?>
	</div>
    <?php if($hover_shadow === 'with-hover-shadow') { ?>
        </div>
    <?php } ?>
</div>