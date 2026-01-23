<?php
// Detect current language (Polylang)
$current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';
$is_english = ($current_lang === 'en');

// Get all categories for current language (including empty ones)
$categories = get_categories(array(
    'orderby' => 'name',
    'order'   => 'ASC',
    'hide_empty' => false,
));

// Check if we're on a category archive page
$current_cat_obj = get_queried_object();
$is_category_page = is_category();
$current_cat_slug = $is_category_page ? $current_cat_obj->slug : '';

// Get total post count
$total_posts = $blog_query->found_posts;

// Blog page URL based on language
$blog_page_url = $is_english ? home_url('/en/tin-tuc/') : home_url('/tin-tuc/');

// Translations
$text_all = $is_english ? 'All' : 'Tất cả';
$text_posts = $is_english ? 'posts' : 'bài viết';
?>
<div class="<?php echo esc_attr( $blog_classes ) ?>" <?php echo esc_attr( $blog_data_params ) ?>>
	
	<!-- Category Filter & Post Count -->
	<div class="mkdf-blog-filter-bar">
		<div class="mkdf-filter-dropdown">
			<div class="mkdf-filter-select" id="categoryFilterToggle">
				<span class="mkdf-filter-icon">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
					</svg>
				</span>
				<span class="mkdf-filter-label" id="filterLabel"><?php echo $is_category_page ? esc_html($current_cat_obj->name) : $text_all; ?></span>
				<span class="mkdf-filter-arrow">
					<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<polyline points="6 9 12 15 18 9"></polyline>
					</svg>
				</span>
			</div>
			<div class="mkdf-filter-options" id="categoryFilterOptions">
				<div class="mkdf-filter-option <?php echo !$is_category_page ? 'active' : ''; ?>" data-url="<?php echo esc_url($blog_page_url); ?>">
					<?php echo $text_all; ?>
					<?php if(!$is_category_page): ?><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg><?php endif; ?>
				</div>
				<?php foreach($categories as $cat): ?>
				<div class="mkdf-filter-option <?php echo ($current_cat_slug === $cat->slug) ? 'active' : ''; ?>" data-url="<?php echo esc_url(get_category_link($cat->term_id)); ?>">
					<?php echo esc_html($cat->name); ?>
					<?php if($current_cat_slug === $cat->slug): ?><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg><?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="mkdf-post-count">
			<span class="mkdf-count-number"><?php echo esc_html($total_posts); ?></span> <?php echo $text_posts; ?>
		</div>
	</div>

	<div class="mkdf-blog-holder-inner mkdf-outer-space mkdf-masonry-list-wrapper">
		<div class="mkdf-masonry-grid-sizer"></div>
		<div class="mkdf-masonry-grid-gutter"></div>
		<?php
		if ( $blog_query->have_posts() ) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
			innovio_mikado_get_post_format_html( $blog_type );
		endwhile;
		else:
			innovio_mikado_get_module_template_part( 'templates/parts/no-posts', 'blog' );
		endif;
		
		wp_reset_postdata();
		?>
	</div>
	<?php innovio_mikado_get_module_template_part( 'templates/parts/pagination/pagination', 'blog', '', $params ); ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('categoryFilterToggle');
    const options = document.getElementById('categoryFilterOptions');
    
    if (!toggle || !options) return;
    
    // Toggle dropdown
    toggle.addEventListener('click', function(e) {
        e.stopPropagation();
        options.classList.toggle('show');
        toggle.classList.toggle('open');
    });
    
    // Handle option click - redirect to category URL
    options.querySelectorAll('.mkdf-filter-option').forEach(function(option) {
        option.addEventListener('click', function() {
            const url = this.dataset.url;
            if (url) {
                window.location.href = url;
            }
        });
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function() {
        options.classList.remove('show');
        toggle.classList.remove('open');
    });
});
</script>
