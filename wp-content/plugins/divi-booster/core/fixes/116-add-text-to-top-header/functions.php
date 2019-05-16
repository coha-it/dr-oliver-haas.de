<?php

// === Try to add the header via Divi filter to allow dynamic shortcodes, etc === 
// - Will fall back to js implementation in wp_footer_script.php if not possible 
// -- (e.g. in Divi pre-3.1 when the et_html_top_header filter did not exist).

add_filter('et_html_top_header', 'db116_add_top_header_text');

function db116_add_top_header_text($html) {

	$text = divibooster_get_setting('116-add-text-to-top-header', 'topheadertext');

	// Add #et-info if missing
	if (strpos($html, '<div id="et-info"') === false) {
		str_replace('<div id="et-secondary-menu"', '<div id="et-info"></div><div id="et-secondary-menu"', $html);
	}
	
	// Add the top header text
	$text_html = '<span id="db-info-text">'.$text.'</span>';
	$html = str_replace('<div id="et-info">', '<div id="et-info">'.$text_html, $html);
	
	return $html;

}

// === Style the top header text ===

add_action('wp_head.css', 'db116_add_top_header_text_css');

function db116_add_top_header_text_css() {
	?>
	#db-info-text { margin:0 10px; }
	<?php
}

// === Do shortcodes within the top header text ===

add_filter('divibooster_setting_116-add-text-to-top-header_topheadertext', 'db116_do_shortcodes_in_top_header_text');

function db116_do_shortcodes_in_top_header_text($text) {
	
	$text = do_shortcode($text);
	
	return $text;
}