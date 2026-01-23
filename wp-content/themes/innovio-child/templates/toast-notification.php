<!-- Toast Notification & Popup Styles -->
<style>
    /* Toast Notification */
    .toast-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: #fff;
        padding: 16px 24px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        z-index: 999999;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.4s ease;
        font-size: 15px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: 350px;
    }
    .toast-notification.show {
        opacity: 1;
        transform: translateX(0);
    }
    .toast-notification .toast-icon {
        font-size: 20px;
    }
    .toast-notification.warning {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
    }
    
    /* Research Download Section */
    .research-download-section {
        margin-top: 40px;
        padding: 40px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 16px;
        border: 1px solid #dee2e6;
        text-align: center;
    }
    .research-download-box {
        max-width: 500px;
        margin: 0 auto;
    }
    .research-download-title {
        font-size: 24px;
        font-weight: 700;
        margin: 0 0 10px;
        color: #333;
    }
    .research-download-desc {
        font-size: 15px;
        color: #666;
        margin: 0 0 25px;
    }
    .btn-download-research {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 16px 32px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        text-decoration: none;
        border: none;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-download-research:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        color: #fff;
    }
    .download-icon {
        font-size: 22px;
    }
    
    /* Research Popup Overlay */
    .research-popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        z-index: 99999;
        opacity: 0;
        transition: opacity 0.3s ease;
        align-items: center;
        justify-content: center;
    }
    .research-popup-overlay.show {
        display: flex;
    }
    .research-popup-overlay.visible {
        opacity: 1;
    }
    .research-popup-container {
        position: relative;
        background: #fff;
        padding: 40px;
        border-radius: 20px;
        max-width: 500px;
        width: 90%;
        max-height: 75vh;
        overflow-y: auto;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        transform: translateY(20px);
        transition: transform 0.3s ease;
        /* Hide scrollbar */
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
    .research-popup-container::-webkit-scrollbar {
        display: none;  /* Chrome, Safari, Opera */
    }
    .research-popup-content .wpcf7-form br {
        display: none;
    }
    .research-popup-overlay.visible .research-popup-container {
        transform: translateY(0);
    }
    .research-popup-close {
        position: absolute;
        top: 15px;
        right: 20px;
        background: none;
        border: none;
        color: #999;
        font-size: 28px;
        cursor: pointer;
        transition: color 0.2s;
        line-height: 1;
    }
    .research-popup-close:hover {
        color: #333;
    }
    .research-popup-title {
        font-size: 24px;
        font-weight: 700;
        margin: 0 0 10px;
        color: #333;
        text-align: center;
    }
    .research-popup-desc {
        font-size: 15px;
        color: #666;
        margin: 0 0 25px;
        text-align: center;
    }
    .research-popup-content .wpcf7-form {
        max-width: 100%;
    }
    .research-popup-content .wpcf7-form input[type="text"],
    .research-popup-content .wpcf7-form input[type="email"],
    .research-popup-content .wpcf7-form input[type="tel"],
    .research-popup-content .wpcf7-form select,
    .research-popup-content .wpcf7-form textarea {
        width: 100%;
        padding: 7px 9px;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-size: 16px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }
    .research-popup-content .wpcf7-form input:focus {
        border-color: #667eea;
        outline: none;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }
    .research-popup-content .wpcf7-submit {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .research-popup-content .wpcf7-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }
</style>

<!-- Toast Notification HTML -->
<div class="toast-notification" id="toastNotification">
    <span class="toast-icon">✓</span>
    <span class="toast-text">Cảm ơn bạn đã đăng ký!</span>
</div>
