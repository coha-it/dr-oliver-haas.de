<?php 

add_filter('dbmo_et_pb_video_whitelisted_fields', 'dbmo_et_pb_video_register_fields');
add_filter('dbmo_et_pb_video_fields', 'dbmo_et_pb_video_add_fields');
add_filter('db_pb_video_content', 'db_pb_video_filter_content', 10, 2);

function dbmo_et_pb_video_register_fields($fields) {
	$fields[] = 'db_show_youtube_related_videos';
	return $fields;
}

function dbmo_et_pb_video_add_fields($fields) {

	// Add the custom label toggle
	$fields['db_limit_youtube_related_videos_to_same_channel'] = array(
		'label' => 'Limit YouTube Related Videos to Same Channel',
		'type' => 'yes_no_button',
		'options' => array(
			'off' => esc_html__( 'No', 'et_builder' ),
			'on'  => esc_html__( 'Yes', 'et_builder' ),
		),
		'option_category' => 'basic_option',
		'description' => 'YouTube show related videos when playback of the initial video ends. By default, these can come from any channel. Enabling this option limits the related videos to those in the same channel as the current video. '.divibooster_module_options_credit(),
		'default' => 'off',
		'toggle_slug' => 'main_content'
	);
	
	return $fields;
}

function db_pb_video_filter_content($content, $args) {

	// Apply custom labels
	if (!empty($args['db_limit_youtube_related_videos_to_same_channel']) && 
		$args['db_limit_youtube_related_videos_to_same_channel'] === 'on') {
		
		$content = preg_replace(
			'/('.
				preg_quote('https://www.youtube.com/embed/', '/').
				'[A-Za-z0-9]+'.
				preg_quote('?feature=oembed', '/').
			')/', 
			'\\1&rel=0', 
			$content
		);
		
		// $label_fields = dbmo_et_pb_video_get_label_fields();
		
		// foreach($label_fields as $k=>$label) {
			// if (isset($args[$k])) {
				// $size = preg_replace('/.*_(full|short)/', '\\1', $k);
				// $content = str_replace(
					// 'data-'.$size.'="'.esc_attr($label['default']).'"', 
					// 'data-'.$size.'="'.esc_attr($args[$k]).'"', 
					// $content
				// );
			// }
		// }		
	}

	return $content;
}