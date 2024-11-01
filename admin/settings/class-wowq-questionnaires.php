<?php

/**
 * Admin Part of Plugin, dashboard and options.
 *
 * @package    Wow_Questionnaire
 * @subpackage wow-questionnaire/admin
 */
class Wow_Questionnaire_List extends Wow_Questionnaire_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0 
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $plugin_name       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name ) {
		
		$this->label = __( 'Questionnaires', $plugin_name );
		$this->plugin_name = $plugin_name.'_questionnaires';
		$this->plugin_settings_tabs[$this->plugin_name] = $this->label;
	}

	/**
	 * Creates our settings sections with fields etc. 
	 *
	 * @since    1.0.0
	 */
	public function settings_api_init(){

		// register_setting( $option_group, $option_name, $settings_sanitize_callback );
		register_setting(
			$this->plugin_name . '_options',
			$this->plugin_name . '_options',
			array( $this, 'settings_sanitize' )
		);

		// add_settings_section( $id, $title, $callback, $menu_slug );
		add_settings_section(
			$this->plugin_name . '-options', // section
			apply_filters( $this->plugin_name . '-display-section-title', __( '', $this->plugin_name ) ),
			array( $this, 'display_options_section' ),
			$this->plugin_name
		);
	}

	/**
	 * Creates a settings section
	 *
	 * @since 		1.0.0
	 * @param 		array 		$params 		Array of parameters for the section
	 * @return 		mixed 						The settings section
	 */
	public function display_options_section( $params ) {

		echo '<p>' . $params['title'] . '</p>';

	} // display_options_section()


}
