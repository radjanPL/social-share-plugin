<?php

/**
 * The plugin bootstrap file
 * @package           Bss_Basic_Social_Share
 *
 * @wordpress-plugin
 * Plugin Name:       Basic Social Share
 * Description:       Basic Social Share
 * Version:           1.1.0
 * Author:            RadJan / Deligo.pl
 * Author URI:        deligo.pl
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BSS_BASIC_SOCIAL_SHARE_VERSION', '1.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bss-basic-social-share-activator.php
 */
function activate_bss_basic_social_share() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bss-basic-social-share-activator.php';
	Bss_Basic_Social_Share_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bss-basic-social-share-deactivator.php
 */
function deactivate_bss_basic_social_share() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bss-basic-social-share-deactivator.php';
	Bss_Basic_Social_Share_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bss_basic_social_share' );
register_deactivation_hook( __FILE__, 'deactivate_bss_basic_social_share' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bss-basic-social-share.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bss_basic_social_share() {

	$plugin = new Bss_Basic_Social_Share();
	$plugin->run();

}
run_bss_basic_social_share();
