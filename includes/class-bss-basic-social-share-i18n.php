<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       deligo.pl
 * @since      1.0.0
 *
 * @package    Bss_Basic_Social_Share
 * @subpackage Bss_Basic_Social_Share/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Bss_Basic_Social_Share
 * @subpackage Bss_Basic_Social_Share/includes
 * @author     Deligo.pl <slawomir.s@deligo.pl>
 */
class Bss_Basic_Social_Share_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'bss-basic-social-share',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
