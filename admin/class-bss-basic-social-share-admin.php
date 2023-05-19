<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       deligo.pl
 * @since      1.0.0
 *
 * @package    Bss_Basic_Social_Share
 * @subpackage Bss_Basic_Social_Share/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bss_Basic_Social_Share
 * @subpackage Bss_Basic_Social_Share/admin
 * @author     Deligo.pl <slawomir.s@deligo.pl>
 */
class Bss_Basic_Social_Share_Admin {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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
		 * defined in Bss_Basic_Social_Share_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bss_Basic_Social_Share_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bss-basic-social-share-admin.css', array(), $this->version, 'all' );

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
		 * defined in Bss_Basic_Social_Share_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bss_Basic_Social_Share_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bss-basic-social-share-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function add_menu() {
        add_options_page( 'Basic Social Share', 'Basic Social Share', 'manage_options', 'basic-social-share', array($this,'bss_options_page') );

    }

    public function bss_options_page()
    {
        include( plugin_dir_path( __FILE__ ) . 'partials/bss-basic-social-share-settings.php' );
    }

    public function register_settings(){
        register_setting( 'bssSettingsPage', 'bss_settings' );
    }

    public function register_sections()
    {
        add_settings_section(
            'bss_pluginPage_section',
            __( 'Basic Social Share', 'wordpress' ),
            array( $this, 'section_messages' ),
            'bssSettingsPage'
        );
    }

    public function register_fields()
    {

        add_settings_field(
            'bss_share_services',
            __( 'Share Services', 'wordpress' ),
            array($this,'render_url_field'),
            'bssSettingsPage',
            'bss_pluginPage_section'
        );

        add_settings_field(
            'bss_share_stylesheet',
            __( 'Enable plugin stylesheet', 'wordpress' ),
            array($this,'render_css_field'),
            'bssSettingsPage',
            'bss_pluginPage_section'
        );


    }
    public function section_messages()
    {
        include( plugin_dir_path( __FILE__ ) . 'partials/bss-basic-social-share-admin-section-messages.php' );
    }

    public function render_url_field($args)
    {
        include( plugin_dir_path( __FILE__ ) . 'partials/bss-basic-social-share-admin-field-url.php' );

    }
    public function render_css_field($args)
    {
        include( plugin_dir_path( __FILE__ ) . 'partials/bss-basic-social-share-admin-field-css.php' );

    }



}
