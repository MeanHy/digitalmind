<?php

if ( class_exists( 'InnovioCoreClassWidget' ) ) {
    class InnovioMikadoClassAuthorInfoWidget extends InnovioCoreClassWidget {
        public function __construct() {
            parent::__construct(
                'mkdf_author_info_widget',
                esc_html__( 'Innovio Author Info Widget', 'innovio' ),
                array( 'description' => esc_html__( 'Add author info element to widget areas', 'innovio' ) )
            );

            $this->setParams();
        }

        protected function setParams() {
            $this->params = array(
                array(
                    'type'  => 'textfield',
                    'name'  => 'extra_class',
                    'title' => esc_html__( 'Custom CSS Class', 'innovio' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'widget_bottom_margin',
                    'title' => esc_html__( 'Widget Bottom Margin (px)', 'innovio' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'author_username',
                    'title' => esc_html__( 'Author Username', 'innovio' )
                )
            );
        }

        public function widget( $args, $instance ) {
            extract( $args );

            $extra_class = '';
            if ( ! empty( $instance['extra_class'] ) ) {
                $extra_class = $instance['extra_class'];
            }

            $widget_styles = array();
            if ( isset( $instance['widget_bottom_margin'] ) && $instance['widget_bottom_margin'] !== '' ) {
                $widget_styles[] = 'margin-bottom: ' . innovio_mikado_filter_px( $instance['widget_bottom_margin'] ) . 'px';
            }

            $authorID = 1;
            if ( ! empty( $instance['author_username'] ) ) {
                $author = get_user_by( 'login', $instance['author_username'] );

                if ( $author ) {
                    $authorID = $author->ID;
                }
            }

            $author_info = get_the_author_meta( 'description', $authorID );
            ?>

            <div class="widget mkdf-author-info-widget <?php echo esc_attr( $extra_class ); ?>" <?php echo innovio_mikado_get_inline_style( $widget_styles ); ?>>
                <div class="mkdf-aiw-inner">
                    <a itemprop="url" class="mkdf-aiw-image" href="<?php echo esc_url( get_author_posts_url( $authorID ) ); ?>">
                        <?php echo innovio_mikado_kses_img( get_avatar( $authorID, 172 ) ); ?>
                    </a>
                    <?php if ( $author_info !== "" ) { ?>
                        <h5 class="mkdf-aiw-title"><?php esc_html_e( 'About Author', 'innovio' ); ?></h5>
                        <p itemprop="description" class="mkdf-aiw-text"><?php echo wp_kses_post( $author_info ); ?></p>
                    <?php } ?>
                </div>
            </div>
            <?php
        }
    }
}