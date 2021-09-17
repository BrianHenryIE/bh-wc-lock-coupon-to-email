<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * frontend-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    brianhenryie/bh-wc-lock-coupon-to-email
 */

namespace BrianHenryIE\WC_Lock_Coupon_To_Email\Includes;

use BrianHenryIE\WC_Lock_Coupon_To_Email\Coupon_Generator\Core_Generate;
use BrianHenryIE\WC_Lock_Coupon_To_Email\WooCommerce\Coupons;
use BrianHenryIE\WC_Lock_Coupon_To_Email\WooCommerce\Order;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * frontend-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    brianhenryie/bh-wc-lock-coupon-to-email
 * @author     BrianHenryIE <BrianHenryIE@gmail.com>
 */
class BH_WC_Lock_Coupon_To_Email {

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the frontend-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->set_locale();

		$this->define_coupon_hooks();
		$this->define_order_hooks();
		$this->define_coupon_generator_hooks();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 */
	protected function set_locale(): void {

		$plugin_i18n = new I18n();

		add_action( 'init', array( $plugin_i18n, 'load_plugin_textdomain' ) );

	}

	/**
	 * Hooks to:
	 * * Add the checkbox on the new coupon screen.
	 * * Save it.
	 */
	protected function define_coupon_hooks(): void {
		$coupons = new Coupons();

		add_filter( 'woocommerce_coupon_options_usage_restriction', array( $coupons, 'print_checkbox_input' ), 1, 2 );

		add_action( 'woocommerce_coupon_options_save', array( $coupons, 'save' ), 10, 2 );

	}

	/**
	 * Hooks when:
	 * * Order status changes to a paid status
	 * * Order payment complete action fires
	 */
	protected function define_order_hooks(): void {
		$order = new Order();

		add_action( 'woocommerce_order_status_changed', array( $order, 'check_coupons_on_status_change_to_paid' ), 10, 3 );
		add_action( 'woocommerce_payment_complete', array( $order, 'check_coupons_on_payment_complete' ) );
	}

	/**
	 * Compatability with Coupon Generator for WooCommerce.
	 */
	protected function define_coupon_generator_hooks(): void {
		$core_generate = new Core_Generate();

		add_filter( 'woocommerce_coupon_generator_coupon_meta_data', array( $core_generate, 'add_lock_coupon_meta' ), 10, 3 );
	}
}

