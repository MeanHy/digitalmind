<div class="mkdf-testimonials-holder clearfix <?php echo esc_attr($holder_classes); ?>">
    <div class="mkdf-testimonials" <?php echo innovio_mikado_get_inline_attrs( $data_attr ) ?>>
        <div class="swiper-container">
            <div class="swiper-wrapper">
        <?php if ( $query_results->have_posts() ):
            while ( $query_results->have_posts() ) : $query_results->the_post();
                $title    = get_post_meta( get_the_ID(), 'mkdf_testimonial_title', true );
                $text     = get_post_meta( get_the_ID(), 'mkdf_testimonial_text', true );
                $author   = get_post_meta( get_the_ID(), 'mkdf_testimonial_author', true );
                $position = get_post_meta( get_the_ID(), 'mkdf_testimonial_author_position', true );

                $current_id = get_the_ID();
                ?>

                <div class="mkdf-testimonial-content swiper-slide" id="mkdf-testimonials-<?php echo esc_attr( $current_id ) ?>">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <div class="mkdf-testimonial-image">
                            <?php echo get_the_post_thumbnail( get_the_ID(), array( 140, 140 ) ); ?>
                        </div>
                    <?php } ?>
                    <div class="mkdf-testimonial-text-holder">
                        <?php if ( ! empty( $title ) ) { ?>
                            <h3 itemprop="name" class="mkdf-testimonial-title entry-title"><?php echo esc_html( $title ); ?></h3>
                        <?php } ?>
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
        <div class="swiper-pagination">
        </div>
    </div>
</div>