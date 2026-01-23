(function ($) {
    'use strict';

    var iconWithText = {};
    mkdf.modules.iconWithText = iconWithText;

    iconWithText.mkdfInitIconWithText = mkdfInitIconWithText;


    iconWithText.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     ** All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitIconWithText();
    }

    /**
     * Init Icon With Text
     */
    function mkdfInitIconWithText() {
        var iwtShortcodes = $('.mkdf-iwt');

        if (iwtShortcodes.length) {
            iwtShortcodes.each(function(){
                var iwtShortcode = $(this);

                if (iwtShortcode.hasClass('mkdf-iwt-with-custom-icon')) {
                    var iwtIcon = iwtShortcode.find('.mkdf-iwt-icon img:first-child'),
                        animating = false;

                    iwtShortcode.on('mouseenter', function(){
                        animating = true;
                        iwtIcon.addClass('mkdf-animate');
                        iwtIcon.one(mkdf.transitionEnd, function(){
                            animating = false;
                        });
                    }).on('mouseleave', function(){
                        if (!animating) {
                            iwtIcon.removeClass('mkdf-animate');
                        } else {
                            iwtIcon.one(mkdf.transitionEnd, function(){
                                iwtIcon.removeClass('mkdf-animate');
                                animating = false;
                            });
                        }
                    });
                }
            });
        }

    }

})(jQuery);