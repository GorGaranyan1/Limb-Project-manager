<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://asdasd
 * @since      1.0.0
 *
 * @package    Limb_project_manager
 * @subpackage Limb_project_manager/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Limb_project_manager
 * @subpackage Limb_project_manager/public
 * @author     asdasdasda <gor.garanyan1859@gmail.com>
 */
class Limb_project_manager_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->editProjects();
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
		 * defined in Limb_project_manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Limb_project_manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/limb_project_manager-public.css', array(), $this->version, 'all' );

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
		 * defined in Limb_project_manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Limb_project_manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/limb_project_manager-public.js', array( 'jquery' ), $this->version, false );

	}

	public function showTasksTable(){
		require_once ('partials/limb_project_manager-public-showTasks.php');
	}
	public function showProjectsTable(){
		require_once ('partials/limb_project_manager-public-showProjects.php');
	}
	public function editProjects(){
		require_once ('partials/limb_project_manager-public-editTasks.php');
	}
	public function editTasks(){
		require_once('partials/limb_project_manager-public-editProjects.php');
	}
}
