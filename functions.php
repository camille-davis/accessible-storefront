<?php

// Add admin styles.
function accessible_storefront_admin_styles() {
  wp_enqueue_style('accessible-storefront-admin-style', get_stylesheet_directory_uri() . '/assets/css/admin-style.css');
}
add_action('admin_enqueue_scripts', 'accessible_storefront_admin_styles');

// Change Storefront default colors to higher contrast theme, and add defaults for new options.
$accessible_storefront_customizer = require('inc/customizer.php');
add_filter('storefront_setting_default_values', array($accessible_storefront_customizer, 'set_default_values'));
add_action('customize_register', array($accessible_storefront_customizer, 'add_custom_settings'));
add_action('wp_head', array($accessible_storefront_customizer, 'add_custom_css'), 8);

