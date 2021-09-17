<?php
/**
 * Tests for the root plugin file.
 *
 * @package BH_WC_Lock_Coupon_To_Email
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WC_Lock_Coupon_To_Email;

use BrianHenryIE\WC_Lock_Coupon_To_Email\Includes\BH_WC_Lock_Coupon_To_Email;

/**
 * Class Plugin_WP_Mock_Test
 */
class Plugin_Unit_Test extends \Codeception\Test\Unit {

	protected function setup() : void {
		parent::setUp();
		\WP_Mock::setUp();
	}

	public function tearDown(): void {
		\WP_Mock::tearDown();
		parent::tearDown();
	}

	/**
	 * Verifies the plugin initialization.
	 * Verifies the plugin does not output anything to screen.
	 */
	public function test_plugin_include() {

		// Prevents code-coverage counting, and removes the need to define the WordPress functions that are used in that class.
		\Patchwork\redefine(
			array( BH_WC_Lock_Coupon_To_Email::class, '__construct' ),
			function() {}
		);

		$plugin_root_dir = dirname( __DIR__, 2 ) . '/src';

		\WP_Mock::userFunction(
			'plugin_dir_path',
			array(
				'args'   => array( \WP_Mock\Functions::type( 'string' ) ),
				'return' => $plugin_root_dir . '/',
			)
		);

		\WP_Mock::userFunction(
			'register_activation_hook'
		);

		\WP_Mock::userFunction(
			'register_deactivation_hook'
		);

		ob_start();

		include $plugin_root_dir . '/bh-wc-lock-coupon-to-email.php';

		$printed_output = ob_get_contents();

		ob_end_clean();

		$this->assertEmpty( $printed_output );

	}

}
