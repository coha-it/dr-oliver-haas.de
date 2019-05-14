<?php
/*
Plugin Name: Divi Supreme Modules
Plugin URI:  https://suprememodules.com
Description: Supreme Modules enhances the experience and features found on Divi and extend with custom creative modules to help you build amazing websites.
Version:     1.4.9
Author:      Supreme Modules
Author URI:  https://suprememodules.com/about-us/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: dsm-supreme-modules-for-divi
Domain Path: /languages

Supreme Modules is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Supreme Modules is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Supreme Modules. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( version_compare(PHP_VERSION, '5.6', '<') ) {
	function dsm_admin_notice__php_version_error() { ?>
		<div class="notice notice-error">
	    	<p><?php _e( "Goodness! Your PHP version is either too old or not recommended to use Divi Supreme! We are not going to load anything on your WordPress unless you update your PHP. Do you know by using Divi Supreme, you can create even more stunning and amazing site with it? Learn more about the WordPress requirements <a href='https://wordpress.org/about/requirements/'>here</a>.<br><br>Current PHP version is: <span style='color:red; font-weight: bold;'>" . PHP_VERSION . "</span><br><span style='color:green; font-weight: bold;''>Recommended PHP version</span>: 7 and above but 5.6 is fine too but why use an older version? Unless you're not living in the future.", 'dsm-supreme-modules-pro-for-divi' ); ?></p>
		</div>
		<?php
	}
	add_action( 'admin_notices', 'dsm_admin_notice__php_version_error' );
	return;
} else {
	define( 'DSM_VERSION', '1.4.9' );
	define( 'DSM_SHORTCODE', 'divi_shortcode' );

	if ( ! function_exists( 'dsm_initialize_extension' ) ):
	/**
	 * Creates the extension's main class instance.
	 *
	 * @since 1.0.0
	 */
	function dsm_initialize_extension() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/SupremeModulesForDivi.php';
	}
	add_action( 'divi_extensions_init', 'dsm_initialize_extension' );
	endif;

	require_once plugin_dir_path( __FILE__ ) . 'includes/SupremeModulesLoader.php';

	function dsm_scripts(){
	    wp_register_script('dsm-typed', plugin_dir_url( __FILE__ ) . 'assets/js/typed.min.js', array(), DSM_VERSION, true );
	    wp_register_script('dsm-facebook', plugin_dir_url( __FILE__ ) . 'assets/js/dsm-facebook.js', array(), DSM_VERSION, true );
	    wp_register_script('dsm-twitter-embed', 'https://platform.twitter.com/widgets.js', array(), DSM_VERSION, true );
	    if ( et_core_is_fb_enabled() ) {
	    	wp_enqueue_style('dsm-et-admin', plugin_dir_url( __FILE__ ) . 'assets/css/dsm-et-admin.css' );
	    }
	}

	add_action('wp_enqueue_scripts', 'dsm_scripts');

	function load_custom_wp_admin_style() {
	    wp_enqueue_style('dsm-plugin', plugin_dir_url( __FILE__ ) . 'assets/css/dsm-plugin.css' );
	}

	add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');

	register_activation_hook( __FILE__, 'dsm_plugin_activate' );

	if ( ! function_exists( 'dsm_plugin_activate' ) ):
	function dsm_plugin_activate() {
	    flush_rewrite_rules();
	    if ( ! get_option( 'dsm_flush_rewrite_rules_flag' ) ) {
	        add_option( 'dsm_flush_rewrite_rules_flag', true );
	    }
	}
	endif;

	add_action( 'init', 'dsm_flush_rewrite_rules', 20 );

	if ( ! function_exists( 'dsm_flush_rewrite_rules' ) ):
	function dsm_flush_rewrite_rules() {
	    if ( get_option( 'dsm_flush_rewrite_rules_flag' ) ) {
	        flush_rewrite_rules();
	        delete_option( 'dsm_flush_rewrite_rules_flag' );
	    }
	}
	endif;

	add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'dsm_plugin_action_links', 10, 5 );

	if ( ! function_exists( 'dsm_plugin_action_links' ) ):
	function dsm_plugin_action_links( $links ) {
		$dsm_go_pro = sprintf(
      		__( '<a href="' . esc_url( 'https://divisupreme.com/features/' ) . '"" target="_blank" class="dsm-plugin-gopro">%1$s</a>', 'dsm-supreme-modules-for-divi' ),
      		sprintf( '%s', esc_html__( 'Go Pro', 'dsm-supreme-modules-for-divi' ) )
        );

		$links[] = $dsm_go_pro;
		return $links;
	}
	endif;

	add_filter( 'plugin_action_links', 'dsm_add_action_plugin', 10, 5 );
	
	if ( ! function_exists( 'dsm_add_action_plugin' ) ):
	function dsm_add_action_plugin( $actions, $plugin_file ) {
		static $plugin;

		if (!isset($plugin)) 
			$plugin = plugin_basename(__FILE__);
		if ($plugin == $plugin_file) {
			$settings = array('settings' => '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=divi_supreme_settings') ) .'">' . __('Settings', 'dsm-supreme-modules-for-divi') . '</a>');

			$actions = array_merge($settings, $actions);

		}
		return $actions;
	}
	endif;

	add_filter( 'plugin_row_meta', 'dsm_plugin_row_meta', 10, 2 );
 
 	if ( ! function_exists( 'dsm_plugin_row_meta' ) ):
	function dsm_plugin_row_meta( $links, $file ) {    
	    if ( plugin_basename( __FILE__ ) == $file ) {
	        $row_meta = array(
	          'docs'    => '<a href="' . esc_url( 'https://docs.divisupreme.com/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Divi Supreme Documentation', 'dsm-supreme-modules-for-divi' ) . '">' . esc_html__( 'Documentation', 'dsm-supreme-modules-for-divi' ) . '</a>',
	          'support'    => '<a href="' . esc_url( 'https://divisupreme.com/contact/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Get Support', 'dsm-supreme-modules-for-divi' ) . '">' . esc_html__( 'Get Support', 'dsm-supreme-modules-for-divi' ) . '</a>'
	        );
	 
	        return array_merge( $links, $row_meta );
	    }
	    return (array) $links;
	}
	endif;

}