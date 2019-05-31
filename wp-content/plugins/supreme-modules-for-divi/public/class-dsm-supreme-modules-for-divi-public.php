<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://suprememodules.com/about-us/
 * @since      1.0.0
 *
 * @package    Dsm_Supreme_Modules_For_Divi
 * @subpackage Dsm_Supreme_Modules_For_Divi/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Dsm_Supreme_Modules_For_Divi
 * @subpackage Dsm_Supreme_Modules_For_Divi/public
 * @author     Supreme Modules <hello@divisupreme.com>
 */
class Dsm_Supreme_Modules_For_Divi_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dsm_Supreme_Modules_For_Divi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dsm_Supreme_Modules_For_Divi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dsm-supreme-modules-for-divi-public.css', array(), $this->version, 'all' );
		if ( et_core_is_fb_enabled() ) {
			wp_enqueue_style( 'dsm-et-admin', plugin_dir_url( __FILE__ ) . 'css/dsm-et-admin.css' );
		}

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dsm_Supreme_Modules_For_Divi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dsm_Supreme_Modules_For_Divi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dsm-supreme-modules-for-divi-public.js', array( 'jquery' ), $this->version, false );
		wp_register_script('dsm-typed', plugin_dir_url( __FILE__ ) . 'js/typed.min.js', array(), DSM_VERSION, true );
        wp_register_script('dsm-facebook', plugin_dir_url( __FILE__ ) . 'js/dsm-facebook.js', array(), DSM_VERSION, true );
        wp_register_script('dsm-twitter-embed', 'https://platform.twitter.com/widgets.js', array(), DSM_VERSION, true );

	}

}
