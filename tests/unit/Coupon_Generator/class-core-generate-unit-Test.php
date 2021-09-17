<?php

namespace BrianHenryIE\WC_Lock_Coupon_To_Email\Coupon_Generator;

class Core_Generate_Unit_Test extends \Codeception\Test\Unit {

	public function test_add_meta() {

		$sut = new Core_Generate();

		// The met
		$meta      = array();
		$coupon_id = null;
		$args      = array();

		$sut->add_lock_coupon_meta( $meta, $coupon_id, $args );

	}

}
