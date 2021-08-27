<?php

class DBDBMagnificPopup {

    private $js_handle;
    private $css_handle;
    private $divi;

    static function create() {
        return new self();
    }

    private function __construct() {
        $this->js_handle = 'dbdb-magnific-popup';
        $this->css_handle = 'dbdb-magnific-popup';
        $this->divi = DBDBDivi::create();
    }

    public function init() {
        add_action('wp_enqueue_scripts', array($this, 'register'));
    }

    public function register() {
        if ($this->divi->supports_dynamic_assets()) { 
            wp_register_script($this->js_handle, $this->divi->dynamic_assets_url('/js/magnific-popup.js'), array( 'jquery' ), $this->divi->version(), true );
            wp_register_style($this->css_handle, $this->divi->dynamic_assets_url('/css/magnific_popup.css'), array(), $this->divi->version() );
        }
    }

    public function enqueue() {
        wp_enqueue_style($this->css_handle);
        wp_enqueue_script($this->js_handle);
    }
}