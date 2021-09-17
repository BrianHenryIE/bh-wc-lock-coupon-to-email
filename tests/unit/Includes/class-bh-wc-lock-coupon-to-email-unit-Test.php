<?php
/**
 * @package BH_WC_Lock_Coupon_To_Email_Unit_Name
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WC_Lock_Coupon_To_Email\Includes;

use BrianHenryIE\WC_Lock_Coupon_To_Email\WooCommerce\Coupons;
use BrianHenryIE\WC_Lock_Coupon_To_Email\WooCommerce\Order;
use WP_Mock\Matcher\AnyInstance;

/**
 * Class BH_WC_Lock_Coupon_To_Email_Unit_Test
 *
 * @coversDefaultClass \BrianHenryIE\WC_Lock_Coupon_To_Email\Includes\BH_WC_Lock_Coupon_To_Email
 */
class BH_WC_Lock_Coupon_To_Email_Unit_Test extends \Codeception\Test\Unit {

	protected function setup(): void {
		parent::setup();
		\WP_Mock::setUp();
	}

	protected function tearDown(): void {
		parent::tearDown();
		\WP_Mock::tearDown();
	}

	/**
	 * @covers ::set_locale
	 */
	public function test_set_locale_hooked() {

		\WP_Mock::expectActionAdded(
			'init',
			array( new AnyInstance( I18n::class ), 'load_plugin_textdomain' )
		);

		new BH_WC_Lock_Coupon_To_Email();
	}

	/**
	 * @covers ::define_coupon_hooks
	 */
	public function test_coupon_hooks() {

		\WP_Mock::expectFilterAdded(
			'woocommerce_coupon_options_usage_restriction',
			array( new AnyInstance( Coupons::class ), 'print_checkbox_input' ),
			1,
			2
		);

		\WP_Mock::expectActionAdded(
			'woocommerce_coupon_options_save',
			array( new AnyInstance( Coupons::class ), 'save' ),
			10,
			2
		);

		new BH_WC_Lock_Coupon_To_Email();
	}

	/**
	 * @covers ::define_order_hooks
	 */
	public function test_order_hooks() {

		\WP_Mock::expectActionAdded(
			'woocommerce_order_status_changed',
			array( new AnyInstance( Order::class ), 'check_coupons_on_status_change_to_paid' ),
			10,
			3
		);

		\WP_Mock::expectActionAdded(
			'woocommerce_payment_complete',
			array( new AnyInstance( Order::class ), 'check_coupons_on_payment_complete' )
		);

		new BH_WC_Lock_Coupon_To_Email();
	}
}
