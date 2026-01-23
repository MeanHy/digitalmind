<?php
namespace InnovioCore\CPT\Shortcodes\SectionTitle;

use InnovioCore\Lib;

class SectionTitle implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'mkdf_section_title';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Section Title', 'innovio-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by INNOVIO', 'innovio-core' ),
					'icon'                      => 'icon-wpb-section-title extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'innovio-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'innovio-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'position',
							'heading'     => esc_html__( 'Horizontal Position', 'innovio-core' ),
							'value'       => array(
								esc_html__( 'Default', 'innovio-core' ) => '',
								esc_html__( 'Left', 'innovio-core' )    => 'left',
								esc_html__( 'Center', 'innovio-core' )  => 'center',
								esc_html__( 'Right', 'innovio-core' )   => 'right'
							),
							'save_always' => true,
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'holder_padding',
							'heading'    => esc_html__( 'Holder Side Padding (px or %)', 'innovio-core' )
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'tagline',
                            'heading'     => esc_html__( 'Tagline', 'innovio-core' ),
                            'admin_label' => true
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'tagline_color',
                            'heading'    => esc_html__( 'Tagline Color', 'innovio-core' ),
                            'dependency' => array( 'element' => 'tagline', 'not_empty' => true ),
                            'group'      => esc_html__( 'Tagline Style', 'innovio-core' )
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'innovio-core' ),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'innovio-core' ),
							'value'       => array_flip( innovio_mikado_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'innovio-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'innovio-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Title Style', 'innovio-core' )
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'title_hightlight_words',
                            'heading'     => esc_html__( 'Highlight Words', 'innovio-core' ),
                            'description' => esc_html__( 'Enter the positions of the words you would like to display in a most dominant color of your theme. Separate the positions with commas (e.g. if you would like the first, second, and third word to have a desired color, you would enter "1,2,3")', 'innovio-core' ),
                            'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
                            'group'       => esc_html__( 'Title Style', 'innovio-core' )
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_break_words',
							'heading'     => esc_html__( 'Position of Line Break', 'innovio-core' ),
							'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'innovio-core' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'innovio-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'disable_break_words',
							'heading'     => esc_html__( 'Disable Line Break for Smaller Screens', 'innovio-core' ),
							'value'       => array_flip( innovio_mikado_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'innovio-core' )
						),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'separator',
                            'heading'     => esc_html__( 'Enable Separator under title', 'innovio-core' ),
                            'value'       => array_flip( innovio_mikado_get_yes_no_select_array( false, false ) ),
                            'dependency' => array( 'element' => 'title', 'not_empty' => true ),
                            'save_always' => true
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'separator_color',
                            'heading'    => esc_html__( 'Separator Color', 'innovio-core' ),
                            'dependency' => array( 'element' => 'separator', 'value' => array('yes') ),
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'separator_top_margin',
                            'heading'    => esc_html__( 'Separator Top Margin (px)', 'innovio-core' ),
                            'dependency' => array( 'element' => 'separator', 'value' => array('yes') ),
                            'group'      => esc_html__( 'Text Settings', 'innovio-core' )
                        ),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'innovio-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_tag',
							'heading'     => esc_html__( 'Text Tag', 'innovio-core' ),
							'value'       => array_flip( innovio_mikado_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
							'group'       => esc_html__( 'Text Style', 'innovio-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'innovio-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'innovio-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_font_size',
							'heading'    => esc_html__( 'Text Font Size (px)', 'innovio-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'innovio-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_line_height',
							'heading'    => esc_html__( 'Text Line Height (px)', 'innovio-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'innovio-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_font_weight',
							'heading'     => esc_html__( 'Text Font Weight', 'innovio-core' ),
							'value'       => array_flip( innovio_mikado_get_font_weight_array( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
							'group'       => esc_html__( 'Text Style', 'innovio-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_margin',
							'heading'    => esc_html__( 'Text Top Margin (px)', 'innovio-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'innovio-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'        => '',
			'position'            => '',
			'holder_padding'      => '',
            'tagline'             => '',
            'tagline_color'       => '',
			'title'               => '',
			'title_tag'           => 'h2',
			'title_color'         => '',
            'title_hightlight_words' => '',
			'title_break_words'   => '',
			'disable_break_words' => '',
            'separator'           => 'no',
            'separator_color'     => '',
			'separator_top_margin'=> '',
			'text'                => '',
			'text_tag'            => 'p',
			'text_color'          => '',
			'text_font_size'      => '',
			'text_line_height'    => '',
			'text_font_weight'    => '',
			'text_margin'         => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['holder_styles']  = $this->getHolderStyles( $params );
        $params['tagline_styles']   = $this->getTaglineStyles( $params );
		$params['title']          = $this->getModifiedTitle( $params );
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']   = $this->getTitleStyles( $params );
        $params['separator_styles'] = $this->getSeparatorStyles( $params );
		$params['text_tag']       = ! empty( $params['text_tag'] ) ? $params['text_tag'] : $args['text_tag'];
		$params['text_styles']    = $this->getTextStyles( $params );
		
		$html = innovio_core_get_shortcode_module_template_part( 'templates/section-title', 'section-title', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = 'mkdf-st-standard';
		$holderClasses[] = $params['disable_break_words'] === 'yes' ? 'mkdf-st-disable-title-break' : '';
		$holderClasses[] = $params['position'] === 'left' ? 'mkdf-st-left-aligned' : '';
		$holderClasses[] = $params['position'] === 'right' ? 'mkdf-st-right-aligned' : '';

		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['holder_padding'] ) ) {
			$styles[] = 'padding: 0 ' . $params['holder_padding'];
		}
		
		if ( ! empty( $params['position'] ) ) {
			$styles[] = 'text-align: ' . $params['position'];
		}
		
		return implode( ';', $styles );
	}

    private function getTaglineStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['tagline_color'] ) ) {
            $styles[] = 'color: ' . $params['tagline_color'];
        }

        return implode( ';', $styles );
    }

    private function getModifiedTitle( $params ) {
        $title             = $params['title'];
        $title_hightlight_words  = str_replace( ' ', '', $params['title_hightlight_words'] );
        $title_break_words = str_replace( ' ', '', $params['title_break_words'] );

        if ( ! empty( $title ) ) {
            $hightlight_words  = explode( ',', $title_hightlight_words );
            $split_title = explode( ' ', $title );

            if ( ! empty( $title_hightlight_words ) ) {
                foreach ( $hightlight_words as $value ) {
                    if ( ! empty( $split_title[ $value - 1 ] ) ) {
                        $split_title[ $value - 1 ] = '<span class="mkdf-st-title-hightlight" data-text="' . $split_title[ $value - 1 ] . '"><span>' . $split_title[ $value - 1 ] . '</span></span>';
                    }
                }
            }

            if ( ! empty( $title_break_words ) ) {
                $title_break_words = intval($title_break_words);
                if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
                    $split_title[ $title_break_words - 1 ] = $split_title[ $title_break_words - 1 ] . '<br />';
                }
            }

            $title = implode( ' ', $split_title );
        }

        return $title;
    }
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		return implode( ';', $styles );
	}

    private function getSeparatorStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['separator_color'] ) ) {
            $styles[] = 'background-color: ' . $params['separator_color'];
        }

        if ( $params['separator_top_margin'] !== '' ) {
            $styles[] = 'margin-top: ' . innovio_mikado_filter_px( $params['separator_top_margin'] ) . 'px';
        }

        return implode( ';', $styles );
    }
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( ! empty( $params['text_font_size'] ) ) {
			$styles[] = 'font-size: ' . innovio_mikado_filter_px( $params['text_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['text_line_height'] ) ) {
			$styles[] = 'line-height: ' . innovio_mikado_filter_px( $params['text_line_height'] ) . 'px';
		}
		
		if ( ! empty( $params['text_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['text_font_weight'];
		}
		
		if ( $params['text_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . innovio_mikado_filter_px( $params['text_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}