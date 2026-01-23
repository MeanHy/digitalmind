<?php

if ( ! function_exists( 'innovio_mikado_load_modules' ) ) {
	/**
	 * Loades all modules by going through all folders that are placed directly in modules folder
	 * and loads load.php file in each. Hooks to innovio_mikado_action_after_options_map action
	 *
	 * @see http://php.net/manual/en/function.glob.php
	 */
	function innovio_mikado_load_modules() {
		foreach ( glob( MIKADO_FRAMEWORK_ROOT_DIR . '/modules/*/load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'innovio_mikado_action_before_options_map', 'innovio_mikado_load_modules' );
}