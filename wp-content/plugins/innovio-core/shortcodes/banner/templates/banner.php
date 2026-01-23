<div class="mkdf-banner-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-banner-text-holder" <?php echo innovio_mikado_get_inline_style($background_styles); ?> <?php echo innovio_mikado_get_inline_attrs($banner_data); ?>>
	    <div class="mkdf-banner-text-outer">
		    <div class="mkdf-banner-text-inner">
		        <?php if(!empty($subtitle)) { ?>
		            <<?php echo esc_attr($subtitle_tag); ?> class="mkdf-banner-subtitle" <?php echo innovio_mikado_get_inline_style($subtitle_styles); ?> <?php echo innovio_mikado_get_inline_attrs($subtitle_data); ?>>
                        <?php echo wp_kses($subtitle, array('span' => array('class' => true))); ?>
		            </<?php echo esc_attr($subtitle_tag); ?>>
		        <?php } ?>
		        <?php if(!empty($title)) { ?>
		            <<?php echo esc_attr($title_tag); ?> class="mkdf-banner-title" <?php echo innovio_mikado_get_inline_style($title_styles); ?> <?php echo innovio_mikado_get_inline_attrs($title_data); ?>>
		                <?php echo wp_kses($title, array('span' => array('class' => true))); ?>
	                </<?php echo esc_attr($title_tag); ?>>
		        <?php } ?>
                <?php
                if (!empty($button_text)) { ?>
                    <div class="mkdf-banner-button" <?php echo innovio_mikado_get_inline_attrs($button_data); ?>>
                        <?php echo innovio_mikado_get_button_html(array(
                            'link'                   => $link,
                            'text'                   => $button_text,
                            'type'                   => $button_type,
                            'size'                   => 'medium',
                            'predefined_icon'        => 'light_style',
                            'color'                  => $button_color,
                            'background_color'       => $button_background_color,
                            'border_color'           => $button_border_color,
                            'hover_shadow'           => $button_hover_shadow
                        )); ?>
                    </div>
                <?php } ?>
			</div>
		</div>
	</div>
</div>