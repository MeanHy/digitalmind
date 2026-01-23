<?php

//define constants
define( 'MIKADO_ROOT', get_template_directory_uri() );
define( 'MIKADO_ROOT_DIR', get_template_directory() );
define( 'MIKADO_ASSETS_ROOT', MIKADO_ROOT . '/assets' );
define( 'MIKADO_ASSETS_ROOT_DIR', MIKADO_ROOT_DIR . '/assets' );
define( 'MIKADO_FRAMEWORK_ROOT', MIKADO_ROOT . '/framework' );
define( 'MIKADO_FRAMEWORK_ROOT_DIR', MIKADO_ROOT_DIR . '/framework' );
define( 'MIKADO_FRAMEWORK_ADMIN_ASSETS_ROOT', MIKADO_ROOT . '/framework/admin/assets' );
define( 'MIKADO_FRAMEWORK_ICONS_ROOT', MIKADO_ROOT . '/framework/lib/icons-pack' );
define( 'MIKADO_FRAMEWORK_ICONS_ROOT_DIR', MIKADO_ROOT_DIR . '/framework/lib/icons-pack' );
define( 'MIKADO_FRAMEWORK_MODULES_ROOT', MIKADO_ROOT . '/framework/modules' );
define( 'MIKADO_FRAMEWORK_MODULES_ROOT_DIR', MIKADO_ROOT_DIR . '/framework/modules' );
define( 'MIKADO_FRAMEWORK_HEADER_ROOT', MIKADO_ROOT . '/framework/modules/header' );
define( 'MIKADO_FRAMEWORK_HEADER_ROOT_DIR', MIKADO_ROOT_DIR . '/framework/modules/header' );
define( 'MIKADO_FRAMEWORK_HEADER_TYPES_ROOT', MIKADO_ROOT . '/framework/modules/header/types' );
define( 'MIKADO_FRAMEWORK_HEADER_TYPES_ROOT_DIR', MIKADO_ROOT_DIR . '/framework/modules/header/types' );
define( 'MIKADO_FRAMEWORK_SEARCH_ROOT', MIKADO_ROOT . '/framework/modules/search' );
define( 'MIKADO_FRAMEWORK_SEARCH_ROOT_DIR', MIKADO_ROOT_DIR . '/framework/modules/search' );
define( 'MIKADO_THEME_ENV', 'false' );
define( 'MIKADO_PROFILE_SLUG', 'mikado' );
define( 'MIKADO_OPTIONS_SLUG', 'innovio_mikado_theme_menu');

//include necessary files
include_once MIKADO_ROOT_DIR . '/framework/mkdf-framework.php';
include_once MIKADO_ROOT_DIR . '/includes/nav-menu/mkdf-menu.php';
require_once MIKADO_ROOT_DIR . '/includes/plugins/class-tgm-plugin-activation.php';
include_once MIKADO_ROOT_DIR . '/includes/plugins/plugins-activation.php';
include_once MIKADO_ROOT_DIR . '/assets/custom-styles/general-custom-styles.php';
include_once MIKADO_ROOT_DIR . '/assets/custom-styles/general-custom-styles-responsive.php';

if ( file_exists( MIKADO_ROOT_DIR . '/export' ) ) {
	include_once MIKADO_ROOT_DIR . '/export/export.php';
}

if ( ! is_admin() ) {
	include_once MIKADO_ROOT_DIR . '/includes/mkdf-body-class-functions.php';
	include_once MIKADO_ROOT_DIR . '/includes/mkdf-loading-spinners.php';
}