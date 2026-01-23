<?php
$share_type = isset( $share_type ) ? $share_type : 'list';
?>
<?php if ( innovio_mikado_core_plugin_installed() && innovio_mikado_options()->getOptionValue( 'enable_social_share' ) === 'yes' && innovio_mikado_options()->getOptionValue( 'enable_social_share_on_post' ) === 'yes' ) { ?>
	<div class="mkdf-blog-share">
		<?php echo innovio_mikado_get_social_share_html( array( 'type' => $share_type ) ); ?>
	</div>
<?php } ?>