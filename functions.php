<?php

// Add admin styles.
function accessible_storefront_admin_styles()
{
  wp_enqueue_style('accessible-storefront-admin-style', get_stylesheet_directory_uri() . '/assets/css/admin-style.css');
}
add_action('admin_enqueue_scripts', 'accessible_storefront_admin_styles');

// Add custom scripts.
function enqueue_accessible_storefront_scripts()
{
  wp_enqueue_script('accessible-storefront-functions', get_stylesheet_directory_uri('') . '/assets/js/accessible-storefront.js', array(), null);
}
add_action('wp_enqueue_scripts', 'enqueue_accessible_storefront_scripts');

// Change Storefront default colors to higher contrast theme, and add defaults for new options.
$accessible_storefront_customizer = require('inc/customizer.php');
add_filter('storefront_setting_default_values', array($accessible_storefront_customizer, 'set_default_values'));
add_action('customize_register', array($accessible_storefront_customizer, 'add_custom_settings'));
add_action('wp_head', array($accessible_storefront_customizer, 'add_custom_css'), 8);

// Add parentheses to item count in header cart link (see accessible-storefront.js for js version).
function storefront_cart_link()
{
  if (! storefront_woo_cart_available()) {
    return;
  }
?>
  <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'storefront'); ?>">
    <?php /* translators: %d: number of items in cart */ ?>
    <?php echo wp_kses_post(WC()->cart->get_cart_subtotal()); ?> <span class="count">(<?php echo wp_kses_data(sprintf(_n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'storefront'), WC()->cart->get_cart_contents_count())); ?>)</span>
  </a>
<?php
}

