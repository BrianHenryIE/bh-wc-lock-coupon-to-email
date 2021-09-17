<?php
/**
 * WooCommerce Coupon Generator
 *
 * @see https://wordpress.org/plugins/coupon-generator-for-woocommerce/
 * @see https://jeroensormani.com/
 *
 * @see /wp-admin/admin.php?page=woocommerce_coupon_generator
 *
 * @package brianhenryie/bh-wc-lock-coupon-to-email
 */

namespace BrianHenryIE\WC_Lock_Coupon_To_Email\Coupon_Generator;

use BrianHenryIE\WC_Lock_Coupon_To_Email\WooCommerce\Coupons;

/**
 * Add the lock-coupon-to-email meta value to the bulk generated coupons.
 */
class Core_Generate {

	/**
	 * Add the posted metadata to the data to be saved by Coupon Generator.
	 *
	 * @hooked woocommerce_coupon_generator_coupon_meta_data
	 * @see wccg_generate_coupons()
	 *
	 * @param array<string, string> $meta The metadata to be saved with the coupons.
	 * @param ?int                  $coupon_id   Coupon post id.
	 * @param array<string, string> $args The posted data.
	 *
	 * @return array<string, string>
	 */
	public function add_lock_coupon_meta( array $meta, ?int $coupon_id, array $args ): array {

		if ( isset( $args[ Coupons::LOCK_COUPON_TO_EMAIL_META_KEY ] ) && wc_string_to_bool( $args[ Coupons::LOCK_COUPON_TO_EMAIL_META_KEY ] ) ) {
			$meta[ Coupons::LOCK_COUPON_TO_EMAIL_META_KEY ] = 'yes';
		} else {
			$meta[ Coupons::LOCK_COUPON_TO_EMAIL_META_KEY ] = 'no';
		}

		return $meta;
	}
}
