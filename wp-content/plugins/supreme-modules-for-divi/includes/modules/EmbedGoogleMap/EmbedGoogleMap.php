<?php

class DSM_EmbedGoogleMap extends ET_Builder_Module {

	public $slug       = 'dsm_embed_google_map';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'https://suprememodules.com/',
		'author'     => 'Supreme Modules',
		'author_uri' => 'https://suprememodules.com/',
	);

	public function init() {
		$this->name       = esc_html__( 'Supreme Embed Google Map', 'et_builder' );
		$this->icon             = 'Y';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Embed Google Map', 'et_builder' ),
				),
			),
		);
	}

	public function get_advanced_fields_config() {
		return array(
			'fonts' => false,
			'button' => false,
			'text' => false,
			'background' => false,
		);
	}

	public function get_fields() {
		return array(
			'address' => array(
				'label'           => esc_html__( 'Address', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter the address for the embed Google Map.', 'et_builder' ),
				'default_on_front' => '1233 Howard St Apt 3A San Francisco, CA 94103-2775',
				'toggle_slug'     => 'main_content',
			),
			'zoom' => array(
				'label'             => esc_html__( 'Zoom', 'dsm-supreme-modules-for-divi' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'toggle_slug'     => 'main_content',
				'default_unit'      => '',
				'default'           => '10',
				'allow_empty'     => false,
				'range_settings'  => array(
					'min'  => '1',
					'max'  => '22',
					'step' => '1',
				),
			),
			'height' => array(
				'label'             => esc_html__( 'Height', 'dsm-supreme-modules-for-divi' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'width',
				'mobile_options'  => true,
				'default_unit'      => 'px',
				'default'           => '320px',
				'range_settings'  => array(
					'min'  => '100',
					'max'  => '1000',
					'step' => '1',
				),
				'responsive'      => true,
			),
		);

		return $fields;
	}

	function render( $attrs, $content = null, $render_slug ) {
		$address              = $this->props['address'];
		$zoom               = $this->props['zoom'];
		$height               = $this->props['height'];
		$height_tablet      = $this->props['height_tablet'];
		$height_phone       = $this->props['height_phone'];
		$height_last_edited = $this->props['height_last_edited'];

		if ( '' !== $height_tablet || '' !== $height_phone || '' !== $height ) {
			$height_responsive_active = et_pb_get_responsive_status( $height_last_edited );

			$height_values = array(
				'desktop' => $height,
				'tablet'  => $height_responsive_active ? $height_tablet : '',
				'phone'   => $height_responsive_active ? $height_phone : '',
			);

			et_pb_generate_responsive_css( $height_values, '%%order_class%% iframe', 'height', $render_slug );
		}

		$output = sprintf(
			'<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=%1$s&amp;t=m&amp;z=%2$s&amp;output=embed&amp;iwloc=near" aria-label="%3$s"></iframe>',
			rawurlencode( $address ),
			absint( $zoom ),
			esc_attr( $address )
		);

		return $output;
	}
}

new DSM_EmbedGoogleMap;