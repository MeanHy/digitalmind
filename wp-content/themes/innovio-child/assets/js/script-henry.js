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
})(jQuery);