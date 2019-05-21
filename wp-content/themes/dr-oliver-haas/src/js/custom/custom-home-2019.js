jQuery(document).ready(function($) {

    // SCROLLMAGIC 
    jQuery(".scrollMagicFadeInLeft > div").each(function() {
        var curr = this;

        var tween0 = TweenMax.from(curr, 0.5, {transform: "translateX(-5%)", opacity: 0});
        var scene0 = new ScrollMagic.Scene({triggerElement: curr, duration: '35%', triggerHook: 0.95})
                        .setTween(tween0)
                        .addTo(controller);
    });

    jQuery(".scrollMagicFadeInRight > div").each(function() {
        var curr = this;

        var tween0 = TweenMax.from(curr, 0.5, {transform: "translateX(5%)", opacity: 0});
        var scene0 = new ScrollMagic.Scene({triggerElement: curr, duration: '35%', triggerHook: 0.95})
                        .setTween(tween0)
                        .addTo(controller);
    });



    // JQUERY TEXT OVERFLOW
    jQuery('.textOverflow').addClass('cutted');
    jQuery('.textOverflow .et_pb_text_inner p').append('&nbsp;&nbsp;<span class="overflowTrigger opener">[Mehr erfahren]</span><span class="overflowTrigger closer">[Weniger anzeigen]</span>');

    // ON Overflow Trigger Click
    jQuery('.overflowTrigger').on('click', function() {
        var elem = $(this);
        var tof = elem.closest('.textOverflow');

        // is opener
        if(elem.hasClass('opener')) {
            tof.removeClass('cutted');
        } else if(elem.hasClass('closer')) {
            tof.addClass('cutted');
        }
    });

});