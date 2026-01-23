<li class="mkdf-bl-item mkdf-item-space">
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
		                if ( $post_info_author == 'yes' ) {
			                innovio_mikado_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
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
	
	        <?php innovio_mikado_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
	
	        <div class="mkdf-bli-excerpt">
		        <?php innovio_mikado_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
		        <?php innovio_mikado_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params ); ?>
	        </div>
        </div>
	</div>
</li>