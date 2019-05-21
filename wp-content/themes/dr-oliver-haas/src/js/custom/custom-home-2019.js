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

});