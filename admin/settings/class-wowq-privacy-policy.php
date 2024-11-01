<?php

/**
 * Admin Part of Plugin, dashboard and options.
 *
 * @package    Wow_Questionnaire
 * @subpackage wow-questionnaire/admin
 */
class Wow_Questionnaire_Privacy_Policy extends Wow_Questionnaire_Admin {

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
	
		$this->label = __( 'Privacy Policy', $plugin_name );
		$this->plugin_name = $plugin_name.'_privacy_policy';
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
			'wowq_privacyPolicyPage',
			apply_filters( $this->plugin_name . '-wowq-privacyPolicy-page', __( 'Privacy Policy Page Shortcode', $this->plugin_name ) ),
			array( $this, 'wowq_privacy_policy_page_options_field' ),
			$this->plugin_name,
			$this->plugin_name . '-options' // section to add to
		);
		
		add_settings_field(
			'wowq_cookiePolicyPage',
			apply_filters( $this->plugin_name . '-wowq-cookiePolicy-page', __( 'Choose a Cookie Policy Page', $this->plugin_name ) ),
			array( $this, 'wowq_cookie_policy_page_options_field' ),
			$this->plugin_name,
			$this->plugin_name . '-options' // section to add to
		);
		
		add_settings_field(
			'wowq_gdprButton',
			apply_filters( $this->plugin_name . '-wowq-gdprButton', __( 'Choose a GDPR request form', $this->plugin_name ) ),
			array( $this, 'wowq_gdpr_button_options_field' ),
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
	 * WOW!Q Privacy Policy Dropdown Field
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	public function wowq_privacy_policy_page_options_field() {

		$options 	= get_option( $this->plugin_name . '_options' );
		$option     = '';
		
		$html  = '<div class="col-sm-6">';
		$html .= '<div class="form-group">';
		$html .= '<h1><b>[wowq_privacy_policy]</b></h1>';
		$html .= '<p class="description">Privacy Policy Page Shortcode where WOW!Q will show your generated policy page.</p>';
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	
	} // ac_gdprPage_options_field()
	
	/**
	 * WOW!Q Cookie Policy Dropdown Field
	 *
	 * @since 		1.3.9
	 * @return 		mixed 			The settings field
	 */
	public function wowq_cookie_policy_page_options_field() {

		$options 	= get_option( $this->plugin_name . '_options' );
		$option     = '';

		if ( !empty( $options['wowq-cookiePolicyPage'] ) ) {
			
			$option  = $options['wowq-cookiePolicyPage'];

		}
		
		$pages = get_pages($args); 
		
		$html  = '<div class="col-sm-6">';
		$html .= '<div class="form-group">';
		$html .= '<select id="' . $this->plugin_name . '_options[wowq-cookiePolicyPage]" name="' . $this->plugin_name . '_options[wowq-cookiePolicyPage]" class="form-control">';
		
		foreach ($pages as $page) {
			$selected = ($page->ID == $option) ? 'selected="selected"' : '';
			$html .= '<option value="'.$page->ID.'" '.$selected.'>'.$page->post_title.'</option>';
		}
		
		$html .= '</select>';
		$html .= '<p class="description">Cookie Policy Page where WOW!Q will show your cookie policy page.</p>';
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	
	}
	
	/**
	 * WOW!Q GDPR Request Form Field
	 *
	 * @since 		1.3.8
	 * @return 		mixed 			The settings field
	 */
	public function wowq_gdpr_button_options_field() {

		$options 	= get_option( $this->plugin_name . '_options' );
		$option     = '';

		if ( !empty( $options['wowq-gdprButton'] ) ) {
			
			$option  = $options['wowq-gdprButton'];

		}
		
		$gdprs = $this->wowq_gdpr_request_forms(); 
		
		$html  = '<div class="col-sm-6">';
		$html .= '<div class="form-group">';
		$html .= '<select id="' . $this->plugin_name . '_options[wowq-gdprButton]" name="' . $this->plugin_name . '_options[wowq-gdprButton]" class="form-control">';
		
		foreach ($gdprs as $gdpr) {
			$selected = ($gdpr->id == $option) ? 'selected="selected"' : '';
			$html .= '<option value="'.$gdpr->id.'" '.$selected.'>'.$gdpr->name.'</option>';
		}
		
		if (empty($selected)) {
	    	$options['wowq-gdprButton'] = '';
			update_option($this->plugin_name . '_options',$options);
		}
		
		$html .= '</select>';
		$html .= '<p class="description">GDPR Request form will be docked at the bottom of your Privacy Policy Page.</p>';
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	
	} // ac_gdprButton_options_field()
	
	//- get gdpr request forms
	private function wowq_gdpr_request_forms () {
	    $result = null;
		$settings_options = get_option('wow-questionnaire_settings_options');
		if ( !empty( $settings_options['wowq-apiKey'] ) &&
			 !empty( $settings_options['wowq-email'] ) ) {
			 
			
			$data = array(
				'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
				'WOWQ-EMAIL'   => $settings_options['wowq-email'],
				'WOWQ-LICENSE' => $settings_options['wowq-licenseKey'],
			);
			
			$url  = $this->api_urls['api'].'questionnaires_gdpr_get/';
			$url  = sprintf("%s?%s", $url, http_build_query($data));
			$response = wp_remote_get( $url,
			    array(
			        'timeout'     => 120,
			        'httpversion' => '1.1'
			    )
			);
			
			if ( is_wp_error( $response ) ) {
			    $error_message = $response->get_error_message();
			    $result = json_encode(array(
					'status' => false,
					'error'  => "Something went wrong: $error_message"
				));
			}
			else {
			    $result = $response['body'];
			}
		    
		}
		
		return json_decode($result);
    }

}
