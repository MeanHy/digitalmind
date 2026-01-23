/**
 * Social Login Handler for Brevo Sync
 * Detects when user returns from social login and auto-submits their email to Brevo
 */
(function () {
    document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const isSocialLoginSuccess = urlParams.get('social_login') === 'success';

        if (isSocialLoginSuccess && typeof socialLoginData !== 'undefined' && socialLoginData.isLoggedIn && socialLoginData.userEmail) {
            // Clean the URL
            const cleanUrl = window.location.origin + window.location.pathname;
            window.history.replaceState({}, document.title, cleanUrl);

            // Wait a bit for form to be ready
            setTimeout(function () {
                autoFillAndSubmitBrevoForm(socialLoginData.userEmail);
            }, 500);
        }
    });

    function autoFillAndSubmitBrevoForm(email) {
        // Find Brevo form (sibwp_form)
        var brevoForms = document.querySelectorAll('.sib-form form, form[id*="sib-form"]');

        if (brevoForms.length === 0) {
            // Try alternative selectors
            brevoForms = document.querySelectorAll('form.sib-form-container form, .sib_signup_form');
        }

        brevoForms.forEach(function (form) {
            // Find email input
            var emailInput = form.querySelector('input[type="email"], input[name="EMAIL"], input[name="email"]');

            if (emailInput) {
                // Fill the email
                emailInput.value = email;
                emailInput.dispatchEvent(new Event('input', { bubbles: true }));
                emailInput.dispatchEvent(new Event('change', { bubbles: true }));

                // Find and click submit button
                var submitBtn = form.querySelector('button[type="submit"], input[type="submit"], .sib-form-btn');

                if (submitBtn) {
                    // Small delay before submit
                    setTimeout(function () {
                        submitBtn.click();

                        // Set cookie for research download if applicable
                        setCookieHelper('research_email_verified', 'true', 365);

                        // Show success message
                        showSocialLoginToast('Đăng ký thành công với email: ' + email);
                    }, 300);
                }
            }
        });
    }

    function setCookieHelper(name, value, days) {
        var expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = name + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
    }

    function showSocialLoginToast(message) {
        var toast = document.getElementById('toastNotification');
        if (toast) {
            var toastIcon = toast.querySelector('.toast-icon');
            var toastText = toast.querySelector('.toast-text');

            if (toastIcon) toastIcon.textContent = '✓';
            if (toastText) toastText.textContent = message;

            toast.classList.remove('warning');
            setTimeout(function () {
                toast.classList.add('show');
            }, 10);

            setTimeout(function () {
                toast.classList.remove('show');
            }, 5000);
        }
    }
})();

(function () {
    function setCookie(name, value, days) {
        const expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = name + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
    }

    function getCookie(name) {
        const nameEQ = name + '=';
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    const urlParams = new URLSearchParams(window.location.search);
    const fromBrevo = urlParams.get('from') === 'brevo' || urlParams.get('ref') === 'brevo';

    if (fromBrevo) {
        setCookie('research_email_verified', 'true', 365);

        const cleanUrl = window.location.origin + window.location.pathname;
        window.history.replaceState({}, document.title, cleanUrl);
    }
    const downloadSection = document.querySelector('.research-download-section');
    if (!downloadSection) {
        return;
    }

    const downloadBtn = document.getElementById('btnDownloadResearch');
    const popup = document.getElementById('researchPopup');
    const popupClose = document.getElementById('researchPopupClose');
    const toast = document.getElementById('toastNotification');
    const isVerified = getCookie('research_email_verified') === 'true' || fromBrevo;

    function showPopup() {
        if (!popup) return;
        popup.classList.add('show');
        setTimeout(function () {
            popup.classList.add('visible');
        }, 10);
    }

    function hidePopup() {
        if (!popup) return;
        popup.classList.remove('visible');
        setTimeout(function () {
            popup.classList.remove('show');
        }, 300);
    }

    function showToast(message, type) {
        if (!toast) return;

        const toastIcon = toast.querySelector('.toast-icon');
        const toastText = toast.querySelector('.toast-text');

        toast.classList.remove('show', 'warning');

        if (type === 'warning') {
            toast.classList.add('warning');
            if (toastIcon) toastIcon.textContent = '⚠';
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

    function triggerDownload() {
        showToast('Đang tải xuống...', 'success');
    }

    if (downloadBtn) {
        downloadBtn.addEventListener('click', function (e) {
            e.preventDefault();

            if (isVerified) {
                triggerDownload();
            } else {
                showPopup();
            }
        });
    }

    if (popupClose) {
        popupClose.addEventListener('click', hidePopup);
    }

    if (popup) {
        popup.addEventListener('click', function (e) {
            if (e.target === popup) {
                hidePopup();
            }
        });
    }

    document.addEventListener('wpcf7mailsent', function (event) {
        setCookie('research_email_verified', 'true', 365);
        hidePopup();
        showToast('Cảm ơn bạn! Đang tải xuống tài liệu...', 'success');
        setTimeout(function () {
            triggerDownload();
        }, 1000);
    });
    document.addEventListener('wpcf7invalid', function (event) {
        showToast('Vui lòng điền đầy đủ thông tin!', 'warning');
    });
})();
(function ($) {
    $(document).ready(function () {
        $(document).on('click', '.menu-item-subscribe > a, a[href="#subscribe-popup"]', function (e) {
            e.preventDefault();
            $('#subscribePopup').addClass('active');
            $('body').css('overflow', 'hidden');
        });
        $('#subscribePopupClose, .subscribe-popup-overlay').on('click', function (e) {
            if (e.target === this) {
                $('#subscribePopup').removeClass('active');
                $('body').css('overflow', '');
            }
        });
        $(document).on('keyup', function (e) {
            if (e.key === 'Escape') {
                $('#subscribePopup').removeClass('active');
                $('body').css('overflow', '');
            }
        });
    });

    (function () {
        const urlParams = new URLSearchParams(window.location.search);
        const isUnsubscribe = urlParams.get('email') === 'resubscribe';

        if (isUnsubscribe) {
            const cleanUrl = window.location.origin + window.location.pathname;
            window.history.replaceState({}, document.title, cleanUrl);

            $(window).on('load', function () {
                $('#unsubscribePopup').addClass('active');
                $('body').css('overflow', 'hidden');
            });
        }

        $('#unsubscribePopupClose, .unsubscribe-popup-overlay').on('click', function (e) {
            if (e.target === this) {
                $('#unsubscribePopup').removeClass('active');
                $('body').css('overflow', '');
            }
        });

        $(document).on('keyup', function (e) {
            if (e.key === 'Escape') {
                $('#unsubscribePopup').removeClass('active');
                $('body').css('overflow', '');
            }
        });

        $('.cf7-other').hide();
        $(document).on('change', '.wpcf7-list-item input[type="radio"], .wpcf7-list-item input[type="checkbox"]', function () {
            var $container = $(this).closest('.wpcf7-form-control-wrap').parent();
            var $otherField = $container.find('.cf7-other');

            if ($otherField.length === 0) {
                $otherField = $container.next('.cf7-other');
            }

            if ($(this).closest('.wpcf7-list-item').hasClass('last') && $(this).is(':checked')) {
                $otherField.slideDown(200);
            } else if ($(this).attr('type') === 'radio') {
                $otherField.slideUp(200);
            }
        });
    })();
})(jQuery);
document.addEventListener("DOMContentLoaded", function () {
    const maxChars = 200;
    const titles = document.querySelectorAll(".entry-title a");

    titles.forEach(el => {
        const text = el.textContent.trim();

        if (text.length > maxChars) {
            el.textContent = text.substring(0, maxChars).trim() + "…";
        }
    });
});