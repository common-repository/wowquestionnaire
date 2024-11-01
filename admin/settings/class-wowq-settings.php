<?php

/**
 * Admin Part of Plugin, dashboard and options.
 *
 * @package    Wow_Questionnaire
 * @subpackage wow-questionnaire/admin
 */
class Wow_Questionnaire_Settings extends Wow_Questionnaire_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0 
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	
	/**
	 * The API URLS.
	 *
	 * @since    1.09
	 * @access   private
	 * @var      array    $api_urls    The API URLS of this plugin.
	 */
	public $api_urls = array();

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $plugin_name       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name ) {
	
		$this->label = __( 'Settings', $plugin_name );
		$this->plugin_name = $plugin_name.'_settings';
		$this->plugin_settings_tabs[$this->plugin_name] = $this->label;
		
		$this->api_urls['root']= 'https://member.wowq.io/';
		$this->api_urls['api'] = 'https://member.wowq.io/wowq_api/';
		$this->api_urls['key'] = 'https://member.wowq.io/key/';
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
		
		add_settings_field(
			'wowq_apiKey',
			apply_filters( $this->plugin_name . '-wowq-apiKey-label', __( 'API KEY', $this->plugin_name ) ),
			array( $this, 'wowq_apiKey_options_field' ),
			$this->plugin_name,
			$this->plugin_name . '-options' // section to add to
		);
		
		add_settings_field(
			'wowq_email',
			apply_filters( $this->plugin_name . '-wowq-email-label', __( 'Registered Email', $this->plugin_name ) ),
			array( $this, 'wowq_email_options_field' ),
			$this->plugin_name,
			$this->plugin_name . '-options' // section to add to
		);
		
		add_settings_field(
			'wowq_licenseKey',
			apply_filters( $this->plugin_name . '-wowq-licenseKey-label', __( 'DOMAIN LICENSE KEY', $this->plugin_name ) ),
			array( $this, 'wowq_licenseKey_options_field' ),
			$this->plugin_name,
			$this->plugin_name . '-options' // section to add to
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

	/**
	 * WOW!Q API KEY Text Field
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	public function wowq_apiKey_options_field() {

		$options 	= get_option( $this->plugin_name . '_options' );
		$option     = '';

		if ( !empty( $options['wowq-apiKey'] ) ) {
			
			$option  = $options['wowq-apiKey'];

		}

		echo '<div class="col-sm-6">
			<div class="form-group">
				<input class="regular-text input-sm form-control required maonster-alphanum-nospace" type="text" id="' . $this->plugin_name . '_options[wowq-apiKey]" name="' . $this->plugin_name . '_options[wowq-apiKey]" value="' . esc_attr( $option ) . '">
				<p class="description">Your WOW!Q API KEY.</p>
			</div></div>';
	
	} // ac_api_key_options_field()
	
	/**
	 * WOW!Q Email Field
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	public function wowq_email_options_field() {

		$options 	= get_option( $this->plugin_name . '_options' );
		$option     = '';

		if ( !empty( $options['wowq-email'] ) ) {
			
			$option  = $options['wowq-email'];

		}

		echo '<div class="col-sm-6">
			<div class="form-group">
				<input class="regular-text input-sm form-control required maonster-email" type="text" id="' . $this->plugin_name . '_options[wowq-email]" name="' . $this->plugin_name . '_options[wowq-email]" value="' . esc_attr( $option ) . '">
				<p class="description">The email you signed up to WOW!Q with goes here.</p>
			</div></div>';
	
	} // ac_api_key_options_field()
	
	/**
	 * WOW!Q DOMAIN LICENSE KEY Text Field
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	public function wowq_licenseKey_options_field() {

		$options 	= get_option( $this->plugin_name . '_options' );
		$option     = '';

		if ( !empty( $options['wowq-licenseKey'] ) ) {
			
			$option  = $options['wowq-licenseKey'];

		}

		echo '<div class="col-sm-6">
			<div class="form-group">
				<input class="regular-text input-sm form-control required maonster-alphanum-nospace" type="text" id="' . $this->plugin_name . '_options[wowq-licenseKey]" name="' . $this->plugin_name . '_options[wowq-licenseKey]" value="' . esc_attr( $option ) . '">
				<p class="description">Your WOW!Q Domain LICENSE KEY. <small><a href="'.$this->api_urls['root'].'profile?tab=domains" target="_blank">Watch how to get your domain license key.</a></small></p>
			</div></div>';
	
	} // ac_api_key_options_field()

}
