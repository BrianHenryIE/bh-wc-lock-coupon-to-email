<?php
/**
 * When an order is paid check the coupons.
 *
 * @package brianhenryie/bh-wc-lock-coupon-to-email
 */

namespace BrianHenryIE\WC_Lock_Coupon_To_Email\WooCommerce;

/**
 * When the order is paid, add the billing email as a coupon restriction.
 */
class Order {

	/**
	 * When an order's status changes to a paid status, check the coupons.
	 *
	 * @hooked woocommerce_order_status_changed
	 * @see WC_Order::status_transition()
	 *
	 * @param int    $order_id The WooCommerce order id.
	 * @param string $status_from The previous status.
	 * @param string $status_to The new status.
	 */
	public function check_coupons_on_status_change_to_paid( int $order_id, string $status_from, string $status_to ): void {
		if ( ! in_array( $status_from, wc_get_is_paid_statuses(), true ) && in_array( $status_to, wc_get_is_paid_statuses(), true ) ) {
			$this->update_coupon( $order_id );
		}
	}

	/**
	 * When the payment complete action is fired, check the coupons.
	 *
	 * @hooked woocommerce_payment_complete
	 * @see WC_Order::payment_complete()
	 *
	 * @param int $order_id The WooCommerce order id.
	 */
	public function check_coupons_on_payment_complete( $order_id ): void {

		$this->update_coupon( $order_id );
	}

	/**
	 * Fetch the order object, get its coupons, check each coupon and if enabled, add the order
	 * billing address to the `Allowed emails` restriction.
	 *
	 * @param int $order_id WooCommerce order id.
	 */
	protected function update_coupon( int $order_id ): void {

		$order = wc_get_order( $order_id );

		if ( ! ( $order instanceof \WC_Order ) ) {
			return;
		}

		$order_item_coupons = $order->get_coupons();

		$coupons = array_map(
			function( \WC_Order_Item_Coupon $order_item_coupon ) {
				return new \WC_Coupon( $order_item_coupon->get_code() );
			},
			$order_item_coupons
		);

		foreach ( $coupons as $coupon ) {

			if ( 'yes' === $coupon->get_meta( Coupons::LOCK_COUPON_TO_EMAIL_META_KEY, true ) ) {

				$email_restrictions   = $coupon->get_email_restrictions();
				$email_restrictions[] = $order->get_billing_email();
				$coupon->set_email_restrictions( array_unique( $email_restrictions ) );
				$coupon->save();

			}
		}
	}

}
