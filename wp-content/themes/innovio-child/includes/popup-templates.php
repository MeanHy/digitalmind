<?php
/**
 * Popup Templates for Digital Mind
 * Contains all popup HTML templates
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Research Popup Form & Thank You Popup
 */
function digitalmind_add_research_popup_form()
{
    ?>
    <div class="thankyou-popup-overlay" id="thankYouPopup">
        <div class="thankyou-popup-container">
            <button class="thankyou-popup-close" id="thankYouPopupClose">&times;</button>
            <div class="thankyou-popup-content">
                <div class="thankyou-checkmark">
                    <svg viewBox="0 0 52 52" class="checkmark-svg">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" />
                        <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                    </svg>
                </div>
                <p class="thankyou-popup-subtitle">
                    <?php echo esc_html__('Thank you for your interest', 'innovio_child'); ?>
                </p>
                <h3 class="thankyou-popup-title" id="thankYouTitle">
                    <?php echo esc_html__('Sent successfully', 'innovio_child'); ?>
                </h3>
                <p class="thankyou-popup-desc" id="thankYouDesc">
                    <?php echo esc_html__('The report is being downloaded.', 'innovio_child'); ?>
                </p>

                <div class="thankyou-related-posts">
                    <h4 class="thankyou-related-title">
                        <?php echo esc_html__('You might also like', 'innovio_child'); ?>
                    </h4>
                    <div class="thankyou-posts-grid">
                        <?php
                        $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'vi';
                        $related_posts = get_posts([
                            'category_name' => 'research',
                            'posts_per_page' => 2,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'lang' => $current_lang
                        ]);

                        foreach ($related_posts as $related_post):
                            $thumbnail = get_the_post_thumbnail_url($related_post->ID, 'medium');
                            $title = get_the_title($related_post->ID);
                            $excerpt = wp_trim_words(get_the_excerpt($related_post->ID), 12, '...');
                            $link = get_permalink($related_post->ID);
                            $categories = get_the_category($related_post->ID);
                            ?>
                            <article class="mkdf-post-content thankyou-post-item">
                                <div class="mkdf-post-heading">
                                    <?php if ($thumbnail): ?>
                                        <div class="mkdf-post-image">
                                            <a href="<?php echo esc_url($link); ?>">
                                                <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($title); ?>">
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mkdf-post-text">
                                    <div class="mkdf-post-text-inner">
                                        <div class="mkdf-post-text-main">
                                            <h5 class="entry-title mkdf-post-title">
                                                <a href="<?php echo esc_url($link); ?>">
                                                    <?php echo esc_html($title); ?>
                                                </a>
                                            </h5>
                                            <div class="mkdf-post-excerpt-holder">
                                                <p class="mkdf-post-excerpt">
                                                    <?php echo esc_html($excerpt); ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mkdf-post-info-bottom">
                                            <div class="mkdf-post-read-more-button">
                                                <a href="<?php echo esc_url($link); ?>"
                                                    class="mkdf-btn mkdf-btn-medium mkdf-btn-simple mkdf-blog-list-button">
                                                    <span
                                                        class="mkdf-btn-text"><?php echo esc_html__('Read More', 'innovio_child'); ?></span>
                                                    <div class="mkdf-btn-plus">
                                                        <span class="mkdf-btn-line-1"></span>
                                                        <span class="mkdf-btn-line-2"></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach;
                        wp_reset_postdata(); ?>
                    </div>
                </div>

                <div class="thankyou-about-section">
                    <div class="thankyou-about-left">
                        <span class="thankyou-about-label">
                            <?php echo esc_html__('VỀ DIGITAL MIND', 'innovio_child'); ?>
                        </span>
                        <h3 class="thankyou-about-heading">
                            <?php echo esc_html__('Kết nối hệ thống số &', 'innovio_child'); ?><br>
                            <em>
                                <?php echo esc_html__('Hệ thống thương mại', 'innovio_child'); ?>
                            </em>
                        </h3>
                        <p class="thankyou-about-desc">
                            <?php echo esc_html__('We believe that transparent data is the key to making informed, growth-driven decisions. Digital Mind provides a scalable platform built on your organization’s existing investments.', 'innovio_child'); ?>
                        </p>
                        <div class="thankyou-about-tags">
                            <span class="thankyou-tag">
                                <?php echo esc_html__('Analysis', 'innovio_child'); ?>
                            </span>
                            <span class="thankyou-tag">
                                <?php echo esc_html__('Insight', 'innovio_child'); ?>
                            </span>
                            <span class="thankyou-tag">
                                <?php echo esc_html__('Strategy', 'innovio_child'); ?>
                            </span>
                            <span class="thankyou-tag">
                                <?php echo esc_html__('Execution', 'innovio_child'); ?>
                            </span>
                        </div>
                        <a itemprop="url" href="/lien-he/" target="_self"
                            style="color: #ffffff;background-color: #e82c75;border-color: #e82c75"
                            class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-btn-custom-hover-bg mkdf-btn-custom-border-hover mkdf-btn-custom-hover-color mkdf-btn-predefined-arrow"
                            data-hover-color="#ffffff" data-hover-bg-color="#e82c75" data-hover-border-color="#e82c75">
                            <span class="mkdf-btn-text"><?php echo esc_html__('My services', 'innovio_child'); ?></span>
                            <svg class="mkdf-btn-svg-one" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 9"
                                style="enable-background:new 0 0 26 9;" xml:space="preserve">
                                <path d="M26,4.7C26,4.6,26,4.4,26,4.3c0-0.1-0.1-0.1-0.1-0.2l-3.5-3.5c-0.2-0.2-0.5-0.2-0.7,0s-0.2,0.5,0,0.7L24.3,4
                            H0.5C0.2,4,0,4.2,0,4.5S0.2,5,0.5,5h23.8l-2.7,2.7c-0.2,0.2-0.2,0.5,0,0.7c0.1,0.1,0.2,0.1,0.4,0.1s0.3,0,0.4-0.1l3.5-3.5
                            C25.9,4.8,25.9,4.8,26,4.7z"></path>
                            </svg>
                            <svg class="mkdf-btn-svg-two" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 9"
                                style="enable-background:new 0 0 26 9;" xml:space="preserve">
                                <path d="M26,4.7C26,4.6,26,4.4,26,4.3c0-0.1-0.1-0.1-0.1-0.2l-3.5-3.5c-0.2-0.2-0.5-0.2-0.7,0s-0.2,0.5,0,0.7L24.3,4
                                H0.5C0.2,4,0,4.2,0,4.5S0.2,5,0.5,5h23.8l-2.7,2.7c-0.2,0.2-0.2,0.5,0,0.7c0.1,0.1,0.2,0.1,0.4,0.1s0.3,0,0.4-0.1l3.5-3.5
                                C25.9,4.8,25.9,4.8,26,4.7z"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="thankyou-about-right">
                        <div class="thankyou-service-box">
                            <div class="thankyou-service-icon">🎯</div>
                            <h4>
                                <?php echo esc_html__('Brand Strategy', 'innovio_child'); ?>
                            </h4>
                            <ul>
                                <li>
                                    <?php echo esc_html__('Brand positioning', 'innovio_child'); ?>
                                </li>
                                <li>
                                    <?php echo esc_html__('Brand identity & spatial experience', 'innovio_child'); ?>
                                </li>
                                <li>
                                    <?php echo esc_html__('Integrated annual planning', 'innovio_child'); ?>
                                </li>
                            </ul>
                        </div>

                        <div class="thankyou-service-box">
                            <div class="thankyou-service-icon">💻</div>
                            <h4>
                                <?php echo esc_html__('Digital Marketing & Media', 'innovio_child'); ?>
                            </h4>
                            <ul>
                                <li>
                                    <?php echo esc_html__('Digital & social planning', 'innovio_child'); ?>
                                </li>
                                <li>
                                    <?php echo esc_html__('Media booking management', 'innovio_child'); ?>
                                </li>
                                <li>
                                    <?php echo esc_html__('KOL / Influencer management', 'innovio_child'); ?>
                                </li>
                            </ul>
                        </div>

                        <div class="thankyou-service-box">
                            <div class="thankyou-service-icon">✏️</div>
                            <h4>
                                <?php echo esc_html__('Creative & Content', 'innovio_child'); ?>
                            </h4>
                            <ul>
                                <li>
                                    <?php echo esc_html__('Key visuals & POSM', 'innovio_child'); ?>
                                </li>
                                <li>
                                    <?php echo esc_html__('Viral videos & TVCs', 'innovio_child'); ?>
                                </li>
                                <li>
                                    <?php echo esc_html__('Social media design', 'innovio_child'); ?>
                                </li>
                            </ul>
                        </div>

                        <div class="thankyou-service-box">
                            <div class="thankyou-service-icon">🚀</div>
                            <h4>
                                <?php echo esc_html__('Campaign Management', 'innovio_child'); ?>
                            </h4>
                            <ul>
                                <li>
                                    <?php echo esc_html__('Marketing campaign execution', 'innovio_child'); ?>
                                </li>
                                <li>
                                    <?php echo esc_html__('Sales kits & websites', 'innovio_child'); ?>
                                </li>
                                <li>
                                    <?php echo esc_html__('Product launch planning', 'innovio_child'); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <p class="thankyou-popup-legal">
                    <strong>
                        <?php echo esc_html__('Legal Note:', 'innovio_child'); ?>
                    </strong>
                    <?php echo esc_html__('By downloading this professional resource, you agree to join Digital Mind’s business network. We are committed to protecting your information and will use it solely to share relevant market updates, trends, and solutions. (You may unsubscribe at any time.)', 'innovio_child'); ?>
                </p>
            </div>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'digitalmind_add_research_popup_form');

require_once get_stylesheet_directory() . '/includes/newsletter-popup.php';
