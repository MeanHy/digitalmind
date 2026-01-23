<?php
$blog_single_navigation = innovio_mikado_options()->getOptionValue('blog_single_navigation') === 'no' ? false : true;
$blog_navigation_through_same_category = innovio_mikado_options()->getOptionValue('blog_navigation_through_same_category') === 'no' ? false : true;
?>
<?php if($blog_single_navigation){ ?>
    <div class="mkdf-blog-single-navigation">
        <div class="mkdf-blog-single-navigation-inner clearfix">
			<?php
			/* Single navigation section - SETTING PARAMS */
			$same_cat_flag = false;
			if($blog_navigation_through_same_category){
				$same_cat_flag = true;
			}
			$prevPost = get_previous_post($same_cat_flag);
			$nextPost = get_next_post($same_cat_flag);

			if(isset($prevPost) && $prevPost !== '' && $prevPost !== null){

				$post_navigation['prev']['post'] = $prevPost;

				$post_navigation['prev']['classes'] = array(
					'mkdf-blog-single-nav-prev'
				);

				$image = get_the_post_thumbnail($prevPost->ID, 'innovio_mikado_image_square');
				$post_navigation['prev']['image'] = '';


				if($image !== ''){
					$post_navigation['prev']['image'] = '<div class="mkdf-blog-single-nav-thumbnail">'.wp_kses_post($image).'</div>';
					$post_navigation['prev']['classes'][] = 'mkdf-with-image';
				}

				$post_navigation['prev']['title'] = '<h6 class="mkdf-blog-single-nav-title">'.get_the_title($prevPost->ID).'</h6>';
				$post_navigation['prev']['date'] =  '<span class="mkdf-blog-single-nav-date">'.get_the_date().'</span>';

			}

			if(isset($nextPost) && $nextPost !== '' && $nextPost !== null){

				$post_navigation['next']['post'] = $nextPost;

				$post_navigation['next']['classes'] = array(
					'mkdf-blog-single-nav-next'
				);

				$image = get_the_post_thumbnail($nextPost->ID, 'innovio_mikado_image_square');
				$post_navigation['next']['image'] = '';

				$post_navigation['next']['title'] = '<h6 class="mkdf-blog-single-nav-title">'.get_the_title($nextPost->ID).'</h6>';
				$post_navigation['next']['date'] =  '<span class="mkdf-blog-single-nav-date">'.get_the_date().'</span>';

				if($image !== ''){
					$post_navigation['next']['classes'][] = 'mkdf-with-image';
					$post_navigation['next']['image'] = '<div class="mkdf-blog-single-nav-thumbnail">'.wp_kses_post($image).'</div>';
				}
			}


			/* Single navigation section - RENDERING */
				if(isset($post_navigation['prev'])){ ?>

                    <div class="<?php echo implode(' ', $post_navigation['prev']['classes']) ?>">
                        <a itemprop="url" href="<?php echo get_permalink($post_navigation['prev']['post']->ID); ?>">
							<?php
							echo wp_kses_post($post_navigation['prev']['image']);
							?>
                            <div class="mkdf-blog-single-nav-text">
                                <?php
                                echo wp_kses_post($post_navigation['prev']['title']);
                                echo wp_kses_post($post_navigation['prev']['date']);
                                ?>
                            </div>
                        </a>
                    </div>

				<?php }

                if(isset($post_navigation['next'])){ ?>

                    <div class="<?php echo implode(' ', $post_navigation['next']['classes']) ?>">
                        <a itemprop="url" href="<?php echo get_permalink($post_navigation['next']['post']->ID); ?>">
                            <div class="mkdf-blog-single-nav-text">
                                <?php
                                echo wp_kses_post($post_navigation['next']['title']);
                                echo wp_kses_post($post_navigation['next']['date']);
                                ?>
                            </div>
                            <?php
                            echo wp_kses_post($post_navigation['next']['image']);
                            ?>
                        </a>
                    </div>

                <?php }

			?>
        </div>
    </div>
<?php } ?>