(function($) {
    "use strict";

    var blogChequered = {};
    mkdf.modules.blogChequered = blogChequered;

    blogChequered.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(window).on('load', mkdfOnWindowLoad);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitBlogChequered();
        mkdfInitBlogChequeredLoadMore();
    }

    /**
     *  Init Blog Chequered
     */
    function mkdfInitBlogChequered(){
        var container = $('.mkdf-blog-holder.mkdf-blog-chequered');
        var masonry = container.children('.mkdf-blog-holder-inner');
        var newSize;

        if(container.length) {
            newSize = masonry.find('.mkdf-masonry-grid-sizer').outerWidth();
            masonry.children('article').css({'height': (newSize) + 'px'});
            masonry.isotope( 'layout', function(){
                masonry.css('opacity', '1');
            });

            masonry.one(mkdf.transitionEnd, function() {
                if (!mkdf.body.hasClass('touch')) {
                    mkdfInitBlogChequeredListAnimation(container);
                }
            });
        }
    }

    function mkdfInitBlogChequeredLoadMore() {
        $( document.body ).on( 'blog_list_load_more_trigger', function() {
            mkdfInitBlogChequered();
        });
    }

    /**
     * Initializes portfolio list article animation
     */
    function mkdfInitBlogChequeredListAnimation(cheqList){
        var articles = cheqList.find('article');

        articles.css('visibility', 'visible');

        articles.each(function(i) {
            var thisArticle = $(this);
            var content = thisArticle.find('.mkdf-post-content');
            var fadeInTime = .1 + (i%4)/5;

            content.css('transition-delay', fadeInTime+'s')
        });

        articles.appear(function() {
            $(this).addClass('mkdf-item-show');
        },{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
    }

})(jQuery);