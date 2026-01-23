<?php
/*
Plugin Name: Innovio Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Mikado Themes
Version: 1.0.3
*/

define( 'INNOVIO_TWITTER_FEED_VERSION', '1.0.3' );
define( 'INNOVIO_TWITTER_ABS_PATH', dirname( __FILE__ ) );
define( 'INNOVIO_TWITTER_REL_PATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'INNOVIO_TWITTER_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'INNOVIO_TWITTER_ASSETS_PATH', INNOVIO_TWITTER_ABS_PATH . '/assets' );
define( 'INNOVIO_TWITTER_ASSETS_URL_PATH', INNOVIO_TWITTER_URL_PATH . 'assets' );
define( 'INNOVIO_TWITTER_SHORTCODES_PATH', INNOVIO_TWITTER_ABS_PATH . '/shortcodes' );
define( 'INNOVIO_TWITTER_SHORTCODES_URL_PATH', INNOVIO_TWITTER_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'innovio_twitter_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function innovio_twitter_theme_installed() {
		return defined( 'MIKADO_ROOT' );
	}
}

if ( ! function_exists( 'innovio_twitter_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function innovio_twitter_feed_text_domain() {
		load_plugin_textdomain( 'innovio-twitter-feed', false, INNOVIO_TWITTER_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'innovio_twitter_feed_text_domain' );
}