<div <?php innovio_mikado_class_attribute($table_classes); ?>>
	<div class="mkdf-cpt-table-holder-inner">
		<div class="mkdf-cpt-table-head-holder">
			<div class="mkdf-cpt-table-head-holder-inner">
				<?php if ($title !== '') : ?>
					<h6 class="mkdf-cpt-table-title"><?php echo esc_html($title); ?></h6>
				<?php endif; ?>
			</div>
		</div>

		<div class="mkdf-cpt-table-content">
			<?php echo do_shortcode(preg_replace('#^<\/p>|<p>$#', '', $content)); ?>
		</div>
	</div>
</div>