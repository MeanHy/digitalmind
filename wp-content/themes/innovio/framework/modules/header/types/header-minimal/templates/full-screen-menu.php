<div class="mkdf-fullscreen-menu-holder-outer">
	<div class="mkdf-fullscreen-menu-holder">
		<div class="mkdf-fullscreen-menu-holder-inner">
			<?php if ($fullscreen_menu_in_grid) : ?>
				<div class="mkdf-container-inner">
			<?php endif; ?>
			<?php 
			//Navigation
			innovio_mikado_get_module_template_part('templates/full-screen-menu-navigation', 'header/types/header-minimal');;
			?>
			<?php if ($fullscreen_menu_in_grid) : ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>