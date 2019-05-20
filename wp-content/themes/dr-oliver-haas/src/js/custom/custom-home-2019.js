jQuery(document).ready(function($) {
    // SCROLLMAGIC 
    
    // jQuery('.et_pb_gutters3 .et_pb_text-inner');

	var tween0 = TweenMax.to(".et_pb_gutters3 .et_pb_text-inner", 0.5, {marginLeft: "5%", opacity: 1});
	var scene0 = new ScrollMagic.Scene({triggerElement: ".et_pb_gutters3 .et_pb_text-inner", duration: 250, triggerHook: 0.75})
					.setTween(tween0)
                    .addTo(controller);

});