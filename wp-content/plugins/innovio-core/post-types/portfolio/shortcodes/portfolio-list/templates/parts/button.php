<?php if ( ! innovio_mikado_post_has_read_more() && ! post_password_required() ) { ?>
	<div class="mkdf-pli-button">
		<?php
			$button_params = array(
				'type'         => 'simple',
				'link'         => get_the_permalink(),
				'text'         => esc_html__( 'Read More', 'innovio' ),
				'custom_class' => 'mkdf-pli-item-button',
				'predefined_icon' => 'light_style'
			);
			
			echo innovio_mikado_return_button_html( $button_params );
		?>
	</div>
<?php } ?>