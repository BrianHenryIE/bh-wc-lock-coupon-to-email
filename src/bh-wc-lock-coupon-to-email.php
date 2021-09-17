<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://BrianHenryIE.com
 * @since             1.0.0
 * @package           brianhenryie/bh-wc-lock-coupon-to-email
 *
 * @wordpress-plugin
 * Plugin Name:       Lock Coupon to Email
 * Plugin URI:        http://github.com/BrianHenryIE/bh-wc-lock-coupon-to-email/
 * Description:       Restrict a coupon to the first email address that uses it.
 * Version:           1.0.0
 * Author:            BrianHenryIE
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bh-wc-lock-coupon-to-email
 * Domain Path:       /languages
 */

namespace BrianHenryIE\WC_Lock_Coupon_To_Email;

use BrianHenryIE\WC_Lock_Coupon_To_Email\Includes\BH_WC_Lock_Coupon_To_Email;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'autoload.php';

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BH_WC_LOCK_COUPON_TO_EMAIL_VERSION', '1.0.0' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function instantiate_bh_wc_lock_coupon_to_email(): void {

	new BH_WC_Lock_Coupon_To_Email();
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and frontend-facing site hooks.
 */
instantiate_bh_wc_lock_coupon_to_email();
