<?php 
if (!defined('ABSPATH')) { exit(); } // No direct access

$text = divibooster_get_setting('116-add-text-to-top-header', 'topheadertext');

if ($text) { 

	?>
	jQuery(function($){
		
		// Add #et-info if missing
		if (!$('#et-info').length) { 
			$('#top-header .container').prepend('<div id="et-info"></div>'); 
		}
		
		// Add the top header text (if not already set via PHP)
		if (!$('#db-info-text').length) {
			$('#et-info').prepend('<span id="db-info-text">'+<?php echo json_encode($text); ?>+'</span>');
		}
	});
<?php
}
