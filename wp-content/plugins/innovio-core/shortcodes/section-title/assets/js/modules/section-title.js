(function($) {
    'use strict';

    var sectionTitle = {};
    mkdf.modules.sectionTitle = sectionTitle;

    sectionTitle.mkdfInitSectionTitle = mkdfInitSectionTitle;

    sectionTitle.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(window).on('load', mkdfOnWindowLoad);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitSectionTitle();
    }

    /**
     * Inti process shortcode on appear
     */
    function mkdfInitSectionTitle() {
        var holder = $('.mkdf-section-title-holder');
        var revHolder = $('.rev_slider, rs-module-wrap'); // rs-module-wrap for new plugin version

        if(holder.length) {
            holder.each(function(){
                var thisHolder = $(this);

                if(thisHolder.closest(revHolder).length) {
                    thisHolder.closest(revHolder).on("revolution.slide.onchange", function(e) {
                        if(thisHolder.closest('.tp-revslider-slidesli').hasClass('active-revslide')) {
                            thisHolder.addClass('mkdf-section-title-appeared');
                        } else if(thisHolder.closest('rs-slide').is('[data-isactiveslide="true"]')) { // another check for new plugin version
                            thisHolder.addClass('mkdf-section-title-appeared');
                        } else {
                            thisHolder.removeClass('mkdf-section-title-appeared');
                        }
                    });
                } else {
                    thisHolder.appear(function(){
                        thisHolder.addClass('mkdf-section-title-appeared');
                    },{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
                }
            });
        }
    }

})(jQuery);