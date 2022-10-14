<?php
/**
 * Fired during plugin activation
 *
 * @link       https://asdasd
 * @since      1.0.0
 *
 * @package    Limb_project_manager
 * @subpackage Limb_project_manager/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Limb_project_manager
 * @subpackage Limb_project_manager/includes
 * @author     asdasdasda <gor.garanyan1859@gmail.com>
 */
class Limb_project_manager_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		// TODO change prefixes from g_ to lpm_
		// TODO change to create if not exists
		// TODO WordPress database error You have an error in your SQL syntax;
		// check the manual that corresponds to your MySQL server version for the right syntax to use near
		// 'wp_g_projects_users'' at line 1 for query
		// SHOW TABLES LIKE 'wp_g_projects_users' made by activate_plugin, do_action('activate_Limb-Project-manager/limb_project_manager.php'), WP_Hook->do_action, WP_Hook->apply_filters, activate_limb_project_manager, Limb_project_manager_Activator::activate
		$db_table_name1 = $wpdb->prefix . 'g_tasks';
		$db_table_name2 = $wpdb->prefix . 'g_projects';
		$db_table_name3 = $wpdb->prefix . 'g_tasks_users';
		$db_table_name4 = $wpdb->prefix . 'g_projects_users';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$db_table_name1'" ) != $db_table_name1
		     && $wpdb->get_var( "SHOW TABLES LIKE '$db_table_name2'" ) != $db_table_name2
		     && $wpdb->get_var( "SHOW TABLES LIKE '$db_table_name3'" ) != $db_table_name3
		     && $wpdb->get_var( "SHOW TABLES LIKE '$db_table_name4'" ) != $db_table_name4 ) {
			$charset_collate = $wpdb->get_charset_collate();
			$sql             = "CREATE TABLE $db_table_name2(
    				id INT(9) NOT NULL AUTO_INCREMENT, 
					name tinytext NOT NULL,
					description text NOT NULL,
					us_id INT(9),
					created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					PRIMARY KEY(id)
                  )	$charset_collate";
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			$wpdb->query($sql);
			$sql = "CREATE TABLE $db_table_name1(
    				id INT(9) NOT NULL AUTO_INCREMENT, 
					title tinytext NOT NULL,
					description text NOT NULL,
					project_id INT(9) NOT NULL,
					us_id INT(9) NOT NULL,
					PRIMARY KEY(id)
                  )	$charset_collate";
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			$wpdb->query($sql);
			$sql = "CREATE TABLE $db_table_name3(
    				task_id INT(9), 
					user_id INT(9)
                  )	$charset_collate";
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			$wpdb->query($sql);
			$sql = "CREATE TABLE $db_table_name4(
    				project_id INT(9), 
					user_id INT(9)
                  )	$charset_collate";
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			$wpdb->query($sql);


		}

	}
}