<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.avdude.com
 * @since      1.0.0
 *
 * @package    Uxc_Study_Request
 * @subpackage Uxc_Study_Request/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Uxc_Study_Request
 * @subpackage Uxc_Study_Request/includes
 * @author     David Fleming <consultant@avdude.com>
 */
class Uxc_Study_Request_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'uxc-study-request',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
