<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://wowq.io/
 * @since      1.0.0
 *
 * @package    Wow_Questionnaire
 * @subpackage Wow_Questionnaire/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wow_Questionnaire
 * @subpackage Wow_Questionnaire/includes
 * @author     AustraliaWOW! <australiawow@gmail.com>
 */
class Wow_Questionnaire_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wow-questionnaire',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
