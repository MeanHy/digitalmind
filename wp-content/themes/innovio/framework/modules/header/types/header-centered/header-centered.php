<?php
namespace InnovioMikadoNamespace\Modules\Header\Types;

use InnovioMikadoNamespace\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Centered layout and option
 *
 * Class HeaderCentered
 */
class HeaderCentered extends HeaderType {
	protected $heightOfTransparency;
	protected $heightOfCompleteTransparency;
	protected $headerHeight;
	protected $mobileHeaderHeight;
	
	/**
	 * Sets slug property which is the same as value of option in DB
	 */
	public function __construct() {
		$this->slug = 'header-centered';
		
		if ( ! is_admin() ) {
			$this->logoAreaHeight     = innovio_mikado_set_default_logo_height_for_header_types();
			$this->menuAreaHeight     = innovio_mikado_set_default_menu_height_for_header_types();
			$this->mobileHeaderHeight = innovio_mikado_set_default_mobile_menu_height_for_header_types();
			
			add_action( 'wp', array( $this, 'setHeaderHeightProps' ) );
			
			add_filter( 'innovio_mikado_filter_js_global_variables', array( $this, 'getGlobalJSVariables' ) );
			add_filter( 'innovio_mikado_filter_per_page_js_vars', array( $this, 'getPerPageJSVariables' ) );
		}
	}
	
	/**
	 * Loads template file for this header type
	 *
	 * @param array $parameters associative array of variables that needs to passed to template
	 */
	public function loadTemplate( $parameters = array() ) {
		$id = innovio_mikado_get_page_id();
		
		$parameters['logo_area_in_grid'] = innovio_mikado_get_meta_field_intersect( 'logo_area_in_grid', $id ) == 'yes' ? true : false;
		$parameters['menu_area_in_grid'] = innovio_mikado_get_meta_field_intersect( 'menu_area_in_grid', $id ) == 'yes' ? true : false;
		
		$parameters = apply_filters( 'innovio_mikado_filter_header_centered_parameters', $parameters );
		
		innovio_mikado_get_module_template_part( 'templates/' . $this->slug, $this->moduleName . '/types/' . $this->slug, '', $parameters );
	}
	
	/**
	 * Sets header height properties after WP object is set up
	 */
	public function setHeaderHeightProps() {
		$this->heightOfTransparency         = $this->calculateHeightOfTransparency();
		$this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
		$this->headerHeight                 = $this->calculateHeaderHeight();
		$this->mobileHeaderHeight           = $this->calculateMobileHeaderHeight();
	}
	
	/**
	 * Returns total height of transparent parts of header
	 *
	 * @return int
	 */
	public function calculateHeightOfTransparency() {
		$id                 = innovio_mikado_get_page_id();
		$transparencyHeight = 0;
		
		$logo_background_color             = innovio_mikado_get_meta_field_intersect( 'logo_area_background_color', $id );
		$logo_background_transparency      = innovio_mikado_get_meta_field_intersect( 'logo_area_background_transparency', $id );
		$logo_grid_background_color        = innovio_mikado_options()->getOptionValue( 'logo_area_grid_background_color' );
		$logo_grid_background_transparency = innovio_mikado_options()->getOptionValue( 'logo_area_grid_background_transparency' );
		
		if ( empty( $logo_background_color ) ) {
			$logoAreaTransparent = ! empty( $logo_grid_background_color ) && $logo_grid_background_transparency !== '1' && $logo_grid_background_transparency !== '';
		} else {
			$logoAreaTransparent = ! empty( $logo_background_color ) && $logo_background_transparency !== '1' && $logo_background_transparency !== '';
		}
		
		$menu_background_color             = innovio_mikado_get_meta_field_intersect( 'menu_area_background_color', $id );
		$menu_background_transparency      = innovio_mikado_get_meta_field_intersect( 'menu_area_background_transparency', $id );
		$menu_grid_background_color        = innovio_mikado_options()->getOptionValue( 'menu_area_grid_background_color' );
		$menu_grid_background_transparency = innovio_mikado_options()->getOptionValue( 'menu_area_grid_background_transparency' );
		
		if ( empty( $menu_background_color ) ) {
			$menuAreaTransparent = ! empty( $menu_grid_background_color ) && $menu_grid_background_transparency !== '1' && $menu_grid_background_transparency !== '';
		} else {
			$menuAreaTransparent = ! empty( $menu_background_color ) && $menu_background_transparency !== '1' && $menu_background_transparency !== '';
		}
		
		$sliderExists        = get_post_meta( $id, 'mkdf_page_slider_meta', true ) !== '';
		$contentBehindHeader = get_post_meta( $id, 'mkdf_page_content_behind_header_meta', true ) === 'yes';
		
		if ( $sliderExists || $contentBehindHeader || is_404() ) {
			$menuAreaTransparent = true;
			$logoAreaTransparent = true;
		}
		
		if ( $logoAreaTransparent || $menuAreaTransparent ) {
			if ( $logoAreaTransparent ) {
				$transparencyHeight = $this->logoAreaHeight + $this->menuAreaHeight;
				
				if ( ( $sliderExists && innovio_mikado_is_top_bar_enabled() )
				     || innovio_mikado_is_top_bar_enabled() && innovio_mikado_is_top_bar_transparent()
				) {
					$transparencyHeight += innovio_mikado_get_top_bar_height();
				}
			}
			
			if ( ! $logoAreaTransparent && $menuAreaTransparent ) {
				$transparencyHeight = $this->menuAreaHeight;
			}
		}
		
		return $transparencyHeight;
	}
	
	/**
	 * Returns height of completely transparent header parts
	 *
	 * @return int
	 */
	public function calculateHeightOfCompleteTransparency() {
		$id                 = innovio_mikado_get_page_id();
		$transparencyHeight = 0;
		
		$logo_background_color_meta        = get_post_meta( $id, 'mkdf_logo_area_background_color_meta', true );
		$logo_background_transparency_meta = get_post_meta( $id, 'mkdf_logo_area_background_transparency_meta', true );
		$logo_background_color             = innovio_mikado_options()->getOptionValue( 'logo_area_background_color' );
		$logo_background_transparency      = innovio_mikado_options()->getOptionValue( 'logo_area_background_transparency' );
		$logo_grid_background_color        = innovio_mikado_options()->getOptionValue( 'logo_area_grid_background_color' );
		$logo_grid_background_transparency = innovio_mikado_options()->getOptionValue( 'logo_area_grid_background_transparency' );
		
		if ( ! empty( $logo_background_color_meta ) ) {
			$logoAreaTransparent = ! empty( $logo_background_color_meta ) && $logo_background_transparency_meta === '0';
		} elseif ( empty( $logo_background_color ) ) {
			$logoAreaTransparent = ! empty( $logo_grid_background_color ) && $logo_grid_background_transparency === '0';
		} else {
			$logoAreaTransparent = ! empty( $logo_background_color ) && $logo_background_transparency === '0';
		}
		
		$menu_background_color_meta        = get_post_meta( $id, 'mkdf_menu_area_background_color_meta', true );
		$menu_background_transparency_meta = get_post_meta( $id, 'mkdf_menu_area_background_transparency_meta', true );
		$menu_background_color             = innovio_mikado_options()->getOptionValue( 'menu_area_background_color' );
		$menu_background_transparency      = innovio_mikado_options()->getOptionValue( 'menu_area_background_transparency' );
		$menu_grid_background_color        = innovio_mikado_options()->getOptionValue( 'menu_area_grid_background_color' );
		$menu_grid_background_transparency = innovio_mikado_options()->getOptionValue( 'menu_area_grid_background_transparency' );
		
		if ( ! empty( $menu_background_color_meta ) ) {
			$menuAreaTransparent = ! empty( $menu_background_color_meta ) && $menu_background_transparency_meta === '0';
		} elseif ( empty( $menu_background_color ) ) {
			$menuAreaTransparent = ! empty( $menu_grid_background_color ) && $menu_grid_background_transparency === '0';
		} else {
			$menuAreaTransparent = ! empty( $menu_background_color ) && $menu_background_transparency === '0';
		}
		
		if ( $logoAreaTransparent || $menuAreaTransparent ) {
			if ( $logoAreaTransparent ) {
				$transparencyHeight = $this->logoAreaHeight + $this->menuAreaHeight;
				
				if ( innovio_mikado_is_top_bar_enabled() && innovio_mikado_is_top_bar_completely_transparent() ) {
					$transparencyHeight += innovio_mikado_get_top_bar_height();
				}
			}
			
			if ( ! $logoAreaTransparent && $menuAreaTransparent ) {
				$transparencyHeight = $this->menuAreaHeight;
			}
		}
		
		return $transparencyHeight;
	}
	
	
	/**
	 * Returns total height of header
	 *
	 * @return int|string
	 */
	public function calculateHeaderHeight() {
		$headerHeight = $this->logoAreaHeight + $this->menuAreaHeight;
		if ( innovio_mikado_is_top_bar_enabled() ) {
			$headerHeight += innovio_mikado_get_top_bar_height();
		}
		
		return $headerHeight;
	}
	
	/**
	 * Returns total height of mobile header
	 *
	 * @return int|string
	 */
	public function calculateMobileHeaderHeight() {
		$mobileHeaderHeight = $this->mobileHeaderHeight;
		
		return $mobileHeaderHeight;
	}
	
	/**
	 * Returns global js variables of header
	 *
	 * @param $globalVariables
	 *
	 * @return int|string
	 */
	public function getGlobalJSVariables( $globalVariables ) {
		$globalVariables['mkdfLogoAreaHeight']     = $this->logoAreaHeight;
		$globalVariables['mkdfMenuAreaHeight']     = $this->menuAreaHeight;
		$globalVariables['mkdfMobileHeaderHeight'] = $this->mobileHeaderHeight;
		
		return $globalVariables;
	}
	
	/**
	 * Returns per page js variables of header
	 *
	 * @param $perPageVars
	 *
	 * @return int|string
	 */
	public function getPerPageJSVariables( $perPageVars ) {
		//calculate transparency height only if header has no sticky behaviour
		$header_behavior = innovio_mikado_get_meta_field_intersect( 'header_behaviour' );
		if ( ! in_array( $header_behavior, array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' ) ) ) {
			$perPageVars['mkdfHeaderTransparencyHeight'] = $this->headerHeight - ( innovio_mikado_get_top_bar_height() + $this->heightOfCompleteTransparency );
		} else {
			$perPageVars['mkdfHeaderTransparencyHeight'] = 0;
		}
        $perPageVars['mkdfHeaderVerticalWidth'] = 0;
		
		return $perPageVars;
	}
	
}