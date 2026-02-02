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
            <button class="newsletter-popup-close" id="newsletterPopupClose">&times;</button>

            <div class="newsletter-popup-header">
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

                <div class="newsletter-footer">
                    <button type="submit" class="newsletter-submit-btn">
                        <span>
                            <?php echo esc_html__('Subscribe to receive reports', 'innovio_child'); ?>
                        </span>
                    </button>

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
