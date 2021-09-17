<?php
/**
 * Print and save the checkbox.
 *
 * @package brianhenryie/bh-wc-lock-coupon-to-email
 */

namespace BrianHenryIE\WC_Lock_Coupon_To_Email\WooCommerce;

use WC_Coupon;

/**
 * Print the checkbox with `woocommerce_wp_checkbox` and save the value to the coupon meta.
 */
class Coupons {

	const LOCK_COUPON_TO_EMAIL_META_KEY = 'bh_wc_lock_coupon_to_email_enabled';

	/**
	 * Prints a simple checkbox.
	 *
	 * @hooked woocommerce_coupon_options_usage_restriction
	 * @see \WC_Meta_Box_Coupon_Data::output()
	 *
	 * @param int       $coupon_id The coupon post id.
	 * @param WC_Coupon $coupon The coupon object.
	 */
	public function print_checkbox_input( int $coupon_id, WC_Coupon $coupon ): void {

			$enabled = 'yes' === $coupon->get_meta( self::LOCK_COUPON_TO_EMAIL_META_KEY, true );

			woocommerce_wp_checkbox(
				array(
					'id'          => self::LOCK_COUPON_TO_EMAIL_META_KEY,
					'label'       => __( 'Lock to first email', 'woocommerce' ),
					'description' => __( 'When the coupon is used for the first time, set <code>Allowed emails</code> to the customer who has used it.', 'woocommerce' ),
					'value'       => wc_bool_to_string( $enabled ),
				)
			);
	}

	/**
	 * When posted data bh_wc_lock_coupon_to_email_enabled is true, set meta to 'yes', otherwise 'no'.
	 *
	 * @hooked woocommerce_coupon_options_save
	 *
	 * @param int       $post_id The coupon id.
	 * @param WC_Coupon $coupon The coupon object.
	 */
	public function save( int $post_id, WC_Coupon $coupon ): void {

		$posted_data = (array) wc_clean( $_POST );

		if ( isset( $posted_data[ self::LOCK_COUPON_TO_EMAIL_META_KEY ] ) ) {
			$lock_coupon_to_email = wc_bool_to_string( $posted_data[ self::LOCK_COUPON_TO_EMAIL_META_KEY ] );
		} else {
			$lock_coupon_to_email = 'no';
		}

		$coupon->add_meta_data( self::LOCK_COUPON_TO_EMAIL_META_KEY, $lock_coupon_to_email, true );
		$coupon->save();
	}

}
