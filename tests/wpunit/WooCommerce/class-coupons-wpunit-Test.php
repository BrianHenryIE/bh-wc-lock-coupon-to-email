<?php

namespace BrianHenryIE\WC_Lock_Coupon_To_Email\WooCommerce;

use BrianHenryIE\WC_Lock_Coupon_To_Email\WooCommerce\Coupons;
use WC_Coupon;

/**
 * @coversDefaultClass \BrianHenryIE\WC_Lock_Coupon_To_Email\WooCommerce\Coupons
 */
class Coupons_WPUnit_Test extends \Codeception\TestCase\WPTestCase {

	/**
	 * @covers ::save
	 */
	public function test_save_lock_coupon_enabled() {

		$coupon    = new WC_Coupon();
		$coupon_id = $coupon->save();

		$_POST[ Coupons::LOCK_COUPON_TO_EMAIL_META_KEY ] = 'yes';

		$sut = new Coupons();

		$sut->save( $coupon_id, $coupon );

		/** @var WC_Coupon $updated_coupon */
		$updated_coupon = new WC_Coupon( $coupon_id );

		$lock_coupon_enabled = $updated_coupon->get_meta( Coupons::LOCK_COUPON_TO_EMAIL_META_KEY, true );

		$this->assertEquals( 'yes', $lock_coupon_enabled );
	}

}
