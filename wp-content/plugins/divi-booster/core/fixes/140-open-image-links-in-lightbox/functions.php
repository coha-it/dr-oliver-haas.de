<?php
if (!defined('ABSPATH')) { exit(); } // No direct access

function db140_user_js($plugin) { 
	?>
	jQuery(function($) {

		// Get all links and turn into a magnific popup instance
		$('.entry-content a').filter(function(){
		
			// Get links to images
			if(/\.(?:jpg|jpeg|gif|png|bmp)$/i.test($(this).attr('href'))){
				return true;
			}
			return false;
			
		}).filter(function(){
			
			// Avoid affecting linked images in gallery module
			if ($(this).parent().hasClass("et_pb_gallery_image")) {
				return false;
			}
			return true;
			
		}).magnificPopup({type:'image'});
	});
	<?php 
}
add_action('wp_footer.js', 'db140_user_js');
