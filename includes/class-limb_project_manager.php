<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://asdasd
 * @since      1.0.0
 *
 * @package    Limb_project_manager
 * @subpackage Limb_project_manager/includes
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
 * @package    Limb_project_manager
 * @subpackage Limb_project_manager/includes
 * @author     asdasdasda <gor.garanyan1859@gmail.com>
 */
class Limb_project_manager {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Limb_project_manager_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
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
		if ( defined( 'LIMB_PROJECT_MANAGER_VERSION' ) ) {
			$this->version = LIMB_PROJECT_MANAGER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'limb_project_manager';
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_ajax_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Limb_project_manager_Loader. Orchestrates the hooks of the plugin.
	 * - Limb_project_manager_i18n. Defines internationalization functionality.
	 * - Limb_project_manager_Admin. Defines all hooks for the admin area.
	 * - Limb_project_manager_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-limb_project_manager-loader.php';
		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-limb_project_manager-i18n.php';
		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-limb_project_manager-admin.php';
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-limb_project_manager-public.php';
		$this->loader = new Limb_project_manager_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Limb_project_manager_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Limb_project_manager_i18n();
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

		$plugin_admin = new Limb_project_manager_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );


		add_action( 'admin_post_nopriv_my_form2', array( $this, 'udpateProjectsData' ) );
		add_action( 'admin_post_my_form2', array( $this, 'udpateProjectsData' ) );
		add_action( 'admin_post_nopriv_my_form3', array( $this, 'addProjectData' ) );
		add_action( 'admin_post_my_form3', array( $this, 'addProjectData' ) );


		add_action( 'admin_post_nopriv_my_form5', array( $this, 'udpateTaskData' ) );
		add_action( 'admin_post_my_form5', array( $this, 'udpateTaskData' ) );
		add_action( 'admin_post_nopriv_my_form6', array( $this, 'addTaskData' ) );
		add_action( 'admin_post_my_form6', array( $this, 'addTaskData' ) );
		add_action( 'init', array( $this, 'create_posttypes' ) );
	}

	public function create_posttypes() {
		register_post_type( 'projects', array(
			'labels'       => array(
				'name'          => __( 'Projects' ),
				'singular_name' => __( 'Project' )
			),
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'projects' ),
			'show_in_rest' => true,
		) );

		register_post_type('tasks', array(
			'labels'=>array(
				'name'=>__('Tasks'),
				'singular_name'=>__('Task'),
			),
			'public'=>true,
			'has_archive'=>true,
			'rewrite'=>array('slug'=>'tasks'),
			'show_in_rest'=>true,
		));
	}

	public function udpateTaskData() {
		global $wpdb;
		$table_name  = $wpdb->prefix . 'g_tasks';
		$table_name2 = $wpdb->prefix . 'g_tasks_users';
		if ( isset( $_POST['edit_data'] ) ) {
			$id          = $_POST['edit_id'];
			$name        = sanitize_text_field( $_POST['edit_title'] );
			$description = sanitize_text_field( $_POST['edit_description'] );
			$date        = $_POST['edit_project'];
			$user_id     = $_POST['edit_user'];
			$wpdb->update( $table_name2, array( 'task_id' => $id, 'user_id' => $user_id ), array( 'task_id' => $id ) );

			update_post_meta($id, 'title', $name);
			update_post_meta($id, 'description', $description);
			update_post_meta($id, 'project_id', $date);
			update_post_meta($id, 'user_id', $user_id);
			$plugin_public = new Limb_project_manager_Public( $this->get_plugin_name(), $this->get_version() );
			$plugin_public->showTasksTable();
		}
	}

	public function udpateProjectsData() {
		global $wpdb;
		$table_name  = $wpdb->prefix . 'g_projects';
		$table_name2 = $wpdb->prefix . 'g_projects_users';
		if ( isset( $_POST['edit_data'] ) ) {
			$id          = $_POST['edit_id'];
			$name        = sanitize_text_field( $_POST['edit_name'] );
			$description = sanitize_text_field( $_POST['edit_description'] );
			$date        = sanitize_text_field( $_POST['edit_date'] );
			$user_id     = $_POST['edit_user'];
			$wpdb->update( $table_name2, array( 'project_id' => $id, 'user_id' => $user_id ), array( 'project_id' => $id ) );
			update_post_meta($id, 'name', $name);
			update_post_meta($id, 'description', $description);
			update_post_meta($id, 'created_at', $date);
			update_post_meta($id, 'user_id', $user_id);
			$plugin_public = new Limb_project_manager_Public( $this->get_plugin_name(), $this->get_version() );
			$plugin_public->showProjectsTable();
		}
	}

	public function addProjectData() {
		global $wpdb;
		$table_name2 = $wpdb->prefix . 'g_projects_users';
		$table_name  = $wpdb->prefix . 'g_projects';
		if ( isset( $_POST['add_data'] ) ) {
			$id                          = $_POST['add_id'];
			$name                        = sanitize_text_field( $_POST['add_name'] );
			$description                 = sanitize_text_field( $_POST['add_description'] );
			$date                        = sanitize_text_field( $_POST['add_date'] );
			$user_id                     = $_POST['add_user'];
			$my_project                  = array();
			$my_project['post_title']    = 'My Project';
			$my_project['post_content']  = 'This is my project.';
			$my_project['post_author']   = 1;
			$my_project['post_status']   = 'publish';
			$my_project['post_category'] = array( 0 );
			$my_project['post_type']     = 'project';
			$id                          = wp_insert_post( $my_project );
			add_post_meta( $id, 'name', $name );
			add_post_meta( $id, 'description', $description );
			add_post_meta( $id, 'created_at', $date );
			add_post_meta( $id, 'user_id', $user_id );
			$wpdb->insert($table_name2, array('project_id'=>$id, 'user_id'=>$user_id));
			$plugin_public = new Limb_project_manager_Public( $this->get_plugin_name(), $this->get_version() );
			$plugin_public->showProjectsTable();
		}
	}


	public function addTaskData() {
		global $wpdb;
		$table_name2 = $wpdb->prefix . 'g_tasks_users';
		$table_name  = $wpdb->prefix . 'g_tasks';
		if ( isset( $_POST['add_data'] ) ) {
			$id          = $_POST['add_id'];
			$name        = sanitize_text_field( $_POST['add_title'] );
			$description = sanitize_text_field( $_POST['add_description'] );
			$project_id        = $_POST['add_project'];
			$user_id     = $_POST['add_user'];
			$my_project                  = array();
			$my_project['post_title']    = 'My Task';
			$my_project['post_content']  = 'This is my task.';
			$my_project['post_author']   = 1;
			$my_project['post_status']   = 'publish';
			$my_project['post_category'] = array( 0 );
			$my_project['post_type']='task';
			$id                          = wp_insert_post( $my_project );
			add_post_meta( $id, 'title', $name );
			add_post_meta( $id, 'description', $description );
			add_post_meta( $id, 'project_id', $project_id );
			add_post_meta( $id, 'user_id', $user_id );
		}
		$wpdb->insert($table_name2, array('task_id'=>$id, 'user_id'=>$user_id));
		$plugin_public = new Limb_project_manager_Public($this->get_plugin_name(), $this->get_version());
		$plugin_public->showTasksTable();
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {


		$plugin_public = new Limb_project_manager_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		add_shortcode( 'show_tasks', array( $plugin_public, 'showTasksTable' ) );
		add_shortcode( 'show_projects', array( $plugin_public, 'showProjectsTable' ) );
	}

	private function define_ajax_hooks(){
		add_action('wp_head', function(){
			?>
			<script> var ajaxurl = "<?php echo get_admin_url()?>/admin-ajax.php"; </script>
			<?php
		});
		add_action('wp_ajax_my_action', array($this, 'my_action'));
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
	 * @return    string    The name of the plugin.
	 * @since     1.0.0
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function my_action(){
		global $wpdb;
		$arr_ids = $_POST['ids'];
		$arr_names = $_POST['names'];
		$arr_desc = $_POST['descriptions'];
		$arr_users = $_POST['users'];
		$arr_date = $_POST['date'];
		for($i = 0; $i < count($arr_ids) - 1; $i++)
		{
			update_post_meta($arr_ids[$i], 'name', $arr_names[$i]);
			update_post_meta($arr_ids[$i], 'description', $arr_desc[$i]);
			update_post_meta($arr_ids[$i], 'user_id', $arr_users[$i]);
			update_post_meta($arr_ids[$i], 'created_at', $arr_date[$i]);
		}
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    Limb_project_manager_Loader    Orchestrates the hooks of the plugin.
	 * @since     1.0.0
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return    string    The version number of the plugin.
	 * @since     1.0.0
	 */
	public function get_version() {
		return $this->version;
	}

}