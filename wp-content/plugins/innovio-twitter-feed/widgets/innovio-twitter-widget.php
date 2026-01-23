<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class InnovioTwitterWidget extends WP_Widget {
	private $params;
	
	public function __construct() {
		parent::__construct(
			'mkdf_twitter_widget',
			esc_html__( 'Innovio Twitter Widget', 'innovio-twitter-feed' ),
			array(
				'description' => esc_html__( 'Display your Twitter feed', 'innovio-twitter-feed' )
			)
		);
		
		$this->setParams();
	}
	
	private function setParams() {
		$this->params = array(
			array(
				'name'  => 'title',
				'type'  => 'textfield',
				'title' => esc_html__( 'Title', 'innovio-twitter-feed' )
			),
			array(
				'name'    => 'type_of_widget',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Type', 'innovio-twitter-feed' ),
				'options' => array(
					'standard' => esc_html__( 'Standard', 'innovio-twitter-feed' ),
					'slider'   => esc_html__( 'Slider', 'innovio-twitter-feed' )
				)
			),
			array(
				'name'  => 'user_id',
				'type'  => 'textfield',
				'title' => esc_html__( 'User ID', 'innovio-twitter-feed' )
			),
			array(
				'name'  => 'count',
				'type'  => 'textfield',
				'title' => esc_html__( 'Number of Tweets', 'innovio-twitter-feed' )
			),
			array(
				'name'    => 'show_tweet_icon',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Show Tweet Icon', 'innovio-twitter-feed' ),
				'options' => array(
					'yes' => esc_html__( 'Yes', 'innovio-twitter-feed' ),
					'no'  => esc_html__( 'No', 'innovio-twitter-feed' )
				)
			),
			array(
				'name'    => 'show_tweet_time',
				'type'    => 'dropdown',
				'title'   => esc_html__( 'Show Tweet Time', 'innovio-twitter-feed' ),
				'options' => array(
					'no'  => esc_html__( 'No', 'innovio-twitter-feed' ),
					'yes' => esc_html__( 'Yes', 'innovio-twitter-feed' )
				)
			),
			array(
				'name'  => 'transient_time',
				'type'  => 'textfield',
				'title' => esc_html__( 'Tweets Cache Time', 'innovio-twitter-feed' )
			)
		);
	}
	
	public function form( $instance ) {
		foreach ( $this->params as $param_array ) {
			$param_name    = $param_array['name'];
			${$param_name} = isset( $instance[ $param_name ] ) ? esc_attr( $instance[ $param_name ] ) : '';
		}
		
		foreach ( $this->params as $param ) {
			switch ( $param['type'] ) {
				case 'textfield':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo esc_html( $param['title'] ); ?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>" type="text" value="<?php echo esc_attr( ${$param['name']} ); ?>"/>
					</p>
					<?php
					break;
				case 'dropdown':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>"><?php echo esc_html( $param['title'] ); ?></label>
						<?php if ( isset( $param['options'] ) && is_array( $param['options'] ) && count( $param['options'] ) ) { ?>
							<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( $param['name'] ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $param['name'] ) ); ?>">
								<?php foreach ( $param['options'] as $param_option_key => $param_option_val ) {
									$option_selected = '';
									if ( ${$param['name']} == $param_option_key ) {
										$option_selected = 'selected';
									}
									?>
									<option <?php echo esc_attr( $option_selected ); ?> value="<?php echo esc_attr( $param_option_key ); ?>"><?php echo esc_attr( $param_option_val ); ?></option>
								<?php } ?>
							</select>
						<?php } ?>
					</p>
					
					<?php
					break;
			}
		}
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		foreach ( $this->params as $param ) {
			$param_name = $param['name'];
			
			$instance[ $param_name ] = sanitize_text_field( $new_instance[ $param_name ] );
		}
		
		return $instance;
	}
	
	public function widget( $args, $instance ) {
		extract( $instance );
		
		print $args['before_widget'];
		
		if ( ! empty( $title ) ) {
			print $args['before_title'] . $title . $args['after_title'];
		}
		
		$user_id        = ! empty( $user_id ) ? $user_id : '';
		$count          = ! empty( $count ) ? $count : '';
		$transient_time = ! empty( $transient_time ) ? $transient_time : 0;
		
		$twitter_style = ( $show_tweet_icon != 'yes' ) ? 'padding: 0;' : '';
		
		$type_of_widget = ! empty( $type_of_widget ) ? $type_of_widget : 'standard';
		
		$holder_classes = 'mkdf-twitter-' . esc_attr( $type_of_widget );
		$slider_data    = array();
		
		if ( $type_of_widget === 'slider' ) {
			$holder_classes .= ' mkdf-owl-slider';
			$slider_data['data-enable-pagination'] = 'yes';
		}
		
		$twitter_api = InnovioTwitterApi::getInstance();
		
		if ( $twitter_api->hasUserConnected() ) {
			$response = $twitter_api->fetchTweets( $user_id, $count, array(
				'transient_time' => $transient_time,
				'transient_id'   => 'mkdf_twitter_' . $args['widget_id']
			) );
			
			if ( $response->status ) {
				if ( is_array( $response->data ) && count( $response->data ) ) { ?>
					<ul class="mkdf-twitter-widget <?php echo esc_attr( $holder_classes ); ?>" <?php echo innovio_mikado_get_inline_attrs( $slider_data ); ?>>
						<?php foreach ( $response->data as $tweet ) { ?>
							
							<?php if ( $type_of_widget == 'slider' ) { ?>
								
								<li class="mkdf-tweet-holder">
									<div class="mkdf-tweet-text" <?php innovio_mikado_inline_style( $twitter_style ); ?>>
										<?php echo wp_kses_post( $twitter_api->getHelper()->getTweetText( $tweet ) ); ?>
										<?php if ( $show_tweet_time == 'yes' ) { ?>
											<a class="mkdf-tweet-time" target="_blank" href="<?php echo esc_url( $twitter_api->getHelper()->getTweetURL( $tweet ) ); ?>">
												<?php if ( $show_tweet_icon == 'yes' ) { ?>
													<span class="mkdf-twitter-icon"><i class="icon-social-twitter"></i></span>
												<?php } ?>
												<?php echo wp_kses_post( $twitter_api->getHelper()->getTweetTime( $tweet ) ); ?>
											</a>
										<?php } ?>
									</div>
								</li>
							
							<?php } else { ?>
								
								<li class="mkdf-tweet-holder">
									<?php if ( $show_tweet_icon == 'yes' ) { ?>
										<div class="mkdf-twitter-icon"><i class="icon-social-twitter"></i></div>
									<?php } ?>
									<div class="mkdf-tweet-text" <?php innovio_mikado_inline_style( $twitter_style ); ?>>
										<?php echo wp_kses_post( $twitter_api->getHelper()->getTweetText( $tweet ) ); ?>
										<?php if ( $show_tweet_time == 'yes' ) { ?>
											<a class="mkdf-tweet-time" target="_blank" href="<?php echo esc_url( $twitter_api->getHelper()->getTweetURL( $tweet ) ); ?>">
												<?php echo wp_kses_post( $twitter_api->getHelper()->getTweetTime( $tweet ) ); ?>
											</a>
										<?php } ?>
									</div>
								</li>
							
							<?php } ?>
						
						<?php } ?>
					</ul>
				<?php }
			} else {
				echo esc_html( $response->message );
			}
		} else {
			esc_html_e( 'It seams that you haven\'t connected with your Twitter account', 'innovio-twitter-feed' );
		}
		
		print $args['after_widget'];
	}
}

if ( ! function_exists( 'innovio_twitter_widget_load' ) ) {
	function innovio_twitter_widget_load() {
		if ( innovio_twitter_theme_installed() ) {
			register_widget( 'InnovioTwitterWidget' );
		}
	}
	
	add_action( 'widgets_init', 'innovio_twitter_widget_load' );
}