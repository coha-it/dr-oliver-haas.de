<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//  
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
//
// Your code goes below
//

// Add Custom CSS and JS
function add_theme_codes() {
    // **** CSS **** //
    // Owl CSS
    wp_enqueue_style( 'style-owl-basic', get_stylesheet_directory_uri().'/src/css/owl.carousel.min.css', 'all');
    wp_enqueue_style( 'style-owl-theme', get_stylesheet_directory_uri().'/src/css/owl.theme.default.min.css', 'all');
    wp_enqueue_style( 'style-custom', get_stylesheet_directory_uri().'/src/css/custom.css', 'all');

    // **** JavaScript **** //
    // Owl JS
    wp_enqueue_script( 'custom-script-1', get_stylesheet_directory_uri().'/src/js/owl.carousel.min.js', ['jquery']);

    // Scrollmagic & Dependencies
    wp_enqueue_script( 'script-scrollto-plugin',    get_stylesheet_directory_uri().'/src/js/greensock/plugins/ScrollToPlugin.min.js', ['jquery']);
    wp_enqueue_script( 'script-scrollto-plugin',    get_stylesheet_directory_uri().'/src/js/greensock/TweenMax.min.js', ['jquery']);
    wp_enqueue_script( 'script-scrollmagic',        get_stylesheet_directory_uri().'/src/js/scrollmagic/ScrollMagic.min.js', ['jquery']);
    wp_enqueue_script( 'script-animation-gsap',     get_stylesheet_directory_uri().'/src/js/scrollmagic/plugins/animation.gsap.min.js', ['jquery']);

    // Custom CSS
    wp_enqueue_script( 'custom-script-2', get_stylesheet_directory_uri().'/src/js/custom.js', 'all');

}

add_action( 'wp_enqueue_scripts', 'add_theme_codes' );
