<div class="mkdf-tabs <?php echo esc_attr($holder_classes); ?>">
	<ul class="mkdf-tabs-nav clearfix" <?php echo innovio_mikado_get_inline_style($holder_styles); ?>>
		<?php foreach ($tabs_titles as $tab_title) { ?>
			<li>
				<?php if(!empty($tab_title)) { ?>
					<a href="#tab-<?php echo sanitize_title($tab_title)?>">
                        <?php echo esc_html($tab_title); ?>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 26 9" style="enable-background:new 0 0 26 9;" xml:space="preserve">
                    <path d="M26,4.7C26,4.6,26,4.4,26,4.3c0-0.1-0.1-0.1-0.1-0.2l-3.5-3.5c-0.2-0.2-0.5-0.2-0.7,0s-0.2,0.5,0,0.7L24.3,4
                    H0.5C0.2,4,0,4.2,0,4.5S0.2,5,0.5,5h23.8l-2.7,2.7c-0.2,0.2-0.2,0.5,0,0.7c0.1,0.1,0.2,0.1,0.4,0.1s0.3,0,0.4-0.1l3.5-3.5
                    C25.9,4.8,25.9,4.8,26,4.7z"/>
                </svg>
                    </a>
				<?php } ?>
			</li>
		<?php } ?>
	</ul>
	<?php echo do_shortcode($content); ?>
</div>