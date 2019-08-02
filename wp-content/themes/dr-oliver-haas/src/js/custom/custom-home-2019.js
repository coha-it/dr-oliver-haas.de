/*globals jQuery document TweenMax ScrollMagic new  */

'use strict';

var customHome2019 = true;

jQuery(document).ready(function($) {

    // Scrollmagic  
    jQuery(".scrollMagicFadeInLeft > div").each(function () {
        var curr = this;

        var tween0 = TweenMax.from(curr, 0.5, {transform: "translateX(-5%)", opacity: 0});
        var scene0 = new ScrollMagic.Scene({triggerElement: curr, duration: '35%', triggerHook: 0.95})
                        .setTween(tween0)
                        .addTo(controller);
    });

    jQuery(".scrollMagicFadeInRight > div").each(function () {
        var curr = this;

        var tween0 = TweenMax.from(curr, 0.5, {transform: "translateX(5%)", opacity: 0});
        var scene0 = new ScrollMagic.Scene({triggerElement: curr, duration: '35%', triggerHook: 0.95})
                        .setTween(tween0)
                        .addTo(controller);
    });

    // JQUERY TEXT OVERFLOW
    jQuery('.textOverflow').addClass('cutted');
    jQuery('.textOverflow').append('<span class="overflowTrigger opener">[Mehr erfahren]</span>');
    jQuery('.textOverflow .et_pb_text_inner').append('<span class="overflowTrigger closer">[Weniger anzeigen]</span>');

    // Open the Box
    $(document).on('click', '.textOverflow.cutted', function () {
        var elem = $(this);
        var tof = elem.closest('.textOverflow');

        // is opener
        if(tof.hasClass('cutted')) {
            tof.removeClass('cutted');
        }
    });

    // ON Overflow Trigger Click on Closer
    $(document).on('click', '.overflowTrigger.closer', function () {
        var elem = $(this);
        var tof = elem.closest('.textOverflow');

        tof.addClass('cutted');
    });

    // Perform a hard-download
    $('a.download').each(function(i, e) {
        var elem = $(e);
        var href = elem.attr('href');
        var filename = href.substr(href.lastIndexOf('/') + 1);
        elem.attr('download', filename);
    });

    // All a-Hrefs add something to the URL
    $('a[href^="#"]').not('a[href="#"]').on('click', function(e) {
        e.preventDefault();

        var elem = $(this);
        var hash = elem.attr('href');

        // window.location.hash = hash;

        if (window.history.pushState) {
            history.pushState({}, '', window.location.origin + window.location.pathname + hash);
        } else {
            window.location.hash = hash;
        }
    });

    // Scroll to Hash
    // if(window.location.hash) {
    //     $('html,body').animate({scrollTop:$(window.location.hash).offset().top}, 500);
    // }

    // Simulate the Nav-Close by clicking the main content
    jQuery('#et-main-area').on('click', function() {
        if($('.mobile_nav').hasClass('opened')) {
            jQuery('.mobile_menu_bar_toggle').click();
        }
    });

});