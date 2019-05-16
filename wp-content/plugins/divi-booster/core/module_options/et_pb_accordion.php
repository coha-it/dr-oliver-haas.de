<?php
add_filter('dbmo_et_pb_accordion_whitelisted_fields', 'dbmo_et_pb_accordion_register_fields');
add_filter('dbmo_et_pb_accordion_fields', 'dbmo_et_pb_accordion_add_fields');
add_filter('db_pb_accordion_content', 'db_pb_accordion_filter_content', 10, 2);

function dbmo_et_pb_accordion_register_fields($fields) {
	$fields[] = 'db_initial_state';
	$fields[] = 'db_closeable';
	return $fields;
}

function dbmo_et_pb_accordion_add_fields($fields) {
	
	// Add initial state option
	$fields['db_initial_state'] = array(
		'label' => 'Initial State',
		'type' => 'select',
		'option_category' => 'layout',
		'options' => array(
			'default'   => esc_html__( 'Default', 'et_builder' ),
			'all_closed'  => esc_html__( 'All Closed', 'et_builder' ),
			'all_open' => esc_html__( 'All Open', 'et_builder' ),
		),
		'description' => 'Set the initial open / closed state of the accordion. '.divibooster_module_options_credit(),
		'default' => 'default',
		'tab_slug'          => 'advanced',
		'toggle_slug'       => 'toggle',
	);		
	
	// Add option to make accordion toggles closeable
	$fields['db_closeable'] = array(
		'label' => 'Closeable',
		'type' => 'yes_no_button',
		'options' => array(
			'off' => esc_html__( 'No', 'et_builder' ),
			'on'  => esc_html__( 'yes', 'et_builder' ),
		),
		'option_category' => 'basic_option',
		'description' => 'Choose whether individual accordion toggles can be closed. '.divibooster_module_options_credit(),
		'default' => 'off',
		'tab_slug'          => 'advanced',
		'toggle_slug'       => 'toggle',
	);
	
	// // Put height setting into appropriate subheading
	// if (!empty($fields['max_width']['toggle_slug'])) { // Sizing subheading
		// $fields['db_height']['toggle_slug'] = $fields['max_width']['toggle_slug'];
	// } else { // Layout subheading, if it exists
		// $fields['db_height']['toggle_slug'] = 'layout';
	// }

	return $fields;
}

// Process added options
function db_pb_accordion_filter_content($content, $args, $module='et_pb_accordion') {

	// Don't apply settings to excerpts
	if (!is_singular()) { return $content; }	

	// Get the class
	$order_class = divibooster_get_order_class_from_content('et_pb_accordion', $content);
	if (!$order_class) { return $content; }
	
	$js = '';
	$css = '';
	
	// Set initial open / close state
	if (!empty($args['db_initial_state'])) {
		
		if ($args['db_initial_state'] === 'all_closed') {
			$js .= db_pb_accordion_js_all_closed($order_class);
		} elseif ($args['db_initial_state'] === 'all_open') {
			$js .= db_pb_accordion_js_all_open($order_class);
		}
	}
	
	// Set toggles as closeable
	if (!empty($args['db_closeable'])) {
		
		if ($args['db_closeable'] === 'on') {
			$js .= db_pb_accordion_js_closeable($order_class);
			$css .= db_pb_accordion_css_closeable($order_class);
		}
	}
	
	if (!empty($css)) { $content.="<style>$css</style>"; }
	if (!empty($js)) { $content.="<script>$js</script>"; }
	
	return $content;
}

function db_pb_accordion_js_all_closed($order_class) {
	return <<<END
jQuery(function($){
    $('.et_pb_accordion.{$order_class} .et_pb_toggle_open').toggleClass('et_pb_toggle_open et_pb_toggle_close');

    $('.et_pb_accordion.{$order_class} .et_pb_toggle').click(function() {
      var toggle = $(this);
      setTimeout(function(){
         toggle.closest('.et_pb_accordion').removeClass('et_pb_accordion_toggling');
      },700);
    });
});
END;
}

function db_pb_accordion_js_all_open($order_class) {
	return <<<END
jQuery(function($){
    $('.et_pb_accordion.{$order_class} .et_pb_toggle_close').toggleClass('et_pb_toggle_open et_pb_toggle_close');

    $('.et_pb_accordion.{$order_class} .et_pb_toggle').click(function() {
      var toggle = $(this);
      setTimeout(function(){
         toggle.closest('.et_pb_accordion').removeClass('et_pb_accordion_toggling');
      },700);
    });
});
END;
}

function db_pb_accordion_js_closeable($order_class) {
	return <<<END
jQuery(function($){
  $('.{$order_class} .et_pb_toggle_title').click(function(){
    var toggle = $(this).closest('.et_pb_toggle');
    if (!toggle.hasClass('et_pb_accordion_toggling')) {
      var accordion = toggle.closest('.et_pb_accordion');
      if (toggle.hasClass('et_pb_toggle_open')) {
        accordion.addClass('et_pb_accordion_toggling');
        toggle.find('.et_pb_toggle_content').slideToggle(700, function() { 
          toggle.toggleClass('et_pb_toggle_open et_pb_toggle_close'); 
        });
      }
      setTimeout(function(){ 
        accordion.removeClass('et_pb_accordion_toggling'); 
      }, 750);
    }
  });
});
END;
}

function db_pb_accordion_css_closeable($order_class) {
	return <<<END
.{$order_class} .et_pb_toggle_open .et_pb_toggle_title:before {
	display: block !important;
	content: "\\e04f";
}
END;
}