<?php
add_filter('dbmo_et_pb_portfolio_whitelisted_fields', 'dbmo_et_pb_portfolio_register_fields');
add_filter('dbmo_et_pb_portfolio_fields', 'dbmo_et_pb_portfolio_add_fields');

function dbmo_et_pb_portfolio_register_fields($fields) {
	$fields[] = 'db_project_order';
	return $fields;
}

function dbmo_et_pb_portfolio_add_fields($fields) {
	
	// Add project order field
	$fields['db_project_order'] = array(
		'label' => 'Project Order',
		'type' => 'select',
		'option_category' => 'layout',
		'options' => array(
			'default'   => esc_html__('Default', 'et_builder'),
			'random' => esc_html__('Random', 'et_builder'),
			'reverse' => esc_html__('Reverse', 'et_builder')
		),
		'default' => 'default',
		'description' => 'Adjust the order in which projects are displayed. '.divibooster_module_options_credit(),
		'tab_slug' => 'advanced',
		'toggle_slug' => 'layout'
	);
	
	return $fields;
}

/* === Run an action hook ("pre_get_portfolio_projects") when the portfolio module gets projects via WP_Query === */

add_filter('et_pb_module_shortcode_attributes', 'db_add_pre_get_portfolio_projects', 10, 3);
add_filter('et_module_shortcode_output', 'db_remove_pre_get_portfolio_projects_random');

function db_add_pre_get_portfolio_projects($props, $atts, $slug) {

	// Do nothing if this module isn't a portfolio
	$portfolio_module_slugs = array('et_pb_portfolio', 'et_pb_filterable_portfolio', 'et_pb_fullwidth_portfolio');
	if (!in_array($slug, $portfolio_module_slugs)) {
		return $props;
	}
	
	// Add an action to run during pre_get_posts for randomized portfolio modules only
	if (isset($atts['db_project_order'])) {
		
		$order = $atts['db_project_order'];
		
		if ($order === 'random') {
			
			add_action('pre_get_posts', 'db_do_portfolio_pre_get_posts_random');
			
		} elseif ($order === 'reverse') {
			
			add_action('pre_get_posts', 'db_do_portfolio_pre_get_posts_reverse');
		}
	}

	return $props;
}

function db_do_portfolio_pre_get_posts_random($query) {
		
	do_action('db_pre_get_portfolio_projects_random', $query);
}

function db_do_portfolio_pre_get_posts_reverse($query) {
		
	do_action('db_pre_get_portfolio_projects_reverse', $query);
}

function db_remove_pre_get_portfolio_projects_random($content) {
	
	remove_action('pre_get_posts', 'db_do_portfolio_pre_get_posts_random');
	remove_action('pre_get_posts', 'db_do_portfolio_pre_get_posts_reverse');
	
	return $content;
}

/* === Randomize the portfolio module projects === */

add_action('db_pre_get_portfolio_projects_random', 'db_randomize_portfolio_module_projects');

function db_randomize_portfolio_module_projects($query) {	

	$query->set('orderby', 'rand');
}

/* === Reverse the portfolio module projects === */

add_action('db_pre_get_portfolio_projects_reverse', 'db_reverse_portfolio_module_projects');

function db_reverse_portfolio_module_projects($query) {	

	$query->set('order', 'ASC');
}
