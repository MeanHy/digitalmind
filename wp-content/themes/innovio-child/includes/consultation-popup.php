<?php
/**
 * Consultation Popup Template for Digital Mind
 * Form đăng ký tư vấn chiến lược Digital Marketing
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Consultation Popup Form
 */
function digitalmind_add_consultation_popup()
{
    ?>
    <div class="consultation-popup-overlay" id="consultationPopup">
        <div class="consultation-popup-container">
            <button class="consultation-popup-close" id="consultationPopupClose">&times;</button>

            <div class="consultation-popup-header">
                <div class="consultation-header-circle-1"></div>
                <div class="consultation-header-circle-2"></div>
                <h1 class="consultation-popup-main-title">
                    <?php echo esc_html__('Register for Digital Marketing Strategy Consultation', 'innovio_child'); ?>
                </h1>
                <p class="consultation-popup-subtitle">
                    "
                    <?php echo esc_html__('Please share your business goals and challenges. Our expert team will review your information and respond with a preliminary solution within 24 business hours.', 'innovio_child'); ?>"
                </p>
            </div>

            <form id="consultationForm" class="consultation-form" novalidate>
                <?php wp_nonce_field('dm_consultation_action', 'dm_consultation_nonce'); ?>

                <section class="consultation-section">
                    <h2 class="consultation-section-header">
                        <?php echo esc_html__('Section 1: Contact Information', 'innovio_child'); ?>
                        <span class="consultation-required-label">(
                            <?php echo esc_html__('Required', 'innovio_child'); ?>)
                        </span>
                    </h2>

                    <div class="consultation-form-row">
                        <div class="consultation-form-group">
                            <label for="fullname" class="consultation-label">
                                1.
                                <?php echo esc_html__('Full Name', 'innovio_child'); ?> <span class="required">*</span>
                            </label>
                            <input type="text" id="fullname" name="fullname" required class="consultation-input">
                            <p class="consultation-error hidden" id="error-fullname">
                                <?php echo esc_html__('Please enter your full name.', 'innovio_child'); ?>
                            </p>
                        </div>

                        <div class="consultation-form-group">
                            <label for="email" class="consultation-label">
                                2.
                                <?php echo esc_html__('Business Email', 'innovio_child'); ?> <span class="required">*</span>
                            </label>
                            <input type="email" id="consultation_email" name="email" required class="consultation-input">
                            <p class="consultation-error hidden" id="error-email">
                                <?php echo esc_html__('Please enter a valid email address.', 'innovio_child'); ?>
                            </p>
                        </div>
                    </div>

                    <div class="consultation-form-row">
                        <div class="consultation-form-group">
                            <label for="phone" class="consultation-label">
                                3.
                                <?php echo esc_html__('Phone Number / Zalo', 'innovio_child'); ?> <span
                                    class="required">*</span>
                            </label>
                            <input type="tel" id="phone" name="phone" required class="consultation-input">
                            <p class="consultation-error hidden" id="error-phone">
                                <?php echo esc_html__('Please enter your phone number.', 'innovio_child'); ?>
                            </p>
                        </div>

                        <div class="consultation-form-group">
                            <label for="jobtitle" class="consultation-label">
                                4.
                                <?php echo esc_html__('Your Job Title', 'innovio_child'); ?> <span class="required">*</span>
                            </label>
                            <input type="text" id="jobtitle" name="jobtitle" required class="consultation-input">
                            <p class="consultation-error hidden" id="error-jobtitle">
                                <?php echo esc_html__('Please enter your job title.', 'innovio_child'); ?>
                            </p>
                        </div>
                    </div>
                </section>

                <section class="consultation-section consultation-section-border">
                    <h2 class="consultation-section-header">
                        <?php echo esc_html__('Section 2: Business Information & Project Details', 'innovio_child'); ?>
                    </h2>

                    <div class="consultation-form-row">
                        <div class="consultation-form-group">
                            <label for="company" class="consultation-label">
                                5.
                                <?php echo esc_html__('Company / Brand Name', 'innovio_child'); ?>
                            </label>
                            <input type="text" id="company" name="company" class="consultation-input">
                        </div>

                        <div class="consultation-form-group">
                            <label for="website" class="consultation-label">
                                6.
                                <?php echo esc_html__('Website or Primary Fanpage Link', 'innovio_child'); ?>
                            </label>
                            <div class="consultation-input-with-icon">
                                <span class="consultation-input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                                        <path
                                            d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z" />
                                    </svg>
                                </span>
                                <input type="url" id="website" name="website"
                                    class="consultation-input consultation-input-icon-left">
                            </div>
                        </div>
                    </div>

                    <div class="consultation-form-group consultation-form-group-full">
                        <label class="consultation-label">
                            7.
                            <?php echo esc_html__('Which services are you interested in? (Multiple selections allowed)', 'innovio_child'); ?>
                        </label>
                        <div class="consultation-checkbox-grid">

                            <label class="consultation-checkbox-item">
                                <input type="checkbox" name="services[]" value="Integrated Planning"
                                    class="consultation-checkbox-input">
                                <div class="consultation-checkbox-box">
                                    <span class="consultation-checkbox-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                        </svg>
                                    </span>
                                    <span class="consultation-checkbox-text">
                                        <?php echo esc_html__('Integrated Strategy Consulting', 'innovio_child'); ?>
                                    </span>
                                </div>
                            </label>

                            <label class="consultation-checkbox-item">
                                <input type="checkbox" name="services[]" value="Social Media"
                                    class="consultation-checkbox-input">
                                <div class="consultation-checkbox-box">
                                    <span class="consultation-checkbox-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                        </svg>
                                    </span>
                                    <span class="consultation-checkbox-text">
                                        <?php echo esc_html__('Social Media & Community Management', 'innovio_child'); ?>
                                    </span>
                                </div>
                            </label>

                            <label class="consultation-checkbox-item">
                                <input type="checkbox" name="services[]" value="Performance Ads"
                                    class="consultation-checkbox-input">
                                <div class="consultation-checkbox-box">
                                    <span class="consultation-checkbox-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                        </svg>
                                    </span>
                                    <span class="consultation-checkbox-text">
                                        <?php echo esc_html__('Performance Marketing (Paid Advertising)', 'innovio_child'); ?>
                                    </span>
                                </div>
                            </label>

                            <label class="consultation-checkbox-item">
                                <input type="checkbox" name="services[]" value="Content & Creative"
                                    class="consultation-checkbox-input">
                                <div class="consultation-checkbox-box">
                                    <span class="consultation-checkbox-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                        </svg>
                                    </span>
                                    <span class="consultation-checkbox-text">
                                        <?php echo esc_html__('Content Marketing & Creative Production', 'innovio_child'); ?>
                                    </span>
                                </div>
                            </label>

                            <label class="consultation-checkbox-item">
                                <input type="checkbox" name="services[]" value="SEO" class="consultation-checkbox-input">
                                <div class="consultation-checkbox-box">
                                    <span class="consultation-checkbox-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                        </svg>
                                    </span>
                                    <span class="consultation-checkbox-text">
                                        <?php echo esc_html__('SEO (Search Engine Optimization)', 'innovio_child'); ?>
                                    </span>
                                </div>
                            </label>

                            <label class="consultation-checkbox-item">
                                <input type="checkbox" name="services[]" value="Branding"
                                    class="consultation-checkbox-input">
                                <div class="consultation-checkbox-box">
                                    <span class="consultation-checkbox-check">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                        </svg>
                                    </span>
                                    <span class="consultation-checkbox-text">
                                        <?php echo esc_html__('Branding & Brand Identity', 'innovio_child'); ?>
                                    </span>
                                </div>
                            </label>

                        </div>
                    </div>
                </section>


                <section class="consultation-section consultation-section-border">
                    <h2 class="consultation-section-header">
                        <?php echo esc_html__('Part 3: Budget & Timeline', 'innovio_child'); ?>
                    </h2>

                    <div class="consultation-form-row">
                        <div class="consultation-form-group">
                            <label for="budget" class="consultation-label">
                                8.
                                <?php echo esc_html__('What is your budget?', 'innovio_child'); ?>
                            </label>
                            <div class="consultation-select-wrapper">
                                <select id="budget" name="budget" class="consultation-select">
                                    <option value="" disabled selected>--
                                        <?php echo esc_html__('Select your estimated budget', 'innovio_child'); ?> --
                                    </option>
                                    <option value="<50m">
                                        <?php echo esc_html__('Under 50 million VND', 'innovio_child'); ?>
                                    </option>
                                    <option value="50m-200m">
                                        <?php echo esc_html__('50 million – 200 million VND', 'innovio_child'); ?>
                                    </option>
                                    <option value="200m-500m">
                                        <?php echo esc_html__('200 million – 500 million VND', 'innovio_child'); ?>
                                    </option>
                                    <option value="500m-1b">
                                        <?php echo esc_html__('500 million – 1 billion VND', 'innovio_child'); ?>
                                    </option>
                                    <option value=">1b">
                                        <?php echo esc_html__('Over 1 billion VND', 'innovio_child'); ?>
                                    </option>

                                </select>
                                <span class="consultation-select-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="consultation-form-group">
                            <label class="consultation-label">
                                9.
                                <?php echo esc_html__('When would you like to start?', 'innovio_child'); ?>
                            </label>
                            <div class="consultation-radio-group">
                                <label class="consultation-radio-item">
                                    <input type="radio" name="timeline" value="ASAP" class="consultation-radio-input">
                                    <span class="consultation-radio-circle"></span>
                                    <span class="consultation-radio-text">
                                        <?php echo esc_html__('As soon as possible (ASAP)', 'innovio_child'); ?>
                                    </span>
                                </label>

                                <label class="consultation-radio-item">
                                    <input type="radio" name="timeline" value="1_month" class="consultation-radio-input">
                                    <span class="consultation-radio-circle"></span>
                                    <span class="consultation-radio-text">
                                        <?php echo esc_html__('Within the next month', 'innovio_child'); ?>
                                    </span>
                                </label>

                                <label class="consultation-radio-item">
                                    <input type="radio" name="timeline" value="next_quarter"
                                        class="consultation-radio-input">
                                    <span class="consultation-radio-circle"></span>
                                    <span class="consultation-radio-text">
                                        <?php echo esc_html__('Next quarter', 'innovio_child'); ?>
                                    </span>
                                </label>

                                <label class="consultation-radio-item">
                                    <input type="radio" name="timeline" value="researching"
                                        class="consultation-radio-input">
                                    <span class="consultation-radio-circle"></span>
                                    <span class="consultation-radio-text">
                                        <?php echo esc_html__('Just exploring / researching options', 'innovio_child'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>

                    </div>
                </section>

                <section class="consultation-section consultation-section-border">
                    <h2 class="consultation-section-header">
                        <?php echo esc_html__('Section 4: Understanding Your Needs (Insight)', 'innovio_child'); ?>
                    </h2>

                    <div class="consultation-form-group consultation-form-group-full">
                        <label for="challenges" class="consultation-label">
                            10.
                            <?php echo esc_html__('What is the biggest challenge your business is currently facing?', 'innovio_child'); ?>
                        </label>
                        <textarea id="challenges" name="challenges" rows="4" class="consultation-textarea"></textarea>
                    </div>
                </section>


                <div class="consultation-footer">
                    <button type="submit" class="consultation-submit-btn">
                        <span>
                            <?php echo esc_html__('Submit & Get Free Consultation', 'innovio_child'); ?>
                        </span>
                    </button>

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
                                <path fill="#2962ff" d="M15,36V6.827l-1.211-0.811C8.64,8.083,5,13.112,5,19v10c0,7.732,6.268,14,14,14h10	c4.722,0,8.883-2.348,11.417-5.931V36H15z"></path>
                                <path fill="#eee" d="M29,5H19c-1.845,0-3.601,0.366-5.214,1.014C10.453,9.25,8,14.528,8,19	c0,6.771,0.936,10.735,3.712,14.607c0.216,0.301,0.357,0.653,0.376,1.022c0.043,0.835-0.129,2.365-1.634,3.742	c-0.162,0.148-0.059,0.419,0.16,0.428c0.942,0.041,2.843-0.014,4.797-0.877c0.557-0.246,1.191-0.203,1.729,0.083	C20.453,39.764,24.333,40,28,40c4.676,0,9.339-1.04,12.417-2.916C42.038,34.799,43,32.014,43,29V19C43,11.268,36.732,5,29,5z"></path>
                                <path fill="#2962ff" d="M36.75,27C34.683,27,33,25.317,33,23.25s1.683-3.75,3.75-3.75s3.75,1.683,3.75,3.75	S38.817,27,36.75,27z M36.75,21c-1.24,0-2.25,1.01-2.25,2.25s1.01,2.25,2.25,2.25S39,24.49,39,23.25S37.99,21,36.75,21z"></path>
                                <path fill="#2962ff" d="M31.5,27h-1c-0.276,0-0.5-0.224-0.5-0.5V18h1.5V27z"></path>
                                <path fill="#2962ff" d="M27,19.75v0.519c-0.629-0.476-1.403-0.769-2.25-0.769c-2.067,0-3.75,1.683-3.75,3.75	S22.683,27,24.75,27c0.847,0,1.621-0.293,2.25-0.769V26.5c0,0.276,0.224,0.5,0.5,0.5h1v-7.25H27z M24.75,25.5	c-1.24,0-2.25-1.01-2.25-2.25S23.51,21,24.75,21S27,22.01,27,23.25S25.99,25.5,24.75,25.5z"></path>
                                <path fill="#2962ff" d="M21.25,18h-8v1.5h5.321L13,26h0.026c-0.163,0.211-0.276,0.463-0.276,0.75V27h7.5	c0.276,0,0.5-0.224,0.5-0.5v-1h-5.321L21,19h-0.026c0.163-0.211,0.276-0.463,0.276-0.75V18z"></path>
                            </svg>
                        </a>
                    </div>

                    <p class="consultation-privacy-note">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                        </svg>
                        <?php echo esc_html__('Your information is kept confidential in accordance with our privacy policy.', 'innovio_child'); ?>
                    </p>
                </div>

            </form>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'digitalmind_add_consultation_popup');
