<?php
require_once plugin_dir_path( __FILE__ ) . 'class.settings-api.php';
require_once plugin_dir_path( __FILE__ ) . 'class.page-settings.php';

/*Temporary fix*/
if ( ! function_exists( 'et_core_is_fb_enabled' ) ):
function et_core_is_fb_enabled() {
    return function_exists( 'et_fb_is_enabled' ) && et_fb_is_enabled();
}
endif;
if ( ! function_exists( 'et_divi_divider_style_choices' ) ) :
/**
 * Returns divider style choices
 * @return array
 */
function et_divi_divider_style_choices() {
    return apply_filters( 'et_divi_divider_style_choices', array(
        'solid'		=> esc_html__( 'Solid', 'Divi' ),
        'dotted'	=> esc_html__( 'Dotted', 'Divi' ),
        'dashed'	=> esc_html__( 'Dashed', 'Divi' ),
        'double'	=> esc_html__( 'Double', 'Divi' ),
        'groove'	=> esc_html__( 'Groove', 'Divi' ),
        'ridge'		=> esc_html__( 'Ridge', 'Divi' ),
        'inset'		=> esc_html__( 'Inset', 'Divi' ),
        'outset'	=> esc_html__( 'Outset', 'Divi' ),
    ) );
}
endif;
/*End of Temporary fix*/

function dsm_setting_get_option( $option, $section, $default = '' ) {

    $options = get_option( $section );

    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }

    return $default;
}

if ( dsm_setting_get_option( 'dsm_use_scheduled_content', 'dsm_general' ) == 'on' ) {
    add_filter('et_pb_all_fields_unprocessed_et_pb_section', 'dsm_add_section_setting');
    function dsm_add_section_setting($fields_unprocessed) {
        $fields = [];
        $fields['dsm_section_schedule_visibility'] = array(
            'label'            => esc_html__( 'Use Scheduled Content Visibility', 'dsm-supreme-modules-for-divi' ),
            'type'            => 'yes_no_button',
            'option_category' => 'configuration',
            'options'         => array(
                'off' => esc_html__( 'No', 'dsm-supreme-modules-for-divi' ),
                'on'  => esc_html__( 'Yes', 'dsm-supreme-modules-for-divi' ),
            ),
            'default_on_front' => 'off',
            'tab_slug'        => 'custom_css',
            'toggle_slug'     => 'visibility',
            'description'      => esc_html__( 'Here you can choose whether your Section will show or hide depending on the given date/time.', 'dsm-supreme-modules-for-divi' ),
        );
        $fields['dsm_section_schedule_show_hide'] = array(
            'label'            => esc_html__( 'Show or Hide Section', 'dsm-supreme-modules-for-divi' ),
            'type'            => 'select',
            'option_category' => 'configuration',
            'options'         => array(
                'start' => esc_html__( 'Show', 'dsm-supreme-modules-for-divi' ),
                'end'  => esc_html__( 'Hide', 'dsm-supreme-modules-for-divi' ),
            ),
            'default_on_front' => 'start',
            'tab_slug'        => 'custom_css',
            'toggle_slug'     => 'visibility',
            'show_if' => array(
                'dsm_section_schedule_visibility' => 'on',
            ),
        );
        $fields['dsm_section_schedule_after_datetime'] = array(
            'default'         => '',
            'label'           => esc_html__( 'Schedule a Date/Time', 'dsm-supreme-modules-for-divi' ),
            'type'            => 'date_picker',
            'tab_slug'        => 'custom_css',
            'toggle_slug'     => 'visibility',
            'show_if' => array(
                'dsm_section_schedule_visibility' => 'on',
            ),
        );
        return array_merge($fields_unprocessed, $fields);
    }

    add_filter( 'et_module_shortcode_output', 'output_section', 10, 3 );
    function output_section( $output, $render_slug, $module ) {
        if ('et_pb_section' !== $render_slug) {
            return $output;
        } else if ('on' !== $module->props['dsm_section_schedule_visibility']) {
            return $output;
        } else {
            $dsm_section_schedule_visibility = $module->props['dsm_section_schedule_visibility'];
            $dsm_section_schedule_show_hide = $module->props['dsm_section_schedule_show_hide'];
            $dsm_section_schedule_after_datetime = $module->props['dsm_section_schedule_after_datetime'];

            $dsm_section_class_output = '';
            if ($dsm_section_schedule_visibility == 'on') {
                $dsm_section_class_output .= ' dsm_schedule_visibility';
            }
            $output = str_replace('class="et_pb_section ', 'data-dsm-' . esc_html($dsm_section_schedule_show_hide) . '="' . esc_html($dsm_section_schedule_after_datetime) . '" class="et_pb_section'. $dsm_section_class_output .' ', $output);
            return $output;
        }
    }

    add_filter('et_pb_all_fields_unprocessed_et_pb_row', 'dsm_add_row_setting');
    function dsm_add_row_setting($fields_unprocessed) {
        $fields = [];
        $fields['dsm_row_schedule_visibility'] = array(
            'label'            => esc_html__( 'Use Scheduled Content Visibility', 'dsm-supreme-modules-for-divi' ),
            'type'            => 'yes_no_button',
            'option_category' => 'configuration',
            'options'         => array(
                'off' => esc_html__( 'No', 'dsm-supreme-modules-for-divi' ),
                'on'  => esc_html__( 'Yes', 'dsm-supreme-modules-for-divi' ),
            ),
            'default_on_front' => 'off',
            'tab_slug'        => 'custom_css',
            'toggle_slug'     => 'visibility',
            'description'      => esc_html__( 'Here you can choose whether your Row will show/hide depending on the given date/time.', 'dsm-supreme-modules-for-divi' ),
        );
        $fields['dsm_row_schedule_show_hide'] = array(
            'label'            => esc_html__( 'Show or Hide Row', 'dsm-supreme-modules-for-divi' ),
            'type'            => 'select',
            'option_category' => 'configuration',
            'options'         => array(
                'start' => esc_html__( 'Show', 'dsm-supreme-modules-for-divi' ),
                'end'  => esc_html__( 'Hide', 'dsm-supreme-modules-for-divi' ),
            ),
            'default_on_front' => 'start',
            'tab_slug'        => 'custom_css',
            'toggle_slug'     => 'visibility',
            'show_if' => array(
                'dsm_row_schedule_visibility' => 'on',
            ),
        );
        $fields['dsm_row_schedule_after_datetime'] = array(
            'default'         => '',
            'label'           => esc_html__( 'Schedule a Date/Time', 'dsm-supreme-modules-for-divi' ),
            'type'            => 'date_picker',
            'tab_slug'        => 'custom_css',
            'toggle_slug'     => 'visibility',
            'show_if' => array(
                'dsm_row_schedule_visibility' => 'on',
            ),
        );
        return array_merge($fields_unprocessed, $fields);
    }

    add_filter( 'et_module_shortcode_output', 'output_row', 10, 3 );
    function output_row( $output, $render_slug, $module ) {
        if ('et_pb_row' !== $render_slug) {
            return $output;
        } else if ('on' !== $module->props['dsm_row_schedule_visibility']) {
            return $output;
        } else {
            $dsm_row_schedule_visibility = $module->props['dsm_row_schedule_visibility'];
            $dsm_row_schedule_show_hide = $module->props['dsm_row_schedule_show_hide'];
            $dsm_row_schedule_after_datetime = $module->props['dsm_row_schedule_after_datetime'];

            $dsm_row_class_output = '';
            if ($dsm_row_schedule_visibility == 'on') {
                $dsm_row_class_output .= ' dsm_schedule_visibility';
            }
            $output = str_replace('class="et_pb_row ', 'data-dsm-' . esc_html($dsm_row_schedule_show_hide) . '="' . esc_html($dsm_row_schedule_after_datetime) . '" class="et_pb_row'. $dsm_row_class_output .' ', $output);
            return $output;
        }
    }

}
// Load custom CF
if( ! function_exists( 'dsm_et_builder_load_actions' )) {
    function dsm_et_builder_load_actions( $actions ) {
        $actions[] = 'dsm_load_caldera_forms';

        return $actions;
    }
}

add_filter( 'et_builder_load_actions', 'dsm_et_builder_load_actions' );

if( ! function_exists( 'dsm_load_caldera_forms' )) {
function dsm_load_caldera_forms() {
    if ( ! wp_verify_nonce( $_POST['et_admin_load_nonce'], 'et_admin_load_nonce' ) ) {
            wp_die();
        }  
        echo do_shortcode( '[caldera_form id="' . $_POST['cf_library'] . '"]' );
        wp_die();
    }
}
add_action( 'wp_ajax_nopriv_dsm_load_caldera_forms', 'dsm_load_caldera_forms' );
add_action( 'wp_ajax_dsm_load_caldera_forms', 'dsm_load_caldera_forms' );

// Load custom CF7
if( ! function_exists( 'dsm_et_builder_load_actions' )) {
    function dsm_et_builder_load_actions( $actions ) {
        $actions[] = 'dsm_load_cf7_library';

        return $actions;
    }
}

add_filter( 'et_builder_load_actions', 'dsm_et_builder_load_actions' );

if( ! function_exists( 'dsm_load_cf7_library' )) {
function dsm_load_cf7_library() {
    if ( ! wp_verify_nonce( $_POST['et_admin_load_nonce'], 'et_admin_load_nonce' ) ) {
            wp_die();
        }  
        echo do_shortcode( '[contact-form-7 id="' . $_POST['cf7_library'] . '"]' );
        wp_die();
    }
}
add_action( 'wp_ajax_nopriv_dsm_load_cf7_library', 'dsm_load_cf7_library' );
add_action( 'wp_ajax_dsm_load_cf7_library', 'dsm_load_cf7_library' );

/* Removing default submit tag */
remove_action( 'wpcf7_init', 'wpcf7_add_form_tag_submit' );
//remove_action( 'wpcf7_init', 'wpcf7_add_shortcode_submit', 20 );
add_action( 'wpcf7_init', 'dsm_wpcf7_add_form_tag_submit' );
if ( !function_exists('dsm_wpcf7_add_form_tag_submit') ) {
    function dsm_wpcf7_add_form_tag_submit() {
        wpcf7_add_form_tag( 'submit', 'dsm_wpcf7_submit_form_tag_handler' );
    }
}

if ( !function_exists('dsm_wpcf7_submit_form_tag_handler') ) {
    function dsm_wpcf7_submit_form_tag_handler( $tag ) {
        $class = wpcf7_form_controls_class( $tag->type . ' et_pb_button' );

        $atts = array();

        $atts['class'] = $tag->get_class_option( $class );
        $atts['id'] = $tag->get_id_option();
        $atts['tabindex'] = $tag->get_option( 'tabindex', 'signed_int', true );

        $value = isset( $tag->values[0] ) ? $tag->values[0] : '';

        if ( empty( $value ) ) {
            $value = __( 'Send', 'contact-form-7' );
        }

        $atts['type'] = 'submit';
        $atts['value'] = $value;

        $atts = wpcf7_format_atts( $atts );

        $html = '<button ' . $atts . '>' . esc_attr( $value ) .  '</button>';

        return $html;
    }
}

remove_action( 'wpcf7_init', 'wpcf7_add_form_tag_select', 20 );
add_action( 'wpcf7_init', 'dsm_wpcf7_add_form_tag_select' );

function dsm_wpcf7_add_form_tag_select() {
    wpcf7_add_form_tag( array( 'select', 'select*' ),
        'dsm_wpcf7_select_form_tag_handler',
        array(
            'name-attr' => true,
            'selectable-values' => true,
        )
    );
}

function dsm_wpcf7_select_form_tag_handler( $tag ) {
    if ( empty( $tag->name ) ) {
        return '';
    }

    $validation_error = wpcf7_get_validation_error( $tag->name );

    $class = wpcf7_form_controls_class( $tag->type );

    if ( $validation_error ) {
        $class .= ' wpcf7-not-valid';
    }

    $atts = array();

    $atts['class'] = $tag->get_class_option( $class . ' et_pb_contact_select input' );
    $atts['id'] = $tag->get_id_option();
    $atts['tabindex'] = $tag->get_option( 'tabindex', 'signed_int', true );

    if ( $tag->is_required() ) {
        $atts['aria-required'] = 'true';
    }

    $atts['aria-invalid'] = $validation_error ? 'true' : 'false';

    $multiple = $tag->has_option( 'multiple' );
    $include_blank = $tag->has_option( 'include_blank' );
    $first_as_label = $tag->has_option( 'first_as_label' );

    if ( $tag->has_option( 'size' ) ) {
        $size = $tag->get_option( 'size', 'int', true );

        if ( $size ) {
            $atts['size'] = $size;
        } elseif ( $multiple ) {
            $atts['size'] = 4;
        } else {
            $atts['size'] = 1;
        }
    }

    $values = $tag->values;
    $labels = $tag->labels;

    if ( $data = (array) $tag->get_data_option() ) {
        $values = array_merge( $values, array_values( $data ) );
        $labels = array_merge( $labels, array_values( $data ) );
    }

    $default_choice = $tag->get_default_option( null, array(
        'multiple' => $multiple,
        'shifted' => $include_blank,
    ) );

    if ( $include_blank || empty( $values ) ) {
        array_unshift( $labels, '---' );
        array_unshift( $values, '' );
    } elseif ( $first_as_label ) {
        $values[0] = '';
    }

    $html = '';
    $hangover = wpcf7_get_hangover( $tag->name );

    foreach ( $values as $key => $value ) {
        if ( $hangover ) {
            $selected = in_array( $value, (array) $hangover, true );
        } else {
            $selected = in_array( $value, (array) $default_choice, true );
        }

        $item_atts = array(
            'value' => $value,
            'selected' => $selected ? 'selected' : '',
        );

        $item_atts = wpcf7_format_atts( $item_atts );

        $label = isset( $labels[$key] ) ? $labels[$key] : $value;

        $html .= sprintf( '<option %1$s>%2$s</option>',
            $item_atts, esc_html( $label ) );
    }

    if ( $multiple ) {
        $atts['multiple'] = 'multiple';
    }

    $atts['name'] = $tag->name . ( $multiple ? '[]' : '' );

    $atts = wpcf7_format_atts( $atts );

    $html = sprintf(
        '<span class="wpcf7-form-control-wrap dsm-contact-form-7-select %1$s"><select %2$s>%3$s</select>%4$s</span>',
        sanitize_html_class( $tag->name ), $atts, $html, $validation_error );

    return $html;
}

function dsm_admin_footer_text( $footer_text ) {
    $current_screen = get_current_screen();
    $is_divi_supreme_screen = ( $current_screen && false !== strpos( $current_screen->id, 'toplevel_page_divi_supreme_settings' ) );

    if ( $is_divi_supreme_screen ) {
        $footer_text = sprintf(
      __( 'If you like %1$s please leave us a %2$s rating. A huge thanks in advance!', 'dsm-supreme-modules-for-divi' ),
      sprintf( '<strong>%s</strong>', esc_html__( 'Divi Supreme', 'dsm-supreme-modules-for-divi' ) ),
      '<a href="https://wordpress.org/support/plugin/supreme-modules-for-divi/reviews/?rate=5#new-post" target="_blank" class="dsm-rating-link" data-rated="' . esc_attr__( 'Thanks :)', 'dsm-supreme-modules-for-divi' ) . '">&#9733;&#9733;&#9733;&#9733;&#9733;</a>'
        );
    }

    return $footer_text;
}

add_filter('admin_footer_text', 'dsm_admin_footer_text');

if ( dsm_setting_get_option( 'dsm_use_header_footer', 'dsm_general' ) == 'on' ) {
    if ( ! function_exists( 'dsm_header_footer_posttypes' ) ) :
    function dsm_header_footer_posttypes() {
        $labels = array(
            'name'               => esc_html__( 'Divi Templates', 'dsm-supreme-modules-for-divi' ),
            'singular_name'      => esc_html__( 'Divi Template', 'dsm-supreme-modules-for-divi' ),
            'add_new'            => esc_html__( 'Add New', 'dsm-supreme-modules-for-divi' ),
            'add_new_item'       => esc_html__( 'Add New Template', 'dsm-supreme-modules-for-divi' ),
            'edit_item'          => esc_html__( 'Edit Template', 'dsm-supreme-modules-for-divi' ),
            'new_item'           => esc_html__( 'New Template', 'dsm-supreme-modules-for-divi' ),
            'all_items'          => esc_html__( 'All Templates', 'dsm-supreme-modules-for-divi' ),
            'view_item'          => esc_html__( 'View Template', 'dsm-supreme-modules-for-divi' ),
            'search_items'       => esc_html__( 'Search Templates', 'dsm-supreme-modules-for-divi' ),
            'not_found'          => esc_html__( 'Nothing found', 'dsm-supreme-modules-for-divi' ),
            'not_found_in_trash' => esc_html__( 'Nothing found in Trash', 'dsm-supreme-modules-for-divi' ),
            'parent_item_colon'  => '',
        );

        $args = array(
            'labels'             => $labels,
            'public'             => false,
            'publicly_queryable' => true,
            'show_in_menu' => false,
            'show_ui'            => true,
            'can_export'         => true,
            'show_in_nav_menus'  => true,
            'has_archive'        => true,
            'rewrite' => array(
                'slug' => 'header-footer',
                'with_front' => false
            ),
            'capability_type'    => 'post',
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'author', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
        );

        register_post_type( 'dsm_header_footer', $args );
    }
    endif;
    add_action( 'init', 'dsm_header_footer_posttypes', 0 );

    function dsm_load_headerfooter_template($template) {
        global $post;

        if ($post->post_type == 'dsm_header_footer' && $template !== locate_template(array('page-template-blank.php'))){
            return plugin_dir_path( __FILE__ ) . 'templates/page-template-blank.php';
        }

        return $template;
    }

    add_filter('single_template', 'dsm_load_headerfooter_template');


    function dsm_header_footer_meta_box_options($post) {
        wp_nonce_field( 'dsm-header-footer-meta-box-nonce', 'dsm-header-footer-meta-box-nonce' );
        ?>
        <div class="dsm-header-footer-meta-box dsm_<?php echo get_post_meta($post->ID, 'dsm-header-footer-meta-box-options', true); ?>">
            <p class="dsm-header-footer-meta-box-options">
                <label for="dsm-header-footer-meta-box-options" style="display: block; font-weight: bold; margin-bottom: 5px;">Assign template to:</label>
                <select name="dsm-header-footer-meta-box-options">
                    <?php 
                        $option_values = array(
                            'footer' => __( 'Footer', 'dsm-supreme-modules-for-divi' ),
                            '404' => __( '404', 'dsm-supreme-modules-for-divi' ),
                            //'header'   => __( 'Header (Not available)', 'dsm-supreme-modules-for-divi' ),
                        );

                        foreach($option_values as $key => $value) {
                            if($key == get_post_meta($post->ID, 'dsm-header-footer-meta-box-options', true)) {
                                ?>
                                    <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                                <?php    
                            }
                            else {
                                ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php
                            }
                        }
                    ?>
                </select>
            </p>
            <p class="dsm-css-classes-meta-box-options">
                <label for="dsm-css-classes-meta-box-options" style="display: block; font-weight: bold; margin-bottom: 5px;">CSS Classes:</label>
                <input name="dsm-css-classes-meta-box-options" style="width:100%;" type="text" value="<?php echo get_post_meta($post->ID, 'dsm-css-classes-meta-box-options', true); ?>">
            </p>
            <p class="dsm-remove-default-footer-meta-box-options">
            <label for="dsm-remove-default-footer-meta-box-options" style="display: block; font-weight: bold; margin-bottom: 5px;">Remove default Divi footer</label>
            <select name="dsm-remove-default-footer-meta-box-options">
                <?php 
                    $option_values = array(
                        'no' => __( 'No', 'dsm-supreme-modules-for-divi' ),
                        'yes'   => __( 'Yes', 'dsm-supreme-modules-for-divi' ),
                    );

                    foreach($option_values as $key => $value) {
                        if($key == get_post_meta($post->ID, 'dsm-remove-default-footer-meta-box-options', true)) {
                            ?>
                                <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                            <?php    
                        }
                        else {
                            ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php
                        }
                    }
                ?>
            </select>
            </p>
            <!--p>
            <label for="dsm-embed-footer-in-vb" style="display: block; font-weight: bold; margin-bottom: 5px;">Embed Footer in Visual Builder</label>
            <span style="display:block; margin-bottom: 5px;">This will show the footer when using Visual Builder in other pages/post/custom post type.</span>
            <select name="dsm-embed-footer-in-vb"-->
                <?php 
                    /**
                    $option_values = array(
                        'no' => __( 'No', 'dsm-supreme-modules-for-divi' ),
                        'yes'   => __( 'Yes', 'dsm-supreme-modules-for-divi' ),
                    );

                    foreach($option_values as $key => $value) {
                        if($key == get_post_meta($post->ID, 'dsm-embed-footer-in-vb', true)) {
                            ?>
                                <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                            <?php    
                        }
                        else {
                            ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php
                        }
                    }**/
                ?>
            <!--/select>
            </p-->
            <p><?php _e( 'Note: Footer Template will only show up on the frontend.', 'dsm-supreme-modules-for-divi' ); ?></p>
        </div>
        <?php  
    }


    if ( ! function_exists( 'dsm_add_header_footer_meta_box' ) ) :
    function dsm_add_header_footer_meta_box() {
        add_meta_box('dsm_header_footer_meta_box', 'Divi Templates', 'dsm_header_footer_meta_box_options', 'dsm_header_footer', 'side', 'high', null);
        remove_meta_box( 'et_settings_meta_box', 'dsm_header_footer', 'side', 'high' );
    }
    endif;

    add_action("add_meta_boxes", "dsm_add_header_footer_meta_box", 11);

    function dsm_save_header_footer_meta_box($post_id, $post, $update) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! isset( $_POST['dsm-header-footer-meta-box-nonce'] ) || ! wp_verify_nonce( $_POST['dsm-header-footer-meta-box-nonce'], 'dsm-header-footer-meta-box-nonce' ) ) {
            return;
        }

        if ( ! current_user_can( 'edit_posts' ) ) {
            return;
        }

        $slug = 'dsm_header_footer';
        if ( $slug != $post->post_type ) {
            return $post_id;
        }

        if ( isset( $_POST['dsm-header-footer-meta-box-options'] ) ) {
            update_post_meta( $post_id, 'dsm-header-footer-meta-box-options', esc_attr( $_POST['dsm-header-footer-meta-box-options'] ) );
        }

        if ( isset( $_POST['dsm-css-classes-meta-box-options'] ) ) {
            update_post_meta( $post_id, 'dsm-css-classes-meta-box-options', sanitize_text_field( $_POST['dsm-css-classes-meta-box-options'] ) );
        }

        if ( isset( $_POST['dsm-remove-default-footer-meta-box-options'] ) ) {
            update_post_meta( $post_id, 'dsm-remove-default-footer-meta-box-options', esc_attr( $_POST['dsm-remove-default-footer-meta-box-options'] ) );
        }
        /*
        if ( isset( $_POST['dsm-embed-footer-in-vb'] ) ) {
            update_post_meta( $post_id, 'dsm-embed-footer-in-vb', sanitize_text_field( $_POST['dsm-embed-footer-in-vb'] ) );
        }*/
    }

    add_action('save_post', 'dsm_save_header_footer_meta_box', 10, 3);

    function dsm_custom_footer() {
        $footer_args = array(
            'post_type' => 'dsm_header_footer',
            'meta_key'     => 'dsm-header-footer-meta-box-options',
            'meta_value'   => 'footer',
            'meta_type'    => 'post',
            'meta_query'     => array(
                array(
                    'key'     => 'dsm-header-footer-meta-box-options',
                    'value'   => 'footer',
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

        if ( $footer_template->have_posts() ) {
            $footer_template_ID = $footer_template->post->ID;
            $footer_template_shortcode = apply_filters('the_content', get_post_field('post_content', $footer_template_ID));
            $footer_template_css = get_post_custom($footer_template_ID);

            if ( $footer_template_css['dsm-css-classes-meta-box-options'][0] != '' ) {
                $footer_template_css_output = get_post_meta( $footer_css_template->post->ID, 'dsm-css-classes-meta-box-options', true );
            } else {
                $footer_template_css_output = '';
            }

            if ( !et_core_is_fb_enabled() ) {
                $footer_output = sprintf(
                    '<footer id="dsm-footer" class="dsm-footer" itemscope="itemscope" itemtype="https://schema.org/WPFooter">%1$s</footer>
                    ',
                    $footer_template_shortcode
                );
                echo $footer_output;
            }
        }
    }

    add_action('et_after_main_content', 'dsm_custom_footer');

    if ( ! function_exists( 'dsm_redirect_404' ) ) :
    function dsm_redirect_404() {
        $dsm_four_zero_four_args = array(
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

        $dsm_four_zero_four_template = new WP_Query(
            $dsm_four_zero_four_args
        );

        if ( $dsm_four_zero_four_template->have_posts() ) {
            if ( is_404() ) :
                include( plugin_dir_path( __FILE__ ) . 'templates/page-template-404.php' );
                exit;
                endif;
        }
    }
    endif;

    add_action( 'template_redirect', 'dsm_redirect_404' );

    function dsm_custom_footer_settings() {
        $footer_args = array(
            'post_type' => 'dsm_header_footer',
            'meta_key'     => 'dsm-header-footer-meta-box-options',
            'meta_value'   => 'footer',
            'meta_type'    => 'post',
            'meta_query'     => array(
                array(
                    'key'     => 'dsm-header-footer-meta-box-options',
                    'value'   => 'footer',
                    'compare' => '==',
                    'type'    => 'post',
                ),
            ),
        );

        $footer_template = new WP_Query(
            $footer_args
        );

        if ( $footer_template->have_posts() ) {
            $footer_template_ID = $footer_template->post->ID;
            $footer_template_css = get_post_custom($footer_template_ID);

            if ( $footer_template_css['dsm-remove-default-footer-meta-box-options'][0] == 'yes' ) {
                echo '<style id="dsm-footer-css" type="text/css">footer#main-footer { display: none; }</style>';
            }
        }
    }

    add_action( 'wp_print_scripts', 'dsm_custom_footer_settings', 30 );

    /*
    function dsm_embed_footer_vb() {
        $show_footer_args = array(
            'post_type' => 'dsm_header_footer',
            'meta_key'     => 'dsm-embed-footer-in-vb',
            'meta_value'   => 'yes',
            'meta_type'    => 'post',
            'meta_query'     => array(
                array(
                    'key'     => 'dsm-embed-footer-in-vb',
                    'value'   => 'yes',
                    'compare' => '==',
                    'type'    => 'post',
                ),
            ),
        );

        $show_footer_template = new WP_Query(
            $show_footer_args
        );

        if ( $show_footer_template->have_posts() ) {
            $footer_template_ID = $show_footer_template->post->ID;
            $footer_template_vb = get_post_custom($footer_template_ID);

            if ( $footer_template_vb['dsm-embed-footer-in-vb'][0] == 'yes' ) {
                if ( et_core_is_fb_enabled() ) {
                    if ( 'dsm_header_footer' !== get_post_type( get_the_ID() ) ) { 
                        wp_enqueue_script('dsm-header-footer');
                    }
                }
            }
        }
    }
    add_action( 'et_after_main_content', 'dsm_embed_footer_vb' );
    */

    function dsm_header_footer_admin_notice($post) {
        $current_screen = get_current_screen();
        
        if ( $current_screen->post_type === 'dsm_header_footer' ) { ?>
            <div class="notice notice-info">
                <p><?php _e( 'Notice: For first time user, please re-save your <a href="'. get_admin_url() .'options-permalink.php"  target="_blank">Permalinks</a> again to flush the rewrite rules in order view them in Visual Builder. This will only work for the Divi Theme. Once ElegantThemes updated their Template Hook on Extra Theme, this feature will also be available. Currently only the footer and 404 template is available you. Please create one template and assign to the footer or 404. If you do not see Divi Builder here, remember to <a href="'. get_admin_url() .'admin.php?page=et_divi_options#wrap-builder" target="_blank">Enable Divi Builder On Post Types</a> in the Divi Options.', 'dsm-supreme-modules-for-divi' ); ?></p>
            </div>
        <?php }
    }
    add_action('admin_notices', 'dsm_header_footer_admin_notice');

    //Template load admin script
    if ( ! function_exists( 'dsm_admin_load_enqueue' ) ) :
    function dsm_admin_load_enqueue( $hook_suffix ){
        if( in_array($hook_suffix, array('post.php', 'post-new.php') ) ){
            $screen = get_current_screen();

            if( is_object( $screen ) && 'dsm_header_footer' == $screen->post_type ){
                wp_enqueue_script( 'dsm-admin-js', plugins_url( 'includes/admin/js/dsm-admin.js' , dirname(__FILE__) ) );
            }
        }
    }
    endif;
    add_action( 'admin_enqueue_scripts', 'dsm_admin_load_enqueue');
}

if ( dsm_setting_get_option( 'dsm_use_shortcode', 'dsm_general' ) == 'on' ) {
    if ( ! function_exists( 'dsm_divi_shortcode' ) ) :
        function dsm_divi_shortcode($divi_shortcode = []) {
        if ( empty( $divi_shortcode['id'] ) ) {
            return '';
        }
        return do_shortcode('[et_pb_section global_module="'.$divi_shortcode['id'].'"][/et_pb_section]');
    }
    endif;
    add_shortcode(DSM_SHORTCODE, 'dsm_divi_shortcode');

    if ( ! function_exists( 'dsm_divi_shortcode_post_columns_header' ) ) :
        function dsm_divi_shortcode_post_columns_header($columns) {
            $columns['shortcode'] = __( 'Shortcode', 'dsm-supreme-modules-for-divi' );
            return $columns;
        }
    endif;
    add_filter('manage_edit-et_pb_layout_columns', 'dsm_divi_shortcode_post_columns_header');

    if ( ! function_exists( 'dsm_divi_shortcode_post_columns_content' ) ) :
    function dsm_divi_shortcode_post_columns_content($column_name) {
        global $post;
        switch ($column_name) {
            case 'shortcode':
                $shortcode = esc_attr( sprintf( '[%s id="%d"]', DSM_SHORTCODE, $post->ID ) );
                printf( '<input class="dsm-shortcode-input" type="text" readonly onfocus="this.select()" value="%s" style="width:100%%" />', $shortcode );
                break;
        }
    }
    endif;
    add_action('manage_et_pb_layout_posts_custom_column',  'dsm_divi_shortcode_post_columns_content');
}
//End