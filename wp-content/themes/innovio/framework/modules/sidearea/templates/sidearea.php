<section class="mkdf-side-menu">
	<a <?php innovio_mikado_class_attribute( $close_icon_classes ); ?> href="#">
		<?php echo innovio_mikado_get_icon_sources_html( 'side_area', true ); ?>
	</a>
	<?php if ( is_active_sidebar( 'sidearea' ) ) {
		dynamic_sidebar( 'sidearea' );
	} ?>
	<?php if ( is_active_sidebar( 'sidearea_bottom' ) ) { ?>
	    <div class="mkdf-sidearea-bottom-holder">
		<?php dynamic_sidebar( 'sidearea_bottom' ); ?>
        </div>
	<?php } ?>
</section>