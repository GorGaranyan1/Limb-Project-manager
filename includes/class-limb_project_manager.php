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
		$this->define_public_hooks();
		$this->define_shortcode_hooks();
		$this->define_admin_post_hooks();
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

	private function define_shortcode_hooks() {
		add_shortcode( 'show_projects', array( $this, 'gtp_show_projects_table' ) );
		add_shortcode( 'show_tasks', array( $this, 'gtp_show_tasks_table' ) );
	}

	private function define_admin_post_hooks() {
		add_action( 'admin_post_nopriv_my_form', array( $this, 'gtp_form_action1' ) );
		add_action( 'admin_post_my_form', array( $this, 'gtp_form_action1' ) );
		add_action( 'admin_post_nopriv_my_form2', array( $this, 'gtp_form_action2' ) );
		add_action( 'admin_post_my_form2', array( $this, 'gtp_form_action2' ) );
		add_action( 'admin_post_nopriv_my_form3', array( $this, 'gtp_form_action3' ) );
		add_action( 'admin_post_my_form3', array( $this, 'gtp_form_action3' ) );
		add_action( 'admin_post_nopriv_my_form4', array( $this, 'gtp_form_action4' ) );
		add_action( 'admin_post_my_form4', array( $this, 'gtp_form_action4' ) );
		add_action( 'admin_post_nopriv_my_form5', array( $this, 'gtp_form_action5' ) );
		add_action( 'admin_post_my_form5', array( $this, 'gtp_form_action5' ) );
		add_action( 'admin_post_nopriv_my_form6', array( $this, 'gtp_form_action6' ) );
		add_action( 'admin_post_my_form6', array( $this, 'gtp_form_action6' ) );
        add_action('admin_post_nopriv_my_form7', array($this, 'gtp_form_action7'));
        add_acion('admin_post_my_form7', array($this, 'gtp_form_action7'));
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

	}
    public function gtp_form_action(){

    }

	public function gtp_show_projects_table() {
		global $wpdb;
		?>
        <form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="get">
            <table align="center" class="my_table" border="1px" style="text-align: center">
                <tr>
                    <th>ID</th>
                    <th>Project Name</th>
                    <th>Project Description</th>
                    <th>User ID</th>
                    <th>Created At</th>
                </tr>
				<?php
				if ( ! isset( $_GET['gago'] ) ) {
					$page_number = 1;
				} else {
					$page_number = $_GET['gago'];
				}
				$table_name = $wpdb->prefix . 'g_projects';
				$limit      = 10;
				$offset     = ( $page_number - 1 ) * $limit;
				$rows       = $wpdb->get_var( "SELECT COUNT(ID FROM $table_name" );
				$pages      = ceil( $rows / $limit );
				$projects   = $wpdb->get_results( "SELECT id, name, description, us_id, created_at FROM $table_name LIMIT $offset, $limit" );
				foreach ( $projects as $project ) {
					echo "<tr class='tableRow' id='project" . $project->id . "'>
							<td class='id'>$project->id</td>
							<td class='id'>$project->name</td>
							<td class='id'>$project->description</td>
							<td class='id'>$project->us_id</td>
							<td class='id'>$project->created_at</td>
							<td class='id'><button class='inp" . $project->id . "' name='edit' value='" . $project->id . "'>Edit</button></td>
						</tr>";
				}
                echo "<tr class='last_row'>";
                echo "<td colspan='6' class='pages'>";
				$row_count = $wpdb->get_var( "SELECT COUNT(ID) FROM $table_name" );
				for ( $i = 0; $i < $row_count / 10; $i ++ ) {
					echo "<a class='page_links' href='?gago=" . ( $i + 1 ) . "'>" . ( $i + 1 ) . "</a>";
				}
                        echo "</td></tr>";
                ?>
                <tr>
                    <td colspan="6">
                        <button name="add_pr" value="true">Add Project</button>
                    </td>
                </tr>
            </table>

            <input type="hidden" name="action" value="my_form">
        </form>

		<?php
	}

	public function gtp_show_tasks_table() {
		global $wpdb;
		?>
        <form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="get">
            <table align="center" class="my_table" border="1px" style="text-align: center">
                <tr>
                    <th>ID</th>
                    <th>Task Title</th>
                    <th>Task Description</th>
                    <th>User ID</th>
                    <th>Project ID</th>
                </tr>
	            <?php
	            if ( ! isset( $_GET['gago'] ) ) {
		            $page_number = 1;
	            } else {
		            $page_number = $_GET['gago'];
	            }
				$table_name = $wpdb->prefix . 'g_tasks';
				$limit      = 10;
				$offset     = ( $page_number - 1 ) * $limit;
				$rows       = $wpdb->get_var( "SELECT COUNT(ID FROM $table_name" );
				$pages      = ceil( $rows / $limit );
				$projects   = $wpdb->get_results( "SELECT id, title, description, us_id, project_id FROM $table_name LIMIT $offset, $limit" );
				foreach ( $projects as $project ) {
					echo "<tr class='tableRow' id='project" . $project->id . "'>
							<td class='id'>$project->id</td>
							<td class='id'>$project->title</td>
							<td class='id'>$project->description</td>
							<td class='id'>$project->us_id</td>
							<td class='id'>$project->project_id</td>
							<td class='id'><button class='inp" . $project->id . "' name='edit' value='" . $project->id . "'>Edit</button></td>
						</tr>";
				}
                ?>
                <form action="<?php echo admin_url('admin-post.php'); ?>" method="get">
                <?php
				echo "<tr class='last_row'>";
				echo "<td colspan='6' class='pages'>";
                $row_count = $wpdb->get_var( "SELECT COUNT(ID) FROM $table_name" );
                for ( $i = 0; $i < $row_count / 10; $i ++ ) {
	                echo "<a class='page_links' href='?gago=" . ( $i + 1 ) . "'>" . ( $i + 1 ) . "</a>";
                }
				echo "</td></tr>";
				?>
                <tr>
                    <td colspan="6">
                        <button name="add_task" value="true">Add Task</button>
                    </td>
                </tr>

            </table>

            <input type="hidden" name="action" value="my_form4">
        </form>

		<?php
	}

	public function gtp_form_action1() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'g_projects';
		if ( isset( $_GET['edit'] ) ) {
			$project_id = $_GET['edit'];
			$project    = $wpdb->get_results( "SELECT * FROM $table_name WHERE id=$project_id" );
			$arr        = $project[0];
//
//			var_dump($arr);
			?>
            <form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post">
                <table border="1px" align="center" style="text-align: center">
                    <tr>
                        <td>ID</td>
                        <td><input value="<?php echo $arr->id; ?>" name="edit_id" type="text"></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><input value="<?php echo $arr->name; ?>" name="edit_name" type="text"></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><input value="<?php echo $arr->description; ?>" name="edit_description" type="text"></td>
                    </tr>
                    <tr>
                        <td>Created At</td>
                        <td><input value="<?php echo $arr->created_at; ?>" name="edit_date" type="text"></td>
                    </tr>
                    <tr>
                        <td>User ID</td>
                        <td><input value="<?php echo $arr->us_id; ?>" name="edit_user" type="text"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Submit" name="edit_data"></td>
                    </tr>
                </table>
                <input type="hidden" name="action" value="my_form2">
            </form>
			<?php
		}
		if ( isset( $_GET['add_pr'] ) ) {
			?>
            <form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post">
                <table border="1px" align="center" style="text-align: center">
                    <td>ID</td>
                    <td><input name="add_id" type="text"></td>
                    <tr>
                        <td>Name</td>
                        <td><input name="add_name" type="text"></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><input name="add_description" type="text"></td>
                    </tr>
                    <tr>
                        <td>Created At</td>
                        <td><input name="add_date" type="text"></td>
                    </tr>
                    <tr>
                        <td>User ID</td>
                        <td><input name="add_user" type="text"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Add Project" name="add_data"></td>
                    </tr>
                </table>
                <input type="hidden" name="action" value="my_form3">
            </form>
			<?php
		}
	}

	public function gtp_form_action4() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'g_tasks';
		if ( isset( $_GET['edit'] ) ) {
			$project_id = $_GET['edit'];
			$project    = $wpdb->get_results( "SELECT * FROM $table_name WHERE id=$project_id" );
			$arr        = $project[0];
//
//			var_dump($arr);
			?>
            <form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post">
                <table border="1px" align="center" style="text-align: center">
                    <tr>
                        <td>ID</td>
                        <td><input value="<?php echo $arr->id; ?>" name="edit_id" type="text"></td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td><input value="<?php echo $arr->title; ?>" name="edit_title" type="text"></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><input value="<?php echo $arr->description; ?>" name="edit_description" type="text"></td>
                    </tr>
                    <tr>
                        <td>Project ID</td>
                        <td><input value="<?php echo $arr->project_id; ?>" name="edit_project" type="text"></td>
                    </tr>
                    <tr>
                        <td>User ID</td>
                        <td><input value="<?php echo $arr->us_id; ?>" name="edit_user" type="text"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Submit" name="edit_data"></td>
                    </tr>
                </table>
                <input type="hidden" name="action" value="my_form5">
            </form>
			<?php
		}
		if ( isset( $_GET['add_task'] ) ) {
			?>
            <form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post">
                <table border="1px" align="center" style="text-align: center">
                    <td>ID</td>
                    <td><input name="add_id" type="text"></td>
                    <tr>
                        <td>Title</td>
                        <td><input name="add_title" type="text"></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><input name="add_description" type="text"></td>
                    </tr>
                    <tr>
                        <td>Project</td>
                        <td><input name="add_project" type="text"></td>
                    </tr>
                    <tr>
                        <td>User ID</td>
                        <td><input name="add_user" type="text"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Add Task" name="add_data"></td>
                    </tr>
                </table>
                <input type="hidden" name="action" value="my_form6">
            </form>
			<?php
		}
	}

	public function gtp_form_action5() {
		global $wpdb;
		$table_name  = $wpdb->prefix . 'g_tasks';
		$table_name2 = $wpdb->prefix . 'g_tasks_users';
		if ( isset( $_POST['edit_data'] ) ) {
			$id          = $_POST['edit_id'];
            $name = sanitize_text_field($_POST['edit_title']);
			$description = sanitize_text_field($_POST['edit_description']);
			$date        = $_POST['edit_project'];
			$user_id     = $_POST['edit_user'];
			$wpdb->update( $table_name, array( 'id' => $id, 'title' => $name, 'description' => $description, 'project_id' => $date, 'us_id' => $user_id ), array( 'id' => $id ) );
			$wpdb->update( $table_name2, array( 'task_id' => $id, 'user_id' => $user_id ), array( 'task_id' => $id ) );
			$this->gtp_show_tasks_table();
		}
	}

	public function gtp_form_action2() {
		global $wpdb;
		$table_name  = $wpdb->prefix . 'g_projects';
		$table_name2 = $wpdb->prefix . 'g_projects_users';
		if ( isset( $_POST['edit_data'] ) ) {
			$id          = $_POST['edit_id'];
			$name        = sanitize_text_field($_POST['edit_name']);
			$description = sanitize_text_field($_POST['edit_description']);
			$date        = sanitize_text_field($_POST['edit_date']);
			$user_id     = $_POST['edit_user'];
			$wpdb->update( $table_name, array( 'id' => $id, 'name' => $name, 'description' => $description, 'created_at' => $date, 'us_id' => $user_id ), array( 'id' => $id ) );
			$wpdb->update( $table_name2, array( 'project_id' => $id, 'user_id' => $user_id ), array( 'project_id' => $id ) );
			$this->gtp_show_projects_table();
		}
	}

	public function gtp_form_action3() {
		global $wpdb;
		$table_name2 = $wpdb->prefix . 'g_projects_users';
		$table_name  = $wpdb->prefix . 'g_projects';
		if ( isset( $_POST['add_data'] ) ) {
			$id          = $_POST['add_id'];
			$name        = sanitize_text_field($_POST['add_name']);
			$description = sanitize_text_field($_POST['add_description']);
			$date        = sanitize_text_field($_POST['add_date']);
			$user_id     = $_POST['add_user'];
			$wpdb->insert( $table_name, array( 'id' => $id, 'name' => $name, 'description' => $description, 'created_at' => $date, 'us_id' => $user_id ) );
			$wpdb->insert( $table_name2, array( 'project_id' => $id, 'user_id' => $user_id ) );
		}
		$this->gtp_show_projects_table();
	}

	public function gtp_form_action6() {
		global $wpdb;
		$table_name2 = $wpdb->prefix . 'g_tasks_users';
		$table_name  = $wpdb->prefix . 'g_tasks';
		if ( isset( $_POST['add_data'] ) ) {
			$id          = $_POST['add_id'];
			$name        = sanitize_text_field($_POST['add_title']);
			$description = sanitize_text_field($_POST['add_description']);
			$date        = $_POST['add_project'];
			$user_id     = $_POST['add_user'];
			$wpdb->insert( $table_name, array( 'id' => $id, 'title' => $name, 'description' => $description, 'project_id' => $date, 'us_id' => $user_id ) );
			$wpdb->insert( $table_name2, array( 'task_id' => $id, 'user_id' => $user_id ) );
		}
		$this->gtp_show_tasks_table();
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
