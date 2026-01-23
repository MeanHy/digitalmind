<?php
$rand = rand(0, 1000);
$link_class = !empty($play_button_hover_image) ? 'mkdf-vb-has-hover-image' : '';
?>
<div class="mkdf-video-button-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="mkdf-video-button-image">
		<?php echo wp_get_attachment_image($video_image, 'full'); ?>
	</div>
	<?php if(!empty($play_button_image)) { ?>
		<a class="mkdf-video-button-play-image <?php echo esc_attr($link_class); ?>" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto[video_button_pretty_photo_<?php echo esc_attr($rand); ?>]">
			<span class="mkdf-video-button-play-inner">
                <?php if(!empty($video_title)){?>
                    <span class="mkdf-video-title" <?php echo innovio_mikado_get_inline_style($title_color); ?>><?php echo wp_kses_post($video_title) ?></span>
                <?php } ?>
				<?php echo wp_get_attachment_image($play_button_image, 'full'); ?>
			</span>
		</a>
	<?php } else { ?>
		<a class="mkdf-video-button-play" <?php echo innovio_mikado_get_inline_style($play_button_styles); ?> href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto[video_button_pretty_photo_<?php echo esc_attr($rand); ?>]">
			<span class="mkdf-video-button-play-inner">
                <?php if(!empty($video_title)){?>
                    <span class="mkdf-video-title" <?php echo innovio_mikado_get_inline_style($title_color); ?>><?php echo wp_kses_post($video_title) ?></span>
                <?php } ?>
				<span class="arrow_triangle-right_alt"></span>
			</span>
		</a>
	<?php } ?>
</div>