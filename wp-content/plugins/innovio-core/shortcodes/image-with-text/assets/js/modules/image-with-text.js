(function($) {
    'use strict';

    var imageWithText = {};
    mkdf.modules.imageWithText = imageWithText;

    imageWithText.mkdfInitImageWithText = mkdfInitImageWithText;

    imageWithText.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitImageWithText();
    }

    function mkdfInitImageWithText() {
        var iwt = $('.mkdf-image-with-text-holder.mkdf-image-behavior-custom-link');

        if(iwt.length) {
            iwt.each(function() {
                var thisIwt = $(this),
                    image = thisIwt.find('.mkdf-iwt-image');

                image.on('mouseenter', function(){
                    thisIwt.addClass('mkdf-iwt-with-hover-eff');
                });
                image.on('mouseleave', function(){
                    thisIwt.removeClass('mkdf-iwt-with-hover-eff');
                });
            });
        }
    }

})(jQuery);