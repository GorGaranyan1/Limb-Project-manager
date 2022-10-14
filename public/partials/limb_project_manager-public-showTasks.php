<?php
global $wpdb;
if ( isset( $_GET['action'] ) ) {
	$action = $_GET['action'];
	if ( $action == "add_task" ) {
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
	} else {
		$project_id   = ltrim( $action, 'edit' );
		$project      = get_post( $project_id );
		$project_name = get_post_meta( $project->ID, 'title' );
		$project_desc = get_post_meta( $project->ID, 'description' );
		$project_us   = get_post_meta( $project->ID, 'user_id' );
		$project_pr   = get_post_meta( $project->ID, 'project_id' );//
        var_dump($project_name);
		?>
        <form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post">
            <table border="1px" align="center" style="text-align: center">
                <tr>
                    <td>ID</td>
                    <td><input value="<?php echo $project->ID; ?>" name="edit_id" type="text"></td>
                </tr>
                <tr>
                    <td>Title</td>
                    <td><input value="<?php echo esc_html($project_name[0]); ?>" name="edit_title" type="text"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><input value="<?php echo esc_html($project_desc[0]); ?>" name="edit_description" type="text"></td>
                </tr>
                <tr>
                    <td>Project ID</td>
                    <td><input value="<?php echo esc_html($project_pr[0]); ?>" name="edit_project" type="text"></td>
                </tr>
                <tr>
                    <td>User ID</td>
                    <td><input value="<?php echo esc_html($project_us[0]); ?>" name="edit_user" type="text"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Submit" name="edit_data"></td>
                </tr>
            </table>
            <input type="hidden" name="action" value="my_form5">
        </form>
		<?php
	}
}
?>
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
	$limit  = 10;
	$offset = ( $page_number - 1 ) * $limit;
	//			$projects   = $wpdb->get_results( "SELECT id, title, description, us_id, project_id FROM $table_name LIMIT $offset, $limit" );
	$args       = array(
		'post_type'  => 'task',
		'post_title' => 'My Task'
	);
	$table_name = $wpdb->prefix . "posts";
	$projects   = $wpdb->get_results( "SELECT ID FROM $table_name WHERE post_type='task' LIMIT $offset , $limit" );
	$rows       = $wpdb->get_var( "SELECT COUNT(ID) FROM $table_name WHERE post_type='task'" );
	$pages      = ceil( $rows / $limit ) - 1;
	foreach ( $projects as $project ) {
		$task_title = get_post_meta( $project->ID, 'title' );
		$task_desc  = get_post_meta( $project->ID, 'description' );
		$task_pr    = get_post_meta( $project->ID, 'project_id' );
		$task_us    = get_post_meta( $project->ID, 'user_id' );
		echo "<tr class='tableRow' id='project" . $project->ID . "'>
							<td class='id'>". esc_html($project->ID)." </td>
							<td class='id'>". esc_html($task_title[0])."</td>
							<td class='id'>". esc_html($task_desc[0])."</td>
							<td class='id'>". esc_html($task_us[0])."</td>
							<td class='id'>". esc_html($task_pr[0])."</td>
							<td class='id'><a class='inp" . $project->ID . "' href='?action=edit' value='" . $project->ID . "'>Edit</a></td>
						</tr>";
	}
	?>

	<?php
	echo "<tr class='last_row'>";
	echo "<td colspan='6' class='pages'>";
	for ( $i = 0; $i <= $pages; $i ++ ) {
		echo "<a class='page_links' href='?gago=" . ( $i + 1 ) . "'>" . ( $i + 1 ) . "</a>";
	}
	echo "</td></tr>";
	?>
    <tr>
        <td colspan="6">
            <a name="add_task" href="?action=add_task">Add Task</a>
        </td>
    </tr>

</table>

