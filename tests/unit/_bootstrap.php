<?php
/**
 * PHPUnit bootstrap file for WP_Mock.
 *
 * @package           BH_WC_Lock_Coupon_To_Email
 */

WP_Mock::setUsePatchwork( true );
WP_Mock::bootstrap();

global $plugin_root_dir;
require_once $plugin_root_dir . '/autoload.php';
