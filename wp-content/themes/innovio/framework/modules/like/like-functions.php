<?php

if ( ! function_exists( 'innovio_mikado_like' ) ) {
	/**
	 * Returns InnovioMikadoClassLike instance
	 *
	 * @return InnovioMikadoClassLike
	 */
	function innovio_mikado_like() {
		return InnovioMikadoClassLike::get_instance();
	}
}

function innovio_mikado_get_like() {
	
	echo wp_kses( innovio_mikado_like()->add_like(), array(
		'span' => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'    => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'    => array(
			'href'  => true,
			'class' => true,
			'id'    => true,
			'title' => true,
			'style' => true
		)
	) );
}