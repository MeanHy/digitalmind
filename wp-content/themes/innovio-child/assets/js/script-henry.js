(function ($) {
    "use strict";
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

    function showPopup() {
        const popup = document.getElementById('researchPopup');
        if (!popup) return;
        popup.classList.add('show');
        setTimeout(function () {
            popup.classList.add('visible');
        }, 10);
    }

    function hidePopup() {
        const popup = document.getElementById('researchPopup');
        if (!popup) return;
        popup.classList.remove('visible');
        setTimeout(function () {
            popup.classList.remove('show');
        }, 300);
    }

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

    function triggerDownload(reportId) {
        if (!reportId && typeof subscribeEmail !== 'undefined') {
            reportId = subscribeEmail.current_report_id;
        }

        if (reportId) {
            requestSecureDownload(reportId);
        } else {
            showPopup();
        }
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

    $(document).ready(function () {
        const urlParams = new URLSearchParams(window.location.search);
        const isSocialLoginSuccess = urlParams.get('social_login') === 'success';
        const isFromEmail = getCookie('dm_from_email') === 'true';

        checkAndPrefillForm();

        if (isFromEmail) {
            document.cookie = 'dm_from_email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';

            setTimeout(function () {
                showPopup();
            }, 500);
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

                            setTimeout(function () {
                                if (response.data.redirect_url) {
                                    window.location.href = response.data.redirect_url;
                                }
                            }, 1000);
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
            const popup = document.getElementById('researchPopup');
            if (popup) {
                popup.classList.add('show');
                setTimeout(function () { popup.classList.add('visible'); }, 10);
            }

            var $btn = $('#dm-research-register-form .dm-submit-btn');
            if ($btn.length && typeof subscribeEmail !== 'undefined') {
                $btn.text(subscribeEmail.lang_key.subscribe);
            }
            $('body').css('overflow', 'hidden');
        });

        $('#researchPopupClose, .research-popup-overlay').on('click', function (e) {
            if (e.target === this || this.id === 'researchPopupClose') {
                const popup = document.getElementById('researchPopup');
                if (popup) {
                    popup.classList.remove('visible');
                    setTimeout(function () { popup.classList.remove('show'); }, 300);
                }
                $('body').css('overflow', '');
            }
        });

        $(document).on('keyup', function (e) {
            if (e.key === 'Escape') {
                const popup = document.getElementById('researchPopup');
                if (popup) {
                    popup.classList.remove('visible');
                    setTimeout(function () { popup.classList.remove('show'); }, 300);
                }
                $('body').css('overflow', '');
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
                const $formInput = $('input[name="current_post_id"]');
                if ($formInput.length) {
                    $formInput.val(reportId);
                }
            }

            if (typeof subscribeEmail !== 'undefined' && subscribeEmail.is_logged_in) {
                const isEnglish = window.location.pathname.startsWith('/en/');
                const thankYouPath = isEnglish ? '/en/thanks-you-for-subscribe/' : '/dang-ky-thanh-cong/';
                window.location.href = thankYouPath + '?report_id=' + reportId;
            } else {
                showPopup();
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

    document.addEventListener('wpcf7mailsent', function (event) {
        setCookie('research_email_verified', 'true', 365);
        hidePopup();
        showToast(subscribeEmail.lang_key.thank_you_downloading, 'success');
        const reportId = $('input[name="current_post_id"]').val();
        setTimeout(function () {
            triggerDownload(reportId);
        }, 1000);
    });

    document.addEventListener('wpcf7invalid', function (event) {
        showToast(subscribeEmail.lang_key.fill_all_fields, 'warning');
    });

})(jQuery);