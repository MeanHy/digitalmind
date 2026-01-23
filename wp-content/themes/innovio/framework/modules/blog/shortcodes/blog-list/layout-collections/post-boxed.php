<?php
    global $post;
    $postID   = $post->ID;
    $postDark = get_post_meta( $postID, 'mkdf_blog_single_skin_meta', true );
    $postSkin = '';

    if ($postDark) {
	    $postSkin = 'mkdf-dark-post';
    }
?>

<li class="mkdf-bl-item mkdf-item-space <?php echo esc_attr($postSkin); ?>">
	<div class="mkdf-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			innovio_mikado_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
        <div class="mkdf-bli-content">
            <?php if ($post_info_section == 'yes') { ?>
                <div class="mkdf-bli-info">
	                <?php
		                if ( $post_info_date == 'yes' ) {
			                innovio_mikado_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
		                if ( $post_info_category == 'yes' ) {
			                innovio_mikado_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
		                if ( $post_info_comments == 'yes' ) {
			                innovio_mikado_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
		                }
		                if ( $post_info_like == 'yes' ) {
			                innovio_mikado_get_module_template_part( 'templates/parts/post-info/like', 'blog', '', $params );
		                }
		                if ( $post_info_share == 'yes' ) {
			                innovio_mikado_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>

            <div class="mkdf-bli-info-bottom">
                <?php
                    innovio_mikado_get_module_template_part( 'templates/parts/title', 'blog', '', $params );
                    if ( $post_info_author == 'yes' ) {
                        innovio_mikado_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
                    }
                ?>
            </div>
	
	        <div class="mkdf-bli-excerpt">
		        <?php innovio_mikado_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
	        </div>
        </div>
	</div>
</li>