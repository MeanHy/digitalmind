<?php get_header(); ?>
				<div class="mkdf-page-not-found">
					<?php
					$mkdf_title_image_404 = innovio_mikado_options()->getOptionValue( '404_page_title_image' );
					$mkdf_title_404       = innovio_mikado_options()->getOptionValue( '404_title' );
					$mkdf_subtitle_404    = innovio_mikado_options()->getOptionValue( '404_subtitle' );
					$mkdf_text_404        = innovio_mikado_options()->getOptionValue( '404_text' );
					$mkdf_button_label    = innovio_mikado_options()->getOptionValue( '404_back_to_home' );
					$mkdf_button_style    = innovio_mikado_options()->getOptionValue( '404_button_style' );
					
					if ( ! empty( $mkdf_title_image_404 ) ) { ?>
						<div class="mkdf-404-title-image">
							<img src="<?php echo esc_url( $mkdf_title_image_404 ); ?>" alt="<?php esc_attr_e( '404 Title Image', 'innovio' ); ?>" />
						</div>
					<?php } ?>
					
					<h3 class="mkdf-404-title">
						<?php if ( ! empty( $mkdf_title_404 ) ) {
							echo esc_html( $mkdf_title_404 );
						} else {
							esc_html_e( 'Error Page 404', 'innovio' );
						} ?>
					</h3>

                    <?php if ( ! empty( $mkdf_subtitle_404 ) ) { ?>
					<h5 class="mkdf-404-subtitle">
							<?php echo esc_html( $mkdf_subtitle_404 ); ?>
					</h5>
                    <?php } ?>
					
					<p class="mkdf-404-text">
						<?php if ( ! empty( $mkdf_text_404 ) ) {
							echo esc_html( $mkdf_text_404 );
						} else {
							esc_html_e( 'Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'innovio' );
						} ?>
					</p>

					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>