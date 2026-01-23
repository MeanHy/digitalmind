<?php

namespace WPAdminify\Inc\Admin\Options;

use WPAdminify\Inc\Utils;
use WPAdminify\Inc\Admin\AdminSettingsModel;

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

class General_Layout_Mode extends AdminSettingsModel {

	public function __construct() {
		$this->general_layout_mode_settings();
	}


	public function get_defaults() {
		return [
			'admin_bar_mode'                => 'light',
			'admin_bar_logo_type'           => 'image_logo',
			'admin_bar_light_mode'          => [
				'admin_bar_light_logo_text'      => __( 'WP Adminify', 'adminify' ),
				'admin_bar_light_logo_text_typo' => '',
				'admin_bar_light_logo'           => '',
				'light_logo_size'                => [
					'width'  => '150',
					'height' => '45',
					'unit'   => 'px',
				],
			],

			'admin_bar_dark_mode'           => [
				'admin_bar_dark_logo_text'      => __( 'WP Adminify', 'adminify' ),
				'admin_bar_dark_logo_text_typo' => '',
				'admin_bar_dark_logo'           => '',
				'dark_logo_size'                => [
					'width'  => '150',
					'height' => '45',
					'unit'   => 'px',
				],
			],

			'enable_schedule_dark_mode'     => false,
			'schedule_dark_mode_type'       => 'system',
			'schedule_dark_mode_start_time' => '',
			'schedule_dark_mode_end_time'   => '',
		];
	}


	/**
	 * Logo Options Settings
	 *
	 * @return void
	 */
	public function layout_mode_setting_fields( &$fields ) {
		$fields[] = [
			'type'    => 'subheading',
			'content' => Utils::adminfiy_help_urls(
				__( 'Logo Options Settings', 'adminify' ),
				'https://wpadminify.com/kb/configure-wordpress-dashboard-dark-mode/',
				'https://www.youtube.com/playlist?list=PLqpMw0NsHXV-EKj9Xm1DMGa6FGniHHly8',
				'https://www.facebook.com/groups/jeweltheme',
				'https://wpadminify.com/support/'
			),
		];

		$fields[] = [
			'id'      => 'admin_bar_mode',
			'type'    => 'button_set',
			'title'   => __( 'Color Mode', 'adminify' ),
			'options' => [
				'light' => __( 'Light Mode', 'adminify' ),
				'dark'  => __( 'Dark Mode', 'adminify' ),
			],
			'default' => $this->get_default_field( 'admin_bar_mode' ),
		];

		$fields[] = [
			'id'         => 'admin_bar_logo_type',
			'type'       => 'button_set',
			'title'      => __( 'Logo Type', 'adminify' ),
			'options'    => [
				'image_logo' => __( 'Image', 'adminify' ),
				'text_logo'  => __( 'Text', 'adminify' ),
			],
			'default'    => $this->get_default_field( 'admin_bar_logo_type' ),
			'dependency' => [ 'admin_ui', '==', 'true', 'true' ],
		];

		$fields[] = [
			'id'         => 'admin_bar_light_mode',
			'type'       => 'fieldset',
			'fields'     => [
				[
					'id'         => 'admin_bar_light_logo_text',
					'type'       => 'text',
					'title'      => __( 'Logo Text', 'adminify' ),
					'dependency' => [ 'admin_bar_logo_type', '==', 'text_logo', 'true' ],
					'default'    => $this->get_default_field( 'admin_bar_light_mode' )['admin_bar_light_logo_text'],
				],
				[
					'id'              => 'admin_bar_light_logo_text_typo',
					'type'            => 'typography',
					'title'           => __( 'Logo Text Typography', 'adminify' ),
					'font_family'     => true,
					'font_weight'     => true,
					'font_style'      => true,
					'font_size'       => true,
					'line_height'     => true,
					'letter_spacing'  => true,
					'text_align'      => false,
					'text-transform'  => true,
					'color'           => true,
					'subset'          => false,
					'word_spacing'    => true,
					'text_decoration' => true,
					'dependency'      => [ 'admin_bar_logo_type', '==', 'text_logo', 'true' ],
					'default'         => $this->get_default_field( 'admin_bar_light_mode' )['admin_bar_light_logo_text_typo'],
				],
				[
					'id'           => 'admin_bar_light_logo',
					'type'         => 'media',
					'title'        => __( 'Light Logo', 'adminify' ),
					'library'      => 'image',
					'preview_size' => 'thumbnail',
					'button_title' => __( 'Add Light Logo', 'adminify' ),
					'remove_title' => __( 'Remove Light Logo', 'adminify' ),
					'default'      => $this->get_default_field( 'admin_bar_light_mode' )['admin_bar_light_logo'],
					'dependency'   => [ 'admin_bar_logo_type', '==', 'image_logo', 'true' ],
				],
				[
					'id'         => 'light_logo_size',
					'type'       => 'dimensions',
					'title'      => __( 'Logo Size', 'adminify' ),
					'default'    => $this->get_default_field( 'admin_bar_light_mode' )['light_logo_size'],
					'dependency' => [ 'admin_bar_logo_type', '==', 'image_logo', 'true' ],
				],
			],
			'dependency' => [ 'admin_ui|admin_bar_mode', '==|==', 'true|light', 'true' ],
		];

		$fields[] = [
			'id'         => 'admin_bar_dark_mode',
			'type'       => 'fieldset',
			'fields'     => [
				[
					'id'         => 'admin_bar_dark_logo_text',
					'type'       => 'text',
					'title'      => __( 'Logo Text', 'adminify' ),
					'default'    => $this->get_default_field( 'admin_bar_dark_mode' )['admin_bar_dark_logo_text'],
					'dependency' => [ 'admin_bar_logo_type', '==', 'text_logo', 'true' ],
				],
				[
					'id'                 => 'admin_bar_dark_logo_text_typo',
					'type'               => 'typography',
					'title'              => __( 'Logo Text Typography', 'adminify' ),
					'font_family'        => true,
					'font_weight'        => true,
					'font_style'         => true,
					'font_size'          => true,
					'line_height'        => true,
					'letter_spacing'     => true,
					'text_align'         => false,
					'text-transform'     => true,
					'color'              => true,
					'subset'             => false,
					'backup_font_family' => false,
					'font_variant'       => false,
					'word_spacing'       => true,
					'text_decoration'    => true,
					'dependency'         => [ 'admin_bar_logo_type', '==', 'text_logo', 'true' ],
					'default'            => $this->get_default_field( 'admin_bar_dark_mode' )['admin_bar_dark_logo_text_typo'],
				],
				[
					'id'           => 'admin_bar_dark_logo',
					'type'         => 'media',
					'title'        => __( 'Dark Logo', 'adminify' ),
					'library'      => 'image',
					'preview_size' => 'thumbnail',
					'button_title' => __( 'Add Dark Logo', 'adminify' ),
					'remove_title' => __( 'Remove Dark Logo', 'adminify' ),
					'default'      => $this->get_default_field( 'admin_bar_dark_mode' )['admin_bar_dark_logo'],
					'dependency'   => [ 'admin_bar_logo_type', '==', 'image_logo', 'true' ],
				],
				[
					'id'         => 'dark_logo_size',
					'type'       => 'dimensions',
					'title'      => __( 'Logo Size', 'adminify' ),
					'default'    => $this->get_default_field( 'admin_bar_dark_mode' )['dark_logo_size'],
					'dependency' => [ 'admin_bar_logo_type', '==', 'image_logo', 'true' ],
				],
			],
			'dependency' => [ 'admin_ui|admin_bar_mode', '==|==', 'true|dark', 'true' ],
		];
	}


	public function schedule_dark_mode_fields( &$fields ) {
		$fields[] = [
			'type'    => 'subheading',
			'content' => __( 'Schedule Dark Mode', 'adminify' ),
		];

		if ( jltwp_adminify()->can_use_premium_code__premium_only() ) {
			$fields[] = [
				'id'         => 'enable_schedule_dark_mode',
				'type'       => 'switcher',
				'title'      => __( 'Enable Schedule Dark Mode', 'adminify' ),
				'text_on'    => __( 'Enable', 'adminify' ),
				'text_off'   => __( 'Disable', 'adminify' ),
				'text_width' => '100',
				'default'    => $this->get_default_field( 'enable_schedule_dark_mode' ),
			];

			$fields[] = [
				'id'         => 'schedule_dark_mode_type',
				'title'      => __( 'Schedule Type', 'adminify' ),
				'type'       => 'button_set',
				'options'    => [
					'system' => __( 'System', 'adminify' ),
					'custom' => __( 'Custom', 'adminify' ),
				],
				'default'    => $this->get_default_field( 'schedule_dark_mode_type' ),
				'dependency' => [
					[ 'enable_schedule_dark_mode', '==', 'true', 'true' ],
				],
			];

			// $fields[] = array(
			// 'id'          => 'schedule_dark_mode_start_time',
			// 'type'        => 'select',
			// 'title'       => __('Start Time', 'adminify'),
			// 'after'       => __('Select Start time for Scheduling Dark Mode', 'adminify'),
			// 'placeholder' => __('Select a time', 'adminify'),
			// 'options'     => array(
			// '00:00' => '00:00',
			// '01:00' => '01:00',
			// '02:00' => '02:00',
			// '03:00' => '03:00',
			// '04:00' => '04:00',
			// '05:00' => '05:00',
			// '06:00' => '06:00',
			// '07:00' => '07:00',
			// '08:00' => '08:00',
			// '09:00' => '09:00',
			// '10:00' => '10:00',
			// '11:00' => '11:00',
			// '12:00' => '12:00',
			// '13:00' => '13:00',
			// '14:00' => '14:00',
			// '15:00' => '15:00',
			// '16:00' => '16:00',
			// '17:00' => '17:00',
			// '18:00' => '18:00',
			// '19:00' => '19:00',
			// '20:00' => '20:00',
			// '21:00' => '21:00',
			// '22:00' => '22:00',
			// '23:00' => '23:00',
			// ),
			// 'default'    => $this->get_default_field('schedule_dark_mode_start_time'),
			// 'dependency' => [
			// ['enable_schedule_dark_mode', '==', 'true', 'true'],
			// ['schedule_dark_mode_type', '==', 'custom', 'true']
			// ]
			// );

			$fields[] = [
				'id'         => 'schedule_dark_mode_start_time',
				'type'       => 'datetime',
				'title'      => __( 'Start Time', 'adminify' ),
				'settings'   => [
					'noCalendar' => true,
					'enableTime' => true,
				],
				'default'    => $this->get_default_field( 'schedule_dark_mode_start_time' ),
				'dependency' => [
					[ 'enable_schedule_dark_mode', '==', 'true', 'true' ],
					[ 'schedule_dark_mode_type', '==', 'custom', 'true' ],
				],
			];

			$fields[] = [
				'id'         => 'schedule_dark_mode_end_time',
				'type'       => 'datetime',
				'title'      => __( 'End Time', 'adminify' ),
				'settings'   => [
					'noCalendar' => true,
					'enableTime' => true,
				],
				'default'    => $this->get_default_field( 'schedule_dark_mode_end_time' ),
				'dependency' => [
					[ 'enable_schedule_dark_mode', '==', 'true', 'true' ],
					[ 'schedule_dark_mode_type', '==', 'custom', 'true' ],
				],
			];

			// $fields[] = array(
			// 'id'          => 'schedule_dark_mode_end_time',
			// 'type'        => 'select',
			// 'title'       => __('End Time', 'adminify'),
			// 'after'       => __('Select End time for Scheduling Dark Mode', 'adminify'),
			// 'placeholder' => __('Select a time', 'adminify'),
			// 'options'     => array(
			// '00:00' => '00:00',
			// '01:00' => '01:00',
			// '02:00' => '02:00',
			// '03:00' => '03:00',
			// '04:00' => '04:00',
			// '05:00' => '05:00',
			// '06:00' => '06:00',
			// '07:00' => '07:00',
			// '08:00' => '08:00',
			// '09:00' => '09:00',
			// '10:00' => '10:00',
			// '11:00' => '11:00',
			// '12:00' => '12:00',
			// '13:00' => '13:00',
			// '14:00' => '14:00',
			// '15:00' => '15:00',
			// '16:00' => '16:00',
			// '17:00' => '17:00',
			// '18:00' => '18:00',
			// '19:00' => '19:00',
			// '20:00' => '20:00',
			// '21:00' => '21:00',
			// '22:00' => '22:00',
			// '23:00' => '23:00',
			// ),
			// 'default'    => $this->get_default_field('schedule_dark_mode_end_time'),
			// 'dependency' => [
			// ['enable_schedule_dark_mode', '==', 'true', 'true'],
			// ['schedule_dark_mode_type', '==', 'custom', 'true']
			// ]
			// );
		} else {
			$fields[] = [
				'type'    => 'notice',
				'title'   => __( 'Enable Schedule Dark Mode', 'adminify' ),
				'style'   => 'warning',
				'content' => Utils::adminify_upgrade_pro(),
				// 'dependency' => array(
				// array('admin_bar_mode', '==', 'dark', 'true')
				// )
			];
		}
	}

	public function general_layout_mode_settings() {
		if ( ! class_exists( 'ADMINIFY' ) ) {
			return;
		}

		$fields = [];
		$this->layout_mode_setting_fields( $fields );
		$this->schedule_dark_mode_fields( $fields );

		\ADMINIFY::createSection(
			$this->prefix,
			[
				'title'  => __( 'Logo Options', 'adminify' ),
				'icon'   => 'fas fa-adjust',
				'fields' => $fields,
			]
		);
	}
}
