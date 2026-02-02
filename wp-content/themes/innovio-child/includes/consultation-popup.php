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
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                        </svg> -->
                    </button>

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
