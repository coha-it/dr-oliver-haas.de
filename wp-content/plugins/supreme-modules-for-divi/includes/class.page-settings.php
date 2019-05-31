<?php

/**
 * WordPress settings API
 *
 */
if ( !class_exists('DSM_Settings' ) ):
class DSM_Settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new DSM_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_menu_page( __( 'Divi Supreme', 'dsm-supreme-modules-for-divi' ), __( 'Divi Supreme', 'dsm-supreme-modules-for-divi' ), 'manage_options', 'divi_supreme_settings', array($this, 'plugin_page'), plugins_url( 'supreme-modules-for-divi/admin/img/icon-128x128.png' ), 99 );
        if ( $this->settings_api->get_option( 'dsm_use_header_footer', 'dsm_general' ) == 'on' ) {
            add_submenu_page( 'divi_supreme_settings', __( 'Divi Templates', 'dsm-supreme-modules-for-divi' ), __( 'Divi Templates', 'dsm-supreme-modules-for-divi' ), 'manage_options', 'edit.php?post_type=dsm_header_footer' );
        }
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id'    => 'dsm_general',
                'title' => __( 'Divi Supreme General Settings', 'dsm-supreme-modules-for-divi' ),
                'desc'  => __( 'Divi Supreme features a huge collection of custom creative modules and extensions that can be used in the Divi Theme, Extra Theme and the Divi Builder. This is really a premium plugin that you can get for free on WordPress plugin repository. Here&apos;s where you can find extra features for Divi to help you build better websites.', 'dsm-supreme-modules-for-divi' ),
            ),
            /*
            array(
                'id'    => 'dsm_advanced',
                'title' => __( 'Advanced', 'dsm-supreme-modules-for-divi' )
            )*/
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'dsm_general' => array(
                array(
                    'name'    => 'dsm_section_subtitle',
                    'class' => 'dsm-section-subtitle',
                    'label'   => __( '<h3>Divi Supreme Extensions</h3>', 'dsm-supreme-modules-for-divi' ),
                    'type'    => 'html',
                ),
                array(
                    'name'  => 'dsm_use_scheduled_content',
                    'class' => 'dsm-settings-checkbox',
                    'label' => __( 'Enable Scheduled Content on Section & Row', 'dsm-supreme-modules-for-divi' ),
                    'desc'  => __( '<span class="slider round"></span>', 'dsm-supreme-modules-for-divi' ),
                    'type'  => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'  => 'dsm_use_header_footer',
                    'class' => 'dsm-settings-checkbox',
                    'label' => __( 'Enable Divi Templates', 'dsm-supreme-modules-for-divi' ),
                    'desc'  => __( '<span class="slider round"></span>', 'dsm-supreme-modules-for-divi' ),
                    'type'  => 'checkbox',
                    'default' => 'off'
                ),
                array(
                    'name'  => 'dsm_use_shortcode',
                    'class' => 'dsm-settings-checkbox',
                    'label' => __( 'Enable Divi Library Shortcodes', 'dsm-supreme-modules-for-divi' ),
                    'desc'  => __( '<span class="slider round"></span>', 'dsm-supreme-modules-for-divi' ),
                    'type'  => 'checkbox',
                    'default' => 'off'
                ),
            ),
            /*
            'dsm_advanced' => array(
                array(
                    'name'    => 'color',
                    'label'   => __( 'Color', 'wedevs' ),
                    'desc'    => __( 'Color description', 'wedevs' ),
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'    => 'password',
                    'label'   => __( 'Password', 'wedevs' ),
                    'desc'    => __( 'Password description', 'wedevs' ),
                    'type'    => 'password',
                    'default' => '123'
                ),
                array(
                    'name'    => 'wysiwyg',
                    'label'   => __( 'Advanced Editor', 'wedevs' ),
                    'desc'    => __( 'WP_Editor description', 'wedevs' ),
                    'type'    => 'wysiwyg',
                    'default' => ''
                ),
                array(
                    'name'    => 'multicheck',
                    'label'   => __( 'Multile checkbox', 'wedevs' ),
                    'desc'    => __( 'Multi checkbox description', 'wedevs' ),
                    'type'    => 'multicheck',
                    'default' => array('one' => 'one', 'four' => 'four'),
                    'options' => array(
                        'one'   => 'One',
                        'two'   => 'Two',
                        'three' => 'Three',
                        'four'  => 'Four'
                    )
                ),
            )*/
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;
new DSM_Settings();