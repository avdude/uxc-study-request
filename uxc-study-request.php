<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.avdude.com
 * @since             1.0.0
 * @package           Uxc_Study_Request
 *
 * @wordpress-plugin
 * Plugin Name:       UXC Study Request
 * Plugin URI:        www.avdude.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.2
 * Author:            David Fleming
 * Author URI:        www.avdude.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       uxc-study-request
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if( ! class_exists( 'StudyRequest_Updater' ) ){
	include_once( plugin_dir_path( __FILE__ ) . 'new_updater.php' );
}

$updater = new StudyRequest_Updater( __FILE__ );
$updater->set_username( 'avdude' );
$updater->set_repository( 'uxc-study-request' );
/*
	$updater->authorize( 'abcdefghijk1234567890' ); // Your auth code goes here for private repos
*/
$updater->initialize();
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-uxc-study-request-activator.php
 */
function activate_uxc_study_request() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-uxc-study-request-activator.php';
	Uxc_Study_Request_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-uxc-study-request-deactivator.php
 */
function deactivate_uxc_study_request() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-uxc-study-request-deactivator.php';
	Uxc_Study_Request_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_uxc_study_request' );
register_deactivation_hook( __FILE__, 'deactivate_uxc_study_request' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-uxc-study-request.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_uxc_study_request() {

	$plugin = new Uxc_Study_Request();
	$plugin->run();

}
run_uxc_study_request();
