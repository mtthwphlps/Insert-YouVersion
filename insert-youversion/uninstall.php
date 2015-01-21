<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   Insert_YouVersion
 * @author    Matthew Phelps <matt@mtthwphlps.com>
 * @license   GPL-2.0+
 * @link      http://mtthwphlps.com
 * @copyright 2014 Matthew Phelps
 */

// If uninstall not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
} else {
	delete_option( 'insert_youversion_settings_defaults' );
}