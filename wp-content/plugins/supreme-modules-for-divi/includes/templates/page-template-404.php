<?php
/*
Template Name: 404 Blank Page
*/

get_header();
?>
<div id="main-content">
    <article id="post-0" <?php post_class( 'not_found' ); ?>>
        <?php 
            $footer_args = array(
                'post_type' => 'dsm_header_footer',
                'meta_key'     => 'dsm-header-footer-meta-box-options',
                'meta_value'   => '404',
                'meta_type'    => 'post',
                'meta_query'     => array(
                    array(
                        'key'     => 'dsm-header-footer-meta-box-options',
                        'value'   => '404',
                        'compare' => '==',
                        'type'    => 'post',
                    ),
                ),
            );

            $footer_template = new WP_Query(
                $footer_args
            );

            $footer_css_args = array(
                'post_type' => 'dsm_header_footer',
                'meta_key'     => 'dsm-css-classes-meta-box-options',
                'value' => '',
                'meta_type'    => 'post',
                'meta_query'     => array(
                    array(
                        'key'     => 'dsm-css-classes-meta-box-options',
                        'value'   => '',
                        'compare' => '!=',
                        'type'    => 'post',
                    ),
                ),
            );

            $footer_css_template = new WP_Query(
                $footer_css_args
            );

            $footer_conditional_args = array(
                'post_type' => 'dsm_header_footer',
                'meta_key'     => 'dsm-conditional-meta-box-options',
                'value' => '',
                'meta_type'    => 'post',
                'meta_query'     => array(
                    array(
                        'key'     => 'dsm-conditional-meta-box-options',
                        'value'   => '',
                        'compare' => '!=',
                        'type'    => 'post',
                    ),
                ),
            );

            $footer_exclude = new WP_Query(
                $footer_conditional_args
            );

            if ( $footer_template->have_posts() ) {
                $footer_template_ID = $footer_template->post->ID;
                $footer_template_shortcode = apply_filters('the_content', get_post_field('post_content', $footer_template_ID));
                $footer_template_css = get_post_custom($footer_template_ID);

                echo $footer_template_shortcode;
            }
        ?>

    </article> <!-- .et_pb_post -->
</div> <!-- #main-content -->

<?php

get_footer();
