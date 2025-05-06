/*
------------------------------------------------------------------------
* Template Name    : Brezon | Responsive Bootstrap 5 Landing Template * 
* Author           : ThemesBoss                                       *
* Version          : 1.0.0                                            *
* Created          : July 2018                                        *
* File Description : Main Js file of the template                     *
*-----------------------------------------------------------------------
*/


(function ($) {

    'use strict';

    // SmoothLink
    function initSmoothLink() {
        $('.nav-item a').on('click', function (event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 0
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    }

    // StickyMenu
    function initStickyMenu() {
        $(window).on('scroll', function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 50) {
                $(".sticky").addClass("stickyadd");
            } else {
                $(".sticky").removeClass("stickyadd");
            }
        });
    }

    // Scrollspy
    function initScrollspy() {
        $("#navbarCollapse").scrollspy({
            offset: 70
        });
    }

    // Back To Top
    function initBackToTop() {
        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 100) {
                $('.back_top').fadeIn();
            } else {
                $('.back_top').fadeOut();
            }
        });
        $('.back_top').on('click', function () {
            $("html, body").animate({ scrollTop: 0 }, 1000);
            return false;
        });
    }

    function init() {
        initSmoothLink();
        initStickyMenu();
        initScrollspy();
        initBackToTop();
    }

    init();

})(jQuery);
