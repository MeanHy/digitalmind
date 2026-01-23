<div class="mkdf-horizontal-timeline" data-distance="<?php echo esc_attr( $distance ); ?>">
	<div class="mkdf-ht-nav">
		<div class="mkdf-ht-nav-wrapper">
			<div class="mkdf-ht-nav-inner">
				<ol>
					<?php foreach ( $dates as $date ) {
						$dateLabel = $timeline_format === 'Y' ? $date['formatted'] : date_i18n( $timeline_format, $date['timestamp'] );
						?>
						<li>
							<a href="#" data-date="<?php echo esc_attr( $date['formatted'] ); ?>"><?php echo esc_html( $dateLabel ); ?></a>
						</li>
					<?php } ?>
				</ol>
				<span class="mkdf-ht-nav-filling-line" aria-hidden="true"></span>
			</div>
		</div>
		<ul class="mkdf-ht-nav-navigation">
			<li><a href="#" class="mkdf-prev mkdf-inactive"></a></li>
			<li><a href="#" class="mkdf-next"></a></li>
		</ul>
	</div>
	<div class="mkdf-ht-content">
		<ol>
			<?php echo do_shortcode( $content ); ?>
		</ol>
	</div>
</div>