<?php

/**
 * Admin Part of Plugin, dashboard and options.
 *
 * @package    Wow_Questionnaire
 * @subpackage wow-questionnaire/admin
 */
class Wow_Questionnaire_Gdpr extends Wow_Questionnaire_Admin {

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
	
		$this->label = __( 'GDPR', $plugin_name );
		$this->plugin_name = $plugin_name.'_gdpr';
		$this->plugin_settings_tabs[$this->plugin_name] = $this->label;
		
		$this->api_urls['root']= 'https://member.wowq.io/';
		$this->api_urls['api'] = 'https://member.wowq.io/wowapi/';
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
			'wowq_gdprPage',
			apply_filters( $this->plugin_name . '-wowq-gdpr-page', __( 'Choose a Page', $this->plugin_name ) ),
			array( $this, 'wowq_gdprPage_options_field' ),
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
	public function wowq_gdprPage_options_field() {

		$options 	= get_option( $this->plugin_name . '_options' );
		$option     = '';

		if ( !empty( $options['wowq-gdprPage'] ) ) {
			
			$option  = $options['wowq-gdprPage'];

		}
		
		$pages = get_pages($args); 
		
		$html  = '<div class="col-sm-6">';
		$html .= '<div class="form-group">';
		$html .= '<select id="' . $this->plugin_name . '_options[wowq-gdprPage]" name="' . $this->plugin_name . '_options[wowq-gdprPage]" class="form-control">';
		
		foreach ($pages as $page) {
			$selected = ($page->ID == $option) ? 'selected="selected"' : '';
			$html .= '<option value="'.$page->ID.'" '.$selected.'>'.$page->post_title.'</option>';
		}
		
		$html .= '</select>';
		$html .= '<p class="description">GDPR Page where WOW!Q will show and Manage User Data.</p>';
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	
	} // ac_gdprPage_options_field()

}
