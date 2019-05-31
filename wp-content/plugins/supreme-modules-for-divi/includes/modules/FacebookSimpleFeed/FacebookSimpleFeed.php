<?php

class DSM_FacebookSimpleFeed extends ET_Builder_Module {

	public $slug       = 'dsm_facebook_feed';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'https://suprememodules.com/',
		'author'     => 'Supreme Modules',
		'author_uri' => 'https://suprememodules.com/',
	);

	public function init() {
		$this->name = esc_html__( 'Supreme Facebook Feed', 'dsm-supreme-modules-for-divi' );
		$this->icon             = '';
		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Facebook Feed Settings', 'dsm-supreme-modules-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
				),
			),
		);
	}

	public function get_advanced_fields_config() {
		return array(
			'text' => false,
			'fonts' => false,
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
			'borders' => false,
			'box_shadow' => false,
			'filters' => false,
		);
	}

	public function get_fields() {
		return array(
			'fb_app_id' => array(
				'label'           => esc_html__( 'App ID', 'dsm-supreme-modules-for-divi' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'toggle_slug'     => 'main_content',
				'description'     => sprintf( esc_html__( 'Enter the Facebook App ID. You can go to <a href="%1$s">Facebook Developer</a> and click on Create New App to get one.'), 'https://developers.facebook.com/', 'dsm-supreme-modules-for-divi' ),
			),
			'fb_page_url' => array(
				'label'           => esc_html__( 'Facebook Page URL', 'dsm-supreme-modules-for-divi' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter the Facebook Page URL.', 'dsm-supreme-modules-for-divi' ),
				'toggle_slug'     => 'main_content',
				'default_on_front' => 'https://www.facebook.com/divisupreme/',
			),
			'fb_hide_cover' => array(
				'label'            => esc_html__( 'Hide Cover Photo', 'dsm-supreme-modules-for-divi' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'false' => esc_html__( 'Show', 'dsm-supreme-modules-for-divi' ),
					'true'  => esc_html__( 'Hide', 'dsm-supreme-modules-for-divi' ),
				),
				'toggle_slug'      => 'main_content',
				'description'      => esc_html__( 'Hide cover photo in the header.', 'dsm-supreme-modules-for-divi' ),
				'default_on_front' => 'false',
			),
			'fb_small_header' => array(
				'label'            => esc_html__( 'Use Small Header?', 'dsm-supreme-modules-for-divi' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'false' => esc_html__( 'No', 'dsm-supreme-modules-for-divi' ),
					'true'  => esc_html__( 'Yes', 'dsm-supreme-modules-for-divi' ),
				),
				'toggle_slug'      => 'main_content',
				'description'      => esc_html__( 'Use the small header instead.', 'dsm-supreme-modules-for-divi' ),
				'default_on_front' => 'false',
			),
			'fb_show_facepile' => array(
				'label'            => esc_html__( 'Show Face Pile', 'dsm-supreme-modules-for-divi' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'false' => esc_html__( 'Hide', 'dsm-supreme-modules-for-divi' ),
					'true'  => esc_html__( 'Show', 'dsm-supreme-modules-for-divi' ),
				),
				'toggle_slug'      => 'main_content',
				'description'      => esc_html__( 'Show profile photos when friends like this.', 'dsm-supreme-modules-for-divi' ),
				'default_on_front' => 'true',
			),
			'fb_width' => array(
				'label'           => esc_html__( 'Width', 'et_builder' ),
				'type'            => 'range',
				'option_category' => 'layout',
				'toggle_slug'      => 'main_content',
				'validate_unit'   => true,
				'default'         => '340px',
				'default_unit'    => 'px',
				'default_on_front'=> '340px',
				'allow_empty'     => true,
				'range_settings'  => array(
					'min'  => '180',
					'max'  => '500',
					'step' => '1',
				),
				'description'      => esc_html__( 'The pixel width of the Facebook Feed. Min. is 180 & Max. is 500.', 'dsm-supreme-modules-for-divi' ),
			),
			'fb_height' => array(
				'label'             => esc_html__( 'Height', 'dsm-supreme-modules-for-divi' ),
				'type'              => 'range',
				'option_category'   => 'layout',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'width',
				'default_unit'      => 'px',
				'default'           => '500px',
				'range_settings'  => array(
					'min'  => '300',
					'max'  => '600',
					'step' => '1',
				),
			),
			'fb_alignment' => array(
				'label'            => esc_html__( 'Alignment', 'dsm-supreme-modules-for-divi' ),
				'type'             => 'text_align',
				'option_category'  => 'configuration',
				'options'          => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'alignment',
				'description'      => esc_html__( 'Here you can define the alignment of Facebook Feed', 'dsm-supreme-modules-for-divi' ),
				'default' => 'center',
			),
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {
		$fb_app_id = $this->props['fb_app_id'];
		$fb_page_url = $this->props['fb_page_url'];
		$fb_hide_cover = $this->props['fb_hide_cover'];
		$fb_small_header = $this->props['fb_small_header'];
		$fb_show_facepile = $this->props['fb_show_facepile'];
		$fb_width = floatval($this->props['fb_width']);
		$fb_height = floatval($this->props['fb_height']);
		$fb_alignment = $this->props['fb_alignment'];

		$this->add_classname( array(
			"et_pb_text_align_{$fb_alignment}",
		));

		$dsmFBCommentData = array( 'appID' => $fb_app_id  );
		wp_enqueue_script('dsm-facebook');
		wp_localize_script( 'dsm-facebook', 'dsm_facebook_data_var', $dsmFBCommentData );

		// Render module content
		$output = sprintf(
			'<div class="dsm-facebook-feed">
				<div id="fb-root"></div>
				<div class="fb-page" data-href="%1$s" data-tabs="timeline" data-width="%6$s" data-height="%5$s" data-small-header="%4$s" data-adapt-container-width="true" data-hide-cover="%2$s" data-show-facepile="%3$s">
				</div>
			</div>',
			esc_url( $fb_page_url ),
			esc_attr( $fb_hide_cover ),
			esc_attr( $fb_show_facepile ),
			esc_attr( $fb_small_header ),
			esc_attr( $fb_height ),
			esc_attr( $fb_width )
		);

		return $output;
		//return $this->_render_module_wrapper( $output, $render_slug );
	}
}

new DSM_FacebookSimpleFeed;