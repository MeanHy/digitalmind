(function($) {
    'use strict';

    var testimonialsVertical = {};
    mkdf.modules.mkdfInitTestimonialsVertical = mkdfInitTestimonialsVertical;

    testimonialsVertical.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitTestimonialsVertical();
    }

    /**
     * Initializes testimonials vertical logic
     */

    function mkdfInitTestimonialsVertical() {
        var holders = $('.mkdf-testimonials-holder.mkdf-testimonials-image-on-side');

        if(holders.length) {
            holders.each(function(){
                var holder = $(this),
                    dataHolder = holder.find('.mkdf-testimonials'),
                    swiperInstance = holder.find('.swiper-container'),
                    singleItem = holder.find('.mkdf-testimonial-content'),
                    maxHeight = 0,
                    autoplay = {
                        delay: 3000,
                    },
                    loop = true,
                    speed = 500;


                var calcHeight = function() {
                    singleItem.each(function(){
                        var thisImgHeight = $(this).find('.mkdf-testimonial-image').height();
                        var thisTextHeight = $(this).find('.mkdf-testimonial-text-holder').height();
                        if (thisImgHeight > thisTextHeight) {
                            if(thisImgHeight > maxHeight) {
                                maxHeight = thisHeight;
                            }
                        } else {
                            if(thisTextHeight > maxHeight) {
                                maxHeight = thisTextHeight;
                            }
                        }
                    });

                    return maxHeight;
                }

                if(typeof dataHolder.data('enable-autoplay') !== 'undefined' && dataHolder.data('enable-autoplay') === 'no') {
                    autoplay = false;
                }

                if(typeof dataHolder.data('enable-loop') !== 'undefined' && dataHolder.data('enable-loop') === 'no') {
                    loop = false;
                }

                if (dataHolder.data('slider-speed') !== 'undefined' && dataHolder.data('slider-speed') !== false) {
                    autoplay = {
                        delay: dataHolder.data('slider-speed'),
                    };
                }

                if (typeof dataHolder.data('slider-speed-animation') !== 'undefined' && dataHolder.data('slider-speed-animation') !== false) {
                    speed = dataHolder.data('slider-speed-animation');
                }


                var swiperSlider = new Swiper (swiperInstance, {
                    loop: loop,
                    autoplay: autoplay,
                    direction: 'vertical',
                    slidesPerView: 1,
                    speed: speed,
                    pagination: {
                        el: '.swiper-pagination',
                        type: 'bullets',
                        clickable: true,
                    },
                    autoHeight: true,
                    init: false

                });

                swiperSlider.on('slideChange', function() {

                });

                swiperSlider.on('transitionEnd', function() {
                });

                holder.waitForImages(function() {
                    swiperSlider.init();
                });

                $(window).on('resize', function() {
                });
            });
        }

    }

})(jQuery);