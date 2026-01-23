<?php

namespace WPAdminify\Pro\Classes;

use WPAdminify\Inc\Admin\AdminSettings;
use WPAdminify\Inc\Admin\AdminSettingsModel;

// no direct access allowed
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class WhiteLabel extends AdminSettingsModel {

	public function __construct() {

		// WP Adminify White Label Settings
		add_action( 'all_plugins', [ $this, 'jltwp_adminify_save_white_label_settings_update' ] );

		add_action( 'activated_plugin', [ $this, 'jltwp_adminify_activated_plugin' ], 10 );
		add_action( 'admin_enqueue_scripts', [ $this, 'jltwp_adminify_hide_action_links' ] );
	}


	public function jltwp_adminify_activated_plugin( $plugin ) {
		$activate_wp_adminify_white_label = (array) AdminSettings::get_instance()->get();
		if ( $plugin == WP_ADMINIFY_BASE ) {
			if ( ! empty( $activate_wp_adminify_white_label ) ) {
				$activate_wp_adminify_white_label['jltwp_adminify_wl_plugin_option'] = '';
				update_option( '_wpadminify', $activate_wp_adminify_white_label );
			}
		}
	}

	// Hide Action Links upgrade, change license etc
	public function jltwp_adminify_hide_action_links() {
		global $pagenow;
		if ( $pagenow == 'plugins.php' ) {
			$plugin_action_links = (array) AdminSettings::get_instance()->get();
			?>
			<style type="text/css">
				<?php
				if ( ! empty( $plugin_action_links['jltwp_adminify_remove_action_links'] ) ) {
					foreach ( $plugin_action_links['jltwp_adminify_remove_action_links'] as $value ) {
						?>
						.wp-list-table.plugins #the-list tr[data-slug=adminify] .plugin-title .<?php echo esc_attr( $value ); ?> {
							display: none;
						}
						<?php
					}
				}
				?>
			</style>
			<?php
		}
	}


	/*
	* Update Plugin Settings
	*/
	public function jltwp_adminify_save_white_label_settings_update( $all_plugins ) {
		$this->options = (array) AdminSettings::get_instance()->get();

		if ( ! empty( $all_plugins[ WP_ADMINIFY_BASE ] ) && is_array( $all_plugins[ WP_ADMINIFY_BASE ] ) ) {
			$all_plugins[ WP_ADMINIFY_BASE ]['Name']        = ! empty( $this->options['jltwp_adminify_wl_plugin_name'] ) ? esc_html( $this->options['jltwp_adminify_wl_plugin_name'] ) : esc_html( $all_plugins[ WP_ADMINIFY_BASE ]['Name'] );
			$all_plugins[ WP_ADMINIFY_BASE ]['PluginURI']   = ! empty( $this->options['jltwp_adminify_wl_plugin_url'] ) ? esc_url( $this->options['jltwp_adminify_wl_plugin_url'] ) : esc_url( $all_plugins[ WP_ADMINIFY_BASE ]['PluginURI'] );
			$all_plugins[ WP_ADMINIFY_BASE ]['Description'] = ! empty( $this->options['jltwp_adminify_wl_plugin_desc'] ) ? esc_html( $this->options['jltwp_adminify_wl_plugin_desc'] ) : esc_html( $all_plugins[ WP_ADMINIFY_BASE ]['Description'] );
			$all_plugins[ WP_ADMINIFY_BASE ]['Author']      = ! empty( $this->options['jltwp_adminify_wl_plugin_author_name'] ) ? esc_html( $this->options['jltwp_adminify_wl_plugin_author_name'] ) : esc_html( $all_plugins[ WP_ADMINIFY_BASE ]['Author'] );
			$all_plugins[ WP_ADMINIFY_BASE ]['AuthorURI']   = ! empty( $this->options['jltwp_adminify_wl_plugin_url'] ) ? esc_url( $this->options['jltwp_adminify_wl_plugin_url'] ) : esc_url( $all_plugins[ WP_ADMINIFY_BASE ]['AuthorURI'] );
			$all_plugins[ WP_ADMINIFY_BASE ]['Title']       = ! empty( $this->options['jltwp_adminify_wl_plugin_name'] ) ? esc_html( $this->options['jltwp_adminify_wl_plugin_name'] ) : esc_html( $all_plugins[ WP_ADMINIFY_BASE ]['Title'] );
			$all_plugins[ WP_ADMINIFY_BASE ]['AuthorName']  = ! empty( $this->options['jltwp_adminify_wl_plugin_author_name'] ) ? esc_html( $this->options['jltwp_adminify_wl_plugin_author_name'] ) : esc_attr( $all_plugins[ WP_ADMINIFY_BASE ]['AuthorName'] );

			return $all_plugins;
		}
	}
}
