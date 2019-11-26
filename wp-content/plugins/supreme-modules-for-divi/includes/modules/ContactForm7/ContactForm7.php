<?php

class DSM_ContactForm7 extends ET_Builder_Module {

	public $slug       = 'dsm_contact_form_7';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'https://divisupreme.com/',
		'author'     => 'Divi Supreme',
		'author_uri' => 'https://divisupreme.com/',
	);

	public function init() {
		$this->name = esc_html__( 'Supreme Contact Form 7', 'dsm-supreme-modules-for-divi' );
		$this->icon             = '1';
		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Contact Form 7', 'dsm-supreme-modules-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'cf7_labels' => esc_html__( 'Labels', 'dsm-supreme-modules-for-divi' ),
					'cf7_field' => esc_html__( 'Input, Textarea & Select', 'dsm-supreme-modules-for-divi' ),
					'cf7_placeholder' => esc_html__( 'Placeholder', 'dsm-supreme-modules-for-divi' ),
					'cf7_radio_checkbox' => esc_html__( 'Radio & Checkbox', 'dsm-supreme-modules-for-divi' ),
					'cf7_file' => esc_html__( 'File', 'dsm-supreme-modules-for-divi' ),
					'cf7_error' => esc_html__( 'Error Messages', 'dsm-supreme-modules-for-divi' ),
					'cf7_validation_errors' => esc_html__( 'Validation Error', 'dsm-supreme-modules-for-divi' ),
					'cf7_validation_success' => esc_html__( 'Validation Success', 'dsm-supreme-modules-for-divi' ),
				),
			),
		);
	}
	public function get_advanced_fields_config() {
		return array(
			'text' => false,
			'fonts'      => array(
				'labels' => array(
					'label'    => esc_html__( 'Labels', 'dsm-supreme-modules-for-divi' ),
					'css'      => array(
						'main' => '%%order_class%% .wpcf7-form label',
					),
					'font_size' => array(
						'default'      => '14px',
					),
					'line_height'    => array(
						'default' => '1.7em',
					),
					'letter_spacing' => array(
						'default' => '0px',
					),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'cf7_labels',
				),
				'input_textarea_select' => array(
					'label'    => esc_html__( 'Input, Textarea & Select', 'dsm-supreme-modules-for-divi' ),
					'css'      => array(
						'main' => '%%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-text, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-tel, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-url, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-quiz, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-number, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-textarea, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-select, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-date',
					),
					'font_size' => array(
						'default'      => '14px',
					),
					'line_height'    => array(
						'default' => '1.7em',
					),
					'letter_spacing' => array(
						'default' => '0px',
					),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'cf7_field',
				),
				'placeholder' => array(
					'label'    => esc_html__( 'Placeholder', 'dsm-supreme-modules-for-divi' ),
					'css'      => array(
						'main' => '%%order_class%% .wpcf7-form-control.wpcf7-text::placeholder, %%order_class%% .wpcf7-form-control.wpcf7-textarea::placeholder',
					),
					'font_size' => array(
						'default'      => '14px',
					),
					'line_height'    => array(
						'default' => '1.7em',
					),
					'letter_spacing' => array(
						'default' => '0px',
					),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'cf7_placeholder',
				),
				'radio_checkbox' => array(
					'label'    => esc_html__( 'Radio & Checkbox', 'dsm-supreme-modules-for-divi' ),
					'css'      => array(
						'main' => '%%order_class%% .wpcf7-list-item-label',
					),
					'font_size' => array(
						'default'      => '14px',
					),
					'line_height'    => array(
						'default' => '1.7em',
					),
					'letter_spacing' => array(
						'default' => '0px',
					),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'cf7_radio_checkbox',
				),
				'file' => array(
					'label'    => esc_html__( 'File', 'dsm-supreme-modules-for-divi' ),
					'css'      => array(
						'main' => '%%order_class%% .wpcf7-form-control.wpcf7-file',
					),
					'font_size' => array(
						'default'      => '11px',
					),
					'letter_spacing' => array(
						'default' => '0px',
					),
					'hide_line_height'    => true,
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'cf7_file',
				),
				'error_msg' => array(
					'label'    => esc_html__( 'Error Messages', 'dsm-supreme-modules-for-divi' ),
					'css'      => array(
						'main' => '%%order_class%% .wpcf7-not-valid-tip',
					),
					'font_size' => array(
						'default'      => '14px',
					),
					'line_height'    => array(
						'default' => '1.7em',
					),
					'letter_spacing' => array(
						'default' => '0px',
					),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'cf7_error',
				),
				'error_validation' => array(
					'label'    => esc_html__( 'Validation Error', 'dsm-supreme-modules-for-divi' ),
					'css'      => array(
						'main' => '%%order_class%% .wpcf7-validation-errors',
					),
					'font_size' => array(
						'default'      => '14px',
					),
					'line_height'    => array(
						'default' => '1.7em',
					),
					'letter_spacing' => array(
						'default' => '0px',
					),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'cf7_validation_errors',
				),
				'success_validation' => array(
					'label'    => esc_html__( 'Validation Success', 'dsm-supreme-modules-for-divi' ),
					'css'      => array(
						'main' => '%%order_class%% .wpcf7-mail-sent-ok',
					),
					'font_size' => array(
						'default'      => '14px',
					),
					'line_height'    => array(
						'default' => '1.7em',
					),
					'letter_spacing' => array(
						'default' => '0px',
					),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'cf7_validation_success',
				),
			),
			'background' => array(
				'css'     => array(
					'main' => '%%order_class%%',
				),
				'options' => array(
					'parallax_method' => array(
						'default' => 'off',
					),
				),
			),
			'max_width'  => array(
				'css'     => array(
					'main' => '%%order_class%%',
				),
			),
			'borders'               => array(
				'default' => array(),
				'image'   => array(
					'css'             => array(
						'main' => array(
							'border_radii' => "%%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-text, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-tel, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-url, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-quiz, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-number, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-textarea, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-select, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-date",
							'border_styles' => "%%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-text, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-tel, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-url, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-quiz, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-number, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-textarea, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-select, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-date",
						)
					),
					'label_prefix'    => esc_html__( 'Field', 'dsm-supreme-modules-for-divi' ),
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'cf7_field',
					'depends_show_if' => 'off',
				),
				'error_msg'   => array(
					'css'             => array(
						'main' => array(
							'border_radii' => "%%order_class%% .wpcf7-not-valid-tip",
							'border_styles' => "%%order_class%% .wpcf7-not-valid-tip",
						)
					),
					'label_prefix'    => esc_html__( 'Validation Errors', 'dsm-supreme-modules-for-divi' ),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'cf7_error',
					'depends_show_if' => 'off',
				),
				'error_validation'   => array(
					'css'             => array(
						'main' => array(
							'border_radii' => "%%order_class%% .wpcf7-validation-errors",
							'border_styles' => "%%order_class%% .wpcf7-validation-errors",
						)
					),
					'label_prefix'    => esc_html__( 'Validation Errors', 'dsm-supreme-modules-for-divi' ),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'cf7_validation_errors',
					'depends_show_if' => 'off',
				),
				'validation_success'   => array(
					'css'             => array(
						'main' => array(
							'border_radii' => "%%order_class%% .wpcf7-mail-sent-ok",
							'border_styles' => "%%order_class%% .wpcf7-mail-sent-ok",
						)
					),
					'label_prefix'    => esc_html__( 'Validation Success', 'dsm-supreme-modules-for-divi' ),
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'cf7_validation_success',
					'depends_show_if' => 'off',
				),
			),
			'box_shadow'            => array(
				'default' => array(),
				'input_field'   => array(
					'label'               => esc_html__( 'Box Shadow', 'dsm-supreme-modules-for-divi' ),
					'option_category'     => 'layout',
					'tab_slug'            => 'advanced',
					'toggle_slug'         => 'cf7_field',
					'depends_show_if'     => 'off',
					'css'                 => array(
						'main' => '%%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-text, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-quiz, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-number, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-textarea, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-select, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-date',
					),
					'default_on_fronts'  => array(
						'color'    => '',
						'position' => '',
					),
				),
			),
			'filters' => false,
			'button'     => array(
				'button_one' => array(
					'label' => esc_html__( 'Button', 'dsm-supreme-modules-for-divi' ),
					'css'      => array(
						'main' => '%%order_class%% .wpcf7-form-control.wpcf7-submit',
					),
					'box_shadow' => array(
						'css' => array(
							'main' => '%%order_class%% .wpcf7-form-control.wpcf7-submit',
						),
					),
				),
			),
		);
	}

	public function get_fields() {
		return array(
			/*
			'cf7_notice' => array(
				'type'              => 'warning',
				'value' => true,
				'display_if' => true,
				'message'           => esc_html__( 'Note: Contact Form 7 will not function in the Divi Visual Builder at all, just like the Divi Contact Form module. It will only work on the frontend as usual. The purpose is to style and design your Contact Form 7 with the Divi Visual Builder without having to code. So go ahead and load your Contact Form 7 Library from the select list below to get started.', 'dsm-supreme-modules-for-divi' ),
			),
			*/
			'cf7_library' => array(
				'label'           => esc_html__( 'Contact Form 7', 'dsm-supreme-modules-for-divi' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => dsm_get_contact_form_7(),
			),
			'show_validation' => array(
				'label'           => esc_html__( 'Show Error & Validation Messages', 'dsm-supreme-modules-for-divi' ),
				'type'            => 'yes_no_button',
				'option_category' => 'basic_option',
				'options'         => array(
					'off' => esc_html__( 'No', 'dsm-supreme-modules-for-divi' ),
					'on'  => esc_html__( 'Yes', 'dsm-supreme-modules-for-divi' ),
				),
				'default' => 'off',
				'description'      => esc_html__( 'This will show the error and validation messages on the Visual Builder for styling purposes.', 'dsm-supreme-modules-for-divi' ),
			),
			'label_bottom_spacing' => array(
				'label'             => esc_html__( 'Bottom Spacing', 'dsm-supreme-modules-for-divi' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'cf7_labels',
				'default_unit'      => 'px',
			),
			'button_alignment' => array(
				'label'            => esc_html__( 'Button Alignment', 'dsm-supreme-modules-for-divi' ),
				'type'             => 'text_align',
				'option_category'  => 'configuration',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'button_one',
				'description'      => esc_html__( 'Here you can define the alignment of Button', 'dsm-supreme-modules-for-divi' ),
			),
			'input_background_color' => array(
				'label'            => esc_html__( 'Background Color', 'dsm-supreme-modules-for-divi' ),
				'type'                => 'color-alpha',
				'option_category'     => 'button',
				'custom_color'        => true,
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'cf7_field',
			),
			'file_padding' => array(
				'label'           => esc_html__( 'Padding', 'dsm-supreme-modules-for-divi' ),
				'type'      => 'custom_padding',
                'option_category'   => 'layout',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'cf7_file',
				'mobile_options'  => true,
				'validate_unit'   => true,
				'default'         => '',
				'default_unit'    => 'px',
				'default_on_front'=> '',
				'responsive'      => true,
			),
			'file_background_color' => array(
				'label'            => esc_html__( 'Background Color', 'dsm-supreme-modules-for-divi' ),
				'type'                => 'color-alpha',
				'option_category'     => 'button',
				'custom_color'        => true,
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'cf7_file',
			),
			'error_msg_background_color' => array(
				'label'            => esc_html__( 'Background Color', 'dsm-supreme-modules-for-divi' ),
				'type'                => 'color-alpha',
				'option_category'     => 'button',
				'custom_color'        => true,
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'cf7_error',
			),
			'validation_error_background_color' => array(
				'label'            => esc_html__( 'Background Color', 'dsm-supreme-modules-for-divi' ),
				'type'                => 'color-alpha',
				'option_category'     => 'button',
				'custom_color'        => true,
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'cf7_validation_errors',
			),
			'validation_success_background_color' => array(
				'label'            => esc_html__( 'Background Color', 'dsm-supreme-modules-for-divi' ),
				'type'                => 'color-alpha',
				'option_category'     => 'button',
				'custom_color'        => true,
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'cf7_validation_success',
			),
		);
	}

	public function get_button_alignment() {
		$text_orientation = isset( $this->props['button_alignment'] ) ? $this->props['button_alignment'] : '';

		return et_pb_get_alignment( $text_orientation );
	}

	public function render( $attrs, $content = null, $render_slug ) {
		$cf7_library = $this->props['cf7_library'];
		$show_validation = $this->props['show_validation'];
		$label_bottom_spacing              = $this->props['label_bottom_spacing'];
		$input_background_color = $this->props['input_background_color'];
		$file_background_color = $this->props['file_background_color'];
		$error_msg_background_color = $this->props['error_msg_background_color'];
		$validation_error_background_color = $this->props['validation_error_background_color'];
		$validation_success_background_color = $this->props['validation_success_background_color'];
		$file_padding = $this->props['file_padding'];
		$file_padding_tablet      = $this->props['file_padding_tablet'];
		$file_padding_phone       = $this->props['file_padding_phone'];
		$file_padding_last_edited = $this->props['file_padding_last_edited'];
		$custom_icon_1                = $this->props['button_one_icon'];
		$button_custom_1              = $this->props['custom_button_one'];
		$button_alignment = $this->get_button_alignment();

		if ( '' !== $input_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-text, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-tel, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-url, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-quiz, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-number, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-textarea, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-select, %%order_class%%.dsm_contact_form_7 .wpcf7-form-control.wpcf7-date',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $input_background_color )
				),
			) );
		}

		if ( '' !== $file_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .wpcf7-form-control.wpcf7-file',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $file_background_color )
				),
			) );
		}

		if ( '' !== $error_msg_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .wpcf7-not-valid-tip',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $error_msg_background_color )
				),
			) );
		}

		if ( '' !== $validation_error_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .wpcf7-validation-errors',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $validation_error_background_color )
				),
			) );
		}

		if ( '' !== $validation_success_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .wpcf7-mail-sent-ok',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $validation_success_background_color )
				),
			) );
		}

		if ( '' !== $label_bottom_spacing ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% label',
				'declaration' => sprintf(
					'margin-bottom: %1$s;',
					esc_attr( $label_bottom_spacing )
				),
			) );
		}

		if ( 'left' !== $button_alignment ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .wpcf7-form p:nth-last-of-type(1)',
				'declaration' => sprintf(
					'text-align: %1$s;',
					esc_attr( $button_alignment )
				),
			) );
		}

		if ( '' !== $file_padding_tablet || '' !== $file_padding_phone || '' !== $file_padding ) {
        	$dwd_file_padding = array( '', '', '', '' );
			foreach(explode("|", $file_padding) as $key => $val) {
				if ($key === 0 && '' !== $val) {
					$dwd_file_padding['padding-top'] = $val;
				}
				if ($key === 1 && '' !== $val) {
					$dwd_file_padding['padding-right'] = $val;
				}
				if ($key === 2 && '' !== $val) {
					$dwd_file_padding['padding-bottom'] = $val;
				}
				if ($key === 3 && '' !== $val) {
					$dwd_file_padding['padding-left'] = $val;
				}
			}

			$file_padding = $dwd_file_padding;

			$dwd_file_padding_tablet = array( '', '', '', '' );
			foreach(explode("|", $file_padding_tablet) as $key => $val) {
				if ($key === 0 && '' !== $val) {
					$dwd_file_padding_tablet['padding-top'] = $val;
				}
				if ($key === 1 && '' !== $val) {
					$dwd_file_padding_tablet['padding-right'] = $val;
				}
				if ($key === 2 && '' !== $val) {
					$dwd_file_padding_tablet['padding-bottom'] = $val;
				}
				if ($key === 3 && '' !== $val) {
					$dwd_file_padding_tablet['padding-left'] = $val;
				}
			}
			
			$file_padding_tablet = $dwd_file_padding_tablet;

			$dwd_file_padding_phone = array( '', '', '', '' );
			foreach(explode("|", $file_padding_phone) as $key => $val) {
				if ($key === 0 && '' !== $val) {
					$dwd_file_padding_phone['padding-top'] = $val;
				}
				if ($key === 1 && '' !== $val) {
					$dwd_file_padding_phone['padding-right'] = $val;
				}
				if ($key === 2 && '' !== $val) {
					$dwd_file_padding_phone['padding-bottom'] = $val;
				}
				if ($key === 3 && '' !== $val) {
					$dwd_file_padding_phone['padding-left'] = $val;
				}
			}
			
			$file_padding_phone = $dwd_file_padding_phone;

			$file_responsive_active = et_pb_get_responsive_status( $file_padding_last_edited );
			$file_padding_values = array(
				'desktop' => $file_padding,
				'tablet'  => $file_responsive_active ? $file_padding_tablet : '',
				'phone'   => $file_responsive_active ? $file_padding_phone : '',
			);

			et_pb_generate_responsive_css( $file_padding_values, '%%order_class%% .wpcf7-form-control.wpcf7-file', 'padding', $render_slug );
		}

		$output = sprintf(
			'<div class="%2$s"%3$s>
				%1$s
			</div>',
			do_shortcode('[contact-form-7 id="'.$cf7_library.'"]'),
			'' !== $custom_icon_1 ? 'dsm_contact_form_7_btn_icon' : '',
			'' !== $custom_icon_1 ? sprintf(
				' data-dsm-btn-icon="%1$s"',
				esc_attr( et_pb_process_font_icon( $custom_icon_1 ) )
			) : ''
		);

		return $output;
	}
}

new DSM_ContactForm7;

function dsm_get_contact_form_7() {
	$args = array(
		'post_type' => 'wpcf7_contact_form',
		'posts_per_page' => - 1
	);

	$dsm_cf7_library_list = [
		'0' => esc_html__( '-- Select Contact Form 7 --', 'dsm-supreme-modules-for-divi' ),
	];

	if ( $categories = get_posts($args) ) {
		foreach($categories as $category) {
			(int)$dsm_cf7_library_list[$category->ID] = $category->post_title;
		}
	} else {
		(int)$dsm_cf7_library_list['0'] = esc_html__( 'No Contact From 7 form found', 'dsm-supreme-modules-for-divi' );
	}

	return $dsm_cf7_library_list;
}