<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wowq.io/
 * @since      1.0.0
 *
 * @package    Wow_Questionnaire
 * @subpackage Wow_Questionnaire/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wow_Questionnaire
 * @subpackage Wow_Questionnaire/admin
 * @author     AustraliaWOW! <australiawow@gmail.com>
 */
class Wow_Questionnaire_Admin {

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
	 * @since    1.0.9
	 * @access   private
	 * @var      array    $api_urls    The API URLS of this plugin.
	 */
	public $api_urls = array();
	
	/**
	 * The plugin tabs array.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $plugin_settings_tabs    The plugin tabs array.
	 */
	public $plugin_settings_tabs = array();

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->api_urls['root']= 'https://member.wowq.io/';
		$this->api_urls['api'] = 'https://member.wowq.io/wowapi/';
		
		//- Set the names and number of tabs
		if ( $this->isLicensed() && $this->get_subscription() ) {
			$this->plugin_settings_tabs['questionnaires'] = 'Questionnaires';
			$this->plugin_settings_tabs['gdpr'] = 'GDPR Page';
			$this->plugin_settings_tabs['privacy-policy'] = 'Privacy Policy Page';
		}
		$this->plugin_settings_tabs['settings'] = 'Settings';
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name . '-bootstrap', plugin_dir_url( __DIR__ ) . 'public/vendor/bootstrap/css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-fontawesome', plugin_dir_url( __DIR__ ) . 'public/vendor/font-awesome/css/font-awesome.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-jquery-datatables-bootstrap', plugin_dir_url( __DIR__ ) . 'public/vendor/datatables/css/dataTables.bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-jquery-datatables-responsive', plugin_dir_url( __DIR__ ) . 'public/vendor/datatables/css/responsive.dataTables.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-sweetalert', plugin_dir_url( __DIR__ ) . 'public/vendor/sweetalert2/sweetalert2.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wow-questionnaire-admin.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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
		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script( $this->plugin_name . '-bootstrap', plugin_dir_url( __DIR__ ) . 'public/vendor/bootstrap/js/bootstrap.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-jquery-datatables', plugin_dir_url( __DIR__ ) . 'public/vendor/datatables/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-jquery-datatables-bootstrap', plugin_dir_url( __DIR__ ) . 'public/vendor/datatables/js/dataTables.bootstrap.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-jquery-datatables-responsive', plugin_dir_url( __DIR__ ) . 'public/vendor/datatables/js/dataTables.responsive.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-jquery-sweetalert', plugin_dir_url( __DIR__ ) . 'public/vendor/sweetalert2/sweetalert2.min.js', array( 'jquery' ), $this->version, true );
		
		//- Include public scripts
		wp_enqueue_script( $this->plugin_name . '-detectmobilebrowser', plugin_dir_url( __DIR__ ) . 'public/vendor/detectmobilebrowser.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-maonster-form', plugin_dir_url( __DIR__ ) . 'public/vendor/maonster/maonster.form.min.js', array( 'jquery' ), $this->version, true );
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wow-questionnaire-admin.min.js?v='.time(), array( 'jquery' ), $this->version, true );
		//- Localize script for ajax call
		wp_localize_script( $this->plugin_name, 'admin_urls' , array( 
			'admin_ajax' => admin_url( 'admin-ajax.php'),
			'ajax_nonce' => wp_create_nonce( 'wow-ajax-nonce' )
		) );
		
		//- Enqueue media uploader
		if ( !did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

	}
	
	/**
	 * Register the Settings page.
	 *
	 * @since    1.1.5
	 */
	public function wowq_admin_menu() {

		 //add_options_page( __('WOW!QUESTIONNAIRE', $this->plugin_name), __('WOW!Q', $this->plugin_name), 'manage_options', $this->plugin_name, array($this, 'display_plugin_admin_page'));
		 add_menu_page(
	        __( 'WOW!Q', $this->plugin_name ),
	        __( 'WOW!Q', $this->plugin_name ),
	        'manage_options',
	        $this->plugin_name,
	        array($this, 'display_plugin_admin_page'),
	        'data:image/png;base64,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',
	        90
	    );
	    
	    add_submenu_page(
	        $this->plugin_name,
	        __( 'Settings', $this->plugin_name ),
	        __( 'Settings', $this->plugin_name ),
	        'manage_options',
	        $this->plugin_name,
	        array($this, 'display_plugin_admin_page')
	    );
	    
		foreach ( $this->plugin_settings_tabs as $tab_key => $tab_caption ) {
			if ($tab_key != 'settings') {
			    add_submenu_page(
			        $this->plugin_name,
			        __( $tab_caption, $this->plugin_name ),
			        __( $tab_caption, $this->plugin_name ),
			        'manage_options',
			        $this->plugin_name."-".$tab_key,
					array($this, 'display_plugin_admin_page')
			    );
		    }
	    }

	}
	
	/**
	 * CSS STYLE FOR WOW!Q DASHBOARD ICON
	 *
	 * @since 		1.3.0
	 */
	public function wowq_admin_menu_icon_css () {
		$dashboard_css  = '<style>';
		
		$dashboard_css .= '#toplevel_page_wow-questionnaire .dashicons-before img {';
		$dashboard_css .= 'padding-top: 4px;';
		$dashboard_css .= 'width: 25px;';
		$dashboard_css .= '}';
		
		$dashboard_css .= '<style>';
		echo $dashboard_css;
	}
	
	/**
	 * Settings - Validates saved options
	 *
	 * @since 		1.0.0
	 * @param 		array 		$input 			array of submitted plugin options
	 * @return 		array 						array of validated plugin options
	 */
	public function settings_sanitize( $input ) {

		// Initialize the new array that will hold the sanitize values
		$new_input = array();

		if(isset($input)) {
			// Loop through the input and sanitize each of the values
			foreach ( $input as $key => $val ) {

				if($key == 'post-type') { // dont sanitize array
					$new_input[ $key ] = $val;
				} else {
					$new_input[ $key ] = sanitize_text_field( $val );
				}
				
			}
			
			$message = '';
		}
		else {
			
		}

		//- Admin notice
		//add_settings_error('my_option_notice', 'my_option_notice', json_encode($input), 'updated');
		return $new_input;

	} // sanitize()
	
	/**
	 * Renders Settings Tabs
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	function wowq_render_tabs() {
		$current_tab = isset( $_GET['page'] ) ? $_GET['page'] : $this->plugin_name;
		screen_icon();
		echo '<h2 class="nav-tab-wrapper">';
		
		foreach ( $this->plugin_settings_tabs as $tab_key => $tab_caption ) {
			$this_tab = $this->plugin_name.'-'.$tab_key;
			if ($tab_key == 'questionnaires') {
				if ($this->isLicensed()) {
					$this->add_gdpr_page();
					
					$options = get_option( $this->plugin_name . '_settings_options' );
					$active  = $current_tab == $this_tab ? 'nav-tab-active' : '';
					echo '<a class="nav-tab ' . $active . '" href="?page=' . $this_tab . '">' . $tab_caption . '</a>';	
				}
			}
			else {
				if ($tab_key == 'settings') $this_tab = $this->plugin_name;
				$active = $current_tab == $this_tab ? 'nav-tab-active' : '';
				echo '<a class="nav-tab ' . $active . '" href="?page=' . $this_tab . '">' . $tab_caption . '</a>';	
			}
		}
		echo '</h2>';
	}

	/**
	 * Plugin Settings Link on plugin page
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	function add_settings_link( $links ) {

		$mylinks = array(
			'<a href="' . admin_url( 'options-general.php?page='.$this->plugin_name ) . '">Settings</a>',
		);
		return array_merge( $links, $mylinks );
	}


	/**
	 * Callback function for the admin settings page.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page(){	

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wow-questionnaire-admin-display.php';
	}
	
	/**
	 * Callback function for removing default admin styles.
	 *
	 * @since    1.0.0
	 */
	public function remove_default_stylesheets() {
	    wp_deregister_style('wp-admin');
	}
	
	//- ADD GDPR PAGE
	//- @since 1.3.0
	public function add_gdpr_page () {
		$gdpr = 'wow-questionnaire_gdpr_options';
		$gdpr_options = get_option($gdpr);
		
		$postData = array(
	    	'post_title'  => 'GDPR Preference User Centre',
	    	'post_content'=> '',
	    	'post_type'   => 'page',
	    	'post_status' => 'publish'
    	);
	    	
		if ( empty( $gdpr_options['wowq-gdprPage'] ) ) {
			delete_option($gdpr);
	    	$post_id = wp_insert_post($postData);
			$option = array(
				'wowq-gdprPage' => $post_id
			);
			add_option($gdpr,$option);
		}
		else if ( FALSE === get_post_status( $gdpr_options['wowq-gdprPage'] ) || 
				  get_the_title($gdpr_options['wowq-gdprPage']) !== $postData['post_title'] ) {
					  
	    	$post_id = wp_insert_post($postData);
	    	$gdpr_options['wowq-gdprPage'] = $post_id;
			update_option($gdpr,$gdpr_options);
			
		}
	}
	
	//- ADD PRIVACY POLICY PAGE
	//- @since 1.3.7
/*
	public function add_gdpr_page () {
		$gdpr = 'wow-questionnaire_gdpr_options';
		$gdpr_options = get_option($gdpr);
		
		$postData = array(
	    	'post_title'  => 'GDPR Preference User Centre',
	    	'post_content'=> '',
	    	'post_type'   => 'page',
	    	'post_status' => 'publish'
    	);
	    	
		if ( empty( $gdpr_options['wowq-gdprPage'] ) ) {
			delete_option($gdpr);
	    	$post_id = wp_insert_post($postData);
			$option = array(
				'wowq-gdprPage' => $post_id
			);
			add_option($gdpr,$option);
		}
		else if ( FALSE === get_post_status( $gdpr_options['wowq-gdprPage'] ) || 
				  get_the_title($gdpr_options['wowq-gdprPage']) !== $postData['post_title'] ) {
					  
	    	$post_id = wp_insert_post($postData);
	    	$gdpr_options['wowq-gdprPage'] = $post_id;
			update_option($gdpr,$gdpr_options);
			
		}
	}
*/
	
	/**
	 * Callback function for checking valid API creds.
	 *
	 * @since    1.0.0
	 */
	public function validate_api_key () {
		// Check nounce - security thingy
		$nonce = $_POST['ajax_nonce'];
		
		if ( !wp_verify_nonce( $nonce, 'wow-ajax-nonce' ) ) {
			echo json_encode(array('status' => false, 'error' => 'Busted!'));
		}
		else {
			$wowq_api_key= $_POST['api_key'];
			$wowq_email  = $_POST['email'];
			$wowq_host   = $_POST['host'];
			$wowq_license= $_POST['license_key'];
			
			$data = array(
				'WOWQ-API-KEY' => $wowq_api_key,
				'WOWQ-EMAIL'   => $wowq_email,
				'WOWQ-HOST'    => $wowq_host,
				'WOWQ-LICENSE' => $wowq_license
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
			    $result = $response['body'];
			}
		    
		    echo $result;
	    }
	    exit();
	}
    
    public function isLicensed() {
	    $isLicensed = false;
		$settings_options = get_option('wow-questionnaire_settings_options');
		if ( !empty( $settings_options['wowq-apiKey'] ) &&
			 !empty( $settings_options['wowq-email'] ) &&
			 !empty( $settings_options['wowq-licenseKey'] ) ) {
			 
		    /*
			 * TEST API KEY.
			 */
			$data = array(
				'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
				'WOWQ-EMAIL'   => $settings_options['wowq-email'],
				'WOWQ-LICENSE' => $settings_options['wowq-licenseKey']
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
			$isLicensed = $result->status;
		}
		
		return $isLicensed;
    }
    
    public function get_subscription() {
	    $isLicensed = false;
		$settings_options = get_option('wow-questionnaire_settings_options');
		if ( !empty( $settings_options['wowq-apiKey'] ) &&
			 !empty( $settings_options['wowq-email'] ) &&
			 !empty( $settings_options['wowq-licenseKey'] ) ) {
			 
		    /*
			 * TEST API KEY.
			 */
			$data = array(
				'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
				'WOWQ-EMAIL'   => $settings_options['wowq-email'],
				'WOWQ-LICENSE' => $settings_options['wowq-licenseKey']
			);
			
			$url  = $this->api_urls['api'].'subscription/';
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
			$subscription = $result->status;
		}
		
		return $subscription;
    }
    
    public function wowq_questionnaires () {
    	$result = null;
		$settings_options = get_option('wow-questionnaire_settings_options');
		if ( !empty( $settings_options['wowq-apiKey'] ) &&
			 !empty( $settings_options['wowq-email'] ) ) {
			 
			
			$data = array(
				'WOWQ-API-KEY' => $settings_options['wowq-apiKey'],
				'WOWQ-EMAIL'   => $settings_options['wowq-email'],
				'WOWQ-LICENSE' => $settings_options['wowq-licenseKey']
			);
			
			$url  = $this->api_urls['api'].'questionnaires_get/';
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
		    
		}
		
		return $result;
    }

}
