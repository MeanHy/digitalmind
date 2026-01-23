(function($) {
	'use strict';
	
	var workflow = {};
	mkdf.modules.workflow = workflow;

    workflow.mkdfWorkflow = mkdfWorkflow;


    workflow.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
        mkdfWorkflow();
	}

    function mkdfWorkflow() {
        var workflowShortcodes = $('.mkdf-workflow');
        if (workflowShortcodes.length) {
            workflowShortcodes.each(function () {
                var workflowShortcode = $(this);
                if (workflowShortcode.hasClass('mkdf-workflow-animate')) {
                    var workflowItems = workflowShortcode.find('.mkdf-workflow-item');

                    workflowShortcode.appear(function () {
                        workflowShortcode.addClass('mkdf-appeared');
                        setTimeout(function () {
                            workflowItems.each(function (i) {
                                var workflowItem = $(this);
                                setTimeout(function () {
                                    workflowItem.addClass('mkdf-appeared');
                                }, 350 * i);
                            });
                        }, 350);
                        $('.mkdf-workflow-item .mkdf-workflow-curve').each(function(i) {
                            var fadeInTime = .2 + i/5;

                            if($(this).hasClass('mkdf-workflow-curve-1') || $(this).hasClass('mkdf-workflow-curve-3')) {
                                $(this).css({
                                    'width' : '80px',
                                    'transition':'width .25s ease-in-out '+ fadeInTime +'s '
                                })
                            } else {
                                $(this).css({
                                    'height' : '100%',
                                    'transition':'height .25s ease-in-out '+ fadeInTime +'s '
                                })
                            }
                        })
                    }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});

                }
            });
        }
    }
	
})(jQuery);