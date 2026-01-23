<div class="mkdf-team-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="mkdf-team-inner">
		<?php if ($team_image !== '') { ?>
			<div class="mkdf-team-image">
                <?php echo wp_get_attachment_image($team_image, 'full'); ?>
                <?php if($team_hover_image !== '') {
                       echo wp_get_attachment_image($team_hover_image, 'full');
                } ?>
                <?php if($subtype === 'hover-image') { ?>
                    <div class="mkdf-team-social-wrapper">
                        <div class="mkdf-team-social-outer">
                            <div class="mkdf-team-social-inner">
                                <?php if ($team_position !== "") { ?>
                                    <h6 class="mkdf-team-position" <?php echo innovio_mikado_get_inline_style($team_position_styles); ?>><?php echo esc_html($team_position); ?></h6>
                                <?php } ?>
                                <?php if ($team_name !== '') { ?>
                                    <<?php echo esc_attr($team_name_tag); ?> class="mkdf-team-name" <?php echo innovio_mikado_get_inline_style($team_name_styles); ?>><?php echo esc_html($team_name); ?></<?php echo esc_attr($team_name_tag); ?>>
                                <?php } ?>
                                <?php if ($team_text !== "") { ?>
                                    <p class="mkdf-team-text" <?php echo innovio_mikado_get_inline_style($team_text_styles); ?>><?php echo esc_html($team_text); ?></p>
                                <?php } ?>
                                <?php if (!empty($team_social_icons)) { ?>
                                    <div class="mkdf-team-social-holder">
                                        <?php foreach( $team_social_icons as $team_social_icon ) { ?>
                                            <span class="mkdf-team-icon"><?php echo wp_kses_post($team_social_icon); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="mkdf-team-hover-content">
                        <div class="mkdf-team-hover-content-inner">
                            <?php if ($team_position !== "") { ?>
                                <span class="mkdf-team-position" <?php echo innovio_mikado_get_inline_style($team_position_styles); ?>><?php echo esc_html($team_position); ?></span>
                            <?php } ?>
                            <?php if ($team_name !== '') { ?>
                            <<?php echo esc_attr($team_name_tag); ?> class="mkdf-team-name" <?php echo innovio_mikado_get_inline_style($team_name_styles); ?>><?php echo esc_html($team_name); ?></<?php echo esc_attr($team_name_tag); ?>>
                            <?php } ?>
                            <?php if ($team_text !== "") { ?>
                                <p class="mkdf-team-text" <?php echo innovio_mikado_get_inline_style($team_text_styles); ?>><?php echo esc_html($team_text); ?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="mkdf-team-social-wrapper">
                        <div class="mkdf-team-social-outer">
                            <div class="mkdf-team-social-inner">
                                <?php if (!empty($team_social_icons)) { ?>
                                    <div class="mkdf-team-social-holder">
                                        <?php foreach( $team_social_icons as $team_social_icon ) { ?>
                                            <span class="mkdf-team-icon"><?php echo wp_kses_post($team_social_icon); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
			</div>
		<?php } ?>
	</div>
</div>