<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="mkdf-search-cover" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="mkdf-container">
		<div class="mkdf-container-inner clearfix">
	<?php } ?>
			<div class="mkdf-form-holder-outer">
				<div class="mkdf-form-holder">
					<div class="mkdf-form-holder-inner">
						<?php echo innovio_mikado_get_icon_sources_html( 'search', false, array( 'search' => 'yes' ) ); ?>
						<input type="text" placeholder="<?php esc_attr_e( 'Type your search... ', 'innovio' ); ?>" name="s" class="mkdf_search_field" autocomplete="off" required />
						<a <?php innovio_mikado_class_attribute( $search_close_icon_class ); ?> href="#">
							<?php echo innovio_mikado_get_icon_sources_html( 'search', true, array( 'search' => 'yes' ) ); ?>
						</a>
					</div>
				</div>
			</div>
	<?php if ( $search_in_grid ) { ?>
		</div>
	</div>
	<?php } ?>
</form>