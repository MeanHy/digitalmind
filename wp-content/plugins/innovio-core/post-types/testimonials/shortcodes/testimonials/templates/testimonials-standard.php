<div class="mkdf-testimonials-holder clearfix <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-testimonials mkdf-owl-slider" <?php echo innovio_mikado_get_inline_attrs( $data_attr ) ?>>

    <?php if ( $query_results->have_posts() ):
        while ( $query_results->have_posts() ) : $query_results->the_post();
            $title    = get_post_meta( get_the_ID(), 'mkdf_testimonial_title', true );
            $text     = get_post_meta( get_the_ID(), 'mkdf_testimonial_text', true );
            $author   = get_post_meta( get_the_ID(), 'mkdf_testimonial_author', true );
            $position = get_post_meta( get_the_ID(), 'mkdf_testimonial_author_position', true );

            $current_id = get_the_ID();
    ?>

            <div class="mkdf-testimonial-content" id="mkdf-testimonials-<?php echo esc_attr( $current_id ) ?>">
                <div class="mkdf-testimonial-text-holder">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="83px" height="60px" viewBox="0 0 83 60" enable-background="new 0 0 83 60" xml:space="preserve">
                    <path fill="#08104d" d="M19.289,2c5.164,0,9.254,1.503,12.503,4.595c3.221,3.069,4.787,7.069,4.787,12.229
                     c0,2.357-0.322,4.757-0.956,7.13c-0.647,2.419-2.18,6.216-4.556,11.288L21.377,58H4.865l6.552-22.289l0.477-1.622l-1.52-0.74
                     c-2.686-1.308-4.704-3.145-6.169-5.62C2.742,25.264,2,22.268,2,18.824c0-5.162,1.565-9.162,4.786-12.228
                     C10.034,3.503,14.123,2,19.289,2 M19.289,0C13.638,0,9.01,1.716,5.407,5.147C1.802,8.58,0,13.139,0,18.824
                     c0,3.823,0.827,7.132,2.484,9.926c1.656,2.794,3.994,4.927,7.014,6.396L2.192,60H22.65l10.229-21.912
                     c2.434-5.195,3.994-9.067,4.677-11.617c0.68-2.549,1.023-5.097,1.023-7.647c0-5.685-1.804-10.244-5.407-13.677
                     C29.566,1.716,24.938,0,19.289,0"/>
                                            <path fill="#08104d" d="M63.711,2c5.163,0,9.254,1.503,12.503,4.595C79.435,9.664,81,13.664,81,18.824
                     c0,2.357-0.321,4.757-0.955,7.13c-0.647,2.419-2.18,6.216-4.557,11.288L65.798,58H49.286l6.553-22.289l0.476-1.622l-1.52-0.74
                     c-2.686-1.308-4.703-3.145-6.169-5.62c-1.463-2.465-2.204-5.461-2.204-8.905c0-5.162,1.565-9.162,4.786-12.228
                     C54.455,3.503,58.545,2,63.711,2 M63.711,0C58.06,0,53.432,1.716,49.828,5.147c-3.604,3.433-5.406,7.992-5.406,13.677
                     c0,3.823,0.826,7.132,2.484,9.926c1.655,2.794,3.992,4.927,7.014,6.396L46.613,60h20.459l10.229-21.912
                     c2.434-5.195,3.993-9.067,4.676-11.617C82.657,23.922,83,21.374,83,18.824c0-5.685-1.804-10.244-5.407-13.677
                     C73.987,1.716,69.359,0,63.711,0"/>
                    </svg>
                    <?php if ( ! empty( $text ) ) { ?>
                        <p class="mkdf-testimonial-text"><?php echo esc_html( $text ); ?></p>
                    <?php } ?>
                    <?php if ( ! empty( $author ) ) { ?>
                        <h6 class="mkdf-testimonial-author">
                            <span class="mkdf-testimonials-author-name"><?php echo esc_html( $author ); ?></span>
                            <?php if ( ! empty( $position ) ) { ?>
                                <span class="mkdf-testimonials-author-job"><?php echo esc_html( $position ); ?></span>
                            <?php } ?>
                        </h6>
                    <?php } ?>
                </div>
            </div>

    <?php
        endwhile;
    else:
        echo esc_html__( 'Sorry, no posts matched your criteria.', 'innovio-core' );
    endif;

    wp_reset_postdata();
    ?>

    </div>
</div>