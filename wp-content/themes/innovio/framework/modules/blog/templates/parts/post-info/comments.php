<?php if(comments_open()) { ?>
	<div class="mkdf-post-info-comments-holder">
		<a itemprop="url" class="mkdf-post-info-comments" href="<?php comments_link(); ?>">
            <?php
                echo innovio_mikado_icon_collections()->renderIcon( 'icon_comment_alt', 'font_elegant' );
                echo esc_html__('Comments','innovio');
            ?>
		</a>
	</div>
<?php } ?>