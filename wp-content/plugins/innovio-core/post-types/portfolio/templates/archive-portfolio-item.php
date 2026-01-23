<?php
get_header();
innovio_mikado_get_title();
do_action( 'innovio_mikado_action_before_main_content' ); ?>
<div class="mkdf-container mkdf-default-page-template">
	<?php do_action( 'innovio_mikado_action_after_container_open' ); ?>
	<div class="mkdf-container-inner clearfix">
		<?php
			$innovio_taxonomy_id   = get_queried_object_id();
			$innovio_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$innovio_taxonomy      = ! empty( $innovio_taxonomy_id ) ? get_term_by( 'id', $innovio_taxonomy_id, $innovio_taxonomy_type ) : '';
			$innovio_taxonomy_slug = ! empty( $innovio_taxonomy ) ? $innovio_taxonomy->slug : '';
			$innovio_taxonomy_name = ! empty( $innovio_taxonomy ) ? $innovio_taxonomy->taxonomy : '';
			
			innovio_core_get_archive_portfolio_list( $innovio_taxonomy_slug, $innovio_taxonomy_name );
		?>
	</div>
	<?php do_action( 'innovio_mikado_action_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
