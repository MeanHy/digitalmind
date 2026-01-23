<?php
$custom_overlay_styles = $this_object->getCustomOverlayStyles($params); ?>
<?php echo innovio_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/image', $item_style, $params); ?>

<div class="mkdf-pli-text-holder" <?php innovio_mikado_inline_style($custom_overlay_styles); ?>>
	<div class="mkdf-pli-text-wrapper">
		<div class="mkdf-pli-text">
			<?php echo innovio_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/category', $item_style, $params); ?>

			<?php echo innovio_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/title', $item_style, $params); ?>

			<?php echo innovio_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/button', $item_style, $params); ?>
        </div>
	</div>
</div>