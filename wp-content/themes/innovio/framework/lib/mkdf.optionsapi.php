<?php

if ( ! function_exists( 'innovio_mikado_set_options_map_position' ) ) {
	function innovio_mikado_set_options_map_position( $map ) {
		$position = 10;
		
		switch ( $map ) {
			case 'general':
				$position = 1;
				break;
			case 'logo':
				$position = 2;
				break;
			case 'fonts':
				$position = 3;
				break;
			case 'header':
				$position = 4;
				break;
			case 'mobile-header':
				$position = 5;
				break;
			case 'title':
				$position = 6;
				break;
			case 'page':
				$position = 7;
				break;
			case 'sidebar':
				$position = 8;
				break;
			case 'footer':
				$position = 9;
				break;
			case 'blog':
				$position = 10;
				break;
			case 'portfolio':
				$position = 11;
				break;
			case 'proofing-gallery':
				$position = 11;
				break;
			case 'stock-photography':
				$position = 11;
				break;
			case 'sidearea':
				$position = 12;
				break;
			case 'search':
				$position = 13;
				break;
			case 'skewed-section':
				$position = 13;
				break;
			case 'subscribe-popup':
				$position = 17;
				break;
			case 'social':
				$position = 18;
				break;
			case '404':
				$position = 19;
				break;
			case 'contact_form_7':
				$position = 20;
				break;
			case 'woocommerce':
				$position = 21;
				break;
			case 'reset':
				$position = 100;
				break;
		}
		
		return apply_filters( 'innovio_mikado_filter_options_map_position', $position, $map );
	}
}

if ( ! function_exists( 'innovio_mikado_add_admin_page' ) ) {
	/**
	 * Generates admin page object and adds it to options
	 * $attributes array can container:
	 *      $slug - slug of the page with which it will be registered in admin, and which will be appended to admin URL
	 *      $title - title of the page
	 *      $icon - icon that will be added to admin page in options navigation
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassAdminPage
	 */
	function innovio_mikado_add_admin_page( $attributes ) {
		$slug  = '';
		$title = '';
		$icon  = '';
		
		extract( $attributes );
		
		if ( isset( $slug ) && ! empty( $title ) ) {
			$admin_page = new InnovioMikadoClassAdminPage( $slug, $title, $icon );
			innovio_mikado_framework()->mkdOptions->addAdminPage( $slug, $admin_page );
			
			return $admin_page;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_admin_panel' ) ) {
	/**
	 * Generates panel object from given parameters
	 * $attributes can container:
	 *      $title - title of panel
	 *      $name - name of panel with which it will be registered in admin page
	 *      $page - slug of that page to which to add panel
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassPanel
	 */
	function innovio_mikado_add_admin_panel( $attributes ) {
		$title           = '';
		$name            = '';
		$dependency      = array();
		$args            = array();
		$page            = '';
		
		extract( $attributes );
		
		if ( isset( $page ) && ! empty( $title ) && ! empty( $name ) && innovio_mikado_framework()->mkdOptions->adminPageExists( $page ) ) {
			$admin_page = innovio_mikado_framework()->mkdOptions->getAdminPage( $page );
			
			if ( is_object( $admin_page ) ) {
				$panel = new InnovioMikadoClassPanel( $title, $name, $args, $dependency);
				$admin_page->addChild( $name, $panel );
				
				return $panel;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_admin_container' ) ) {
	/**
	 * Generates container object
	 * $attributes can contain:
	 *      $name - name of the container with which it will be added to parent element
	 *      $parent - parent object to which to add container
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassContainer
	 */
	function innovio_mikado_add_admin_container( $attributes ) {
		$name            = '';
		$parent          = '';
		$dependency      = array();
		
		extract( $attributes );
		
		if ( ! empty( $name ) && is_object( $parent ) ) {
			$container = new InnovioMikadoClassContainer( $name, $dependency );
			$parent->addChild( $name, $container );
			
			return $container;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_admin_twitter_button' ) ) {
	
	/**
	 * Generates twitter button field
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassTwitterFramework
	 */
	function innovio_mikado_add_admin_twitter_button( $attributes ) {
		$name   = '';
		$parent = '';
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new InnovioMikadoClassTwitterFramework();
			
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
			}
			
			return $field;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_admin_instagram_button' ) ) {
	
	/**
	 * Generates instagram button field
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassInstagramFramework
	 */
	function innovio_mikado_add_admin_instagram_button( $attributes ) {
		$name   = '';
		$parent = '';
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new InnovioMikadoClassInstagramFramework();
			
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
			}
			
			return $field;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_admin_container_no_style' ) ) {
	/**
	 * Generates container object
	 * $attributes can contain:
	 *      $name - name of the container with which it will be added to parent element
	 *      $parent - parent object to which to add container
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassContainerNoStyle
	 */
	function innovio_mikado_add_admin_container_no_style( $attributes ) {
		$name            = '';
		$parent          = '';
		$args            = array();
		$dependency      = array();

		extract( $attributes );
		
		if ( ! empty( $name ) && is_object( $parent ) ) {
			$container = new InnovioMikadoClassContainerNoStyle( $name, $args, $dependency );
			$parent->addChild( $name, $container );
			
			return $container;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_admin_group' ) ) {
	/**
	 * Generates group object
	 * $attributes can contain:
	 *      $name - name of the group with which it will be added to parent element
	 *      $title - title of group
	 *      $description - description of group
	 *      $parent - parent object to which to add group
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassGroup
	 */
	function innovio_mikado_add_admin_group( $attributes ) {
		$name        = '';
		$title       = '';
		$description = '';
		$parent      = '';
		
		extract( $attributes );
		
		if ( ! empty( $name ) && ! empty( $title ) && is_object( $parent ) ) {
			$group = new InnovioMikadoClassGroup( $title, $description );
			$parent->addChild( $name, $group );
			
			return $group;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_admin_row' ) ) {
	/**
	 * Generates row object
	 * $attributes can contain:
	 *      $name - name of the group with which it will be added to parent element
	 *      $parent - parent object to which to add row
	 *      $next - whether row has next row. Used to add bottom margin class
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassRow
	 */
	function innovio_mikado_add_admin_row( $attributes ) {
		$parent = '';
		$next   = false;
		$name   = '';
		
		extract( $attributes );
		
		if ( is_object( $parent ) ) {
			$row = new InnovioMikadoClassRow( $next );
			$parent->addChild( $name, $row );
			
			return $row;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_admin_field' ) ) {
	/**
	 * Generates admin field object
	 * $attributes can container:
	 *      $type - type of the field to generate
	 *      $name - name of the field. This will be name of the option in database
	 *      $default_value
	 *      $label - title of the option
	 *      $description
	 *      $options - assoc array of option. Used only for select and radiogroup field types
	 *      $args - assoc array of additional parameters. Used for dependency
	 *      $parent - parent object to which to add field
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassField
	 */
	function innovio_mikado_add_admin_field( $attributes ) {
		$type            = '';
		$name            = '';
		$default_value   = '';
		$label           = '';
		$description     = '';
		$options         = array();
		$args            = array();
		$parent          = '';
		$dependency		 = array();
		
		extract( $attributes );

		if ( ! empty( $parent ) && ! empty( $type ) && ! empty( $name ) ) {
			$field = new InnovioMikadoClassField( $type, $name, $default_value, $label, $description, $options, $args, $dependency );
			
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_admin_section_title' ) ) {
	/**
	 * Generates admin title field
	 * $attributes can contain:
	 *      $parent - parent object to which to add title
	 *      $name - name of title with which to add it to the parent
	 *      $title - title text
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassTitle
	 */
	function innovio_mikado_add_admin_section_title( $attributes ) {
		$parent = '';
		$name   = '';
		$title  = '';
		
		extract( $attributes );
		
		if ( is_object( $parent ) && ! empty( $title ) && ! empty( $name ) ) {
			$section_title = new InnovioMikadoClassTitle( $name, $title );
			$parent->addChild( $name, $section_title );
			
			return $section_title;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_admin_notice' ) ) {
	/**
	 * Generates InnovioMikadoClassNotice object from given parameters
	 * $attributes array can contain:
	 *      $title - title of notice object
	 *      $description - description of notice object
	 *      $notice - text of notice to display
	 *      $name - unique name of notice with which it will be added to it's parent
	 *      $parent - object to which to add notice object using addChild method
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassNotice
	 */
	function innovio_mikado_add_admin_notice( $attributes ) {
		$title           = '';
		$description     = '';
		$notice          = '';
		$parent          = '';
		$name            = '';
		
		extract( $attributes );
		
		if ( is_object( $parent ) && ! empty( $title ) && ! empty( $notice ) && ! empty( $name ) ) {
			$notice_object = new InnovioMikadoClassNotice( $title, $description, $notice);
			$parent->addChild( $name, $notice_object );
			
			return $notice_object;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_framework' ) ) {
	/**
	 * Function that returns instance of InnovioMikadoClassFramework class
	 *
	 * @return InnovioMikadoClassFramework
	 */
	function innovio_mikado_framework() {
		return InnovioMikadoClassFramework::get_instance();
	}
}

if ( ! function_exists( 'innovio_mikado_options' ) ) {
	/**
	 * Returns instance of InnovioMikadoClassOptions class
	 *
	 * @return InnovioMikadoClassOptions
	 */
	function innovio_mikado_options() {
		return innovio_mikado_framework()->mkdOptions;
	}
}

if ( ! function_exists( 'innovio_mikado_meta_boxes' ) ) {
	/**
	 * Returns instance of InnovioMikadoClassMetaBoxes class
	 *
	 * @return InnovioMikadoClassMetaBoxes
	 */
	function innovio_mikado_meta_boxes() {
		return innovio_mikado_framework()->mkdMetaBoxes;
	}
}

/**
 * Meta boxes functions
 */
if ( ! function_exists( 'innovio_mikado_create_meta_box' ) ) {
	/**
	 * Adds new meta box
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassMetaBox
	 */
	function innovio_mikado_create_meta_box( $attributes ) {
		$scope           = array();
		$title           = '';
		$name            = '';
		
		extract( $attributes );
		
		if ( ! empty( $scope ) && $title !== '' && $name !== '' ) {
			$meta_box_obj = new InnovioMikadoClassMetaBox( $scope, $title, $name );
			innovio_mikado_framework()->mkdMetaBoxes->addMetaBox( $name, $meta_box_obj );
			
			return $meta_box_obj;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_create_meta_box_field' ) ) {
	/**
	 * Generates meta box field object
	 * $attributes can contain:
	 *      $type - type of the field to generate
	 *      $name - name of the field. This will be name of the option in database
	 *      $default_value
	 *      $label - title of the option
	 *      $description
	 *      $options - assoc array of option. Used only for select and radiogroup field types
	 *      $args - assoc array of additional parameters. Used for dependency
	 *      $parent - parent object to which to add field
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassField
	 */
	function innovio_mikado_create_meta_box_field( $attributes ) {
		$type            = '';
		$name            = '';
		$default_value   = '';
		$label           = '';
		$description     = '';
		$options         = array();
		$args            = array();
		$dependency		 = array();
		$parent          = '';
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $type ) && ! empty( $name ) ) {
			$field = new InnovioMikadoClassMetaField( $type, $name, $default_value, $label, $description, $options, $args, $dependency );
			
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_multiple_images_field' ) ) {
	/**
	 * Generates meta box field object
	 * $attributes can contain:
	 *      $name - name of the field. This will be name of the option in database
	 *      $label - title of the option
	 *      $description
	 *      $parent - parent object to which to add field
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassField
	 */
	function innovio_mikado_add_multiple_images_field( $attributes ) {
		$name        = '';
		$label       = '';
		$description = '';
		$parent      = '';
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new InnovioMikadoClassMultipleImages( $name, $label, $description );
			
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_get_yes_no_select_array' ) ) {
	/**
	 * Returns array of yes no
	 * @return array
	 */
	function innovio_mikado_get_yes_no_select_array( $enable_default = true, $set_yes_to_be_first = false ) {
		$select_options = array();
		
		if ( $enable_default ) {
			$select_options[''] = esc_html__( 'Default', 'innovio' );
		}
		
		if ( $set_yes_to_be_first ) {
			$select_options['yes'] = esc_html__( 'Yes', 'innovio' );
			$select_options['no']  = esc_html__( 'No', 'innovio' );
		} else {
			$select_options['no']  = esc_html__( 'No', 'innovio' );
			$select_options['yes'] = esc_html__( 'Yes', 'innovio' );
		}
		
		return $select_options;
	}
}

if ( ! function_exists( 'innovio_mikado_get_query_order_by_array' ) ) {
	/**
	 * Returns array of query order by
	 *
	 * @param bool $first_empty whether to add empty first member
	 * @param array $additional_elements
	 *
	 * @return array
	 */
	function innovio_mikado_get_query_order_by_array( $first_empty = false, $additional_elements = array() ) {
		$orderBy = array();
		
		if ( $first_empty ) {
			$orderBy[''] = esc_html__( 'Default', 'innovio' );
		}
		
		$orderBy['date']       = esc_html__( 'Date', 'innovio' );
		$orderBy['ID']         = esc_html__( 'ID', 'innovio' );
		$orderBy['menu_order'] = esc_html__( 'Menu Order', 'innovio' );
		$orderBy['name']       = esc_html__( 'Post Name', 'innovio' );
		$orderBy['rand']       = esc_html__( 'Random', 'innovio' );
		$orderBy['title']      = esc_html__( 'Title', 'innovio' );
		
		if ( ! empty( $additional_elements ) ) {
			$orderBy = array_merge( $orderBy, $additional_elements );
		}
		
		return $orderBy;
	}
}

if ( ! function_exists( 'innovio_mikado_get_query_order_array' ) ) {
	/**
	 * Returns array of query order
	 *
	 * @param bool $first_empty whether to add empty first member
	 *
	 * @return array
	 */
	function innovio_mikado_get_query_order_array( $first_empty = false ) {
		$order = array();
		
		if ( $first_empty ) {
			$order[''] = esc_html__( 'Default', 'innovio' );
		}
		
		$order['ASC']  = esc_html__( 'ASC', 'innovio' );
		$order['DESC'] = esc_html__( 'DESC', 'innovio' );
		
		return $order;
	}
}

if ( ! function_exists( 'innovio_mikado_get_number_of_columns_array' ) ) {
	/**
	 * Returns array of columns number
	 *
	 * @param bool $first_empty whether to add empty first member
	 * @param array $removed_items
	 *
	 * @return array
	 */
	function innovio_mikado_get_number_of_columns_array( $first_empty = false, $removed_items = array() ) {
		$options = array();
		
		if ( $first_empty ) {
			$options[''] = esc_html__( 'Default', 'innovio' );
		}
		
		$options['one']   = esc_html__( 'One', 'innovio' );
		$options['two']   = esc_html__( 'Two', 'innovio' );
		$options['three'] = esc_html__( 'Three', 'innovio' );
		$options['four']  = esc_html__( 'Four', 'innovio' );
		$options['five']  = esc_html__( 'Five', 'innovio' );
		$options['six']   = esc_html__( 'Six', 'innovio' );
		
		if ( ! empty( $removed_items ) ) {
			foreach ( $removed_items as $removed_item ) {
				unset( $options[ $removed_item ] );
			}
		}
		
		return $options;
	}
}

if ( ! function_exists( 'innovio_mikado_get_space_between_items_array' ) ) {
	/**
	 * Returns array of space between items
	 *
	 * @param bool  $first_empty whether to add empty first member
	 * @param array $disable_by_keys
	 *
	 * @return array
	 */
	function innovio_mikado_get_space_between_items_array( $first_empty = false, $disable_by_keys = array() ) {
		$options = array();
		
		if ( $first_empty ) {
			$options[''] = esc_html__( 'Default', 'innovio' );
		}
		
		$options['huge']   = esc_html__( 'Huge (40)', 'innovio' );
		$options['large']  = esc_html__( 'Large (25)', 'innovio' );
		$options['medium'] = esc_html__( 'Medium (20)', 'innovio' );
		$options['normal'] = esc_html__( 'Normal (15)', 'innovio' );
		$options['small']  = esc_html__( 'Small (10)', 'innovio' );
		$options['tiny']   = esc_html__( 'Tiny (5)', 'innovio' );
		$options['no']     = esc_html__( 'No (0)', 'innovio' );
		
		if ( ! empty( $disable_by_keys ) ) {
			foreach ( $disable_by_keys as $key ) {
				if ( array_key_exists( $key, $options ) ) {
					unset( $options[ $key ] );
				}
			}
		}
		
		return $options;
	}
}

if ( ! function_exists( 'innovio_mikado_get_link_target_array' ) ) {
	/**
	 * Returns array of link target
	 *
	 * @param bool $first_empty whether to add empty first member
	 *
	 * @return array
	 */
	function innovio_mikado_get_link_target_array( $first_empty = false ) {
		$order = array();
		
		if ( $first_empty ) {
			$order[''] = esc_html__( 'Default', 'innovio' );
		}
		
		$order['_self']  = esc_html__( 'Same Window', 'innovio' );
		$order['_blank'] = esc_html__( 'New Window', 'innovio' );
		
		return $order;
	}
}

if ( ! function_exists( 'innovio_mikado_get_title_tag' ) ) {
	/**
	 * Returns array of title tags
	 *
	 * @param bool $first_empty
	 * @param array $additional_elements
	 *
	 * @return array
	 */
	function innovio_mikado_get_title_tag( $first_empty = false, $additional_elements = array() ) {
		$title_tag = array();
		
		if ( $first_empty ) {
			$title_tag[''] = esc_html__( 'Default', 'innovio' );
		}
		
		$title_tag['h1'] = 'h1';
		$title_tag['h2'] = 'h2';
		$title_tag['h3'] = 'h3';
		$title_tag['h4'] = 'h4';
		$title_tag['h5'] = 'h5';
		$title_tag['h6'] = 'h6';
		
		if ( ! empty( $additional_elements ) ) {
			$title_tag = array_merge( $title_tag, $additional_elements );
		}
		
		return $title_tag;
	}
}

if ( ! function_exists( 'innovio_mikado_get_font_weight_array' ) ) {
	/**
	 * Returns array of font weights
	 *
	 * @param bool $first_empty whether to add empty first member
	 *
	 * @return array
	 */
	function innovio_mikado_get_font_weight_array( $first_empty = false ) {
		$font_weights = array();
		
		if ( $first_empty ) {
			$font_weights[''] = esc_html__( 'Default', 'innovio' );
		}
		
		$font_weights['100'] = esc_html__( '100 Thin', 'innovio' );
		$font_weights['200'] = esc_html__( '200 Thin-Light', 'innovio' );
		$font_weights['300'] = esc_html__( '300 Light', 'innovio' );
		$font_weights['400'] = esc_html__( '400 Normal', 'innovio' );
		$font_weights['500'] = esc_html__( '500 Medium', 'innovio' );
		$font_weights['600'] = esc_html__( '600 Semi-Bold', 'innovio' );
		$font_weights['700'] = esc_html__( '700 Bold', 'innovio' );
		$font_weights['800'] = esc_html__( '800 Extra-Bold', 'innovio' );
		$font_weights['900'] = esc_html__( '900 Ultra-Bold', 'innovio' );
		
		return $font_weights;
	}
}

if ( ! function_exists( 'innovio_mikado_get_font_style_array' ) ) {
	/**
	 * Returns array of font styles
	 *
	 * @param bool $first_empty
	 *
	 * @return array
	 */
	function innovio_mikado_get_font_style_array( $first_empty = false ) {
		$font_styles = array();
		
		if ( $first_empty ) {
			$font_styles[''] = esc_html__( 'Default', 'innovio' );
		}
		
		$font_styles['normal']  = esc_html__( 'Normal', 'innovio' );
		$font_styles['italic']  = esc_html__( 'Italic', 'innovio' );
		$font_styles['oblique'] = esc_html__( 'Oblique', 'innovio' );
		$font_styles['initial'] = esc_html__( 'Initial', 'innovio' );
		$font_styles['inherit'] = esc_html__( 'Inherit', 'innovio' );
		
		return $font_styles;
	}
}

if ( ! function_exists( 'innovio_mikado_get_text_transform_array' ) ) {
	/**
	 * Returns array of text transforms
	 *
	 * @param bool $first_empty
	 *
	 * @return array
	 */
	function innovio_mikado_get_text_transform_array( $first_empty = false ) {
		$text_transforms = array();
		
		if ( $first_empty ) {
			$text_transforms[''] = esc_html__( 'Default', 'innovio' );
		}
		
		$text_transforms['none']       = esc_html__( 'None', 'innovio' );
		$text_transforms['capitalize'] = esc_html__( 'Capitalize', 'innovio' );
		$text_transforms['uppercase']  = esc_html__( 'Uppercase', 'innovio' );
		$text_transforms['lowercase']  = esc_html__( 'Lowercase', 'innovio' );
		$text_transforms['initial']    = esc_html__( 'Initial', 'innovio' );
		$text_transforms['inherit']    = esc_html__( 'Inherit', 'innovio' );
		
		return $text_transforms;
	}
}

if ( ! function_exists( 'innovio_mikado_get_text_decorations' ) ) {
	/**
	 * Returns array of text transforms
	 *
	 * @param bool $first_empty
	 *
	 * @return array
	 */
	function innovio_mikado_get_text_decorations( $first_empty = false ) {
		$text_decorations = array();
		
		if ( $first_empty ) {
			$text_decorations[''] = esc_html__( 'Default', 'innovio' );
		}
		
		$text_decorations['none']         = esc_html__( 'None', 'innovio' );
		$text_decorations['underline']    = esc_html__( 'Underline', 'innovio' );
		$text_decorations['overline']     = esc_html__( 'Overline', 'innovio' );
		$text_decorations['line-through'] = esc_html__( 'Line-Through', 'innovio' );
		$text_decorations['initial']      = esc_html__( 'Initial', 'innovio' );
		$text_decorations['inherit']      = esc_html__( 'Inherit', 'innovio' );
		
		return $text_decorations;
	}
}

if ( ! function_exists( 'innovio_mikado_is_font_option_valid' ) ) {
	/**
	 * Checks if font family option is valid (different that -1)
	 *
	 * @param $option_name
	 *
	 * @return bool
	 */
	function innovio_mikado_is_font_option_valid( $option_name ) {
		return $option_name !== '-1' && $option_name !== '';
	}
}

if ( ! function_exists( 'innovio_mikado_get_font_option_val' ) ) {
	/**
	 * Returns font option value without + so it can be used in css
	 *
	 * @param $option_val
	 *
	 * @return mixed
	 */
	function innovio_mikado_get_font_option_val( $option_val ) {
		$option_val = str_replace( '+', ' ', $option_val );
		
		return $option_val;
	}
}

if ( ! function_exists( 'innovio_mikado_get_icon_sources_array' ) ) {
	/**
	 * Returns array of icon sources
	 *
	 * @param bool $first_empty
	 * @param bool $enable_predefined
	 *
	 * @return array
	 */
	function innovio_mikado_get_icon_sources_array( $first_empty = false, $enable_predefined = true ) {
		$icon_sources = array();
		
		if ( $first_empty ) {
			$icon_sources[''] = esc_html__( 'Default', 'innovio' );
		}
		
		$icon_sources['icon_pack']	= esc_html__( 'Icon Pack', 'innovio' );
		$icon_sources['svg_path']	= esc_html__( 'SVG Path', 'innovio' );
		
		if ( $enable_predefined ) {
			$icon_sources['predefined']	= esc_html__( 'Predefined', 'innovio' );
		}
		
		return $icon_sources;
	}
}

if ( ! function_exists( 'innovio_mikado_get_icon_sources_class' ) ) {
	/**
	 * Returns class for icon sources
	 *
	 * @param string $option_name
	 * @param string $class_prefix
	 *
	 * @return string
	 */
	function innovio_mikado_get_icon_sources_class( $option_name = '', $class_prefix = '' ) {
		$class = '';
		
		if ( ! empty( $option_name ) && ! empty( $class_prefix ) ) {
			$icon_source 	= innovio_mikado_options()->getOptionValue( $option_name . '_icon_source' );
			
			if ( $icon_source === 'icon_pack' ) {
				$class = $class_prefix . '-icon-pack';
			} else if ( $icon_source === 'svg_path' ) {
				$class = $class_prefix . '-svg-path';
			} else if ( $icon_source === 'predefined' ) {
				$class = $class_prefix . '-predefined';
			}
		}
		
		return $class;
	}
}

if ( ! function_exists( 'innovio_mikado_get_icon_sources_html' ) ) {
	/**
	 * Returns html for icon sources
	 *
	 * @param string $option_name
	 * @param bool $is_close_icon
	 * @param array $args
	 *
	 * @return string/html
	 */
	function innovio_mikado_get_icon_sources_html( $option_name = '', $is_close_icon = false, $args = array() ) {
		$html = '';
		
		if ( ! empty( $option_name ) ) {
			$icon_source         = innovio_mikado_options()->getOptionValue( $option_name . '_icon_source' );
			$icon_pack           = innovio_mikado_options()->getOptionValue( $option_name . '_icon_pack' );
			$icon_svg_path       = innovio_mikado_options()->getOptionValue( $option_name . '_icon_svg_path' );
			$close_icon_svg_path = innovio_mikado_options()->getOptionValue( $option_name . '_close_icon_svg_path' );
			$is_search_icon      = isset( $args['search'] ) && $args['search'] === 'yes';
			$is_dropdown_cart    = isset( $args['dropdown_cart'] ) && $args['dropdown_cart'] === 'yes';
			
			if ( $icon_source === 'icon_pack' && isset( $icon_pack ) ) {
				
				if ( $is_search_icon ) {
					
					if ( $is_close_icon ) {
						$html .= innovio_mikado_icon_collections()->getSearchClose( $icon_pack, true );
					} else {
						$html .= innovio_mikado_icon_collections()->getSearchIcon( $icon_pack, true );
					}
					
				} else if ( $is_dropdown_cart ) {
					$html .= innovio_mikado_icon_collections()->getDropdownCartIcon( $icon_pack, true );
				} else if ( $is_close_icon ) {
					$html .= innovio_mikado_icon_collections()->getMenuCloseIcon( $icon_pack, true );
				} else {
					$html .= innovio_mikado_icon_collections()->getMenuIcon( $icon_pack, true );
				}
				
			} else if ( ( isset( $icon_svg_path ) && ! empty( $icon_svg_path ) ) || ( isset( $close_icon_svg_path ) && ! empty( $close_icon_svg_path ) ) ) {
				
				if ( $is_close_icon ) {
					$html .= $close_icon_svg_path;
				} else {
					$html .= $icon_svg_path;
				}
				
			} else if ( $icon_source === 'predefined' ) {
				
				if ( $is_close_icon ) {
					$html .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve" width="58">
					<g>
						<path class="st0" d="M29,0C13,0,0,13,0,29s13,29,29,29s29-13,29-29S45,0,29,0L29,0z"/>
					</g>
					<path class="st1" d="M29.7,29l9.2-9.2c0.2-0.2,0.2-0.5,0-0.7c-0.2-0.2-0.5-0.2-0.7,0L29,28.3l-9.2-9.2c-0.2-0.2-0.5-0.2-0.7,0
						c-0.2,0.2-0.2,0.5,0,0.7l9.2,9.2l-9.2,9.2c-0.2,0.2-0.2,0.5,0,0.7c0.2,0.2,0.5,0.2,0.7,0l9.2-9.2l9.2,9.2c0.2,0.2,0.5,0.2,0.7,0
						c0.2-0.2,0.2-0.5,0-0.7L29.7,29z"/>
					</svg>';
				} else {
					$html .= '<span class="mkdf-hm-lines">';
					$html .= '<span class="mkdf-hm-line mkdf-line-1"></span>';
					$html .= '<span class="mkdf-hm-line mkdf-line-2"></span>';
					$html .= '<span class="mkdf-hm-line mkdf-line-3"></span>';
					$html .= '</span>';
				}
			}
		}
		
		return $html;
	}
}

if ( ! function_exists( 'innovio_mikado_is_customizer_item_enabled' ) ) {
	/**
	 * Function check is item enabled throw customizer options
	 *
	 * @param $item string - module path
	 * @param $option_name string - customizer option name
	 * @param $is_item_id_class bool
	 *
	 * @return bool
	 */
	function innovio_mikado_is_customizer_item_enabled( $item, $option_name, $is_item_id_class = false ) {
		$item_slug       = $is_item_id_class ? $item : basename( dirname( $item ) );
		$item_id_class   = str_replace( '-', '_', $item_slug );
		$item_option     = get_option( $option_name . $item_id_class );
		$is_item_enabled = empty( $item_option );
		
		return $is_item_enabled;
	}
}

if ( ! function_exists( 'innovio_mikado_add_repeater_field' ) ) {
	/**
	 * Generates meta box field object
	 * $attributes can contain:
	 *      $name - name of the field. This will be name of the option in database
	 *      $label - title of the option
	 *      $description
	 *      $field_type - type of the field that will be rendered and repeated
	 *      $parent - parent object to which to add field
	 *
	 * @param $attributes
	 *
	 * @return bool|RepeaterField
	 */
	function innovio_mikado_add_repeater_field( $attributes ) {
		$name        = '';
		$label       = '';
		$description = '';
		$fields      = array();
		$parent      = '';
		$button_text = '';
		$table_layout = false;
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new InnovioMikadoClassRepeater( $fields, $name, $label, $description, $button_text, $table_layout );
			
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}

/**
 * Taxonomy fields function
 */
if ( ! function_exists( 'innovio_mikado_add_taxonomy_fields' ) ) {
	/**
	 * Adds new meta box
	 *
	 * @param $attributes
	 *
	 * @return bool|MikadoMetaBox
	 */
	function innovio_mikado_add_taxonomy_fields( $attributes ) {
		$scope = array();
		$name  = '';
		
		extract( $attributes );
		
		if ( ! empty( $scope ) ) {
			$tax_obj = new InnovioMikadoClassTaxonomyOption( $scope );
			innovio_mikado_framework()->mkdTaxonomyOptions->addTaxonomyOptions( $name, $tax_obj );
			
			return $tax_obj;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_taxonomy_field' ) ) {
	/**
	 * Generates meta box field object
	 * $attributes can contain:
	 *      $type - type of the field to generate
	 *      $name - name of the field. This will be name of the option in database
	 *      $label - title of the option
	 *      $description
	 *      $options - assoc array of option. Used only for select and radiogroup field types
	 *      $args - assoc array of additional parameters. Used for dependency
	 *      $parent - parent object to which to add field
	 *
	 * @param $attributes
	 *
	 * @return bool|RepeaterField
	 */
	function innovio_mikado_add_taxonomy_field( $attributes ) {
		$type        = '';
		$name        = '';
		$label       = '';
		$description = '';
		$options     = array();
		$args        = array();
		$parent      = '';
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new InnovioMikadoClassTaxonomyField( $type, $name, $label, $description, $options, $args);
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}

/**
 * User fields function
 */
if ( ! function_exists( 'innovio_mikado_add_user_fields' ) ) {
	/**
	 * Adds new meta box
	 *
	 * @param $attributes
	 *
	 * @return bool|MikadoMetaBox
	 */
	function innovio_mikado_add_user_fields( $attributes ) {
		$scope = array();
		$name  = '';
		
		extract( $attributes );
		
		if ( ! empty( $scope ) ) {
			$user_obj = new InnovioMikadoClassUserOption( $scope );
			innovio_mikado_framework()->mkdUserOptions->addUserOptions( $name, $user_obj );
			
			return $user_obj;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_user_field' ) ) {
	/**
	 * Generates meta box field object
	 * $attributes can contain:
	 *      $type - type of the field to generate
	 *      $name - name of the field. This will be name of the option in database
	 *      $label - title of the option
	 *      $description
	 *      $options - assoc array of option. Used only for select and radiogroup field types
	 *      $args - assoc array of additional parameters. Used for dependency
	 *      $parent - parent object to which to add field
	 *
	 * @param $attributes
	 *
	 * @return bool|RepeaterField
	 */
	function innovio_mikado_add_user_field( $attributes ) {
		$type        = '';
		$name        = '';
		$label       = '';
		$description = '';
		$options     = array();
		$args        = array();
		$parent      = '';
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new InnovioMikadoClassUserField( $type, $name, $label, $description, $options, $args );
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_user_group' ) ) {
	/**
	 * Generates group object
	 * $attributes can contain:
	 *      $name - name of the group with which it will be added to parent element
	 *      $title - title of group
	 *      $description - description of group
	 *      $parent - parent object to which to add group
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassUserGroup
	 */
	function innovio_mikado_add_user_group( $attributes ) {
		$name        = '';
		$title       = '';
		$description = '';
		$parent      = '';
		
		extract( $attributes );
		
		if ( ! empty( $name ) && ! empty( $title ) && is_object( $parent ) ) {
			$group = new InnovioMikadoClassUserGroup( $title, $description );
			$parent->addChild( $name, $group );
			
			return $group;
		}
		
		return false;
	}
}

/**
 * Dashboard fields function
 */
if ( ! function_exists( 'innovio_mikado_add_dashboard_fields' ) ) {
	/**
	 * Adds new meta box
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassDashboardOption
	 */
	function innovio_mikado_add_dashboard_fields( $attributes ) {
		$name = '';
		
		extract( $attributes );
		
		if ( $name !== '') {
			$dash_obj = new InnovioMikadoClassDashboardOption();
			innovio_mikado_framework()->mkdDashboardOptions->addDashboardOptions( $name, $dash_obj );
			
			return $dash_obj;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_dashboard_form' ) ) {
	/**
	 * Generates form object
	 * $attributes can contain:
	 *      $name - name of the form with which it will be added to parent element
	 *      $parent - parent object to which to add form
	 *      $form_id - id of form generated
	 *      $form_method - method for form generated
	 *      $form_nonce - nonce for form generated
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassContainer
	 */
	function innovio_mikado_add_dashboard_form( $attributes ) {
		$name				= '';
		$form_id			= '';
		$form_method		= 'post';
		$form_action		= '';
		$form_nonce_action	= '';
		$form_nonce_name	= '';
		$button_label		= esc_html__('SUMBIT','innovio');
		$button_args		= array();
		$parent				= '';
		
		extract( $attributes );
		
		if ( ! empty( $name ) && is_object( $parent ) && $form_id !== '') {
			$container = new InnovioMikadoClassDashboardForm( $name, $form_id, $form_method, $form_action, $form_nonce_action, $form_nonce_name, $button_label, $button_args);
			$parent->addChild( $name, $container );
			
			return $container;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_dashboard_group' ) ) {
	/**
	 * Generates form object
	 * $attributes can contain:
	 *      $name - name of the form with which it will be added to parent element
	 *      $parent - parent object to which to add form
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassContainer
	 */
	function innovio_mikado_add_dashboard_group( $attributes ) {
		$name		 = '';
		$title 		 = '';
		$description = '';
		$parent		 = '';
		
		extract( $attributes );
		
		if ( ! empty( $name ) && is_object( $parent ) ) {
			$container = new InnovioMikadoClassDashboardGroup( $name, $title, $description );
			$parent->addChild( $name, $container );
			
			return $container;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_dashboard_section_title' ) ) {
	/**
	 * Generates dashboard title field
	 * $attributes can contain:
	 *      $parent - parent object to which to add title
	 *      $name - name of title with which to add it to the parent
	 *      $title - title text
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassDashboardTitle
	 */
	function innovio_mikado_add_dashboard_section_title( $attributes ) {
		$parent = '';
		$name   = '';
		$title  = '';
		$args   = array();
		
		extract( $attributes );
		
		if ( is_object( $parent ) && ! empty( $title ) && ! empty( $name ) ) {
			$section_title = new InnovioMikadoClassDashboardTitle( $name, $title, $args );
			$parent->addChild( $name, $section_title );
			
			return $section_title;
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_dashboard_repeater_field' ) ) {
	/**
	 * Generates meta box field object
	 * $attributes can contain:
	 *      $name - name of the field. This will be name of the option in database
	 *      $label - title of the option
	 *      $description
	 *      $field_type - type of the field that will be rendered and repeated
	 *      $parent - parent object to which to add field
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassDashboardRepeater
	 */
	function innovio_mikado_add_dashboard_repeater_field( $attributes ) {
		$name        = '';
		$label       = '';
		$description = '';
		$fields      = array();
		$parent      = '';
		$button_text = '';
		$table_layout = false;
		$value = array();
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new InnovioMikadoClassDashboardRepeater( $fields, $name, $label, $description, $button_text, $table_layout, $value);
			
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}

if ( ! function_exists( 'innovio_mikado_add_dashboard_field' ) ) {
	/**
	 * Generates dashboard field object
	 * $attributes can contain:
	 *      $type - type of the field to generate
	 *      $name - name of the field. This will be name of the option in database
	 *      $label - title of the option
	 *      $description
	 *      $options - assoc array of option. Used only for select and radiogroup field types
	 *      $args - assoc array of additional parameters. Used for dependency
	 *      $parent - parent object to which to add field
	 *      $hidden_property - name of option that hides field
	 *      $hidden_values - array of valus of $hidden_property that hides field
	 *
	 * @param $attributes
	 *
	 * @return bool|InnovioMikadoClassDashboardField
	 */
	function innovio_mikado_add_dashboard_field( $attributes ) {
		$type        = '';
		$name        = '';
		$label       = '';
		$description = '';
		$options     = array();
		$args        = array();
		$value       = '';
		$parent      = '';
		$repeat      = array();
		
		extract( $attributes );
		
		if ( ! empty( $parent ) && ! empty( $name ) ) {
			$field = new InnovioMikadoClassDashboardField( $type, $name, $label, $description, $options, $args, $value, $repeat);
			if ( is_object( $parent ) ) {
				$parent->addChild( $name, $field );
				
				return $field;
			}
		}
		
		return false;
	}
}