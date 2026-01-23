(function($) {
    'use strict';

    var banner = {};
    mkdf.modules.banner = banner;

    banner.mkdfBanner = mkdfBanner;


    banner.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfBanner().init();
    }

    /**
     * Banner object that initializes whole banner functionality
     * @type {Function}
     */
    var mkdfBanner = function() {
        //all banners on the page
        var banners = $('.mkdf-banner-holder .mkdf-banner-text-holder');

        /**
         * Initializes banner hover background color
         * @param banner current banner
         */
        var bannerHoverBgColor = function(banner) {
            if(typeof banner.data('hover-bg-color') !== 'undefined') {
                var changeBannerBg = function(event) {
                    event.data.banner.css('background-color', event.data.color);
                };

                var originalBgColor = banner.css('background-color');
                var hoverBgColor = banner.data('hover-bg-color');

                banner.on('mouseenter', { banner: banner, color: hoverBgColor }, changeBannerBg);
                banner.on('mouseleave', { banner: banner, color: originalBgColor }, changeBannerBg);
            }
        };

        var bannerTitleHoverBgColor = function(banner) {
            if(typeof banner.find('.mkdf-banner-title').data('title-hover-color') !== 'undefined') {
                var changeBannerTitleColor = function(event) {
                    event.data.banner.find('.mkdf-banner-title').css('color', event.data.color);
                };

                var originalColor = banner.find('.mkdf-banner-title').css('color');
                var hoverColor = banner.find('.mkdf-banner-title').data('title-hover-color');

                banner.on('mouseenter', { banner: banner, color: hoverColor }, changeBannerTitleColor);
                banner.on('mouseleave', { banner: banner, color: originalColor }, changeBannerTitleColor);
            }
        };

        var bannerSubtitleHoverBgColor = function(banner) {
            if(typeof banner.find('.mkdf-banner-subtitle').data('subtitle-hover-color') !== 'undefined') {
                var changeBannerSubtitleColor = function(event) {
                    event.data.banner.find('.mkdf-banner-subtitle').css('color', event.data.color);
                };

                var originalColor = banner.find('.mkdf-banner-subtitle').css('color');
                var hoverColor = banner.find('.mkdf-banner-subtitle').data('subtitle-hover-color');

                banner.on('mouseenter', { banner: banner, color: hoverColor }, changeBannerSubtitleColor);
                banner.on('mouseleave', { banner: banner, color: originalColor }, changeBannerSubtitleColor);
            }
        };

        var bannerButtonHoverBgColor = function(banner) {
            if(typeof banner.find('.mkdf-banner-button').data('button-hover-color') !== 'undefined') {
                var changeBannerButtonColor = function(event) {
                    event.data.banner.find('.mkdf-banner-button a').css('color', event.data.color);
                };

                var originalColor = banner.find('.mkdf-banner-button a').css('color');
                var hoverColor = banner.find('.mkdf-banner-button').data('button-hover-color');

                banner.on('mouseenter', { banner: banner, color: hoverColor }, changeBannerButtonColor);
                banner.on('mouseleave', { banner: banner, color: originalColor }, changeBannerButtonColor);
            }
        };

        return {
            init: function() {
                if(banners.length) {
                    banners.each(function() {
                        bannerHoverBgColor($(this));
                        bannerTitleHoverBgColor($(this));
                        bannerSubtitleHoverBgColor($(this));
                        bannerButtonHoverBgColor($(this));
                    });
                }
            }
        };
    };

})(jQuery);