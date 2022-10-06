<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://asdasd
 * @since             1.0.0
 * @package           Limb_project_manager
 *
 * @wordpress-plugin
 * Plugin Name:       Limb Project manager
 * Plugin URI:        https://localhost
 * Description:       qweqweqweq
 * Version:           1.0.0
 * Author:            asdasdasda
 * Author URI:        https://asdasd
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       limb_project_manager
 * Domain Path:       /languages
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
define( 'LIMB_PROJECT_MANAGER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-limb_project_manager-activator.php
 */
function activate_limb_project_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-limb_project_manager-activator.php';
	Limb_project_manager_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-limb_project_manager-deactivator.php
 */
function deactivate_limb_project_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-limb_project_manager-deactivator.php';
	Limb_project_manager_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_limb_project_manager' );
register_deactivation_hook( __FILE__, 'deactivate_limb_project_manager' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-limb_project_manager.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_limb_project_manager() {

	$plugin = new Limb_project_manager();
	$plugin->run();

}
run_limb_project_manager();
