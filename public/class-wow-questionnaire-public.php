<?php
session_start();
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wowq.io/
 * @since      1.0.0
 *
 * @package    Wow_Questionnaire
 * @subpackage Wow_Questionnaire/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wow_Questionnaire
 * @subpackage Wow_Questionnaire/public
 * @author     AustraliaWOW! <australiawow@gmail.com>
 */
class Wow_Questionnaire_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->api_urls['root']= 'https://member.wowq.io/';
		$this->api_urls['api'] = 'https://member.wowq.io/wowapi/';
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wow_Questionnaire_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wow_Questionnaire_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		 
		wp_enqueue_style( $this->plugin_name . '-bootstrap', plugin_dir_url( __FILE__ ) . 'vendor/bootstrap/css/bootstrap-wowq.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-jquery-datatables-bootstrap', plugin_dir_url( __FILE__ ) . 'vendor/datatables/css/dataTables.bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-jquery-datatables-responsive', plugin_dir_url( __FILE__ ) . 'vendor/datatables/css/responsive.dataTables.min.css', array(), $this->version, 'all' );
		
		wp_enqueue_style( $this->plugin_name . '-fontawesome', plugin_dir_url( __FILE__ ) . 'vendor/font-awesome/css/font-awesome.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-sweetalert', plugin_dir_url( __FILE__ ) . 'vendor/sweetalert2/sweetalert2.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-int-tel-input', plugin_dir_url( __FILE__ ) . 'vendor/int-tel-input/css/intlTelInput.min.css', array(), time(), 'all' );
		wp_enqueue_style( $this->plugin_name . '-main', plugin_dir_url( __FILE__ ) . 'css/wow-questionnaire-main.min.css', array(), time(), 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wow-questionnaire-public.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wow_Questionnaire_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wow_Questionnaire_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		
		wp_enqueue_script( $this->plugin_name . '-bootstrap', plugin_dir_url( __FILE__ ) . 'vendor/bootstrap/js/bootstrap.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-jquery-datatables', plugin_dir_url( __FILE__ ) . 'vendor/datatables/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-jquery-datatables-bootstrap', plugin_dir_url( __FILE__ ) . 'vendor/datatables/js/dataTables.bootstrap.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-jquery-datatables-responsive', plugin_dir_url( __FILE__ ) . 'vendor/datatables/js/dataTables.responsive.min.js', array( 'jquery' ), $this->version, true );
		
		wp_enqueue_script( $this->plugin_name . '-jquery-sweetalert', plugin_dir_url( __FILE__ ) . 'vendor/sweetalert2/sweetalert2.min.js', array( 'jquery' ), $this->version, true );
		
		//- Include public scripts
		wp_enqueue_script( $this->plugin_name . '-detectmobilebrowser', plugin_dir_url( __FILE__ ) . 'vendor/detectmobilebrowser.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-int-tel-input', plugin_dir_url( __FILE__ ) . 'vendor/int-tel-input/js/intlTelInput-jquery.min.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( $this->plugin_name . '-radial-indicator', plugin_dir_url( __FILE__ ) . 'vendor/radialIndicator/radialIndicator.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-maonster-step', plugin_dir_url( __FILE__ ) . 'vendor/maonster/maonster.form.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-stripe', 'https://js.stripe.com/v3/', array( 'jquery' ), $this->version, true );
		//wp_enqueue_script( $this->plugin_name . '-square', 'https://js.squareupsandbox.com/v2/paymentform', array( 'jquery' ), $this->version, true );
 		wp_enqueue_script( $this->plugin_name . '-square', 'https://js.squareup.com/v2/paymentform', array( 'jquery' ), $this->version, true );
		 
		 
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wow-questionnaire-public.min.js', array( 'jquery' ), time(), true );
		
		//- Localize script for ajax call
		wp_localize_script( $this->plugin_name, 'admin_urls' , array( 
			'base_url'   => plugin_dir_url(__FILE__),
			'admin_ajax' => admin_url( 'admin-ajax.php'),
			'ajax_nonce' => wp_create_nonce( 'wow-ajax-nonce' )
		) );

	}
	
	/**
	 * Register the stylesheets for the public-facing side of the GDPR page.
	 *
	 * @since    1.3.0
	 */
	public function enqueue_gdpr_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wow_Questionnaire_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wow_Questionnaire_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		 
		wp_enqueue_style( $this->plugin_name . '-gdpr-bootstrap', plugin_dir_url( __FILE__ ) . 'vendor/bootstrap/css/bootstrap-wowq.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-gdpr-jquery-datatables-bootstrap', plugin_dir_url( __FILE__ ) . 'vendor/datatables/css/dataTables.bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-gdpr-jquery-datatables-responsive', plugin_dir_url( __FILE__ ) . 'vendor/datatables/css/responsive.dataTables.min.css', array(), $this->version, 'all' );
		
		wp_enqueue_style( $this->plugin_name . '-gdpr-fontawesome', plugin_dir_url( __FILE__ ) . 'vendor/font-awesome/css/font-awesome.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-gdpr-sweetalert', plugin_dir_url( __FILE__ ) . 'vendor/sweetalert2/sweetalert2.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-gdpr-pinlogin', plugin_dir_url( __FILE__ ) . 'vendor/pinlogin/jquery.pinlogin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-gdpr-int-tel-input', plugin_dir_url( __FILE__ ) . 'vendor/int-tel-input/css/intlTelInput.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-gdpr-main', plugin_dir_url( __FILE__ ) . 'css/wow-questionnaire-main.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-gdpr', plugin_dir_url( __FILE__ ) . 'css/wow-questionnaire-gdpr-public.min.css?v='.time(), array(), $this->version, 'all' );

	}
	
	/**
	 * Register the JavaScript for the public-facing side of the GDPR preference page.
	 *
	 * @since    1.3.0
	 */
	public function enqueue_gdpr_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wow_Questionnaire_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wow_Questionnaire_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		
		wp_enqueue_script( $this->plugin_name . '-gdpr-bootstrap', plugin_dir_url( __FILE__ ) . 'vendor/bootstrap/js/bootstrap.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-gdpr-jquery-datatables', plugin_dir_url( __FILE__ ) . 'vendor/datatables/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-gdpr-jquery-datatables-bootstrap', plugin_dir_url( __FILE__ ) . 'vendor/datatables/js/dataTables.bootstrap.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-gdpr-jquery-datatables-responsive', plugin_dir_url( __FILE__ ) . 'vendor/datatables/js/dataTables.responsive.min.js', array( 'jquery' ), $this->version, true );
		
		wp_enqueue_script( $this->plugin_name . '-gdpr-jquery-sweetalert', plugin_dir_url( __FILE__ ) . 'vendor/sweetalert2/sweetalert2.min.js', array( 'jquery' ), $this->version, true );
		
		wp_enqueue_script( $this->plugin_name . '-gdpr-pinlogin', plugin_dir_url( __FILE__ ) . 'vendor/pinlogin/jquery.pinlogin.js', array( 'jquery' ), $this->version, true );
		
		wp_enqueue_script( $this->plugin_name . '-gdpr-table2csv', plugin_dir_url( __FILE__ ) . 'vendor/table2csv.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-gdpr-int-tel-input', plugin_dir_url( __FILE__ ) . 'vendor/int-tel-input/js/intlTelInput-jquery.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-gdpr-maonster-step', plugin_dir_url( __FILE__ ) . 'vendor/maonster/maonster.form.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-gdpr-crs', plugin_dir_url( __FILE__ ) . 'vendor/crs/data.js', array( 'jquery' ), $this->version, true );
		 
		wp_enqueue_script( $this->plugin_name . '-gdpr', plugin_dir_url( __FILE__ ) . 'js/wow-questionnaire-gdpr-public.min.js?v='.time(), array( 'jquery' ), $this->version, true );
		
		//- Localize script for ajax call
		wp_localize_script( $this->plugin_name . '-gdpr', 'wowq_gdpr_admin_urls' , array( 
			'base_url'   => plugin_dir_url(__FILE__),
			'admin_ajax' => admin_url( 'admin-ajax.php'),
			'ajax_nonce' => wp_create_nonce( 'wowgdpr-ajax-nonce' )
		) );

	}
	
	/**
	 * function for gdpr template page.
	 *
	 * @atts	 the template 
	 * @since    1.3.0
	 */
	function gdpr_template ($template) {
		$options  = get_option( $this->plugin_name . '_gdpr_options' );
		$option   = '';

		if ( !empty( $options['wowq-gdprPage'] ) ) {
			$option  = $options['wowq-gdprPage'];
		}
		
	    if ( !empty($option) && is_page($option)  ) {
			return plugin_dir_path( __FILE__ ) . 'partials/gdpr-template.php';
		}
	
		return $template;
	}
	
	/**
	 * Register the stylesheets for the public-facing side of the GDPR popup.
	 *
	 * @since    1.3.0
	 */
	public function enqueue_privacy_policy_styles() {
		wp_enqueue_style( $this->plugin_name . '-gdprpopup-bootstrap', plugin_dir_url( __FILE__ ) . 'vendor/bootstrap/css/bootstrap-wowq.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-gdprpopup-fontawesome', plugin_dir_url( __FILE__ ) . 'vendor/font-awesome/css/font-awesome.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-privacy-policy', plugin_dir_url( __FILE__ ) . 'css/wow-questionnaire-gdprpopup-public.min.css', array(), $this->version, 'all' );

	}
	
	/**
	 * Register the JavaScript for the public-facing side of the Privacy Policy page.
	 *
	 * @since    1.3.7
	 */
	public function enqueue_privacy_policy_scripts() {
		
		wp_enqueue_script( $this->plugin_name . '-privacy-policy-bootstrap', plugin_dir_url( __FILE__ ) . 'vendor/bootstrap/js/bootstrap.min.js', array( 'jquery' ), $this->version, true );
		//wp_enqueue_script( $this->plugin_name . '-privacy-policy', plugin_dir_url( __FILE__ ) . 'js/wow-questionnaire-privacy-policy-public.min.js', array( 'jquery' ), $this->version, true );
		
		//- Localize script for ajax call
		wp_localize_script( $this->plugin_name . '-privacy-policy', 'wowq_privacy_policy_admin_urls' , array( 
			'base_url'   => plugin_dir_url(__FILE__),
			'admin_ajax' => admin_url( 'admin-ajax.php'),
			'ajax_nonce' => wp_create_nonce( 'wowgdpr-privacy-policy-ajax-nonce' )
		) );

	}
	
	/**
	 * function for privacy policy template page.
	 *
	 * @atts	 the template for the generated privacy policy
	 * @since    1.3.7
	 */
	function privacy_policy_template ($template) {
		$options  = get_option( $this->plugin_name . '_privacy_policy_options' );
		$option   = '';

		if ( !empty( $options['wowq-privacyPolicyPage'] ) ) {
			$option  = $options['wowq-privacyPolicyPage'];
		}
		
	    if ( !empty($option) && is_page($option)  ) {
			return plugin_dir_path( __FILE__ ) . 'partials/privacy-policy-template.php';
		}
	
		return $template;
	}
	
	/**
	 * Register the stylesheets for the public-facing side of the GDPR popup.
	 *
	 * @since    1.3.0
	 */
	public function enqueue_wowqgdprpopup_styles() {
		wp_enqueue_style( $this->plugin_name . '-gdprpopup-bootstrap', plugin_dir_url( __FILE__ ) . 'vendor/bootstrap/css/bootstrap-wowq.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-gdprpopup-fontawesome', plugin_dir_url( __FILE__ ) . 'vendor/font-awesome/css/font-awesome.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-gdprpopup-toggle', plugin_dir_url( __FILE__ ) . 'vendor/bootstrap-toggle/css/bootstrap-toggle.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-gdprpopup-main', plugin_dir_url( __FILE__ ) . 'css/wow-questionnaire-main.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-gdprpopup', plugin_dir_url( __FILE__ ) . 'css/wow-questionnaire-gdprpopup-public.min.css', array(), $this->version, 'all' );

	}
	
	/**
	 * Register the JavaScript for the public-facing side of the GDPR popup.
	 *
	 * @since    1.3.0
	 */
	public function enqueue_wowqgdprpopup_scripts() {
		
		wp_enqueue_script( $this->plugin_name . '-gdprpopup-bootstrap', plugin_dir_url( __FILE__ ) . 'vendor/bootstrap/js/bootstrap.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-gdprpopup-toggle', plugin_dir_url( __FILE__ ) . 'vendor/bootstrap-toggle/js/bootstrap-toggle.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-gdprpopup', plugin_dir_url( __FILE__ ) . 'js/wow-questionnaire-gdprpopup-public.min.js', array( 'jquery' ), $this->version, true );
		
		
		$options 	= get_option( $this->plugin_name . '_privacy_policy_options' );
		$option     = '';
	
		if ( !empty( $options['wowq-cookiePolicyPage'] ) ) {
			$option  = $options['wowq-cookiePolicyPage'];
			$cookiePolicyLink = get_page_link($option);
		}
		else {
			$cookiePolicyLink = '#';
		}
		//- Localize script for ajax call
		wp_localize_script( $this->plugin_name . '-gdprpopup', 'wowq_gdpr_popup_admin_urls' , array( 
			'base_url'   => plugin_dir_url(__FILE__),
			'admin_ajax' => admin_url( 'admin-ajax.php'),
			'ajax_nonce' => wp_create_nonce( 'wowgdpr-popup-ajax-nonce' ),
			'cookie_policy_url' => $cookiePolicyLink
		) );

	}
	
	/**
	 * Shortcode function to show questionnaire.
	 *
	 * @since    1.0.0
	 * @atts	 shortcode attributes
	 * @atts[qid] the questionnaire id
	 */
	function shortcode_wowq ( $atts ) {
		$this->enqueue_styles(); 
		$this->enqueue_scripts(); 
		
		$isLicensed = $this->isLicensed();
		
		if ( $isLicensed && $isLicensed->status ) {
			
			$a = shortcode_atts( array(
		        'id'         => 0,
		        'html_id'    => '', // string only one
		        'html_class' => '', // string multiple separated by space
		        'html_style' => ''  // string multiple separated by semicolon
		    ), $atts );
		    $qid 		= $a['id'];
		    $html_id 	= $a['html_id'];
		    $html_class = $a['html_class'];
		    $html_style = $a['html_style'];
		    
			$startBtn       = 'GET STARTED!';
		    $questionnaire 	= $this->wowq_questionnaire($qid);
		    
		    $design   = $questionnaire->design;
			$settings = $questionnaire->settings;
			$is_gdpr  = $questionnaire->is_gdpr;
			
			if ($questionnaire->status) {
				$staStyle = 'style="background-color:'.$design->startBtnBgColor.' !important;color:'.$design->startBtnTextColor.' !important;"';
				$subStyle = 'style="background-color:'.$design->submitBtnBgColor.' !important;color:'.$design->submitBtnTextColor.' !important;"';
				$comStyle = 'style="background-color:'.$design->completionBtnBgColor.' !important;color:'.$design->completionBtnTextColor.' !important;"';
				
				if ($is_gdpr) {
					$html  = '<button data-qid="'.$qid.'" data-loading="'.$design->loadingText.'" class="wowqStart" '.$staStyle.'>'.$design->startBtn.'</button>';
					
					$html .= '<div id="wowq-modal-'.$qid.'" class="wowq-modal fade" style="display:none;" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">';
			        $html .= '<div class="wowq-modal-dialog" role="document">';
					$html .= '<div class="wowq-modal-content">';
					
					$html .= '<div class="wowq-modal-header">';
					$html .= '<button data-step="0" type="button" class="btn btn-default pull-left hidden back">Back</button>';
					$html .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
					$html .= '<span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></button>';
					$html .= '<h4 class="wowq-page-count wowq-modal-title">GDPR</h4>';
					$html .= '</div>';
					
					$html .= '<div class="wowq-modal-body">';
					
					$html .= '<form class="form-horizontal maonster-form" autocomplete="off">';
					
					$html .= '<div class="qContent">';
					
					$html .= $this->populateGDPRData($questionnaire->options);
					
					$html .= '</div>';
					
					if (!empty($design->bookImage)) {
						$html .= '<div class="free-book col-xs-offset-7 col-xs-5">';
						$html .= '<img class="img-responsive" src="'.$this->api_urls['root'].$design->bookImage.'">';
					  	$html .= '</div>';
					}
					
					if ($isLicensed->is_free == 'true' || (isset($design->poweredBy) && !empty($design->poweredBy) && $design->poweredBy == 'true')) {
						$html .= '<div class="createdBy col-xs-12 text-right">';
						$html .= '<small>Created using <a href="https://wowq.io" target="_blank">WOW!Q</a></small>';
					  	$html .= '</div>';
					}
					
						
					$html .= '</form>';
					
					$html .= '</div>';
					$html .= '</div>';
			        $html .= '</div>';
			        
			         //- The Thank You Popup
			        $html .= '<div class="wowq-thankyou" style="display:none;">';
			        
			        $html .= '<div class="form-group">';
			        $html .= '<h2 class="text-black text-center" style="font-size:32px;">';
			        $html .= $design->thankyouHeader;
			        $html .= '</h2>';
			        $html .= '<h4 class="text-black text-center" style="font-size:26px;">';
			        $html .= $design->thankyouSub;
			        $html .= '</h4>';
			        $html .= '</div>';
			        
			        $html .= '</div>';
			        
			        $html .= '</div>';
			        
				}
				else {
				
					if ($design->floatingBtnOn && $design->floatingBtnOn == 'true') {
						$html  = '<div class="wowq-floating-bar-footer" data-offset="'.$design->floatingBtnOffset.'" data-docked="'.$design->floatingDockedOn.'">';
						$html .= '<button data-qid="'.$qid.'" data-loading="'.$design->loadingText.'" class="wowqStart" '.$staStyle.'>'.$design->startBtn.'</button>';
						$html .= '</div>';
					}
					else {
						$html  = '<button data-qid="'.$qid.'" data-loading="'.$design->loadingText.'" class="wowqStart" '.$staStyle.'>'.$design->startBtn.'</button>';
					}
					
					
			        $html .= '<div id="wowq-modal-'.$qid.'" class="wowq-modal fade" style="display:none;" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">';
			        $html .= '<div class="wowq-modal-dialog" role="document">';
					$html .= '<div class="wowq-modal-content">';
					
					$html .= '<div class="wowq-modal-header">';
					$html .= '<button data-step="0" type="button" class="btn btn-default pull-left hidden back">Back</button>';
					$html .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
					$html .= '<span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></button>';
					$html .= '<h4 class="wowq-page-count wowq-modal-title">Step 1 of 14</h4>';
					$html .= '</div>';
					
					$html .= '<div class="wowq-modal-body">';
					
					$html .= '<form class="form-horizontal maonster-form" autocomplete="off">';
					$html .= '<div class="form-group">';
					$html .= '<div class="prg-cont rad-prg indicatorContainer"></div>';
					$html .= '</div>';
					$html .= '<div class="qContent">';
					
					$html .= $this->populateData($questionnaire->options);
					
					$html .= '</div>';
					
					$html .= '<div data-step="step-final" class="hidden step">';
					$html .= '<div class="complete-container">';
					$html .= '<div class="form-group">';
					$html .= '<p>';
					$html .= $design->completionText;
					$html .= '</p>';
					$html .= '</div>';
					$html .= '<div class="form-group">';
					
					if ($design->completionBlurScore && $design->completionBlurScore == 'true') {
						$html .= '<h1 class="dummy-score">SCORE: xxx%</h1>';
					}
					
					$html .= '</div>';
					$html .= '<div class="form-group">';
					$html .= '<button class="showMyScore" type="button" class="btn" '.$comStyle.'>'.$design->completionBtn.'</button>';
					$html .= '</div>';
					$html .= '</div>';
					
					$html .= '<div class="hidden ac-container">';
					$html .= '<div class="form-group">';
					$html .= '<input type="email" class="form-control required maonster-email" name="email" placeholder="Email">';
					$html .= '</div>';
					$html .= '<div class="form-group">';
					$html .= '<input type="tel" class="form-control maonster-phone" name="phone">';
					$html .= '</div>';
					$html .= '<div class="form-group text-left">';
					$html .= '<div class="checkbox">';
					$html .= '<label><input type="checkbox" class="wowq-optok">';
					$html .= '<small><b>YES!</b> I am OK with you sending me RELEVANT emails from this point. I can opt-out anytime.</small>';
					$html .= '</label>';
					$html .= '</div></div>';
					$html .= '<div class="form-group text-left">';
					$html .= '<div class="checkbox">';
					$html .= '<label><input type="checkbox" class="wowq-fbadok">';
					$html .= '<small><b>YES!</b> I am OK with you adding me to your social media tracking.</small>';
					$html .= '</label>';
					$html .= '</div></div>';
					$html .= '<div class="form-group">';
					$html .= '<button type="button" class="acSubmit maonster-submit btn btn-success" '.$subStyle.'>'.$design->submitBtn.'</button>';
					$html .= '</div>';
					
					//- privacy policy link
					$options 	= get_option( $this->plugin_name . '_privacy_policy_options' );
					$option     = '';
			
					if ( !empty( $options['wowq-privacyPolicyPage'] ) ) {
						
						$option  = $options['wowq-privacyPolicyPage'];
						$privacyPolicyLink = get_page_link($option);
						
						$html .= '<div class="form-group">';
						$html .= '<small style="font-size:60%;">We process your personal data in accordance with our <a href="'.$privacyPolicyLink.'" target="_blank" style="color: -webkit-link;cursor: pointer;text-decoration: underline;">privacy notice.</a></small>';
					  	$html .= '</div>';
					}
					
					$html .= '</div>';
					
					$html .= '<div class="hidden final-container">';
					$html .= '<div class="form-group">';
					$html .= '<h1 class="final-score">SCORE: xxx%</h1>';
					$html .= '</div>';
					$html .= '<div class="form-group">';
					$html .= '</div>';
					$html .= '</div>';
					
					$html .= '</div>';
										
					if (!empty($design->bookImage)) {
						$html .= '<div class="free-book col-xs-offset-7 col-xs-5">';
						$html .= '<img class="img-responsive" src="'.$this->api_urls['root'].$design->bookImage.'">';
					  	$html .= '</div>';
					}
					
					if ($isLicensed->is_free == 'true' || (isset($design->poweredBy) && !empty($design->poweredBy) && $design->poweredBy == 'true')) {
						$html .= '<div class="createdBy col-xs-12 text-right">';
						$html .= '<small>Created using <a href="https://wowq.io" target="_blank" style="color: -webkit-link;cursor: pointer;text-decoration: underline;">WOW!Q</a></small>';
					  	$html .= '</div>';
					}
					
						
					$html .= '</form>';
					
					$html .= '</div>';
					$html .= '</div>';
			        $html .= '</div>';
			        
			        $wooHTML = '';
					$_SESSION['wowqData_'.$qid] = $questionnaire->options;
			        if (isset($settings->woocommerce) && !empty($settings->woocommerce)) {
				        
						$_SESSION['wowqWoocommerce_'.$qid] = $settings->woocommerce;
						
						
						$wooHTML .= '<h2 class="text-center text-success wooSaleAlert" style="display:none;">';
						$wooHTML .= 'Sale Succcessful!';
						$wooHTML .= '</h2>';
			        }
			        
			        //- The Thank You Popup
			        $html .= '<div class="wowq-thankyou" style="display:none;">';
			        
			        $html .= '<div class="form-group">';
			        
			        $html .= $wooHTML;
			        
			        $html .= '<h2 class="text-black text-center" style="font-size:32px;padding:5px;margin:5px;">';
			        $html .= $design->thankyouHeader;
			        $html .= '</h2>';
			        $html .= '<h4 class="text-black text-center" style="font-size:26px;padding:5px;margin:5px;">';
			        $html .= $design->thankyouSub;
			        $html .= '</h4>';
			        $html .= '</div>';
			        
			        $html .= '<div class="form-group">';
			        $html .= '<h1 class="text-center" style="font-size:32px;">';
			        if ($design->thankyouBtnOn && $design->thankyouBtnOn == 'true') {
				        $tyStyle = 'style="background-color:'.$design->thankyouBtnBgColor.' !important;color:'.$design->thankyouBtnTextColor.'  !important;"';
			        	$html .= '<a class="swal2-styled" href="'.$design->thankyouBtnUrl.'" target="_blank" '.$tyStyle.'>';
				        $html .= $design->thankyouBtn;
				        $html .= '</a>';
			        }
			        $html .= '</h1>';
			        $html .= '</div>';
			        
			        $html .= '</div>';
			        
			        //- FB Pixel
			        if ($settings->fbPixel && $settings->fbPixel != '') {
				        
				        $html .= '<code class="wowqCodePixel" style="display:none;" data-fbpixel="'.($settings->fbPixel).'">';
				        $html .= '</code>';
			        }
			        
			        $html .= '</div>';
			    }
			        
		        return $html;
			}
			else {
				return '<div class="alert alert-danger">'.$questionnaire->msg.'</div>';
			}
		}
		else {
			if (isset($isLicensed->error) && !empty($isLicensed->error)) {
				$errorText = $isLicensed->error;
				return '<div class="alert alert-danger">'.$errorText.'</div>';
			}
			else {
				$errorText = 'WOW!Q is under maintenance at the moment. Sorry for the inconvenience.';
				return '<div class="alert alert-info">'.$errorText.'</div>';
			}
		}
		
	}
	
	/**
	 * Shortcode function to show questionnaire.
	 *
	 * @since    1.0.0
	 * @atts	 shortcode attributes
	 * @atts[qid] the questionnaire id
	 */
	function shortcode_wowq_privacy_policy ( $atts ) {
		$this->enqueue_privacy_policy_styles(); 
		$this->enqueue_privacy_policy_scripts(); 
		
		$html = '';
			
		$html .= '<div id="wowqpp-content" class="">';
			$get_privacy_policy = $this->get_privacy_policy();
			
			if (isset($get_privacy_policy)) {
				if ($get_privacy_policy->status) {
					$html .= nl2br($get_privacy_policy->html);
					
					$html .= '<div class="wowq-gdpr-docked-button bootstrap-wowq">';
					$html .= '<div class="row">';
					$html .= '<div class="col-6 text-center">';
					
					$options 	= get_option(  'wow-questionnaire_privacy_policy_options' );
					$option     = '';
			
					if ( !empty( $options['wowq-gdprButton'] ) ) {
						$option  = $options['wowq-gdprButton'];
						
						//- double check if questionnaire exists. if not, don't call shortcode
						$questionnaire = $this->wowq_questionnaire($option);
						
						if ($questionnaire->status) {
							$html .= do_shortcode("[wowq id='$option']");
						}
					}
					
					$html .= '</div>';
					$html .= '</div>';
					$html .= '</div>';
					
				}
				else {
					$html .= $get_privacy_policy->error;
				}
			}
			else {
				$html .= 'No Privacy Policy Generated yet.';
			}
		
		$html .= '</div>';
		
		return $html;
	}
    
	/* PUBLIC FUNCTIONS */
	public function get_wowq_woocommerce_data () {
	    // Check nounce - security thingy
		$nonce = $_POST['ajax_nonce'];
		$qid   = $_POST['qid'];
		
		if ( !wp_verify_nonce( $nonce, 'wow-ajax-nonce' ) ) {
			echo json_encode(array('status' => false, 'error' => 'Busted!'));
		}
		else {
			$result = null;
			echo json_encode($_SESSION);
		}
		exit();
    }
    
    public function get_wowq_woocommerce_products () {
	    // Check nounce - security thingy
		$nonce = $_POST['ajax_nonce'];
		$qid   = $_POST['qid'];
		
		if ( !wp_verify_nonce( $nonce, 'wow-ajax-nonce' ) ) {
			echo json_encode(array('status' => false, 'error' => 'Busted!'));
		}
		else {
			$result = null;
			$settings_options = get_option('wow-questionnaire_settings_options');
			if ( !empty( $settings_options['wowq-apiKey'] ) &&
				 !empty( $settings_options['wowq-email'] ) ) {
				 

				$homeUrl = get_home_url();
				$homeParsed = parse_url($homeUrl);	
				
				$data = array(
					'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
					'WOWQ-EMAIL'   => $settings_options['wowq-email'],
					'WOWQ-LICENSE' => $settings_options['wowq-licenseKey'],
					'WOWQ-ID'      => $qid,
					'WOWQ-WOO'     => $_POST['woocommerce']
				);
				
				$url  = $this->api_urls['api'].'get_wowq_woocommerce_products/';
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
				    $result = json_decode($response['body'],true);
				    
				    if ($result['status']) {
					    $method = $_POST['method'];
				    	$result['html'] = $this->wowq_woo_product($method, $result['woocommerce']);
				    	
				    	$result = json_encode($result);
				    }
				}
			    
			}
			
			echo $result;
		}
		exit();
    }
    
    
    public function wowq_woo_create_order () {
	    // Check nounce - security thingy
		$nonce = $_POST['ajax_nonce'];
		
		if ( !wp_verify_nonce( $nonce, 'wow-ajax-nonce' ) ) {
			echo json_encode(array('status' => false, 'error' => 'Busted!'));
		}
		else {
	    	$result = null;
			$settings_options = get_option('wow-questionnaire_settings_options');
			if ( !empty( $settings_options['wowq-apiKey'] ) &&
				 !empty( $settings_options['wowq-email'] ) ) {
				 

				$homeUrl = get_home_url();
				$homeParsed = parse_url($homeUrl);	
				
				$data = array(
					'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
					'WOWQ-EMAIL'   => $settings_options['wowq-email'],
					'WOWQ-LICENSE' => $settings_options['wowq-licenseKey'],
					'WOWQ-HOST'    => $homeParsed['host'],
					'WOWQ-DATA'    => $_POST['data'],
				);
				
				$url  = $this->api_urls['api'].'wowq_woo_create_order/';
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
			echo $result;
		}
		exit();
    }
    
    
    public function wowq_woo_payment () {
	    // Check nounce - security thingy
		$nonce = $_POST['ajax_nonce'];
		
		if ( !wp_verify_nonce( $nonce, 'wow-ajax-nonce' ) ) {
			echo json_encode(array('status' => false, 'error' => 'Busted!'));
		}
		else {
	    	$result = null;
			$settings_options = get_option('wow-questionnaire_settings_options');
			if ( !empty( $settings_options['wowq-apiKey'] ) &&
				 !empty( $settings_options['wowq-email'] ) ) {
				 

				$homeUrl = get_home_url();
				$homeParsed = parse_url($homeUrl);	
				
				$data = array(
					'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
					'WOWQ-EMAIL'   => $settings_options['wowq-email'],
					'WOWQ-LICENSE' => $settings_options['wowq-licenseKey'],
					'WOWQ-HOST'    => $homeParsed['host'],
					'WOWQ-DATA'    => $_POST['data'],
				);
				
				$url  = $this->api_urls['api'].'wowq_woo_payment/';
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
			echo $result;
		}
		exit();
    }
    
	
	public function get_geoip () {
	    // Check nounce - security thingy
		$nonce = $_POST['ajax_nonce'];
		
		if ( !wp_verify_nonce( $nonce, 'wowgdpr-popup-ajax-nonce' ) ) {
			echo json_encode(array('status' => false, 'error' => 'Busted!'));
		}
		else {
	    	$result = null;
			$settings_options = get_option('wow-questionnaire_settings_options');
			if ( !empty( $settings_options['wowq-apiKey'] ) &&
				 !empty( $settings_options['wowq-email'] ) ) {
				 

				$data = array(
					'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
					'WOWQ-EMAIL'   => $settings_options['wowq-email'],
					'WOWQ-LICENSE' => $settings_options['wowq-licenseKey'],
				);
				
				$url  = $this->api_urls['api'].'geoip/';
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
			echo $result;
		}
		exit();
    }
    
    public function gdpr_verify () {
		// Check nounce - security thingy
/*
		$nonce = $_POST['ajax_nonce'];
		if ( ! wp_verify_nonce( $nonce, 'wow-ajax-nonce' ) ) {
			echo json_encode(array('status' => false, 'error' => 'Busted!'));
		}
*/
		
    	$result = null;
		$settings_options = get_option('wow-questionnaire_settings_options');
		if ( !empty( $settings_options['wowq-apiKey'] ) &&
			 !empty( $settings_options['wowq-email'] ) ) {
			
			$data = array(
				'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
				'WOWQ-EMAIL'   => $settings_options['wowq-email'],
				'WOWQ-LICENSE' => $settings_options['wowq-licenseKey'],
				'WOWQ-RID'	   => $_POST['rid'],
				'WOWQ-PIN'     => $_POST['pin'],
				'WOWQ-HOST'    => $_POST['host'],
			);
			
			$args = array(
			    'body' => $data,
			    'timeout' => 120,
			    'httpversion' => '1.1'
			);
			 
			$url      = $this->api_urls['api'].'gdpr_verify/';
			$url      = sprintf("%s?%s", $url, http_build_query($data));
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
				$newData = array();
				$responseData = json_decode($response['body'],true);
				$newData['response'] = $responseData;
				//- Include WP User if any
				$wp_user = get_user_by('email',$responseData['data']['user_info']['requestor']);
					    
			    $wp_data = array();
			    if($wp_user) {
				    //- check if there is already a request..
				    $requests_query = new WP_Query( array(
					    'author'         => $wp_user->ID,
						'post_type'      => 'user_request',
						'posts_per_page' => -1,
						'post_status'    => 'any',
					) );
					$request_posts = $requests_query->posts;
					
					$requested = false;
					if ($request_posts && count($request_posts) > 0) {
						$requested = true;
						$wp_request_status = $request_posts[0]->post_status;
						$wp_data['status'] = $wp_request_status;
					}
					else {
					    $args = array(
						    'author'        => $wp_user->ID,
						    'orderby'       => 'date',
						    'order'         => 'DESC' ,
						    'post_status'   => 'any',
						    'numberposts'   => -1
					    );
					    $user_posts = get_posts( $args );
					    $new_posts  = array();
					    foreach ($user_posts as $uck => $user_post) {
						    $new_posts[$uck]['title']   = $user_post->post_title;
						    $new_posts[$uck]['content'] = wp_trim_words($user_post->post_content, 25);
						    $new_posts[$uck]['added']   = date('l, F jS, Y', strtotime($user_post->post_date_gmt));
					    }
						$wp_data['user_posts'] = $new_posts;
					    
					    $args = array(
							'author_email'       => $wp_user->user_email,
							'order_by'           => 'comment_date',
							'order'              => 'DESC',
							'include_unapproved' => array($wp_user->user_email),
						);
						
					    $user_comments = get_comments($args);
						$requested = false;
					    $new_comments  = array();
					    foreach ($user_comments as $uck => $user_comment) {
						    $comment_post = get_post($user_comment->comment_post_ID);
						    $new_comments[$uck]['title']   = $comment_post->post_title;
						    $new_comments[$uck]['content'] = wp_trim_words($user_comment->comment_content, 25);
						    $new_comments[$uck]['added']   = date('l, F jS, Y', strtotime($user_comment->comment_date_gmt));
					    }
						$wp_data['user_comments'] = $new_comments;
					}
					
					$wp_data['user'] = $wp_user;
					$wp_data['user_registered'] = date('l, F jS, Y', strtotime($wp_user->user_registered));
				}
				else {
					//- GET REQUEST DATA
					$request_posts = wp_get_user_request_data($responseData['data']['user_info']['wp_rid']);
					if ($request_posts) {
						$wp_request_status = $request_posts->status;
						$wp_data['status'] = $wp_request_status;
						$requested = true;
					}
					else {
					    $args = array(
							'author_email'       => $responseData['data']['user_info']['requestor'],
							'order_by'           => 'comment_date',
							'order'              => 'DESC',
							'include_unapproved' => array($responseData['data']['user_info']['requestor']),
						);
						
					    $user_comments = get_comments($args);
					    $new_comments  = array();
					    foreach ($user_comments as $uck => $user_comment) {
						    $new_comments[$uck]['title'] = $user_comment->post_title;
						    $new_comments[$uck]['title'] = wp_trim_words($user_post->post_content, 25);
						    $new_comments[$uck]['title'] = $user_comment->post_title;
					    }
					    
					    $requested = false;
					    $new_comments  = array();
					    foreach ($user_comments as $uck => $user_comment) {
						    $comment_post = get_post($user_comment->comment_post_ID);
						    $new_posts[$uck]['title']   = $comment_post->post_title;
						    $new_posts[$uck]['content'] = wp_trim_words($user_comment->comment_content, 25);
						    $new_posts[$uck]['added']   = date('l, F jS, Y', strtotime($user_comment->comment_date_gmt));
					    }
						$wp_data['user_comments'] = $new_posts;
				    }
				}
				$wp_data['requested'] = $requested;
				
			    $newData['wp_data'] = $wp_data;
			    $result = json_encode($newData);
			}
			
		}
		
		echo $result;
		exit();
    }
    
	public function get_gdpr_data () {
		$nonce  = $_POST['ajax_nonce'];
		$rid    = $_POST['rid'];
		
    	$result = null;
		$settings_options = get_option('wow-questionnaire_settings_options');
		if ( !empty( $settings_options['wowq-apiKey'] ) &&
			 !empty( $settings_options['wowq-email'] ) && 
			 isset($rid) && !empty($rid) ) {
			 
			
			$data = array(
				'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
				'WOWQ-EMAIL'   => $settings_options['wowq-email'],
				'WOWQ-LICENSE' => $settings_options['wowq-licenseKey'],
				'WOWQ-RID'     => $rid,
			);
			
			$args = array(
			    'body' => $data,
			    'timeout' => 120,
			    'httpversion' => '1.1'
			);
			 
			$url      = $this->api_urls['api'].'gdpr_data_get/';
			$url      = sprintf("%s?%s", $url, http_build_query($data));
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
		
		echo $result;
		exit();
    }
    
    public function gdpr_request () {
		// Check nounce - security thingy
		$nonce  = $_POST['ajax_nonce'];
    	$result = null;
/*
    	$verify = wp_verify_nonce( 'ad6f95701a', 'wowgdpr-ajax-nonce' );
		if ( !$verify ) {
			$result = json_encode(array(
				'status' => false,
				'error'  => 'Busted!',
				'post'   => $verify
			));
		}
*/
		
		$post   = $_POST;
    	if ($post['data']['action'] == 'generate') {
	    	if (isset($post['data']['uid']) && !empty($post['data']['uid'])) {
		    	$user_info = get_userdata($post['data']['uid']);
	    	}
	    	else {
		    	$userdata = array(
			    	'user_login'  => $post['data']['email'],
				    'user_email'  => $post['data']['email'],
				    'first_name'  => 'WOW!QGDPR',
				    'last_name'   => 'User'.wp_hash(time().'-'.$post['data']['email']),
				    'user_pass'   => NULL  // When creating an user, `user_pass` is expected.
				);
				$user_id   = wp_insert_user( $userdata ) ;
				$user_info = get_userdata($user_id);
	    	}
	    	
	    	if ($user_info) {
		    	$num_posts = 2;
		    	$num_comments = 3;
		    	$post_ids = array();
		    	for ($i=0;$i<$num_posts;$i++) {
			    	$postData = array(
				    	'post_author' => $user_info->ID,
				    	'post_title'  => 'WOW!QGDPR Test Post - '.wp_hash(time().'-'.$user_info->ID.'-'.$i),
				    	'post_content'=> 'Content here...',
				    	'post_status' => 'publish'
			    	);
			    	$post_id = wp_insert_post($postData);
			    	$post_ids[$i] = $post_id;
		    	}
		    	
		    	//- create random comments to newly created posts...
		    	for ($j=0;$j<$num_comments;$j++) {
			    	$rand_post_id = array_rand($post_ids);
			    	$time = current_time('mysql');
			    	$commentData  = array(
				    	'comment_post_ID' 		=> $post_ids[$rand_post_id],
				    	'comment_author_email'  => $user_info->user_email,
				    	'comment_author' 		=> $user_info->first_name . ' ' . $user_info->last_name,
				    	'comment_content'		=> 'WOW!QGDPR random comment - '.wp_hash(time().'-'.$rand_post_id.'-'.$j),
				    	'comment_date'			=> $time,
				    	'comment_approved'      => 1,
				    	'user_id'   			=> $user_info->ID
			    	);
			    	wp_insert_comment($commentData);
		    	}
		    	
		    	$result = json_encode(array(
					'status'  => true,
					'request' => $post_ids,
					'user'    => $user_info,
					'posts'   => $post
				));
			}
			else {
				$result = json_encode(array(
					'status'  => false,
					'request' => $post_ids,
					'user'    => $user_info,
					'posts'   => $post
				));
			}
    	}
    	else {
			$settings_options = get_option('wow-questionnaire_settings_options');
			if ( !empty( $settings_options['wowq-apiKey'] ) &&
				 !empty( $settings_options['wowq-email'] ) ) {
			
				$request = $post['data']['action'];
				
				if ($post['data']['crm'] == 'wp') {
					if ($request == 'update_data') {
						if (isset($post['data']['uid']) && !empty($post['data']['uid'])) {
							$wp_id   = $post['data']['uid'];
							$wp_user = get_user_by('ID',$wp_id);
							if ($wp_user) {
								$user_id = wp_update_user( array( 
									'ID' 	     => $wp_user->ID,
									'first_name' => $post['data']['fname'],
									'last_name'  => $post['data']['lname'],
									'user_url'   => $post['data']['website'] 
								) );
								if ( is_wp_error( $user_id ) ) {
									$result = json_encode(array(
										'status' => false,
										'error'  => "There was an error, probably that user doesn't exist"
									));
								} else {
									$result = json_encode(array(
										'status'  => true,
										'request' => $user_id
									));
								}
							}
						}
					}
					else if ($request == 'remove_data') {
						//- check if admin, send email to user...
						$isAdmin = false;
						if (isset($post['data']['uid']) && !empty($post['data']['uid'])) {
							$wp_id   = $post['data']['uid'];
							$wp_user = get_user_by('ID',$wp_id);
							if ($wp_user) {
								if ($wp_user->has_cap('administrator')) {
									$isAdmin = true;
								}
							}
						}
						
						if (!$isAdmin) {
							$request_id = wp_create_user_request( $post['data']['email'], 'remove_personal_data' );
							
							if (!isset($request_id->errors)) {
								$data = array(
									'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
									'WOWQ-EMAIL'   => $settings_options['wowq-email'],
									'WOWQ-LICENSE' => $settings_options['wowq-licenseKey'],
									'WOWQ-DATA'    => $post['data'],
									'WOWQ-WP-RID'  => $request_id,
									'WOWQ-WP-ADMIN'=> $isAdmin
								);
								
								$args = array(
								    'body' => $data,
								    'timeout' => 120,
								    'httpversion' => '1.1'
								);
								 
								$url      = $this->api_urls['api'].'gdpr_data_post/';
								$response = wp_remote_post( $url, $args );
								
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
							else {
								$result = json_encode(array(
									'status'  => true,
									'request' => true
								));
							}
						}
						else {
							$result = json_encode(array(
								'status'  => false,
								'error'   => 'Can not remove Administrator.'
							));
						}
					}
				}
				else {
								
					//- check if admin, send email to user...
					$isAdmin = false;
					if (isset($post['data']['uid']) && !empty($post['data']['uid'])) {
						$wp_id   = $post['data']['uid'];
						$wp_user = get_user_by('ID',$wp_id);
						if ($wp_user) {
							if ($wp_user->has_cap('administrator')) {
								$isAdmin = true;
							}
						}
					}
					$data = array(
						'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
						'WOWQ-EMAIL'   => $settings_options['wowq-email'],
						'WOWQ-LICENSE' => $settings_options['wowq-licenseKey'],
						'WOWQ-DATA'    => $post['data'],
						'WOWQ-WP-ADMIN'=> $isAdmin
					);
					
					$args = array(
					    'body' => $data,
					    'timeout' => 120,
					    'httpversion' => '1.1'
					);
					 
					$url      = $this->api_urls['api'].'gdpr_data_post/';
					$response = wp_remote_post( $url, $args );
					
					if ( is_wp_error( $response ) ) {
					    $error_message = $response->get_error_message();
					    $result = json_encode(array(
							'status' => false,
							'error'  => "Something went wrong: $error_message"
						));
					}
					else {
					    $result = $response['body'];
					    
					    //- update WP last for remove all...
					    if ($post['data']['crm'] == 'all') {
							if ($request == 'update_data') {
								
								if (isset($post['data']['uid']) && !empty($post['data']['uid'])) {
									$wp_id   = $post['data']['uid'];
									$wp_user = get_user_by('ID',$wp_id);
									if ($wp_user) {
										$user_id = wp_update_user( array( 
											'ID' 	     => $wp_user->ID,
											'first_name' => $post['data']['fname'],
											'last_name'  => $post['data']['lname'],
											'user_url'   => $post['data']['website'] 
										) );
										if ( is_wp_error( $user_id ) ) {
											$result = json_encode(array(
												'status' => false,
												'error'  => "There was an error, probably that user doesn't exist"
											));
										} else {
											$result = json_encode(array(
												'status'  => true,
												'request' => $user_id
											));
										}
									}
								}
							}
							else if ($request == 'remove_data') {
								
								if (!$isAdmin) {
									$request_id = wp_create_user_request( $post['data']['email'], 'remove_personal_data' );
									
									$result = json_encode(array(
										'status'  => true,
										'request' => true
									));
								}
							
							}
						}
					}
				}
				
			}
		}
		
		echo $result;
		exit();
    }
        
    public function submit_questionnaire () {
		// Check nounce - security thingy
		$nonce = $_POST['ajax_nonce'];
		if ( ! wp_verify_nonce( $nonce, 'wow-ajax-nonce' ) ) {
			echo json_encode(array('status' => false, 'error' => 'Busted!'));
		}
		
    	$result = null;
		$settings_options = get_option('wow-questionnaire_settings_options');
		if ( !empty( $settings_options['wowq-apiKey'] ) &&
			 !empty( $settings_options['wowq-email'] ) ) {
			 
			$gdpr_options  = get_option( $this->plugin_name . '_gdpr_options' );
			$gdpr_option   = '';
		
			if ( !empty( $gdpr_options['wowq-gdprPage'] ) ) {
				$gdpr_option  = $gdpr_options['wowq-gdprPage'];
				$gdpr_option  = get_permalink($gdpr_option);
			}
			
			$data = array(
				'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
				'WOWQ-EMAIL'   => $settings_options['wowq-email'],
				'WOWQ-LICENSE' => $settings_options['wowq-licenseKey'],
				'WOWQ-ID'      => $_POST['qid'],
				'WOWQ-DATA'    => $_POST['data'],
				'WOWQ-STEPS'   => $_POST['steps'],
				'WOWQ-COOKIES' => $_POST['cookies'],
				'WOWQ-GDPR'    => $_POST['is_gdpr'],
				'WOWQ-GDPR-PAGE' => $gdpr_option
			);
			
			$args = array(
			    'body' => $data,
			    'timeout' => 120,
			    'httpversion' => '1.1'
			);
			 
			$url      = $this->api_urls['api'].'questionnaire_post/';
			$response = wp_remote_post( $url, $args );
			
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
		
		echo $result;
		exit();
    }
    
    public function gdpr_settings () {
	    // Check nounce - security thingy
		$nonce = $_POST['ajax_nonce'];
		
		if ( !wp_verify_nonce( $nonce, 'wow-ajax-nonce' ) ) {
			echo json_encode(array('status' => false, 'error' => 'Busted!'));
		}
		else {
	    	$result = null;
			$settings_options = get_option('wow-questionnaire_settings_options');
			if ( !empty( $settings_options['wowq-apiKey'] ) &&
				 !empty( $settings_options['wowq-email'] ) ) {
				 

				$data = array(
					'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
					'WOWQ-EMAIL'   => $settings_options['wowq-email'],
					'WOWQ-LICENSE' => $settings_options['wowq-licenseKey'],
					'WOWQ-DOMAIN'  => $_POST['domain'],
				);
				
				$url  = $this->api_urls['api'].'domaindata_get/';
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
			echo $result;
		}
		exit();
    }
	
	/* PRIVATE FUNCTIONS */
	private function isLicensed() {
	    $isLicensed = false;
		$settings_options = get_option('wow-questionnaire_settings_options');
		if ( !empty( $settings_options['wowq-apiKey'] ) &&
			 !empty( $settings_options['wowq-email'] ) ) {
			 
		    /*
			 * TEST API KEY.
			 */
			$data = array(
				'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
				'WOWQ-EMAIL'   => $settings_options['wowq-email'],
				'WOWQ-LICENSE' => $settings_options['wowq-licenseKey'],
			);
			
			$url  = $this->api_urls['api'].'validate/';
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
			    $result = json_decode($response['body']);
			}
		    
			 //- validate
			$isLicensed = $result;
		}
		
		return $isLicensed;
    }
    
    public function wowq_questionnaire ($qid) {
	    $result = null;
		$settings_options = get_option('wow-questionnaire_settings_options');
		if ( !empty( $settings_options['wowq-apiKey'] ) &&
			 !empty( $settings_options['wowq-email'] ) ) {
			 
			
			$data = array(
				'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
				'WOWQ-EMAIL'   => $settings_options['wowq-email'],
				'WOWQ-LICENSE' => $settings_options['wowq-licenseKey'],
				'WOWQ-ID'      => $qid
			);
			
			$url  = $this->api_urls['api'].'questionnaire_get/';
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
    
    //- FOR ERASE PERSONAL DATA HOOK
    public function register_wowq_eraser( $erasers ) {
	  $erasers[$this->plugin_name] = array(
	    'eraser_friendly_name' => __( 'WOW!Q Eraser' ),
	    'callback'             => array( $this, 'wowq_eraser' ),
	    );
	  return $erasers;
	}
	
	public function wowq_eraser ( $email_address, $page = 1 ) {
		//- Remove USER
	    $wp_user = get_user_by('email',$email_address);
		if ($wp_user) {
			wp_delete_user($wp_user->ID);
		}
		return array(
			'items_removed'  => true,
		    'items_retained' => false, // always false in this example
		    'messages' => array(), // no messages in this example
		    'done' => true,
		);
	}
	
    public function wowq_personal_data_erased( $request_id ) {
	  	wp_delete_post($request_id);
	  	return true;
	}
	//- END FOR ERASE PERSONAL DATA HOOK
	
	//- @since 1.3.7
	public function get_privacy_policy () {
		
    	$result = null;
		$settings_options = get_option('wow-questionnaire_settings_options');
		if ( !empty( $settings_options['wowq-apiKey'] ) &&
			 !empty( $settings_options['wowq-email'] ) ) {
			 
			$gdpr_options  = get_option( $this->plugin_name . '_gdpr_options' );
			$gdpr_option   = '';
		
			if ( !empty( $gdpr_options['wowq-gdprPage'] ) ) {
				$gdpr_option  = $gdpr_options['wowq-gdprPage'];
				$gdpr_option  = get_permalink($gdpr_option);
			}
			
			$homeUrl = get_home_url();
			$homeParsed = parse_url($homeUrl);	
			
			$data = array(
				'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
				'WOWQ-EMAIL'   => $settings_options['wowq-email'],
				'WOWQ-LICENSE' => $settings_options['wowq-licenseKey'],
				'WOWQ-HOST'    => $homeParsed['host']
			);
			
			$args = array(
			    'body' => $data,
			    'timeout' => 120,
			    'httpversion' => '1.1'
			);
			 
			$url      = $this->api_urls['api'].'get_privacy_policy/';
			$response = wp_remote_post( $url, $args );
			
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
    
    
    //- PRIVATE FUNCTIONS
    
	
	private function wowq_woo_product ($method, $data) {
		
	    $html = '<div id="wowq-woocommerce-div">';
	    $productPriceHTML = '';
	    $productFinishBtn = '';
	    
	    
		$stripeValidCountries = ['AE', 'AT', 'AU', 'BE', 'BR', 'CA', 'CH', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GB', 'GR', 'HK', 'IE', 'IN', 'IT', 'JP', 'LT', 'LU', 'LV', 'MX', 'MY', 'NL', 'NO', 'NZ', 'PH', 'PL', 'PT', 'RO', 'SE', 'SG', 'SI', 'SK', 'US'];
	    
	    
		$shippingFee = '';
		if ($data['shipping']) {
			$shippingText = 'Free Shipping';
			if ($data['shipping']['value'] > 0) {
				$shippingFee = '+'.$data['shipping']['value'];
				$shippingText = 'Shipping Fee: '.$data['shipping']['value'];
			}
			
		    $productFinishBtn .= '<div class="form-group">';
		    $productFinishBtn .= '<div class="alert alert-info">'.$shippingText.'</div>';
			$productFinishBtn .= '</div>';
		}
	    
		if ($method == 'more') {
		
			$productMore = $data['productMore'];
			$productMorePercent = $data['settings']['percent'];
			$productPriceHTML = $productMore['price_html'];
		
			$html .= '<div data-percent="'.$productMorePercent.'" class="text-center hidden" id="wowq-woocommerce-product-more">';
		    $html .= '<h3>';
		    $html .= '<span class="wowq-woocommerce-fname"></span> - based on your answers today, this might be of benefit to you!';
		    $html .= '</h3>';
		    
		    $html .= '<img src="'.$productMore['images'][0].'" class="img-responsive center-block wowq-woocommerce-pname" style="max-height: 200px;"/>';
		    $html .= '<h3 class="wowq-woocommerce-pname">'.$productMore['name'].'</h3>';
		    $html .= '<p class="wowq-woocommerce-pdesc">'.$productMore['description'].'</p>';
		    $html .= '</ul>';
		    $html .= '<button data-price="'.$productMore['price'].'" data-prodid="'.$productMore['id'].'" class="wowq-woocommerce-buy btn btn-large btn-success button-credit-card">BUY NOW '.$productPriceHTML.'</button>';
		    $html .= '</div>';
		    
		    $productFinishBtn .= '<div class="form-group">';
		    $productFinishBtn .= '<button id="wowq-woocommerce-finish" class="btn btn-large btn-success maonster-submit button-credit-card">FINISH & PAY '.$productPriceHTML.' '.$shippingFee.'</button>';
			$productFinishBtn .= '</div>';
	    
	    }
	    else if ($method == 'less') {
		
			$productLess = $data['productLess'];
			$productLessPercent = $data['settings']['percent'];
			$productPriceHTML = $productLess['price_html'];
			
		    $html .= '<div data-percent="'.$productLessPercent.'" class="text-center hidden" id="wowq-woocommerce-product-less">';
		    $html .= '<h3>';
		    $html .= '<span class="wowq-woocommerce-fname"></span> - based on your answers today, this might be of benefit to you!';
		    $html .= '</h3>';
		    
		    $html .= '<img src="'.$productLess['images'][0].'" class="img-responsive center-block wowq-woocommerce-img" style="max-height: 200px;"/>';
		    $html .= '<h3 class="wowq-woocommerce-pname">'.$productLess['name'].'</h3>';
		    $html .= '<p class="wowq-woocommerce-pdesc">'.$productLess['description'].'</p>';
		    $html .= '<button data-price="'.$productLess['price'].'" data-prodid="'.$productLess['id'].'" class="wowq-woocommerce-buy btn btn-large btn-success button-credit-card">BUY NOW '.$productPriceHTML.'</button>';
		    $html .= '</div>';
		    
		    $productFinishBtn .= '<div class="form-group">';
		    $productFinishBtn .= '<button id="wowq-woocommerce-finish" class="btn btn-large btn-success maonster-submit button-credit-card">FINISH & PAY '.$productPriceHTML.' '.$shippingFee.'</button>';
			$productFinishBtn .= '</div>';
	    
	    }
	    
		$html .= '<div class="text-center hidden" id="wowq-woocommerce-billing">';
	    $html .= '<h2>';
	    $html .= 'Billing Information';
	    $html .= '</h2>';
		
	    $html .= '<form id="wowq-woo-billing-form" class="form-horizontal maonster-form">';
	    
	    $html .= '<div class="form-group">';
		$html .= '<div class="col-sm-6">';
		$html .= '<input class="form-control required maonster-name" type="text" name="qWoo[billing][fname]" value="" placeholder="First Name">';
		$html .= '</div>';
		$html .= '<div class="col-sm-6">';
		$html .= '<input class="form-control required maonster-name" type="text" name="qWoo[billing][lname]" value="" placeholder="Last Name">';
		$html .= '</div></div>';
		
	    $html .= '<div class="form-group">';
		$html .= '<div class="col-sm-12">';
		$html .= '<input class="form-control required maonster-email" type="email" name="qWoo[billing][email]" value="" placeholder="Email">';
		$html .= '</div></div>';
		
	    $html .= '<div class="form-group">';
		$html .= '<div class="col-sm-12">';
		$html .= '<input class="form-control required maonster-phone" type="tel" name="qWoo[billing][phone]" value="" placeholder="">';
		$html .= '</div></div>';
		
	    $html .= '<div class="form-group">';
		$html .= '<div class="col-sm-12">';
		$html .= '<input class="form-control required maonster-address" type="text" name="qWoo[billing][address]" value="" placeholder="Address">';
		$html .= '</div></div>';
		
	    $html .= '<div class="form-group">';
		$html .= '<div class="col-sm-6">';
		$html .= '<input class="form-control required" type="text" name="qWoo[billing][city]" value="" placeholder="City">';
		$html .= '</div>';
		$html .= '<div class="col-sm-6">';
		$html .= '<input class="form-control required" type="text" name="qWoo[billing][postcode]" value="" placeholder="Post Code">';
		$html .= '</div></div>';
		
	    $html .= '<div class="form-group">';
		$html .= '<div class="col-sm-6">';
		$html .= '<select class="form-control required wooCountryBilling" name="qWoo[billing][country]">';
		
		$html .= '<option value="" >CHOOSE COUNTRY</option>';
		
		foreach ($data['wooCountries'] as $countries) {
			if (in_array($countries['code'], $stripeValidCountries)) {
				$html .= '<option value="'.$countries['code'].'"> ' .$countries['name']. '</option>';
			}
		}
		
		$html .= '</select>';
		$html .= '</div>';
		$html .= '<div class="col-sm-6">';
		$html .= '<select class="form-control required wooStateBilling" name="qWoo[billing][state]">';
		$html .= '<option value="" >CHOOSE STATE</option>';
		$html .= '</select>';
		$html .= '</div></div>';
		
	    $html .= '<div class="form-group">';
		$html .= '<label class="col-sm-12 text-left">';
		$html .= '<input class="form-control" type="checkbox" name="qWoo[shippingOther]" value="" >';
		$html .= ' Ship to a different address?</label>';
		$html .= '</div>';
		
		
	    $html .= '<div id="wowq-woo-shipping" class="hidden">';
	    
	    $html .= '<h2>';
	    $html .= 'Shipping Information';
	    $html .= '</h2>';
		
	    $html .= '<div class="form-group">';
		$html .= '<div class="col-sm-6">';
		$html .= '<input class="form-control maonster-name" type="text" name="qWoo[shipping][fname]" value="" placeholder="First Name">';
		$html .= '</div>';
		$html .= '<div class="col-sm-6">';
		$html .= '<input class="form-control maonster-name" type="text" name="qWoo[shipping][lname]" value="" placeholder="Last Name">';
		$html .= '</div></div>';
		
	    $html .= '<div class="form-group">';
		$html .= '<div class="col-sm-12">';
		$html .= '<input class="form-control maonster-address" type="text" name="qWoo[shipping][address]" value="" placeholder="Address">';
		$html .= '</div></div>';
		
	    $html .= '<div class="form-group">';
		$html .= '<div class="col-sm-6">';
		$html .= '<select class="form-control wooCountryShipping" name="qWoo[shipping][country]">';
		
		$html .= '<option value="" >CHOOSE COUNTRY</option>';
		
		foreach ($data['wooCountries'] as $countries) {
			if (in_array($countries['code'], $stripeValidCountries)) {
				$html .= '<option value="'.$countries['code'].'"> ' .$countries['name']. '</option>';
			}
		}
		
		$html .= '</select>';
		$html .= '</div>';
		$html .= '<div class="col-sm-6">';
		$html .= '<select class="form-control wooStateShipping" name="qWoo[shipping][state]">';
		$html .= '<option value="" >CHOOSE STATE</option>';
		$html .= '</select>';
		$html .= '</div></div>';
		
	    $html .= '<div class="form-group">';
		$html .= '<div class="col-sm-6">';
		$html .= '<input class="form-control" type="text" name="qWoo[shipping][city]" value="" placeholder="City">';
		$html .= '</div>';
		$html .= '<div class="col-sm-6">';
		$html .= '<input class="form-control" type="text" name="qWoo[shipping][postcode]" value="" placeholder="Post Code">';
		$html .= '</div></div>';
		
		$html .= '</div>';
		
		$html .= $productFinishBtn;
		
		$html .= '<div id="wowq-order-progress" class="progress hidden">';
		$html .= '<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">';
		$html .= '<span class="progress-text">0%</span>';
		$html .= '</div>';
		$html .= '</div>';
		
		$html .= '</form></div>';
		
		
	    $html .= '<div id="wowq-woo-payment" class="hidden">';
		$html .= '</div>';
		
		$html .= '</div>';
		
		return $html;
	}
    
    private function findNameType($questions) {
	   foreach($questions as $key => $question) {
	      if ( $question->type === 'name' )
	         return true;
	   }
	   return false;
	}
	
	//- @since 1.3.0
    private function populateGDPRData($options) {
	    $html = '';
	    $html .= '<div data-step="step-gdpr" class="step">';
		foreach ($options as $i => $option) {
			foreach ($option->questions as $key => $question) {
				$name = 'page['.$i.'][question]['.$key.']';
				$html .= '<div data-type="gdpr" class="form-group text-center question">';
				$html .= '<label class="text-left col-xs-12">';
				$html .= $question->title;
				$html .= '</label>';
				$html .= '<div class="form-group">';
				$html .= '<input data-type="gdpr" type="text" class="form-control required maonster-email" name="'.$name.'[email]" placeholder="'.$question->email.'">';
				$html .= '</div>';
				
			    $html .= '<button type="button" class="gdprSubmit next btn btn-success">SUBMIT</button>';
				$html .= '</div>';
			}
		}
				
		$html .= '</div>';
		
		return $html;
	}
    
    private function populateData($options) {
	    $html = '';
		$result = array();
		
		foreach ($options as $i => $option) {
			$page = $i + 1;
			$hidden = ($i == 0) ? '' : 'hidden';
			$hasYaN = 0;
			$hasHNS = 0;
			
			$yAnPos = 0;
			$hNsPos = 0;
			foreach ($option->questions as $key => $question) {
				if ($question->type == 'yesorno') {
					$hasYaN++;
					$yAnPos = $key;
				}
				else if ($question->type == 'satisfaction') {
					$hasHNS++;
					$hNsPos = $key;
				}
			}
			
			if ($this->findNameType($option->questions)) {
				$html .= '<div data-step="step-name" class="'.$hidden.' step">';
			}
			else {
				$html .= '<div data-step="step-'.$page.'" class="'.$hidden.' step">';
			}
			
			//- check type of question(s)
			$qCnt = count($option->questions);
			foreach ($option->questions as $key => $question) {
				$name = 'page['.$i.'][question]['.$key.']';
				switch($question->type) {
					case "yesorno":
						$html .= $this->createQYN($question,$name,$hasYaN,$yAnPos,$hasHNS,$qCnt);
					break;
					case "text":
						$html .= $this->createQText($question,$name);
					break;
					case "textarea":
						$html .= $this->createQTextarea($question,$name);
					break;
					case "list":
						$html .= $this->createQList($question,$name);
					break;
					case "dropdown":
						$html .= $this->createQDropdown($question,$name);
					break;
					case "name":
						$html .= $this->createQName($question,$name);
					break;
					case "satisfaction":
						$html .= $this->createQSatisfaction($question,$name,$hasHNS,$hNsPos,$hasYaN,$qCnt);
					break;
				}
			}
			
			//- check if has yes and no question. if not, add next button
			if ( ($hasYaN <= 0 && $hasHNS <= 0) || ($hasYaN > 1 || $hasHNS > 1) ) {
				$html .= '<div class="form-group">';
				$html .= '<button type="button" class="next btn btn-success">NEXT</button>';
				$html .= '</div>';
			}
			else if ( ($hasYaN == 1 && $yAnPos == 0 && $qCnt > 1) || ($hasHNS == 1 && $hNsPos == 0 && $qCnt > 1) ) {
				$html .= '<div class="form-group">';
				$html .= '<button type="button" class="next btn btn-success">NEXT</button>';
				$html .= '</div>';
			}
			
			$html .= '</div>';
		}
		
		return $html;
    }
    

    private function createQYN ($data, $name, $yans, $yansPos, $hns, $qLength) {
	    $isNextBtn = 'next';
		$html = '';
		
		if (($yans > 1) || ($yans == 1 && $yansPos == 0 && $qLength > 1) || ($yans == 1 && $hns == 1) && $qLength > 1) {
			$isNextBtn = '';
		}
		
		$html .= '<div data-type="yesorno" class="form-group text-center question">';
		$html .= '<label class="text-left col-xs-12">';
		$html .= $data->title;
		$html .= '</label>';
		$html .= '<label class="btn btn-default '.$isNextBtn.'">';
		$html .= '<input data-type="yesorno" data-branched="'.$data->branched.'" data-branch="'.$data->yesBranch.'" data-exclude="'.$data->exclude.'" type="radio" class="form-control hidden" name="'.$name.'" value="yes" />Yes</label>';
		$html .= '<label class="btn btn-default '.$isNextBtn.'">';
		$html .= '<input data-type="yesorno" data-branched="'.$data->branched.'" data-branch="'.$data->noBranch.'" data-exclude="'.$data->exclude.'" type="radio" class="form-control hidden" name="'.$name.'" value="no" />No</label>';
		
		if (($yans > 1) || ($yans == 1 && $yansPos == 0 && $qLength > 1) || ($yans == 1 && $hns == 1 && $qLength > 1)) {
			$html .= '<div class="wowqYNVal hidden">'; 
			$html .= '<input class="required" type="hidden" value="" />';
			$html .= '</div>'; 
		}
		
		$html .= '</div>'; 
		
		
		return $html;
	}
	
	private function createQText ($data, $name) {
		
		//- check for validation
		$validation = '';
		switch ($data->validate) {
			case "alpha":
				$validation = 'maonster-name';
			break;
			case "num":
				$validation = 'maonster-number';
			break;
			case "alphanum":
				$validation = 'maonster-alphanum';
			break;
			case "alpha-ns":
				$validation = 'maonster-alpha-nospace';
			break;
			case "num-ns":
				$validation = 'maonster-number-nospace';
			break;
			case "alphanum-ns":
				$validation = 'maonster-alphanum-nospace';
			break;
			case "email":
				$validation = 'maonster-email';
			break;
		}
		
		$html = '';
		
		$html .= '<div data-type="text" class="form-group text-center question">';
		$html .= '<label class="text-left col-xs-12">';
		$html .= $data->title;
		$html .= '</label>';
		$html .= '<input data-type="text" data-branched="'.$data->branched.'" data-branch="'.$data->textBranch.'" data-textcondition="'.$data->textBranchCondition.'" data-textvalue="'.$data->textBranchValue.'" data-exclude="'.$data->exclude.'" type="text" maxlength="20" class="form-control required '.$validation.'" name="'.$name.'" placeholder="">';
		$html .= '</div>'; 
		
		return $html;
	}
	
	private function createQTextarea ($data, $name) {
		
		$html = '';
		
		$html .= '<div data-type="textarea" class="form-group text-center question">';
		$html .= '<label class="text-left col-xs-12">';
		$html .= $data->title;
		$html .= '</label>';
		$html .= '<textarea data-type="textarea" data-branched="'.$data->branched.'" data-branch="'.$data->textareaBranch.'" data-textcondition="'.$data->textareaBranchCondition.'" data-textvalue="'.$data->textareaBranchValue.'" data-exclude="'.$data->exclude.'" class="form-control textarea-count required maonster-address" name="'.$name.'" rows="5" maxlength="140"></textarea>';
		$html .= '<span class="pull-right"><span class="message-count text-success">140</span>/140</span>';
		$html .= '</div>';
		
		return $html;
	}
	
	private function createQList ($data, $name) {
		
		$html = '';
		$multiple = 'no';
		$type = 'radio';
		if ($data->multiple) {
			$multiple = 'yes';
			$type = 'checkbox';
		}
		
		$html .= '<div data-type="list" data-multiple="'.$multiple.'" data-branched="'.$data->branched.'" data-exclude="'.$data->exclude.'" class="form-group text-center question">';
		$html .= '<label class="text-left col-xs-12">';
		$html .= $data->title;
		$html .= '</label>';
		
		foreach ($data->options as $i => $option) {
			$html .= '<div class="radio text-left">';
			$html .= '<label>';
			$isChecked = ($i == 0) ? 'checked' : '';
			$html .= '<input data-type="list" data-branch="'.$option->branch.'" type="'.$type.'" name="'.$name.'" value="'.$i.'" '.$isChecked.'> ' . $option->text;
			$html .= '</label>';
			$html .= '</div>';
		}
		
		$html .= '<input type="hidden" class="multiple-checkbox required" value="0" /> ';
		
		$html .= '</div>';
		
		return $html;
	}
	
	private function createQDropdown ($data, $name) {
		
		$html = '';
		
		$html .= '<div data-type="dropdown" class="form-group text-center question">';
		$html .= '<label class="text-left col-xs-12">';
		$html .= $data->title;
		$html .= '</label>';
		$html .= '<select class="form-control" name="'.$name.'" data-branched="'.$data->branched.'" data-type="dropdown" data-exclude="'.$data->exclude.'">';
		
		foreach ($data->options as $i => $option) {
			$isSelected = ($option->default && $option->default != 0) ? 'selected="selected"' : '';
			//$showInput  = ($option->show && $option->show == 'input') ? 'data-show="input"' : '';
			$html .= '<option data-branch="'.$option->branch.'" value="'.$i.'" '.$isSelected.'> ' . $option->text . '</option>';
		}
		
		$html .= '</select></div>';
		
		return $html;
	}
	
	private function createQName ($data, $name) {
		
		$html = '';
		
		$html .= '<div data-type="name" class="form-group text-center question">';
		$html .= '<label class="text-left col-xs-12">';
		$html .= $data->title;
		$html .= '</label>';
		$html .= '<div class="form-group">';
		$fnameR = ($data->fname->required != 0) ? 'required' : '';
		$html .= '<input data-type="name" data-name="fname" type="text" class="form-control '.$fnameR.' maonster-name" name="'.$name.'[fname]" placeholder="'.$data->fname->text.'">';
		$html .= '</div>';
		$html .= '<div class="form-group">';
		$lnameR = ($data->lname->required != 0) ? 'required' : '';
		$html .= '<input data-type="name" data-name="lname" type="text" class="form-control '.$lnameR.' maonster-name" name="'.$name.'[lname]" placeholder="'.$data->lname->text.'">';
		$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
	
	private function createQSatisfaction ($data, $name, $hns, $hnsPos, $yans, $qLength) {
		$isNextBtn = 'next';
		$html = '';
		
		if (($hns > 1) || ($hns == 1 && $hnsPos == 0 && $qLength > 1) || ($hns == 1 && $yans == 1 && $qLength > 1)) {
			$isNextBtn = '';
		}
		
		$html .= '<div data-type="satisfaction" class="form-group text-center question">';
		$html .= '<label class="text-left col-xs-12">';
		$html .= $data->title;
		$html .= '</label>';
		$html .= '<label class="btn btn-success happy '.$isNextBtn.'">';
		$html .= '<input data-type="satisfaction" data-branched="'.$data->branched.'" data-branch="'.$data->happyBranch.'" data-exclude="'.$data->exclude.'" type="radio" class="form-control hidden" name="'.$name.'" value="happy" /></label>';
		$html .= '<label class="btn btn-default neutral '.$isNextBtn.'">';
		$html .= '<input data-type="satisfaction" data-exclude="'.$data->exclude.'" type="radio" class="form-control hidden" name="'.$name.'" value="neutral" /></label>';
		$html .= '<label class="btn btn-danger sad '.$isNextBtn.'">';
		$html .= '<input data-type="satisfaction" data-branched="'.$data->branched.'" data-branch="'.$data->sadBranch.'" data-exclude="'.$data->exclude.'" type="radio" class="form-control hidden" name="'.$name.'" value="sad" /></label>';
		
		
		$html .= '<div class="form-group text-center satisfaction-text">';
		$html .= '<h2>&nbsp;</h2>';
		$html .= '</div>';
		if (($hns > 1) || ($hns == 1 && $hnsPos == 0 && $qLength > 1) || ($hns == 1 && $yans == 1 && $qLength > 1)) {
			$html .= '<div class="wowqHNSVal hidden">'; 
			$html .= '<input class="required" type="hidden" value="" />';
			$html .= '</div>'; 
		}
		
		$html .= '</div>';
		
		return $html;
	}

}
