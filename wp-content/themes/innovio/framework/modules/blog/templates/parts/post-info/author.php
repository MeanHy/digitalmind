<div class="mkdf-post-info-author">
    <span class="mkdf-post-info-author-img">
	    <?php echo innovio_mikado_kses_img( get_avatar( get_the_author_meta( 'ID' ), 34 ) ); ?>
    </span>
    <span class="mkdf-post-info-author-text">
        <?php esc_html_e('by', 'innovio'); ?>
    </span>
    <a itemprop="author" class="mkdf-post-info-author-link" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
        <?php the_author_meta('display_name'); ?>
    </a>
</div>