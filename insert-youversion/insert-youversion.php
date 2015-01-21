<?php
/**
 * Insert YouVersion
 *
 * This plugin creates shortcodes that generate scripture references with links to the scripture on YouVersion.
 *
 * @package   Insert_YouVersion
 * @author    Matthew Phelps <matt@mtthwphlps.com>
 * @license   GPL-2.0+
 * @link      http://mtthwphlps.com
 * @copyright 2014 Matthew Phelps
 *
 * @wordpress-plugin
 * Plugin Name:       Insert YouVersion
 * Plugin URI:        http://mtthwphlps.com/plugins/insert-youversion/
 * Description:       This plugin creates shortcodes that generate scripture references with links to the scripture on YouVersion.
 * Version:           1.0.1
 * Author:            Matthew Phelps
 * Author URI:        http://mtthwphlps.com
 * Text Domain:       insert-youversion
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
Shared Files
*-----------------------------------------------------------------------------*/
include_once( 'includes/data.php' );
include_once( 'includes/functions.php' );

/*----------------------------------------------------------------------------*
Public Functionality
*-----------------------------------------------------------------------------*/
require_once( 'public/insert-youversion-public.php' );

/*----------------------------------------------------------------------------*
Activation/Deactivation Hooks
*-----------------------------------------------------------------------------*/
register_activation_hook( __FILE__, 'activate' );
register_deactivation_hook( __FILE__, 'deactivate' );


/*----------------------------------------------------------------------------*
Dashboard Functionality
*-----------------------------------------------------------------------------*/
if (is_admin()) {
	require_once( 'admin/insert-youversion-admin.php' );
}
