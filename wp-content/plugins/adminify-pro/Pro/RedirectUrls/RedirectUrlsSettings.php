<?php

namespace WPAdminify\Pro\RedirectUrls;

use WPAdminify\Inc\Utils;
// no direct access allowed
if (!defined('ABSPATH')) {
	exit;
}

/**
 * WPAdminify
 *
 * @package Redirect URLs
 *
 * @author Jewel Theme <support@jeweltheme.com>
 */

class RedirectUrlsSettings extends RedirectUrlsModel
{

	public function __construct()
	{
		// this should be first so the default values get stored
		$this->redirect_urls_settings();
		parent::__construct((array) get_option($this->prefix));
	}


	public function get_defaults()
	{
		return [
			'redirect_urls_options' => [
				'new_login_url'      => '',
				'redirect_admin_url' => '',
				'new_register_url'   => '',
			],

		];
	}

	/**
	 * Settings Fields
	 *
	 * @return void
	 */
	public function login_register_redirect_tab_fields(&$login_register_redirect_tab_fields)
	{
		$settings_fields     = [];
		$reg_settings_fields = [];
		$this->login_register_url_fields($settings_fields);

		$login_register_redirect_tab_fields[] = [
			'type'    => 'subheading',
			'content' => Utils::adminfiy_help_urls(
				__('Redirect URL\'s', 'adminify'),
				'https://wpadminify.com/kb/how-to-change-wordpress-login-url/',
				'https://www.youtube.com/watch?v=0X-oneFB9HQ',
				'https://www.facebook.com/groups/jeweltheme',
				'https://wpadminify.com/support/'
			),
		];

		$login_register_redirect_tab_fields[] = [
			'id'    => 'redirect_urls_options',
			'type'  => 'tabbed',
			'title' => '',
			'tabs'  => [
				[
					'title'  => __('Login/Register URL', 'adminify'),
					'fields' => $settings_fields,
				],
			],
		];
	}

	public function login_register_url_fields(&$settings_fields)
	{
		$settings_fields[] = [
			'id'          => 'new_login_url',
			'type'        => 'text',
			'class'       => 'new-login-url',
			'title'       => __('New Login URL', 'adminify'),
			'desc'        => __('Change the login URL and prevent access to the wp-admin and wp-login.php page directly.', 'adminify'),
			'placeholder' => 'login',
			'before'      => \get_site_url() . '/',
			'after'       => '/',
			'default'     => $this->get_default_field('redirect_urls_options')['new_login_url'],
		];

		$settings_fields[] = [
			'id'          => 'redirect_admin_url',
			'type'        => 'text',
			'class'       => 'new-login-url redirect-admin-url',
			'title'       => __('Redirect Admin', 'adminify'),
			'desc'        => __('Redirect users those are not logged in and trying to access ', 'adminify') . get_admin_url(),
			'placeholder' => '404',
			'default'     => $this->get_default_field('redirect_urls_options')['redirect_admin_url'],
			'before'      => \get_site_url() . '/',
			'after'       => '/',
		];

		$settings_fields[] = [
			'id'          => 'new_register_url',
			'type'        => 'text',
			'class'       => 'new-login-url new-register-url',
			'title'       => __('New Register URL', 'adminify'),
			'subtitle'    => __('Enable <a href="', 'adminify') . admin_url('options-general.php#users_can_register') . __('"><b>Membership: "Anyone can register"</b></a> checkbox from Settings.', 'adminify'),
			'desc'        => __('Change the Register URL, to setup the custom designed registration page.', 'adminify'),
			'placeholder' => 'wp-login.php?action=register',
			'before'      => \get_site_url() . '/',
			'after'       => '/',
			'default'     => $this->get_default_field('redirect_urls_options')['new_register_url'],
		];
	}

	public function redirect_urls_settings()
	{
		if (!class_exists('ADMINIFY')) {
			return;
		}

		// WP Adminify Custom Header & Footer Options
		\ADMINIFY::createOptions(
			$this->prefix,
			[

				// Framework Title
				'framework_title'         => 'WP Adminify Redirect URLs <small>by WP Adminify</small>',
				'framework_class'         => 'adminify-redirect-urls',

				// menu settings
				'menu_title'              => __('Redirect URLs', 'adminify'),
				'menu_slug'               => 'adminify-redirect-urls',
				'menu_type'               => 'submenu',                  // menu, submenu, options, theme, etc.
				'menu_capability'         => 'manage_options',
				'menu_icon'               => '',
				'menu_position'           => 54,
				'menu_hidden'             => false,
				'menu_parent'             => 'wp-adminify-settings',

				// footer
				'footer_text'             => ' ',
				'footer_after'            => ' ',
				'footer_credit'           => ' ',

				// menu extras
				'show_bar_menu'           => false,
				'show_sub_menu'           => false,
				'show_in_network'         => false,
				'show_in_customizer'      => false,

				'show_search'             => false,
				'show_reset_all'          => false,
				'show_reset_section'      => false,
				'show_footer'             => false,
				'show_all_options'        => true,
				'show_form_warning'       => true,
				'sticky_header'           => false,
				'save_defaults'           => true,
				'ajax_save'               => true,

				// admin bar menu settings
				'admin_bar_menu_icon'     => '',
				'admin_bar_menu_priority' => 45,

				// database model
				'database'                => 'options',   // options, transient, theme_mod, network(multisite support)
				'transient_time'          => 0,

				// typography options
				'enqueue_webfont'         => true,
				'async_webfont'           => false,

				// others
				'output_css'              => false,

				// theme and wrapper classname
				'nav'                     => 'normal',
				'theme'                   => 'dark',
				'class'                   => 'wp-adminify-redirect-urls',
			]
		);

		$login_register_redirect_tab_fields = [];
		$this->login_register_redirect_tab_fields($login_register_redirect_tab_fields);

		// Custom CSS/JS Settings
		\ADMINIFY::createSection(
			$this->prefix,
			[
				'title'  => __('Othersss', 'adminify'),
				'icon'   => 'fas fa-bolt',
				'fields' => $login_register_redirect_tab_fields,
			]
		);
	}
}
