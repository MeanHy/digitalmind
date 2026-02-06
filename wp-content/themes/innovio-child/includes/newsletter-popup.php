<?php
/**
 * Newsletter Subscription Popup Template for Digital Mind
 * Form đăng ký nhận báo cáo & xu hướng Marketing
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Newsletter Subscription Popup Form
 */
function digitalmind_add_newsletter_popup()
{
    ?>
    <div class="newsletter-popup-overlay" id="newsletterPopup">
        <div class="newsletter-popup-container">
            <div class="newsletter-popup-header">
                <button class="newsletter-popup-close" id="newsletterPopupClose">&times;</button>
                <div class="newsletter-header-circle-1"></div>
                <div class="newsletter-header-circle-2"></div>
                <h1 class="newsletter-popup-main-title">
                    <?php echo esc_html__('Marketing Reports & Trends', 'innovio_child'); ?>
                </h1>
                <p class="newsletter-popup-subtitle">
                    "
                    <?php echo esc_html__(
                        'To help us deliver the most relevant insights for your role and industry, please complete the expert profile below.',
                        'innovio_child'
                    ); ?>"
                </p>
            </div>

            <form id="newsletterForm" class="newsletter-form" novalidate>
                <?php wp_nonce_field('dm_newsletter_action', 'dm_newsletter_nonce'); ?>

                <section class="newsletter-section">
                    <h2 class="newsletter-section-header">
                        1.
                        <?php echo esc_html__('Identification information', 'innovio_child'); ?>
                        <span class="newsletter-section-note">(
                            <?php echo esc_html__('Basic', 'innovio_child'); ?>)
                        </span>
                    </h2>

                    <div class="newsletter-form-row">
                        <div class="newsletter-form-group">
                            <label for="nl_fullname" class="newsletter-label">
                                <?php echo esc_html__('Full name', 'innovio_child'); ?> <span class="required">*</span>
                            </label>
                            <input type="text" id="nl_fullname" name="fullname" required class="newsletter-input"
                                placeholder="<?php echo esc_attr__('Enter your full name', 'innovio_child'); ?>">
                            <p class="newsletter-error hidden" id="error-nl_fullname">
                                <?php echo esc_html__('Please enter your full name.', 'innovio_child'); ?>
                            </p>
                        </div>

                        <div class="newsletter-form-group">
                            <label for="nl_email" class="newsletter-label">
                                <?php echo esc_html__('Business email', 'innovio_child'); ?> <span class="required">*</span>
                            </label>
                            <input type="email" id="nl_email" name="email" required class="newsletter-input"
                                placeholder="name@company.com">
                            <p class="newsletter-error hidden" id="error-nl_email">
                                <?php echo esc_html__('Please enter your business email.', 'innovio_child'); ?>
                            </p>
                        </div>
                    </div>
                </section>

                <section class="newsletter-section newsletter-section-border">
                    <h2 class="newsletter-section-header">
                        2.
                        <?php echo esc_html__('Professional information', 'innovio_child'); ?>
                        <span class="newsletter-section-important">(
                            <?php echo esc_html__('Important', 'innovio_child'); ?>)
                        </span>
                    </h2>
                    <p class="newsletter-section-desc">
                        <?php echo esc_html__(
                            'This information helps us segment and deliver the most relevant resources.',
                            'innovio_child'
                        ); ?>
                    </p>

                    <div class="newsletter-form-group newsletter-form-group-full">
                        <label for="job_function" class="newsletter-label">
                            <?php echo esc_html__('Job function', 'innovio_child'); ?> <span class="required">*</span>
                        </label>
                        <div class="newsletter-select-wrapper">
                            <select id="job_function" name="job_function" required class="newsletter-select">
                                <option value="" disabled selected>--
                                    <?php echo esc_html__('Select your role', 'innovio_child'); ?> --
                                </option>
                                <option value="C-Level">
                                    <?php echo esc_html__(
                                        'C-level / Founder (Strategic insights)',
                                        'innovio_child'
                                    ); ?>
                                </option>
                                <option value="Manager">
                                    <?php echo esc_html__(
                                        'Marketing Manager / Director (Team & budget management)',
                                        'innovio_child'
                                    ); ?>
                                </option>
                                <option value="Specialist">
                                    <?php echo esc_html__(
                                        'Specialist / Executive (Technical execution)',
                                        'innovio_child'
                                    ); ?>
                                </option>
                                <option value="Student">
                                    <?php echo esc_html__('Student / Freelancer', 'innovio_child'); ?>
                                </option>
                            </select>
                            <span class="newsletter-select-arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </span>
                        </div>
                        <p class="newsletter-error hidden" id="error-job_function">
                            <?php echo esc_html__('Please select your job function.', 'innovio_child'); ?>
                        </p>
                    </div>

                    <div class="newsletter-form-row">
                        <div class="newsletter-form-group">
                            <label for="company_type" class="newsletter-label">
                                <?php echo esc_html__('Company type', 'innovio_child'); ?> <span class="required">*</span>
                            </label>
                            <div class="newsletter-select-wrapper">
                                <select id="company_type" name="company_type" required class="newsletter-select">
                                    <option value="" disabled selected>--
                                        <?php echo esc_html__('Select company type', 'innovio_child'); ?> --
                                    </option>
                                    <option value="Brand">
                                        <?php echo esc_html__('Brand / Client', 'innovio_child'); ?>
                                    </option>
                                    <option value="Agency">
                                        <?php echo esc_html__('Agency / Partner', 'innovio_child'); ?>
                                    </option>
                                    <option value="Publisher">
                                        <?php echo esc_html__('Publisher / Media', 'innovio_child'); ?>
                                    </option>
                                </select>
                                <span class="newsletter-select-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </span>
                            </div>
                            <p class="newsletter-error hidden" id="error-company_type">
                                <?php echo esc_html__('Please select a company type.', 'innovio_child'); ?>
                            </p>
                        </div>

                        <div class="newsletter-form-group">
                            <label for="industry" class="newsletter-label">
                                <?php echo esc_html__('Industry', 'innovio_child'); ?> <span class="required">*</span>
                            </label>
                            <div class="newsletter-select-wrapper">
                                <select id="industry" name="industry" required class="newsletter-select">
                                    <option value="" disabled selected>--
                                        <?php echo esc_html__('Select industry', 'innovio_child'); ?> --
                                    </option>
                                    <option value="Real Estate">
                                        <?php echo esc_html__('Real Estate', 'innovio_child'); ?>
                                    </option>
                                    <option value="FMCG">
                                        <?php echo esc_html__('FMCG / Retail', 'innovio_child'); ?>
                                    </option>
                                    <option value="Education">
                                        <?php echo esc_html__('Education', 'innovio_child'); ?>
                                    </option>
                                    <option value="Tech">
                                        <?php echo esc_html__('Technology / SaaS', 'innovio_child'); ?>
                                    </option>
                                    <option value="Other">
                                        <?php echo esc_html__('Other', 'innovio_child'); ?>
                                    </option>
                                </select>
                                <span class="newsletter-select-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </span>
                            </div>
                            <p class="newsletter-error hidden" id="error-industry">
                                <?php echo esc_html__('Please select an industry.', 'innovio_child'); ?>
                            </p>
                        </div>
                </section>

                <section class="newsletter-section newsletter-section-border">
                    <h2 class="newsletter-section-header">
                        3.
                        <?php echo esc_html__('Content preferences', 'innovio_child'); ?>
                    </h2>
                    <p class="newsletter-section-desc">
                        <?php echo esc_html__(
                            'Select up to 3 topics you are most interested in so we can personalize the content for you.',
                            'innovio_child'
                        ); ?>
                    </p>

                    <div class="newsletter-checkbox-grid" id="interests-container">
                        <label class="newsletter-checkbox-item">
                            <input type="checkbox" name="interests[]" value="Strategy"
                                class="newsletter-checkbox-input interest-checkbox">
                            <div class="newsletter-checkbox-box">
                                <span class="newsletter-checkbox-check">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </span>
                                <span class="newsletter-checkbox-text">
                                    <?php echo esc_html__('Strategy & Planning', 'innovio_child'); ?>
                                </span>
                            </div>
                        </label>

                        <label class="newsletter-checkbox-item">
                            <input type="checkbox" name="interests[]" value="Data"
                                class="newsletter-checkbox-input interest-checkbox">
                            <div class="newsletter-checkbox-box">
                                <span class="newsletter-checkbox-check">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </span>
                                <span class="newsletter-checkbox-text">
                                    <?php echo esc_html__('Data & Analytics', 'innovio_child'); ?>
                                </span>
                            </div>
                        </label>

                        <label class="newsletter-checkbox-item">
                            <input type="checkbox" name="interests[]" value="Creative"
                                class="newsletter-checkbox-input interest-checkbox">
                            <div class="newsletter-checkbox-box">
                                <span class="newsletter-checkbox-check">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </span>
                                <span class="newsletter-checkbox-text">
                                    <?php echo esc_html__('Creative & Content', 'innovio_child'); ?>
                                </span>
                            </div>
                        </label>

                        <label class="newsletter-checkbox-item">
                            <input type="checkbox" name="interests[]" value="Social"
                                class="newsletter-checkbox-input interest-checkbox">
                            <div class="newsletter-checkbox-box">
                                <span class="newsletter-checkbox-check">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </span>
                                <span class="newsletter-checkbox-text">
                                    <?php echo esc_html__('Social Media', 'innovio_child'); ?>
                                </span>
                            </div>
                        </label>

                        <label class="newsletter-checkbox-item">
                            <input type="checkbox" name="interests[]" value="SEO"
                                class="newsletter-checkbox-input interest-checkbox">
                            <div class="newsletter-checkbox-box">
                                <span class="newsletter-checkbox-check">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </span>
                                <span class="newsletter-checkbox-text">
                                    <?php echo esc_html__('SEO / SEM', 'innovio_child'); ?>
                                </span>
                            </div>
                        </label>
                    </div>

                    <p class="newsletter-error hidden" id="error-interests">
                        <?php echo esc_html__('Please select at least one topic.', 'innovio_child'); ?>
                    </p>
                </section>

                <section class="newsletter-section newsletter-section-border">
                    <h2 class="newsletter-section-header">
                        4.
                        <?php echo esc_html__('Open-ended questions', 'innovio_child'); ?>
                        <span class="newsletter-section-note">(
                            <?php echo esc_html__('Optional', 'innovio_child'); ?>)
                        </span>
                    </h2>
                    <p class="newsletter-section-desc">
                        <?php echo esc_html__(
                            'For high-intent leads – helps us better understand your business scale.',
                            'innovio_child'
                        ); ?>
                    </p>

                    <div class="newsletter-optional-box">
                        <label class="newsletter-label">
                            <?php echo esc_html__('Company size (number of employees)', 'innovio_child'); ?>
                        </label>
                        <div class="newsletter-radio-grid">
                            <label class="newsletter-radio-item">
                                <input type="radio" name="company_size" value="<50" class="newsletter-radio-input">
                                <span class="newsletter-radio-circle"></span>
                                <span class="newsletter-radio-text">
                                    <?php echo esc_html__('Under 50', 'innovio_child'); ?>
                                </span>
                            </label>

                            <label class="newsletter-radio-item">
                                <input type="radio" name="company_size" value="50-100" class="newsletter-radio-input">
                                <span class="newsletter-radio-circle"></span>
                                <span class="newsletter-radio-text">
                                    <?php echo esc_html__('50 – 100', 'innovio_child'); ?>
                                </span>
                            </label>

                            <label class="newsletter-radio-item">
                                <input type="radio" name="company_size" value="100-300" class="newsletter-radio-input">
                                <span class="newsletter-radio-circle"></span>
                                <span class="newsletter-radio-text">
                                    <?php echo esc_html__('100 – 300', 'innovio_child'); ?>
                                </span>
                            </label>

                            <label class="newsletter-radio-item">
                                <input type="radio" name="company_size" value=">300" class="newsletter-radio-input">
                                <span class="newsletter-radio-circle"></span>
                                <span class="newsletter-radio-text">
                                    <?php echo esc_html__('Over 300', 'innovio_child'); ?>
                                </span>
                            </label>
                        </div>
                    </div>
                </section>

                <div class="newsletter-submit-sticky">
                    <button type="submit" class="newsletter-submit-btn">
                        <span>
                            <?php echo esc_html__('Subscribe to our newsletter', 'innovio_child'); ?>
                        </span>
                    </button>
                </div>

                <div class="newsletter-footer">
                    <div class="research-popup-divider">
                        <span><?php echo esc_html__('or sign in with', 'innovio_child'); ?></span>
                    </div>

                    <?php
                    $popup_redirect_url = site_url('?social_login_mode=popup');
                    $fb_login_url = site_url('/wp-login.php?loginSocial=facebook&redirect=' . urlencode($popup_redirect_url));
                    $google_login_url = site_url('/wp-login.php?loginSocial=google&redirect=' . urlencode($popup_redirect_url));
                    $linkedin_login_url = class_exists('DM_LinkedIn_OAuth') ? DM_LinkedIn_OAuth::get_auth_url(get_the_ID()) : '#';
                    ?>
                    <div class="research-popup-social">
                        <a href="<?php echo esc_url($fb_login_url); ?>"
                            class="social-icon-btn social-facebook popup-trigger" title="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="<?php echo esc_url($google_login_url); ?>"
                            class="social-icon-btn social-gmail popup-trigger" title="Google">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.91 1.528-1.145C21.69 2.28 24 3.434 24 5.457z" />
                            </svg>
                        </a>
                        <a href="<?php echo esc_url($linkedin_login_url); ?>"
                            class="social-icon-btn social-linkedin popup-trigger" title="LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                        <a href="#" class="social-icon-btn social-zalo popup-trigger" title="Zalo" onclick="return false;">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                viewBox="0 0 48 48">
                                <path fill="#2962ff"
                                    d="M15,36V6.827l-1.211-0.811C8.64,8.083,5,13.112,5,19v10c0,7.732,6.268,14,14,14h10	c4.722,0,8.883-2.348,11.417-5.931V36H15z">
                                </path>
                                <path fill="#eee"
                                    d="M29,5H19c-1.845,0-3.601,0.366-5.214,1.014C10.453,9.25,8,14.528,8,19	c0,6.771,0.936,10.735,3.712,14.607c0.216,0.301,0.357,0.653,0.376,1.022c0.043,0.835-0.129,2.365-1.634,3.742	c-0.162,0.148-0.059,0.419,0.16,0.428c0.942,0.041,2.843-0.014,4.797-0.877c0.557-0.246,1.191-0.203,1.729,0.083	C20.453,39.764,24.333,40,28,40c4.676,0,9.339-1.04,12.417-2.916C42.038,34.799,43,32.014,43,29V19C43,11.268,36.732,5,29,5z">
                                </path>
                                <path fill="#2962ff"
                                    d="M36.75,27C34.683,27,33,25.317,33,23.25s1.683-3.75,3.75-3.75s3.75,1.683,3.75,3.75	S38.817,27,36.75,27z M36.75,21c-1.24,0-2.25,1.01-2.25,2.25s1.01,2.25,2.25,2.25S39,24.49,39,23.25S37.99,21,36.75,21z">
                                </path>
                                <path fill="#2962ff" d="M31.5,27h-1c-0.276,0-0.5-0.224-0.5-0.5V18h1.5V27z"></path>
                                <path fill="#2962ff"
                                    d="M27,19.75v0.519c-0.629-0.476-1.403-0.769-2.25-0.769c-2.067,0-3.75,1.683-3.75,3.75	S22.683,27,24.75,27c0.847,0,1.621-0.293,2.25-0.769V26.5c0,0.276,0.224,0.5,0.5,0.5h1v-7.25H27z M24.75,25.5	c-1.24,0-2.25-1.01-2.25-2.25S23.51,21,24.75,21S27,22.01,27,23.25S25.99,25.5,24.75,25.5z">
                                </path>
                                <path fill="#2962ff"
                                    d="M21.25,18h-8v1.5h5.321L13,26h0.026c-0.163,0.211-0.276,0.463-0.276,0.75V27h7.5	c0.276,0,0.5-0.224,0.5-0.5v-1h-5.321L21,19h-0.026c0.163-0.211,0.276-0.463,0.276-0.75V18z">
                                </path>
                            </svg>
                        </a>
                    </div>

                    <p class="newsletter-privacy-note">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                            <path
                                d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                        <?php echo esc_html__('100% privacy guaranteed. No spam.', 'innovio_child'); ?>
                    </p>
                </div>


            </form>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'digitalmind_add_newsletter_popup');
