(function ($) {
    "use strict";

    // ========================================
    // UTILITY FUNCTIONS
    // Cookie management, toast notifications
    // ========================================

    function setCookie(name, value, days) {
        const expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = name + '=' + encodeURIComponent(value) + ';expires=' + expires.toUTCString() + ';path=/';
    }

    function getCookie(name) {
        const nameEQ = name + '=';
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
        }
        return null;
    }

    function showToast(message, type) {
        const toast = document.getElementById('toastNotification');
        if (!toast) return;

        const toastIcon = toast.querySelector('.toast-icon');
        const toastText = toast.querySelector('.toast-text');

        toast.classList.remove('show', 'warning');

        if (type === 'warning') {
            toast.classList.add('warning');
            if (toastIcon) toastIcon.textContent = '⚠️';
        } else {
            if (toastIcon) toastIcon.textContent = '✓';
        }

        if (toastText) toastText.textContent = message;

        setTimeout(function () {
            toast.classList.add('show');
        }, 10);

        setTimeout(function () {
            toast.classList.remove('show', 'warning');
        }, 5000);
    }

    window.dmSetCookie = setCookie;
    window.dmGetCookie = getCookie;
    window.dmShowToast = showToast;
    window.dmSetCookieValue = setCookie;

    // ========================================
    // POPUP MANAGEMENT
    // Generic popup show/hide functions
    // ========================================

    /**
     * Show popup by ID with consistent animation
     */
    function showPopup(popupId) {
        var $popup = $(popupId);
        if (!$popup.length) return;

        $popup.addClass('show');
        setTimeout(function () {
            $popup.addClass('visible');
        }, 10);
        $('body').css('overflow', 'hidden');
    }

    /**
     * Hide popup by ID with consistent animation
     */
    function hidePopup(popupId) {
        var $popup = $(popupId);
        if (!$popup.length) return;

        $popup.removeClass('visible');
        setTimeout(function () {
            $popup.removeClass('show');
        }, 300);
        $('body').css('overflow', '');
    }

    // Specific popup functions using common logic
    function showNewsletterPopup() {
        var reportId = $('#newsletterForm').data('report-id');
        var $title = $('.newsletter-popup-main-title');
        var $btnText = $('.newsletter-submit-btn span');

        if (reportId && reportId > 0) {
            // Download flow
            $title.html(subscribeEmail.lang_key.fill_info_to_download);
            $btnText.html(subscribeEmail.lang_key.download);
        } else {
            // Subscribe flow - reset to default texts
            $title.html(subscribeEmail.lang_key.newsletter_title);
            $btnText.html(subscribeEmail.lang_key.subscribe);
        }

        showPopup('#newsletterPopup');
    }

    function hideNewsletterPopup() {
        hidePopup('#newsletterPopup');
    }

    function showThankYouPopup() {
        showPopup('#thankYouPopup');
    }


    // ========================================
    // DOWNLOAD FUNCTIONS
    // ========================================

    function requestSecureDownload(reportId) {
        if (!reportId) {
            return;
        }

        $.ajax({
            url: subscribeEmail.ajaxurl,
            type: 'POST',
            data: {
                action: 'dm_get_secure_download_link',
                nonce: subscribeEmail.download_nonce,
                report_id: reportId
            },
            success: function (response) {
                if (response.success && response.data.download_url) {
                    window.location.href = response.data.download_url;
                } else {
                    showToast(response.data.message || 'Download failed', 'warning');
                }
            },
            error: function () {
                showToast(subscribeEmail.lang_key.server_error, 'warning');
            }
        });
    }

    var downloadCompleteTriggered = false;
    function updateDownloadComplete() {
        if (downloadCompleteTriggered) return;
        downloadCompleteTriggered = true;

        var $title = $('#thankYouTitle');
        var $desc = $('#thankYouDesc');

        if ($title.length) $title.text(subscribeEmail.lang_key.download_complete_title);
        if ($desc.length) $desc.text(subscribeEmail.lang_key.download_complete);

        setTimeout(function () {
            var $popup = $('#thankYouPopup');
            $popup.removeClass('visible');
            setTimeout(function () {
                $popup.removeClass('show');
                if ($title.length) $title.text(subscribeEmail.lang_key.sent_successfully);
                if ($desc.length) $desc.text(subscribeEmail.lang_key.report_downloading);
                downloadCompleteTriggered = false;
            }, 300);
        }, 100000);
    }

    $(document).on('click', '#thankYouPopupClose, .thankyou-popup-overlay', function (e) {
        if (e.target === this || this.id === 'thankYouPopupClose') {
            hidePopup('#thankYouPopup');
        }
    });

    // ========================================
    // SOCIAL LOGIN & HELPER FUNCTIONS
    // ========================================

    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidVietnamPhone(phone) {
        var phoneRegex = /^(0|\+84)(\d{9,10})$/;
        var cleanPhone = phone.replace(/[\s\-\.]/g, '');
        return phoneRegex.test(cleanPhone);
    }

    function checkRequiredFields($container) {
        var isValid = true;
        var $requiredFields = $container.find('input[required], select[required]');

        $requiredFields.each(function () {
            var $field = $(this);
            var value = $field.val();

            // Handle trim if it's a string
            if (value && typeof value === 'string') {
                value = value.trim();
            }

            if (!value) {
                isValid = false;
                $field.addClass('error');
                $('#error-' + $field.attr('id')).removeClass('hidden');
            }
        });

        return isValid;
    }


    function handleSocialLoginSuccess() {
        setCookie('research_email_verified', 'true', 365);
        showToast(subscribeEmail.lang_key.login_success_reloading);

        const savedPostId = getCookie('dm_social_login_post_id');
        document.cookie = 'dm_social_login_post_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';

        const source = getCookie('dm_source') || 'download';

        const isEnglish = window.location.pathname.startsWith('/en/');
        const pathSuccess = isEnglish ? '/en/thanks-you-for-subscribe/' : '/dang-ky-thanh-cong/';

        let redirectUrl = pathSuccess;

        if (savedPostId) {
            redirectUrl = pathSuccess + '?report_id=' + savedPostId;
        }

        setTimeout(function () {
            window.location.href = redirectUrl;
        }, 500);
    }

    function checkAndPrefillForm() {
        var $form = $('#dm-research-register-form');
        if (!$form.length) return;

        var $nameInput = $form.find('input[name="user_name"]');
        var $emailInput = $form.find('input[name="user_email"]');
        var $btn = $form.find('.dm-submit-btn');

        var savedName = getCookie('dm_user_name');
        var savedEmail = getCookie('dm_user_email');

        if (savedName && savedEmail) {
            $nameInput.val(savedName);
            $emailInput.val(savedEmail);
            $btn.text(subscribeEmail.lang_key.confirm);
            if (!$form.find('input[name="is_logged_in_action"]').length) {
                $form.append('<input type="hidden" name="is_logged_in_action" value="1">');
            }
        }
    }

    // ========================================
    // FORM HANDLERS & DOWNLOAD LOGIC
    // ========================================
    $(document).ready(function () {
        const urlParams = new URLSearchParams(window.location.search);
        const isSocialLoginSuccess = urlParams.get('social_login') === 'success';
        const isFromEmail = getCookie('dm_from_email') === 'true';
        const fromEmailDownloadReportId = getCookie('dm_from_email_download');
        const showThankYou = getCookie('dm_show_thankyou') === 'true';
        const autoDownloadUrl = getCookie('dm_auto_download_url');
        const isFromMail = getCookie('utm_source') === 'mail';

        const isThankYouPage = window.location.pathname.includes('thank-you') ||
            window.location.pathname.includes('cam-on') ||
            window.location.pathname.includes('thankyou') ||
            window.location.pathname.includes('dang-ky-thanh-cong') ||
            window.location.pathname.includes('thanks-you-for-subscribe');

        if (autoDownloadUrl && showThankYou && isFromMail && !isThankYouPage) {
            document.cookie = 'dm_auto_download_url=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'dm_show_thankyou=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'utm_source=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';

            setTimeout(function () {
                showThankYouPopup();
            }, 300);

            setTimeout(function () {
                var iframe = document.createElement('iframe');
                iframe.style.display = 'none';

                iframe.onload = function () {
                    updateDownloadComplete();
                };

                setTimeout(function () {
                    updateDownloadComplete();
                }, 2000);

                iframe.src = decodeURIComponent(autoDownloadUrl);
                document.body.appendChild(iframe);
            }, 500);
        } else if (showThankYou && isFromMail && !isThankYouPage) {
            document.cookie = 'dm_show_thankyou=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'utm_source=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            setTimeout(function () {
                showThankYouPopup();
            }, 500);
        } else if (showThankYou || autoDownloadUrl) {
            document.cookie = 'dm_show_thankyou=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'dm_auto_download_url=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            document.cookie = 'utm_source=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        }

        checkAndPrefillForm();

        if (isFromEmail) {
            document.cookie = 'dm_from_email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';

            if (fromEmailDownloadReportId) {
                var $form = $('#dm-research-register-form');
                if ($form.length) {
                    $form.attr('data-from-email-download', fromEmailDownloadReportId);
                    var $postIdInput = $form.find('input[name="current_post_id"]');
                    if ($postIdInput.length) {
                        $postIdInput.val(fromEmailDownloadReportId);
                    }
                }
            }

            if (!showThankYou && !autoDownloadUrl && !isFromMail) {
                setTimeout(function () {
                    showPopup('#researchPopup');
                }, 500);
            }
        }

        let currentReportId = (typeof subscribeEmail !== 'undefined' && subscribeEmail.current_report_id) ? subscribeEmail.current_report_id : '';

        if (window.location.pathname.includes('dang-ky-thanh-cong') || window.location.pathname.includes('thanks-you-for-subscribe')) {
            const dmSource = getCookie('dm_source') || subscribeEmail.dm_source || '';
            const $subtitle = $('.thankyou-subtitle');
            const $downloadBtn = $('.report-download-btn');

            if (dmSource === 'download' && currentReportId) {
                if ($subtitle.length) $subtitle.show();
                if ($downloadBtn.length) $downloadBtn.hide();
                requestSecureDownload(currentReportId);
            } else {
                if ($subtitle.length) $subtitle.hide();
                if ($downloadBtn.length) $downloadBtn.show();
            }

            document.cookie = 'dm_source=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        }



        if (isSocialLoginSuccess && typeof socialLoginData !== 'undefined' && socialLoginData.isLoggedIn && socialLoginData.userEmail) {
            const cleanUrl = window.location.origin + window.location.pathname;
            window.history.replaceState({}, document.title, cleanUrl);
            setTimeout(function () {
                showToast(subscribeEmail.lang_key.login_success_reloading);
                window.location.reload();
            }, 500);
        }

        var $form = $('#dm-research-register-form');
        if ($form.length) {
            var $nameInput = $form.find('input[name="user_name"]');
            var $emailInput = $form.find('input[name="user_email"]');
            var $btn = $form.find('.dm-submit-btn');

            $form.on('submit', function (e) {
                e.preventDefault();
                var originalBtnText = $btn.text();
                var fromEmailDownloadId = $form.attr('data-from-email-download');

                $btn.prop('disabled', true).text(subscribeEmail.lang_key.processing);

                $.ajax({
                    url: subscribeEmail.ajaxurl,
                    type: 'POST',
                    data: $form.serialize() + '&action=dm_register_user',
                    success: function (response) {
                        if (response.success) {
                            showToast(response.data.message, 'success');

                            setCookie('research_email_verified', 'true', 365);
                            if ($nameInput.val()) setCookie('dm_user_name', $nameInput.val(), 365);
                            if ($emailInput.val()) setCookie('dm_user_email', $emailInput.val(), 365);

                            if (fromEmailDownloadId && response.data.download_url) {
                                document.cookie = 'dm_from_email_download=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                                hidePopup('#researchPopup');

                                setTimeout(function () {
                                    window.location.href = response.data.download_url;
                                }, 500);
                            } else {
                                hidePopup('#researchPopup');
                                setTimeout(function () {
                                    if (response.data.redirect_url) {
                                        window.location.href = response.data.redirect_url;
                                    }
                                }, 500);
                            }
                        } else {
                            showToast(response.data.message, 'warning');
                            $btn.prop('disabled', false).text(originalBtnText);
                        }
                    },
                    error: function () {
                        showToast(subscribeEmail.lang_key.server_error, 'warning');
                        $btn.prop('disabled', false).text(originalBtnText);
                    }
                });
            });
        }

        $(document).on('click', '.menu-item-subscribe > a, a[href="#research-popup"]', function (e) {
            e.preventDefault();
            setCookie('dm_source', 'subscribe', 1);
            showNewsletterPopup();
        });

        $('#researchPopupClose, .research-popup-overlay').on('click', function (e) {
            if (e.target === this || this.id === 'researchPopupClose') {
                hidePopup('#researchPopup');
            }
        });

        $(document).on('keyup', function (e) {
            if (e.key === 'Escape') {
                hidePopup('#researchPopup');
            }
        });

        const socialButtons = document.querySelectorAll('.research-popup-social .popup-trigger');
        socialButtons.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                const postIdInput = document.querySelector('input[name="current_post_id"]');
                if (postIdInput && postIdInput.value) {
                    setCookie('dm_social_login_post_id', postIdInput.value, 1);
                }

                let url = this.getAttribute('href');
                const width = 600;
                const height = 600;
                const left = (window.innerWidth - width) / 2;
                const top = (window.innerHeight - height) / 2;
                window.open(url, 'socialLoginPopup', `width=${width},height=${height},top=${top},left=${left},resizable=yes,scrollbars=yes,status=yes`);
            });
        });
    });

    document.addEventListener('click', function (e) {
        const btn = e.target.closest('#btnDownloadResearch');
        if (e.target && (e.target.id === 'btnDownloadResearch' || btn)) {
            e.preventDefault();
            const targetBtn = btn || e.target;
            setCookie('dm_source', 'download', 1);
            const reportId = targetBtn.getAttribute('data-report-id');

            if (reportId) {
                $('#newsletterForm').data('report-id', reportId);
            }

            if (typeof subscribeEmail !== 'undefined' && subscribeEmail.is_logged_in) {
                const isEnglish = window.location.pathname.startsWith('/en/');
                const thankYouPath = isEnglish ? '/en/thanks-you-for-subscribe/' : '/dang-ky-thanh-cong/';
                window.location.href = thankYouPath + '?report_id=' + reportId;
            } else {
                showNewsletterPopup();
            }
        }
    });

    window.addEventListener('message', function (event) {
        if (event.data === 'social_login_success') {
            handleSocialLoginSuccess();
        } else if (event.data && event.data.type === 'linkedin_login_success' && event.data.redirect_url) {
            setCookie('research_email_verified', 'true', 365);
            window.location.href = event.data.redirect_url;
        }
    });

    window.addEventListener('storage', function (event) {
        if (event.key === 'social_login_status' && event.newValue && event.newValue.startsWith('success_')) {
            localStorage.removeItem('social_login_status');
            handleSocialLoginSuccess();
        }
    });

    $(document).ready(function () {
        var $unsubPopup = $('#unsubscribePopup');

        if ($unsubPopup.length) {
            $('#unsubscribePopupClose, .unsubscribe-popup-overlay').on('click', function (e) {
                if (e.target === this || this.id === 'unsubscribePopupClose') {
                    $unsubPopup.removeClass('active');
                }
            });

            $unsubPopup.on('change', 'input[name="unsub_reason"]', function () {
                var $otherInput = $unsubPopup.find('.dm-other-reason-input');
                if ($(this).val() === 'Other') {
                    $otherInput.fadeIn();
                } else {
                    $otherInput.fadeOut();
                }
            });
        }

        const isFromUnsubscribe = getCookie('dm_from_email_unsubscribe');
        if (isFromUnsubscribe) {
            $unsubPopup.addClass('active');

            const emailCookie = getCookie('dm_user_email_unsubscribe');
            if (emailCookie) {
                $('#dm_unsub_email').val(decodeURIComponent(emailCookie));
            }
        }

        $('#dm_unsub_form').on('submit', function (e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('button[type="submit"]');
            var originalText = $btn.text();

            $btn.prop('disabled', true).text('Processing...');

            var formData = $form.serialize();
            formData += '&action=dm_unsubscribe';
            formData += '&nonce=' + $('#dm_unsub_nonce_field').val();

            $.ajax({
                url: subscribeEmail.ajaxurl,
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        showToast(response.message, 'success');
                        setTimeout(function () {
                            $('#unsubscribePopup').removeClass('active');
                            location.reload(); // Optional
                        }, 2000);
                    } else {
                        showToast(response.message, 'warning');
                        $btn.prop('disabled', false).text(originalText);
                    }
                },
                error: function () {
                    showToast(subscribeEmail.lang_key.server_error, 'warning');
                    $btn.prop('disabled', false).text(originalText);
                }
            });
        });

    });



    // ========================================
    // NEWSLETTER POPUP HANDLERS
    // ========================================
    $(document).ready(function () {
        var $newsletterPopup = $('#newsletterPopup');
        var $newsletterForm = $('#newsletterForm');

        $(document).on('click', '#subscribeNewsLetter', function (e) {
            e.preventDefault();
            $('#newsletterForm').removeData('report-id');
            showNewsletterPopup();
        });

        $('#newsletterPopupClose').on('click', hideNewsletterPopup);

        $newsletterPopup.on('click', function (e) {
            if (e.target === this) hideNewsletterPopup();
        });

        $(document).on('keyup', function (e) {
            if (e.key === 'Escape' && $newsletterPopup.hasClass('show')) {
                hideNewsletterPopup();
            }
        });

        $newsletterForm.on('submit', function (e) {
            e.preventDefault();
            var isValid = true;
            var errorMessages = [];

            $newsletterForm.find('.newsletter-error').addClass('hidden');
            $newsletterForm.find('.newsletter-input, .newsletter-select').removeClass('error');

            var isDownloadFlow = $newsletterForm.data('report-id') && $newsletterForm.data('report-id') > 0;

            if (isDownloadFlow) {
                // Simplified validation for download: only name + email
                var $nameField = $('#nl_fullname');
                var $emailField = $('#nl_email');

                if (!$nameField.val() || $nameField.val().trim() === '') {
                    isValid = false;
                    $nameField.addClass('error');
                    $('#error-nl_fullname').removeClass('hidden');
                }

                var emailVal = $emailField.val() ? $emailField.val().trim() : '';
                if (!emailVal) {
                    isValid = false;
                    $emailField.addClass('error');
                    $('#error-nl_email').removeClass('hidden');
                } else if (!isValidEmail(emailVal)) {
                    isValid = false;
                    $emailField.addClass('error');
                    $('#error-nl_email').removeClass('hidden');
                    errorMessages.push('Email không hợp lệ.');
                }
            } else {
                // Full validation for newsletter subscription
                isValid = checkRequiredFields($newsletterForm);

                var $emailField = $('#nl_email');
                var emailVal = $emailField.val() ? $emailField.val().trim() : '';
                if (emailVal && !isValidEmail(emailVal)) {
                    isValid = false;
                    $emailField.addClass('error');
                    $('#error-nl_email').removeClass('hidden');
                    errorMessages.push('Email không hợp lệ.');
                }

                var checkedInterests = $newsletterForm.find('input[name="interests[]"]:checked').length;
                if (checkedInterests === 0) {
                    isValid = false;
                    $('#error-interests').removeClass('hidden');
                } else {
                    $('#error-interests').addClass('hidden');
                }
            }

            if (!isValid) {
                if (errorMessages.length > 0) {
                    showToast(errorMessages[0], 'warning');
                } else {
                    showToast('Vui lòng kiểm tra lại thông tin.', 'warning');
                }
                return false;
            }

            var $submitBtn = $newsletterForm.find('.newsletter-submit-btn');
            var originalText = $submitBtn.find('span').text();

            $submitBtn.prop('disabled', true);
            $submitBtn.find('span').text('Đang xử lý...');

            var ajaxData = {
                action: 'dm_register_user',
                dm_register_nonce: subscribeEmail.register_nonce,
                user_name: $('#nl_fullname').val(),
                user_email: $('#nl_email').val(),
                current_post_id: $newsletterForm.data('report-id') || 0
            };

            $newsletterForm.serializeArray().forEach(function (field) {
                if (field.name !== 'fullname' && field.name !== 'email' && field.name !== 'dm_newsletter_nonce') {
                    ajaxData[field.name] = field.value;
                }
            });

            $.ajax({
                type: 'POST',
                url: subscribeEmail.ajaxurl,
                data: ajaxData,
                success: function (response) {
                    if (response.success) {
                        showToast('Đăng ký nhận báo cáo thành công!', 'success');
                        hideNewsletterPopup();
                        $newsletterForm[0].reset();
                        if (response.data && response.data.redirect_url) {
                            window.location.href = response.data.redirect_url;
                        } else {
                            window.location.reload();
                        }
                    } else {
                        showToast(response.data.message || 'Error occurred.', 'error');
                        $submitBtn.prop('disabled', false);
                        $submitBtn.find('span').text(originalText);
                    }
                },
                error: function () {
                    showToast('Connection error. Please try again.', 'error');
                    $submitBtn.prop('disabled', false);
                    $submitBtn.find('span').text(originalText);
                }
            });
        });

        $newsletterForm.on('input change', 'input, select', function () {
            $(this).removeClass('error');
            $('#error-' + $(this).attr('id')).addClass('hidden');

            if ($(this).attr('name') === 'interests[]') {
                $('#error-interests').addClass('hidden');
            }
        });

    });

})(jQuery);