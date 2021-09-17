<?php
/**
 * Class Plugin_Test. Tests the root plugin setup.
 *
 * @package BH_WC_Lock_Coupon_To_Email
 * @author     BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WC_Lock_Coupon_To_Email;

use BrianHenryIE\WC_Lock_Coupon_To_Email\Includes\BH_WC_Lock_Coupon_To_Email;

/**
 * Verifies the plugin has been instantiated and added to PHP's $GLOBALS variable.
 */
class Plugin_Integration_Test extends \Codeception\TestCase\WPTestCase {

	/**
	 * Test the main plugin object is added to PHP's GLOBALS and that it is the correct class.
	 */
	public function test_plugin_instantiated() {

		$this->assertArrayHasKey( 'bh_wc_lock_coupon_to_email', $GLOBALS );

		$this->assertInstanceOf( BH_WC_Lock_Coupon_To_Email::class, $GLOBALS['bh_wc_lock_coupon_to_email'] );
	}

}
