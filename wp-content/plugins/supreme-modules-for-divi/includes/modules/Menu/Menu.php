<?php

class DSM_NavMenu extends ET_Builder_Module {

	public $slug       = 'dsm_menu';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'https://suprememodules.com/',
		'author'     => 'Supreme Modules',
		'author_uri' => 'https://suprememodules.com/',
	);

	public function init() {
		$this->name = esc_html__( 'Supreme Menu', 'dsm-supreme-modules-for-divi' );
		//$this->icon             = '';
		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Text', 'dsm-supreme-modules-for-divi' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'menu_style' => esc_html__( 'Menu Style', 'dsm-supreme-modules-for-divi' ),
				),
			),
		);
	}

	public function get_advanced_fields_config() {
		return array(
			'fonts'      => array(
				'header' => array(
					'label'    => esc_html__( 'Title', 'dsm-supreme-modules-for-divi' ),
					'css'      => array(
						'main' => '%%order_class%% h1.dsm-menu-title, %%order_class%% h2.dsm-menu-title, %%order_class%% h3.dsm-menu-title, %%order_class%% h4.dsm-menu-title, %%order_class%% h5.dsm-menu-title, %%order_class%% h6.dsm-menu-title',
					),
					'font_size' => array(
						'default'      => '18px',
					),
					'line_height'    => array(
						'default' => '1em',
					),
					'letter_spacing' => array(
						'default' => '0px',
					),
					'header_level' => array(
						'default' => 'h4',
					),
				),
				'menu' => array(
					'label'    => esc_html__( 'Menu', 'dsm-supreme-modules-for-divi' ),
					'css'      => array(
						'main' => '%%order_class%% ul.dsm-menu li a',
						'plugin_main' => '%%order_class%% ul.dsm-menu li a'
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size' => array(
						'default' => '14px',
						'range_settings' => array(
							'min'  => '12',
							'max'  => '24',
							'step' => '1',
						),
					),
					'letter_spacing' => array(
						'default' => '0px',
						'range_settings' => array(
							'min'  => '0',
							'max'  => '8',
							'step' => '1',
						),
					),
					'hide_text_align' => true,
					'hide_text_color' => true,
				),
			),
			'text'       => array(
				'use_background_layout' => true,
				'toggle_slug' => 'links',
				'options' => array(
					'text_orientation'  => array(
						'default_on_front' => 'left',
					),
					'background_layout' => array(
						'default_on_front' => 'light',
						'hover' => 'tabs',
					),
				),
			),
			'button'     => false,
			'margin_padding'  => array(
				'css'     => array(
					'main' => '%%order_class%%',
				),
			),
		);
	}

	public function get_fields() {
		$et_accent_color = et_builder_accent_color();
		return array(
			'title' => array(
				'label'           => esc_html__( 'Menu Title', 'dsm-supreme-modules-for-divi' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'The title will appear above the menu.', 'dsm-supreme-modules-for-divi' ),
				'toggle_slug'     => 'main_content',
			),
			'title_bottom_gap' => array(
				'label'           => esc_html__( 'Bottom Gap', 'dsm-supreme-modules-for-divi' ),
				'type'            => 'range',
				'option_category' => 'layout',
				'mobile_options'  => true,
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'header',
				'responsive'      => true,
				'default_unit'    => 'px',
				'default'		  => '10px',
			),
			'menu_id' => array(
				'label'           => esc_html__( 'Menu', 'dsm-supreme-modules-for-divi' ),
				'type'            => 'select',
				'option_category' => 'basic_option',
				'options'         => et_builder_get_nav_menus_options(),
				'description'     => sprintf(
					'<p class="description">%2$s. <a href="%1$s" target="_blank">%3$s</a>.</p>',
					esc_url( admin_url( 'nav-menus.php' ) ),
					esc_html__( 'Select a menu that should be used in the module', 'dsm-supreme-modules-for-divi' ),
					esc_html__( 'Click here to create new menu', 'dsm-supreme-modules-for-divi' )
				),
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__menu',
				),
			),
			'menu_link_text_color' => array(
				'label'        => esc_html__( 'Menu Link Color', 'dsm-supreme-modules-for-divi' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'menu',
				'hover'        => 'tabs',
			),
			'list_style_type' => array(
				'label'           => esc_html__( 'List Style Type', 'dsm-supreme-modules-for-divi' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'none'  => esc_html__( 'None', 'dsm-supreme-modules-for-divi' ),
					'disc'  => esc_html__( 'Disc', 'dsm-supreme-modules-for-divi' ),
					'circle' => esc_html__( 'Circle', 'dsm-supreme-modules-for-divi' ),
					'decimal' => esc_html__( 'Decimal', 'dsm-supreme-modules-for-divi' ),
					'square' => esc_html__( 'Square', 'dsm-supreme-modules-for-divi' ),
				),
				'default_on_front' => 'disc',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'menu_style',
			),
			'__menu' => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'DSM_NavMenu', 'get_dsm_navmenu' ),
				'computed_depends_on' => array(
					'menu_id',
					'list_style_type',
				),
			),
		);
	}

	/**
	 * Add the class with page ID to menu item so it can be easily found by ID in Frontend Builder
	 *
	 * @return menu item object
	 */
	static function modify_dsm_menu_item( $menu_item ) {
		if ( esc_url( home_url( '/' ) ) === $menu_item->url ) {
			$fw_menu_custom_class = 'et_pb_menu_page_id-home';
		} else {
			$fw_menu_custom_class = 'et_pb_menu_page_id-' . $menu_item->object_id;
		}

		$menu_item->classes[] = $fw_menu_custom_class;
		return $menu_item;
	}

	/**
	 * Get fullwidth menu markup for fullwidth menu module
	 *
	 * @return string of fullwidth menu markup
	 */
	static function get_dsm_navmenu( $args = array() ) {
		$defaults = array(
			'list_style_type' => '',
			'menu_id'           => '',
		);

		// modify the menu item to include the required data
		add_filter( 'wp_setup_nav_menu_item', array( 'DSM_NavMenu', 'modify_dsm_menu_item' ) );

		$args = wp_parse_args( $args, $defaults );

		$menu = '<div class="dsm-menu-container">';

		$menuClass = 'dsm-menu';

		if ( ! et_is_builder_plugin_active() && 'on' == et_get_option( 'divi_disable_toptier' ) ) {
			$menuClass .= ' et_disable_top_tier';
		}
		$menuClass .= ( '' !== $args['list_style_type'] ? sprintf( ' %s', esc_attr( 'dsm-menu-style-type-' . $args['list_style_type'] ) ) : '' );

		$primaryNav = '';

		$menu_args = array(
			'theme_location' => 'primary-menu',
			'container'      => '',
			'fallback_cb'    => '',
			'menu_class'     => $menuClass,
			'menu_id'        => '',
			'echo'           => false,
		);

		if ( '' !== $args['menu_id'] ) {
			$menu_args['menu'] = (int) $args['menu_id'];
		}

		$primaryNav = wp_nav_menu( apply_filters( 'dsm_menu_args', $menu_args ) );

		if ( '' == $primaryNav ) {
			$menu .= sprintf(
				'<ul class="%1$s">
					%2$s',
				esc_attr( $menuClass ),
				( ! et_is_builder_plugin_active() && 'on' === et_get_option( 'divi_home_link' )
					? sprintf( '<li%1$s><a href="%2$s">%3$s</a></li>',
						( is_home() ? ' class="current_page_item"' : '' ),
						esc_url( home_url( '/' ) ),
						esc_html__( 'Home', 'dsm-supreme-modules-for-divi' )
					)
					: ''
				)
			);

			ob_start();

			// @todo: check if Fullwidth Menu module works fine with no menu selected in settings
			if ( et_is_builder_plugin_active() ) {
				wp_page_menu();
			} else {
				show_page_menu( $menuClass, false, false );
				show_categories_menu( $menuClass, false );
			}

			$menu .= ob_get_contents();

			$menu .= '</ul>';

			ob_end_clean();
		} else {
			$menu .= $primaryNav;
		}

		$menu .= '</div>';

		remove_filter( 'wp_setup_nav_menu_item', array( 'DSM_NavMenu', 'modify_dsm_menu_item' ) );

		return $menu;
	}

	public function render( $attrs, $content = null, $render_slug ) {
		$background_layout = $this->props['background_layout'];
		$title = $this->props['title'];
		$title_bottom_gap = $this->props['title_bottom_gap'];
		$title_bottom_gap_tablet = $this->props['title_bottom_gap_tablet'];
		$title_bottom_gap_phone = $this->props['title_bottom_gap_phone'];
		$title_bottom_gap_last_edited = $this->props['title_bottom_gap_last_edited'];
		$menu_id = $this->props['menu_id'];
		$list_style_type  = $this->props['list_style_type'];
		$menu_link_text_color = $this->props['menu_link_text_color'];
		$menu_link_text_color_hover = $this->get_hover_value('menu_link_text_color');
		$header_level = $this->props['header_level'];

		$menu = self::get_dsm_navmenu( array(
			'menu_id'           => $menu_id,
			'list_style_type' => $list_style_type,
		) );

		if ( '10px' !== $title_bottom_gap || '' !== $title_bottom_gap_tablet || '' !== $title_bottom_gap_phone ) {
			$title_bottom_gap_responsive_active = et_pb_get_responsive_status( $title_bottom_gap_last_edited );

			$title_bottom_gap_values = array(
				'desktop' => $title_bottom_gap,
				'tablet'  => $title_bottom_gap_responsive_active ? $title_bottom_gap_tablet : '',
				'phone'   => $title_bottom_gap_responsive_active ? $title_bottom_gap_phone : '',
			);

			et_pb_generate_responsive_css( $title_bottom_gap_values, '%%order_class%% .dsm-menu-title', 'padding-bottom', $render_slug );
		}

		if ( '' !== $menu_link_text_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% ul.dsm-menu li a',
				'declaration' => sprintf(
					'color: %1$s;',
					esc_html( $menu_link_text_color )
				),
			) );
		}

		if ( et_builder_is_hover_enabled( 'menu_link_text_color', $this->props ) ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% ul.dsm-menu li a:hover',
				'declaration' => sprintf(
					'color: %1$s;',
					esc_html( $menu_link_text_color_hover )
				),
			) );
		}

		if ( 'disc' !== $list_style_type ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% ul.dsm-menu',
				'declaration' => sprintf(
					'list-style-type: %1$s;',
					esc_attr( $list_style_type )
				),
			) );
		}

		if ( '' !== $title ) {
			$title = sprintf( '<%1$s class="dsm-menu-title et_pb_module_header">%2$s</%1$s>',
				et_pb_process_header_level( $header_level, 'h4' ),
				$title
			);
		}

		$this->add_classname( array(
			$this->get_text_orientation_classname(),
			"et_pb_bg_layout_{$background_layout}",
		));

		// Render module content
		$output = sprintf(
			'%2$s%1$s',
			$menu,
			$title
		);

		return $output;
	}
}

new DSM_NavMenu;