<<?php echo esc_attr($title_tag); ?> class="mkdf-accordion-title">
    <span class="mkdf-accordion-num">
        <span class="mkdf-accordion-number"><?php echo esc_html($number); ?></span>
        <span class="mkdf-accordion-label"><?php echo esc_html($label); ?></span>
    </span>
	<span class="mkdf-tab-title"><?php echo esc_html($title); ?></span>
    <span class="mkdf-accordion-mark">
		<span class="mkdf-accordion-line-1"></span>
        <span class="mkdf-accordion-line-2"></span>
	</span>
</<?php echo esc_attr($title_tag); ?>>
<div class="mkdf-accordion-content">
	<div class="mkdf-accordion-content-inner">
		<?php echo do_shortcode($content); ?>
	</div>
</div>