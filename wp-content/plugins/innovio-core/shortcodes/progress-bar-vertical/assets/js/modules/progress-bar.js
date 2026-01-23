(function($) {
	'use strict';
	
	var progressBarVertical = {};
	mkdf.modules.progressBarVertical = progressBarVertical;
	
	progressBarVertical.mkdfInitProgressBarsVertical = mkdfInitProgressBarsVertical;
	
	
	progressBarVertical.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitProgressBarsVertical();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function mkdfInitProgressBarsVertical() {
		var progressBarVertical = $('.mkdf-progress-bar-vertical');
		
		if (progressBarVertical.length) {
            progressBarVertical.each(function (i) {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.mkdf-progress-bar-progress-content'),
					progressBar = thisBar.find('.mkdf-pb-percent'),
					progressBarHolder = thisBar.find('.mkdf-pb-percent-holder'),
					percentage = thisBarContent.data('percentage');

				thisBar.appear(function () {
					setTimeout(function(){
                        mkdfInitToCounterProgressBarVertical(thisBar);

                        thisBarContent.css('height', '0%').animate({'height': percentage + '%'},1200, 'easeInOutQuint');
                    }, i*300);
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function mkdfInitToCounterProgressBarVertical(thisBar){

        if(thisBar.find('.mkdf-progress-bar-number span').length){
            thisBar.find('.mkdf-progress-bar-number span').each(function() {
                var $max = parseFloat($(this).text());
                $(this).countTo({
                    from: 0,
                    to: $max,
                    speed: 1200,
                    refreshInterval: 50
                });
            });
        }
	}
	
})(jQuery);