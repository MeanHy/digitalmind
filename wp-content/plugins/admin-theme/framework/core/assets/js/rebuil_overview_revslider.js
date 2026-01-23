/*!
 * REVOLUTION 6.0.0 OVERVIEW JS
 * @version: 1.0 (01.07.2019)
 * @author ThemePunch
 */
function showPluginInfos() {}!(function() {
    (RVS.F.initOverView = function() {
        RVS.F.initAdmin(),
            (RVS.C.rsOVM = jQuery("#rs_overview_menu")),
            (RVS.S.ovMode = !0),
            RVS.F.initialiseInputBoxes("overview"),
            initLocalListeners(),
            jQuery("#plugin_history").RSScroll({
                wheelPropagation: !0,
                suppressScrollX: !1,
                minScrollbarLength: 30,
            }),
            (sliderLibrary.output = jQuery("#existing_sliders")),
            (sliderLibrary.sfw = jQuery("#slider_folders_wrap")),
            sliderLibrary.sfw.appendTo(jQuery(document.body)),
            (sliderLibrary.sfwu = jQuery("#slider_folders_wrap_underlay")),
            (sliderLibrary.backOneLevel = jQuery(
                '<div id="back_one_folder" class="new_slider_block"><i class="material-icons">more_horiz</i><span class="nsb_title">Back</span></div>'
            )),
            (sliderLibrary.selectedFolder = -1),
            (sliderLibrary.selectedPage = 1),
            (sliderLibrary.slidesContainer = jQuery(".overview_slide_elements")),
            updateParentAttributes(),
            (sliderLibrary.filters = buildModuleFilters()),
            (function() {
                window.ov_scroll_targets = [];
                var e = 0;
                jQuery(".rso_scrollmenuitem").each(function() {
                        void 0 !== this.dataset.ref &&
                            (window.ov_scroll_targets.push({
                                    obj: jQuery(this.dataset.ref),
                                    top: jQuery(this.dataset.ref).offset().top,
                                    height: jQuery(this.dataset.ref).height(),
                                    menu: jQuery(this),
                                    menu_js: this,
                                }),
                                (this.dataset.ostref = e),
                                e++);
                    }),
                    jQuery("#adminmenuwrap").append('<div id="wpadmin_overlay"></div>'),
                    jQuery("#wpcontent").append('<div id="wpadmin_overlay_top"></div>'),
                    tpGS.gsap.to(["#wpadmin_overlay", "#wpadmin_overlay_top"], 0.6, {
                        opacity: 0,
                        ease: "power3.inOut",
                    }),
                    tpGS.gsap.to(
                        ["#adminmenuback", "#adminmenuwrap", "#wpadminbar"],
                        0.6, { filter: "grayscale(0%)", ease: "power3.inOut" }
                    ),
                    jQuery("#adminmenuback, #adminmenuwrap, #wpadminbar")
                    .on("mouseenter", function() {
                        tpGS.gsap.to(["#wpadmin_overlay", "#wpadmin_overlay_top"], 0.3, {
                                opacity: 0,
                                ease: "power3.inOut",
                            }),
                            tpGS.gsap.to(
                                ["#adminmenuback", "#adminmenuwrap", "#wpadminbar"],
                                0.6, { filter: "grayscale(0%)", ease: "power3.inOut" }
                            );
                    })
                    .on("mouseleave", function() {
                        tpGS.gsap.to(["#wpadmin_overlay", "#wpadmin_overlay_top"], 0.3, {
                                opacity: 0,
                                ease: "power3.inOut",
                            }),
                            tpGS.gsap.to(
                                ["#adminmenuback", "#adminmenuwrap", "#wpadminbar"],
                                0.6, { filter: "grayscale(0%)", ease: "power3.inOut" }
                            );
                    }),
                    s(),
                    t(),
                    tpGS.gsap.to("#rs_overview_menu", 1, {
                        opacity: 1,
                        ease: "power3.out",
                    });
            })(),
            updateOVFilteredList()
    }),
    (RVS.F.getOVSliderIndex = function(e) {
        var i = -1;
        for (var r in sliderLibrary.sliders)
            sliderLibrary.sliders.hasOwnProperty(r) &&
            sliderLibrary.sliders[r].id == e &&
            (i = r);
        return i;
    })

    function t() {
        window.scroll_top = RVS.WIN.scrollTop();
        var e = -1;
        for (var i in ((window.cacheOMT = jQuery("#rs_overview").offset().top),
                tpGS.gsap.set(RVS.C.rsOVM, {
                    top: Math.max(32, window.cacheOMT - window.scroll_top),
                }),
                window.ov_scroll_targets))
            window.ov_scroll_targets.hasOwnProperty(i) &&
            window.ov_scroll_targets[i].obj.length > 0 &&
            ((window.ov_scroll_targets[i].top =
                    window.ov_scroll_targets[i].obj.offset().top), !window.ov_scroll_targets[i].shown &&
                window.ov_scroll_targets[i].top <
                window.scroll_top + window.outerHeight - 200 &&
                (tpGS.gsap.to(window.ov_scroll_targets[i].obj[0], 1, {
                        autoAlpha: 1,
                        ease: "power3.inOut",
                    }),
                    (window.ov_scroll_targets[i].shown = !0)),
                (window.ov_scroll_targets[i].height =
                    window.ov_scroll_targets[i].obj.height()),
                window.scroll_top + 200 >= window.ov_scroll_targets[i].top &&
                window.scroll_top <=
                window.ov_scroll_targets[i].top +
                window.ov_scroll_targets[i].height &&
                (e = i));
        (e = -1 === e ? window.ov_scroll_targets.length - 1 : e),
        jQuery(".rso_scrollmenuitem").removeClass("active"),
            window.ov_scroll_targets[e].menu.addClass("active");
    }

    function s() {
        tpGS.gsap.set("#rs_overview_menu", { width: jQuery("#wpbody").width() }),
            jQuery("#wpadmin_overlay").width(jQuery("#adminmenuback").width()),
            jQuery("#wpadmin_overlay_top").height(jQuery("#wpadminbar").height()),
            t();
    }
})();