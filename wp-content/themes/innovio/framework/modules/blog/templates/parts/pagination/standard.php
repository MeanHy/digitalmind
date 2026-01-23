<?php
if($max_num_pages > 1) {
	$number_of_pages = $max_num_pages;
	$current_page    = $paged;
	$range           = 3;
	?>
	
	<div class="mkdf-blog-pagination">
		<ul>
			<?php if($current_page > 2 && $current_page > $range && $range < $number_of_pages) { ?>
				<li class="mkdf-pag-first">
					<a itemprop="url" href="<?php echo esc_url(get_pagenum_link(1)); ?>">
						<span class="arrow_carrot-2left"></span>
					</a>
				</li>
			<?php } ?>
			<?php if ($current_page > 1) { ?>
				<li class="mkdf-pag-prev">
					<a itemprop="url" href="<?php echo esc_url(get_pagenum_link($current_page - 1)); ?>">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="26px" height="9px" viewBox="0 0 26 9" enable-background="new 0 0 26 9" xml:space="preserve">
                        <path fill="#08104D" d="M0.038,4.691c0.024,0.062,0.063,0.117,0.108,0.163l3.535,3.535c0.098,0.098,0.226,0.146,0.354,0.146
                         s0.256-0.049,0.354-0.146c0.195-0.195,0.195-0.512,0-0.707L1.707,5h23.792c0.276,0,0.5-0.224,0.5-0.5S25.775,4,25.499,4H1.707
                         l2.682-2.682c0.194-0.195,0.194-0.512,0-0.707c-0.195-0.195-0.513-0.195-0.707,0L0.146,4.146C0.102,4.192,0.063,4.248,0.038,4.309
                         C-0.012,4.431-0.012,4.569,0.038,4.691"/>
                        </svg>
					</a>
				</li>
			<?php } ?>
			<?php for ($i=1; $i <= $number_of_pages; $i++) { ?>
				<?php if (!($i >= $current_page + $range+1 || $i <= $current_page - $range-1) || $number_of_pages <= $range ) { ?>
					<?php if($current_page == $i) { ?>
						<li class="mkdf-pag-number mkdf-pag-active">
							<a href="#"><?php echo esc_attr($i); ?></a>
						</li>
					<?php } else { ?>
						<li class="mkdf-pag-number">
							<a itemprop="url" href="<?php echo get_pagenum_link($i); ?>"><?php echo esc_attr($i); ?></a>
						</li>
					<?php } ?>
				<?php } ?>
			<?php } ?>
			<?php if ($current_page < $number_of_pages) { ?>
				<li class="mkdf-pag-next">
					<a itemprop="url" href="<?php echo esc_url(get_pagenum_link($current_page + 1)); ?>">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="26px" height="9px" viewBox="0 0 26 9" enable-background="new 0 0 26 9" xml:space="preserve">
                        <path fill="#08104D" d="M25.962,4.691c0.05-0.122,0.05-0.26,0-0.382c-0.024-0.061-0.063-0.117-0.108-0.163l-3.535-3.535
                         c-0.194-0.195-0.512-0.195-0.707,0c-0.194,0.195-0.194,0.512,0,0.707L24.293,4H0.501c-0.277,0-0.5,0.224-0.5,0.5S0.224,5,0.501,5
                         h23.792l-2.682,2.682c-0.195,0.195-0.195,0.512,0,0.707c0.098,0.098,0.226,0.146,0.354,0.146s0.256-0.049,0.354-0.146l3.535-3.535
                         C25.898,4.808,25.938,4.753,25.962,4.691"/>
                        </svg>
					</a>
				</li>
			<?php } ?>
			<?php if ($current_page + 1 < $number_of_pages && $current_page + $range-1 < $number_of_pages && $range < $number_of_pages) { ?>
				<li class="mkdf-pag-last">
					<a itemprop="url" href="<?php echo esc_url(get_pagenum_link($number_of_pages)); ?>">
						<span class="arrow_carrot-2right"></span>
					</a>
				</li>
			<?php } ?>
		</ul>
	</div>
	
	<div class="mkdf-blog-pagination-wp">
		<?php echo get_the_posts_pagination(); ?>
	</div>
	
	<?php
}