<?php
$post_classes[] = 'mkdf-item-space';
$background_color_meta = get_post_meta( get_the_ID(), "mkdf_blog_list_initial_background_color_meta", true );
$styles = array();

if($background_color_meta !== ''){
    $styles[] =  'background-color: ' . $background_color_meta;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?> <?php innovio_mikado_inline_style($styles); ?>>
    <div class="mkdf-post-content">
	    <?php innovio_mikado_get_module_template_part('templates/parts/image-background', 'blog', $post_format, $part_params); ?>
	    <div class="mkdf-post-text-main">
            <div class="mkdf-post-heading-top">
			    <?php innovio_mikado_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
			    <?php innovio_mikado_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
            </div>
            <div class="mkdf-post-heading-bottom">
                <?php innovio_mikado_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                <?php innovio_mikado_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
            </div>
	    </div>
    </div>
</article>