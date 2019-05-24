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


});