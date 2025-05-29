<?php

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Custom control for section subheadings.
 */
if (class_exists('WP_Customize_Control')) {
  class Customizer_Subheading extends WP_Customize_Control
  {
    public $type = 'customizer_subheading';
    public function render_content()
    {
      echo '<h4>' . esc_html($this->label) . '</h4>';
    }
  }
}

/**
 * Accessible Storefront customizer.
 */
class Accessible_Storefront_Customizer
{
  private $colors = array(
    'white' => '#ffffff',
    'black' => '#000000',
    'light_gray' => '#C9DEF3',
    'medium_gray' => '#949494',
    'lightest_blue' => '#cce0f5',
    'light_blue' => '#5699D7',
    'medium_blue' => '#0067A3',
    'dark_blue' => '#0D4687',
  );

  // Change Storefront default colors to higher contrast theme, and add defaults for new options.
  public function set_default_values()
  {
    return array(

      // Hex values are original from Storefront.
      'storefront_heading_color' => '#333333',
      'storefront_text_color' => '#6d6d6d',
      'storefront_accent_color' => $this->colors['dark_blue'],
      'storefront_hero_heading_color' => '#000000',
      'storefront_hero_text_color' => '#000000',
      'storefront_header_background_color' => $this->colors['dark_blue'],
      'storefront_header_text_color' => $this->colors['light_gray'],
      'storefront_header_link_color' => $this->colors['white'],
      'storefront_footer_background_color' => '#f0f0f0',
      'storefront_footer_heading_color' => '#333333',
      'storefront_footer_text_color' => '#6d6d6d',
      'storefront_footer_link_color' => '#333333',
      'storefront_button_background_color' => $this->colors['medium_gray'],
      'storefront_button_text_color' => $this->colors['white'],
      'storefront_button_alt_background_color' => '#333333',
      'storefront_button_alt_text_color' => '#ffffff',
      'storefront_layout' => 'right',
      'background_color' => 'ffffff',

      // Defaults for new options.
      'accessible_storefront_focus_inside' => $this->colors['white'],
      'accessible_storefront_focus_outside' => $this->colors['light_blue'],
      'accessible_storefront_input_border_color' => $this->colors['medium_gray'],
      'accessible_storefront_header_search_border_color' => $this->colors['light_blue'],
      'accessible_storefront_header_button_background_color' => $this->colors['medium_blue'],
      'accessible_storefront_header_button_text_color' => $this->colors['white'],
      'accessible_storefront_header_button_alt_background_color' => $this->colors['lightest_blue'],
      'accessible_storefront_header_button_alt_text_color' => $this->colors['black'],
    );
  }

  // Add new options to customizer.
  public function add_custom_settings($wp_customize)
  {
    // Focus ring section
    $wp_customize->add_section(
      'focus_ring',
      array(
        'title' => __('Focus Ring', '_s'),
        'priority' => 47,
        'description' => __('Customize the two-toned focus ring that appears around links, buttons, and inputs when under focus.', '_s')
      )
    );

    // Focus ring inside color
    $wp_customize->add_setting(
      'accessible_storefront_focus_inside',
      array(
        'default' => $this->colors['white'],
        'sanitize_callback' => 'sanitize_hex_color',
      )
    );
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'accessible_storefront_focus_inside',
        array(
          'label' => __('Inside color', '_s'),
          'section' => 'focus_ring',
          'settings' => 'accessible_storefront_focus_inside',
        )
      )
    );

    // Focus ring outside color
    $wp_customize->add_setting(
      'accessible_storefront_focus_outside',
      array(
        'default' => $this->colors['light_blue'],
        'sanitize_callback' => 'sanitize_hex_color',
      )
    );
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'accessible_storefront_focus_outside',
        array(
          'label' => __('Outside color', '_s'),
          'section' => 'focus_ring',
          'settings' => 'accessible_storefront_focus_outside',
        )
      )
    );

    // Inputs section
    $wp_customize->add_section(
      'inputs',
      array(
        'title' => __('Inputs', '_s'),
        'priority' => 46,
        'description' => __('Customize the look & feel of your website inputs.', '_s')
      )
    );

    // Input border color
    $wp_customize->add_setting(
      'accessible_storefront_input_border_color',
      array(
        'default' => $this->colors['medium_gray'],
        'sanitize_callback' => 'sanitize_hex_color',
      )
    );
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'accessible_storefront_input_border_color',
        array(
          'label' => __('Border color', '_s'),
          'section' => 'inputs',
          'settings' => 'accessible_storefront_input_border_color',
        )
      )
    );

    // Header - Input border color
    $wp_customize->add_setting(
      'accessible_storefront_header_search_border_color',
      array(
        'default' => $this->colors['light_blue'],
        'sanitize_callback' => 'sanitize_hex_color',
      )
    );
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'accessible_storefront_header_search_border_color',
        array(
          'label' => __('Header search border color', '_s'),
          'section' => 'inputs',
          'settings' => 'accessible_storefront_header_search_border_color',
        )
      )
    );

    // Header buttons subheading
    $wp_customize->add_control(new Customizer_Subheading($wp_customize, 'header_buttons', array(
      'label' => __('Header Buttons'),
      'section' => 'storefront_buttons',
      'settings' => array(),
      'priority' => 41, // TODO
    )));

    // Header button background color
    $wp_customize->add_setting(
      'accessible_storefront_header_button_background_color',
      array(
        'default' => $this->colors['medium_blue'],
        'sanitize_callback' => 'sanitize_hex_color',
      )
    );
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'accessible_storefront_header_button_background_color',
        array(
          'label' => __('Background color', '_s'),
          'section' => 'storefront_buttons',
          'settings' => 'accessible_storefront_header_button_background_color',
          'priority' => 41,
        )
      )
    );

    // Header button button text color
    $wp_customize->add_setting(
      'accessible_storefront_header_button_text_color',
      array(
        'default' => $this->colors['white'],
        'sanitize_callback' => 'sanitize_hex_color',
      )
    );
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'accessible_storefront_header_button_text_color',
        array(
          'label' => __('Text color', '_s'),
          'section' => 'storefront_buttons',
          'settings' => 'accessible_storefront_header_button_text_color',
          'priority' => 41,
        )
      )
    );

    // Header alternate button background color
    $wp_customize->add_setting(
      'accessible_storefront_header_button_alt_background_color',
      array(
        'default' => $this->colors['lightest_blue'],
        'sanitize_callback' => 'sanitize_hex_color',
      )
    );
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'accessible_storefront_header_button_alt_background_color',
        array(
          'label' => __('Alternate button background color', '_s'),
          'section' => 'storefront_buttons',
          'settings' => 'accessible_storefront_header_button_alt_background_color',
          'priority' => 41,
        )
      )
    );

    // 'Checkout' button text color
    $wp_customize->add_setting(
      'accessible_storefront_header_button_alt_text_color',
      array(
        'default' => $this->colors['black'],
        'sanitize_callback' => 'sanitize_hex_color',
      )
    );
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        'accessible_storefront_header_button_alt_text_color',
        array(
          'label' => __('Alternate button text color', '_s'),
          'section' => 'storefront_buttons',
          'settings' => 'accessible_storefront_header_button_alt_text_color',
          'priority' => 41,
        )
      )
    );
  }

  // Apply new styles.
  public function add_custom_css()
  {
    echo '<style>
    a:focus, button:focus, .button.alt:focus, input:focus, textarea:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus, input[type="email"]:focus, input[type="tel"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus {
      outline: 0;
      box-shadow: inset 0 0 0 .125rem' . get_theme_mod('accessible_storefront_focus_inside') . ', 0 0 0 .125rem ' . get_theme_mod('accessible_storefront_focus_outside') . ';
    }
    input[type="text"]:not(:focus), input[type="number"]:not(:focus), input[type="email"]:not(:focus), input[type="tel"]:not(:focus), input[type="url"]:not(:focus), input[type="password"]:not(:focus), input[type="search"]:not(:focus), textarea:not(:focus), .input-text {
      box-shadow: inset 0 0 0 .125rem ' . get_theme_mod('accessible_storefront_input_border_color') . ';
    }
    .widget_product_search input[type="search"],
    .widget_product_search input[type="search"]::placeholder {
      color: ' . get_theme_mod('storefront_header_text_color') . ';
    }
    .widget_product_search input[type="search"]:not(:focus) {
      box-shadow: inset 0 0 0 .125rem ' . get_theme_mod('accessible_storefront_header_search_border_color') . ';
    }
    .site-header-cart .widget_shopping_cart a.button, .site-header-cart .cart-contents {
      background-color: ' . get_theme_mod('accessible_storefront_header_button_background_color') . ';
      color: ' . get_theme_mod('accessible_storefront_header_button_text_color') . ';
    }
    .site-header-cart .widget_shopping_cart a.button:hover {
      background-color: ' . storefront_adjust_color_brightness(get_theme_mod('accessible_storefront_header_button_background_color'), 25) . ';
    }
    .site-header-cart .widget a.button.checkout {
      background-color: ' . get_theme_mod('accessible_storefront_header_button_alt_background_color') . ';
      color: ' . get_theme_mod('accessible_storefront_header_button_alt_text_color') . ';
    }
    .site-header-cart .widget a.button.checkout:hover {
      background-color: ' . storefront_adjust_color_brightness(get_theme_mod('accessible_storefront_header_button_alt_background_color'), 25) . ';
    }
    </style>';
  }
}

return new Accessible_Storefront_Customizer;
