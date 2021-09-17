<?php

namespace BrianHenryIE\WC_Lock_Coupon_To_Email\WooCommerce;

use WC_Coupon;
use WC_Order;

/**
 * @coversDefaultClass \BrianHenryIE\WC_Lock_Coupon_To_Email\WooCommerce\Order
 */
class Order_WPUnit_Test extends \Codeception\TestCase\WPTestCase {

	public function test_update_coupon() {

		$coupon = new WC_Coupon();
		$coupon->set_code( 'ABC123' );
		$coupon->add_meta_data( Coupons::LOCK_COUPON_TO_EMAIL_META_KEY, 'yes' );
		$coupon_id = $coupon->save();

		$order = new WC_Order();
		$order->set_billing_email( 'brianhenryie@gmail.com' );
		$order->add_coupon( 'ABC123' );
		$order_id = $order->save();

		$sut = new Order();

		$prior_coupon       = new WC_Coupon( 'ABC123' );
		$prior_restrictions = $prior_coupon->get_email_restrictions();
		assert( 0 === count( $prior_restrictions ) );

		$sut->check_coupons_on_payment_complete( $order_id );

		$after_coupon       = new WC_Coupon( 'ABC123' );
		$after_restrictions = $after_coupon->get_email_restrictions();

		$this->assertCount( 1, $after_restrictions );

		$this->assertEquals( 'brianhenryie@gmail.com', $after_restrictions[0] );

	}

}
