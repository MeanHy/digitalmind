<form role="search" method="get" class="mkdf-searchform searchform" id="searchform-<?php echo esc_attr(rand(0, 1000)); ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text"><?php esc_html_e( 'Search for:', 'innovio' ); ?></label>
	<div class="input-holder clearfix">
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search...', 'innovio' ); ?>" value="" name="s" title="<?php esc_attr_e( 'Search for:', 'innovio' ); ?>"/>
		<button type="submit" class="mkdf-search-submit">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="17" x="0px" y="0px"
                 viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                            <path class="st0" d="M15.9,15.1l-4.4-4.4c1-1.2,1.6-2.7,1.6-4.2c0-1.7-0.7-3.4-1.9-4.6C9.9,0.7,8.3,0,6.5,0C4.8,0,3.1,0.7,1.9,1.9
                C0.7,3.1,0,4.8,0,6.5c0,1.7,0.7,3.4,1.9,4.6c1.2,1.2,2.9,1.9,4.6,1.9c1.6,0,3.1-0.6,4.2-1.6l4.4,4.4c0.1,0.1,0.2,0.1,0.4,0.1
                s0.3,0,0.4-0.1C16,15.7,16,15.3,15.9,15.1z M2.6,10.4C1.6,9.4,1,8,1,6.5c0-1.5,0.6-2.9,1.6-3.9S5.1,1,6.5,1s2.9,0.6,3.9,1.6
                c1,1,1.6,2.4,1.6,3.9c0,1.5-0.6,2.9-1.6,3.9c-1,1-2.4,1.6-3.9,1.6S3.7,11.5,2.6,10.4z"/>
            </svg>
        </button>
	</div>
</form>