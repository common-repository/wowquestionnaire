<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://wowq.io/
 * @since      1.0.0
 *
 * @package    Wow_Questionnaire
 * @subpackage Wow_Questionnaire/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wow_Questionnaire
 * @subpackage Wow_Questionnaire/includes
 * @author     AustraliaWOW! <australiawow@gmail.com>
 */
class Wow_Questionnaire {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wow_Questionnaire_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'wow-questionnaire';
		$this->version = '1.4.1';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wow_Questionnaire_Loader. Orchestrates the hooks of the plugin.
	 * - Wow_Questionnaire_i18n. Defines internationalization functionality.
	 * - Wow_Questionnaire_Admin. Defines all hooks for the admin area.
	 * - Wow_Questionnaire_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wow-questionnaire-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wow-questionnaire-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wow-questionnaire-admin.php';
		
		/**
		 * The class responsible for defining all Settings.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/settings/class-wowq-settings.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/settings/class-wowq-questionnaires.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/settings/class-wowq-gdpr.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/settings/class-wowq-privacy-policy.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wow-questionnaire-public.php';
		

		$this->loader = new Wow_Questionnaire_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wow_Questionnaire_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wow_Questionnaire_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Wow_Questionnaire_Admin( $this->get_plugin_name(), $this->get_version() );
		$settings_init= new Wow_Questionnaire_Settings( $this->get_plugin_name() );
		$settings_questionnaires_init= new Wow_Questionnaire_List( $this->get_plugin_name() );
		$settings_gdpr_init= new Wow_Questionnaire_Gdpr( $this->get_plugin_name() );
		$settings_pp_init= new Wow_Questionnaire_Privacy_Policy( $this->get_plugin_name() );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'wowq_admin_menu' );
		$this->loader->add_action( 'admin_init', $settings_init, 'settings_api_init' );
		$this->loader->add_action( 'admin_init', $settings_questionnaires_init, 'settings_api_init' );
		$this->loader->add_action( 'admin_init', $settings_gdpr_init, 'settings_api_init' );
		$this->loader->add_action( 'admin_init', $settings_pp_init, 'settings_api_init' );
		$this->loader->add_action( 'admin_head', $plugin_admin, 'wowq_admin_menu_icon_css' );
		$this->loader->add_filter( 'plugin_action_links_wow-questionnaire/wow-questionnaire.php', $plugin_admin, 'add_settings_link' );

		//- AJAX CALLS
		$this->loader->add_action('wp_ajax_nopriv_validate_api_key', $plugin_admin, 'validate_api_key');
		$this->loader->add_action('wp_ajax_validate_api_key', $plugin_admin, 'validate_api_key');
		$this->loader->add_action('wp_ajax_nopriv_compatibility_check', $plugin_admin, 'compatibility_check');
		$this->loader->add_action('wp_ajax_compatibility_check', $plugin_admin, 'compatibility_check');
		$this->loader->add_action('wp_ajax_nopriv_save_settings', $plugin_admin, 'save_settings');
		$this->loader->add_action('wp_ajax_save_settings', $plugin_admin, 'save_settings');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @updated  1.3.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Wow_Questionnaire_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_wowqgdprpopup_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_wowqgdprpopup_scripts' );
		
		//- Add shortcode
		$this->loader->add_shortcode( 'wowq', $plugin_public, 'shortcode_wowq' );
		$this->loader->add_shortcode( 'wowq_privacy_policy', $plugin_public, 'shortcode_wowq_privacy_policy' );
		//$this->loader->add_shortcode( 'wowq_privacy_preference', $plugin_public, 'shortcode_wowq_privacy_preference' );
		//- Add GDPR template
		$this->loader->add_filter( 'template_include', $plugin_public, 'gdpr_template', 99 );
		//$this->loader->add_filter( 'template_include', $plugin_public, 'privacy_policy_template', 99 );
		$this->loader->add_filter( 'wp_privacy_personal_data_erasers', $plugin_public, 'register_wowq_eraser', 10);
		$this->loader->add_action( 'wp_privacy_personal_data_erased', $plugin_public, 'wowq_personal_data_erased');
		
		$this->loader->add_action('wp_ajax_nopriv_wowq_questionnaire', $plugin_public, 'wowq_questionnaire');
		$this->loader->add_action('wp_ajax_wowq_questionnaire', $plugin_public, 'wowq_questionnaire');
		$this->loader->add_action('wp_ajax_nopriv_submit_questionnaire', $plugin_public, 'submit_questionnaire');
		$this->loader->add_action('wp_ajax_submit_questionnaire', $plugin_public, 'submit_questionnaire');
		$this->loader->add_action('wp_ajax_nopriv_get_temp_score', $plugin_public, 'get_temp_score');
		$this->loader->add_action('wp_ajax_get_temp_score', $plugin_public, 'get_temp_score');
		$this->loader->add_action('wp_ajax_nopriv_get_wowq_woocommerce_data', $plugin_public, 'get_wowq_woocommerce_data');
		$this->loader->add_action('wp_ajax_get_wowq_woocommerce_data', $plugin_public, 'get_wowq_woocommerce_data');
		$this->loader->add_action('wp_ajax_nopriv_get_wowq_woocommerce_products', $plugin_public, 'get_wowq_woocommerce_products');
		$this->loader->add_action('wp_ajax_get_wowq_woocommerce_products', $plugin_public, 'get_wowq_woocommerce_products');
		$this->loader->add_action('wp_ajax_nopriv_wowq_woo_payment', $plugin_public, 'wowq_woo_payment');
		$this->loader->add_action('wp_ajax_wowq_woo_payment', $plugin_public, 'wowq_woo_payment');
		$this->loader->add_action('wp_ajax_nopriv_wowq_woo_create_order', $plugin_public, 'wowq_woo_create_order');
		$this->loader->add_action('wp_ajax_wowq_woo_create_order', $plugin_public, 'wowq_woo_create_order');
		
		
		$this->loader->add_action('wp_ajax_nopriv_gdpr_request', $plugin_public, 'gdpr_request');
		$this->loader->add_action('wp_ajax_gdpr_request', $plugin_public, 'gdpr_request');
		
		$this->loader->add_action('wp_ajax_nopriv_gdpr_settings', $plugin_public, 'gdpr_settings');
		$this->loader->add_action('wp_ajax_gdpr_settings', $plugin_public, 'gdpr_settings');
		
		$this->loader->add_action('wp_ajax_nopriv_gdpr_verify', $plugin_public, 'gdpr_verify');
		$this->loader->add_action('wp_ajax_gdpr_verify', $plugin_public, 'gdpr_verify');
		
		$this->loader->add_action('wp_ajax_nopriv_get_gdpr_data', $plugin_public, 'get_gdpr_data');
		$this->loader->add_action('wp_ajax_get_gdpr_data', $plugin_public, 'get_gdpr_data');
		
		$this->loader->add_action('wp_ajax_nopriv_get_geoip', $plugin_public, 'get_geoip');
		$this->loader->add_action('wp_ajax_get_geoip', $plugin_public, 'get_geoip');
		
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wow_Questionnaire_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
