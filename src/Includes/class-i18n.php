<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    brianhenryie/bh-wc-lock-coupon-to-email
 */

namespace BrianHenryIE\WC_Lock_Coupon_To_Email\Includes;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    brianhenryie/bh-wc-lock-coupon-to-email
 * @author     BrianHenryIE <BrianHenryIE@gmail.com>
 */
class I18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @hooked plugins_loaded
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain(): void {

		load_plugin_textdomain(
			'bh-wc-lock-coupon-to-email',
			false,
			plugin_basename( dirname( __FILE__, 2 ) ) . '/languages/'
		);

	}

}
