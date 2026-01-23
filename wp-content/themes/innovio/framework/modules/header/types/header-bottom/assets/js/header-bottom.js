(function($) {
    "use strict";

    var headerBottom = {};
    mkdf.modules.headerBottom = headerBottom;

    headerBottom.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfBottomMenu().init();
        mkdfBottomMenuPosition();
    }

    /**
     * Init Bottom Menu
     */
    var mkdfBottomMenu = function() {
        /**
         * Main vertical area object that used through out function
         * @type {jQuery object}
         */
        var verticalMenuObject = $('.mkdf-header-bottom .mkdf-vertical-menu-area');

        var initNavigation = function() {
            var verticalMenuOpener = $('.mkdf-header-bottom .mkdf-header-bottom-menu-opener'),
                headerObject = $('.mkdf-header-bottom .mkdf-page-header'),
                verticalMenuNavHolder = verticalMenuObject.find('.mkdf-vertical-menu-nav-holder-outer'),
                menuItemWithChild =  verticalMenuObject.find('.mkdf-header-bottom-menu > ul li.has_sub > a'),
                menuItemWithoutChild = verticalMenuObject.find('.mkdf-header-bottom-menu ul li:not(.has_sub) a');

            //set height of vertical menu holder and initialize perfectScrollbar
            verticalMenuNavHolder.height(mkdf.windowHeight);
            mkdf.modules.common.mkdfInitPerfectScrollbar().init(verticalMenuNavHolder);

            //set height of vertical menu holder on resize
            $(window).resize(function() {
                verticalMenuNavHolder.height(mkdf.windowHeight);
            });

            verticalMenuOpener.on('click',function(e){
                e.preventDefault();
                if(!verticalMenuNavHolder.hasClass('active')){
                    verticalMenuNavHolder.addClass('active');
                    verticalMenuObject.addClass('opened');
                    verticalMenuOpener.addClass('active');
                    mkdf.body.addClass('mkdf-header-bottom-opened');
                    if(!mkdf.body.hasClass('page-template-full_screen-php')){
                        mkdf.modules.common.mkdfDisableScroll();
                    }
                }else{
                    verticalMenuNavHolder.removeClass('active');
                    verticalMenuObject.removeClass('opened');
                    verticalMenuOpener.removeClass('active');
                    mkdf.body.removeClass('mkdf-header-bottom-opened');
                    if(!mkdf.body.hasClass('page-template-full_screen-php')){
                        mkdf.modules.common.mkdfEnableScroll();
                    }
                }
            });

            headerObject.next().on('click', function(){
                if(verticalMenuNavHolder.hasClass('active')){
                    verticalMenuNavHolder.removeClass('active');
                    verticalMenuObject.removeClass('opened');
                    verticalMenuOpener.removeClass('active');
                    mkdf.body.removeClass('mkdf-header-bottom-opened');
                    if(!mkdf.body.hasClass('page-template-full_screen-php')){
                        mkdf.modules.common.mkdfEnableScroll();
                    }
                }
            });

            $('.mkdf-slider, .mkdf-title-holder').on('click', function(){
                if(verticalMenuNavHolder.hasClass('active')){
                    verticalMenuNavHolder.removeClass('active');
                    verticalMenuObject.removeClass('opened');
                    verticalMenuOpener.removeClass('active');
                    mkdf.body.removeClass('mkdf-header-bottom-opened');
                    if(!mkdf.body.hasClass('page-template-full_screen-php')){
                        mkdf.modules.common.mkdfEnableScroll();
                    }
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                if ($(this).parent().hasClass('has_sub')) {
                    var submenu = $(this).parent().find('> ul.sub_menu');
                    if (submenu.is(':visible')) {
                        submenu.slideUp(200);
                        $(this).parent().removeClass('open_sub');
                    } else {
                        if($(this).parent().siblings().hasClass('open_sub')) {
                            $(this).parent().siblings().each(function() {
                                var sibling = $(this);
                                if(sibling.hasClass('open_sub')) {
                                    var openedUl = sibling.find('> ul.sub_menu');
                                    openedUl.slideUp(200);
                                    sibling.removeClass('open_sub');
                                }
                                if(sibling.find('.open_sub')) {
                                    var openedUlUl = sibling.find('.open_sub').find('> ul.sub_menu');
                                    openedUlUl.slideUp(200);
                                    sibling.find('.open_sub').removeClass('open_sub');
                                }
                            });
                        }

                        $(this).parent().addClass('open_sub');
                        submenu.slideDown(200);
                    }
                }
                return false;
            });

        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                }
            }
        };
    };

    function mkdfBottomMenuPosition() {
        var bottomHeader = $('.mkdf-header-bottom');
        
        if(bottomHeader.length && mkdf.windowWidth > 1024) {
            var slider = $('.mkdf-slider'),
                sliderHeightUsed = slider.length && slider.outerHeight() + mkdfGlobalVars.vars.mkdfMenuAreaHeight < mkdf.windowHeight,
                initialHeight = sliderHeightUsed ? slider.outerHeight() : mkdf.windowHeight - mkdfGlobalVars.vars.mkdfMenuAreaHeight,
                contentHolder = $('.mkdf-content'),
                footer = $('footer'),
                footerHeight = footer.outerHeight(),
                uncoveringFooter = footer.hasClass('mkdf-footer-uncover');
            
            if(slider.length > 0) {
                slider.addClass('mkdf-slider-fixed');
                contentHolder.css("padding-top", initialHeight);
            }
            
            $(window).scroll(function() {
                if(mkdf.windowWidth > 1024) {
                    calculatePosition(initialHeight, uncoveringFooter, footerHeight);
                }
            });
        }

        function calculatePosition(initialHeight, uncoveringFooter, footerHeight) {
            if(uncoveringFooter) {
                if(mkdf.window.scrollTop() > initialHeight) {
                    slider.css('margin-top', '-' + footerHeight + 'px');
                } else {
                    slider.css('margin-top', 0);
                }
            }
        }
    }

})(jQuery);