<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wowq.io
 * @since             1.0.0
 * @package           Wow_Questionnaire
 *
 * @wordpress-plugin
 * Plugin Name:       WOW!QUESTIONNAIRE
 * Plugin URI:        https://wowq.io
 * Description:       Popup questionnaires linked back into a CRM in JUST a few clicks? Yup.
 * Version:           1.4.1
 * Author:            AustraliaWOW!
 * Author URI:        https://nathanhague.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wow-questionnaire
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wow-questionnaire-activator.php
 */
function activate_wow_questionnaire() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wow-questionnaire-activator.php';
	Wow_Questionnaire_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wow-questionnaire-deactivator.php
 */
function deactivate_wow_questionnaire() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wow-questionnaire-deactivator.php';
	Wow_Questionnaire_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wow_questionnaire' );
register_deactivation_hook( __FILE__, 'deactivate_wow_questionnaire' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wow-questionnaire.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wow_questionnaire() {

	$plugin = new Wow_Questionnaire();
	$plugin->run();

}
run_wow_questionnaire();
