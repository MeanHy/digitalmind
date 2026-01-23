(function($) {
    'use strict';

    var pricingSlider = {};
    mkdf.modules.pricingSlider = pricingSlider;

    pricingSlider.mkdfInitPricingSlider = mkdfInitPricingSlider;


    pricingSlider.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitPricingSlider();
    }

    /*
     **	Horizontal progress bars shortcode
     */
    function mkdfInitPricingSlider() {
        var pricingSliders = $('.mkdf-pricing-slider');

        pricingSliders.each(function() {
            var slider = $(this);
            var dragHolder = slider.find('.mkdf-pricing-slider-bar-holder');
            var drag = slider.find('.mkdf-pricing-slider-drag');
            var progressBar = slider.find('.mkdf-pricing-slider-bar');
            var pricingButtonHolder = slider.find('.mkdf-pricing-slider-button-holder');
            var activeFilter = pricingButtonHolder.find('.active');
            var priceElement = slider.find('.mkdf-price');
            var sliderTextLabel = slider.find('.mkdf-pricing-slider-value');

            var unitName = slider.data('unit-name') ? slider.data('unit-name') : "unit";
            var unitsRange = parseFloat(slider.data('units-range')) ? parseFloat(slider.data('units-range')) : 0;
            var unitsBreakpoints = parseFloat(slider.data('units-breakpoints')) ? parseFloat(slider.data('units-breakpoints')) : 0;
            var price = parseFloat(activeFilter.data('price-per-unit')) ? parseFloat(activeFilter.data('price-per-unit')) : 0;
            var reduceRate = parseFloat(activeFilter.data('price-reduce-per-breakpoint')) ? parseFloat(activeFilter.data('price-reduce-per-breakpoint')) : 0;
            var breakpointValue = unitsBreakpoints;
            var breakPointsIterator = 0;

            var parentXPos = dragHolder.offset().left;
            var parentWidth = dragHolder.outerWidth() - drag.outerWidth();
            var iterator = parentWidth/unitsRange;

            var offset = 0;
            var xPos = 1;
            var units = 1;

            var i;
            if(unitsBreakpoints > 0) {
                var delimiters = unitsRange / unitsBreakpoints;
                for (i = 1; i < delimiters; i++) {
                    progressBar.append('<span class="delimiter" style="left:' + Math.round((100 / delimiters) * i) + '%;"></span>');
                }
            }

            recalculateValues(priceElement, units, price, sliderTextLabel, progressBar, xPos, parentWidth, unitName);

            pricingButtonHolder.find('.mkdf-btn').on('click', function () {
                if(!$(this).parent().hasClass('active')) {
                    activeFilter.removeClass('active');
                    $(this).parent().addClass('active');
                    activeFilter = $(this).parent();
                    price = parseFloat(activeFilter.data('price-per-unit')) ? parseFloat(activeFilter.data('price-per-unit')) : 0;
                    reduceRate = parseFloat(activeFilter.data('price-reduce-per-breakpoint')) ? parseFloat(activeFilter.data('price-reduce-per-breakpoint')) : 0;
                    price = price - breakPointsIterator * reduceRate;
                    recalculateValues(priceElement, units, price, sliderTextLabel, progressBar, xPos, parentWidth, unitName);
                }
            });

            var draggerPosition;
            drag.draggable({
                axis: "x",
                containment: dragHolder.parent(),
                scrollSensitivity: 10,
                start: function(event, ui) {
                    draggerPosition = ui.position.left;
                },
                drag: function( event, ui ) {
                    var direction = (ui.position.left > draggerPosition) ? 'right' : 'left';
                    draggerPosition = ui.position.left;
                    offset = $(this).offset();
                    xPos = offset.left - parentXPos;
                    units = Math.floor(xPos / iterator);
                    if(xPos >= 0 && xPos <= parentWidth) {
                        if (direction == 'right') {
                            if (units > breakpointValue) {
                                breakpointValue = breakpointValue + unitsBreakpoints;
                                breakPointsIterator ++;
                                price = price - reduceRate;
                            }
                        }
                        else if (direction == 'left') {
                            if (units <= breakpointValue - unitsBreakpoints) {
                                breakpointValue = breakpointValue - unitsBreakpoints;
                                breakPointsIterator --;
                                price = price + reduceRate;
                            }
                        }
                        recalculateValues(priceElement, units, price, sliderTextLabel, progressBar, xPos, parentWidth, unitName);
                    }
                }
            });
        });

        function recalculateValues(priceElement, units, price, sliderTextLabel, progressBar, xPos, parentWidth, unitName) {
            priceElement.text(((Math.round(units * price * 100)) / 100));
            if(units == 1) {
                sliderTextLabel.text(units + " " + unitName);
            } else {
                sliderTextLabel.text(units + " " + unitName + "s");
            }
            progressBar.width(Math.round((xPos/parentWidth)*100)+"%");
        }
    }

})(jQuery);