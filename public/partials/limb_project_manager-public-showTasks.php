<?php
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
		$pages = ceil( $rows / $limit ) -1;
		foreach ( $projects as $project ) {
			$task_title = get_post_meta( $project->ID, 'title' );
			$task_desc  = get_post_meta( $project->ID, 'description' );
			$task_pr    = get_post_meta( $project->ID, 'project_id' );
			$task_us    = get_post_meta( $project->ID, 'user_id' );
			echo "<tr class='tableRow' id='project" . $project->ID . "'>
							<td class='id'>$project->ID</td>
							<td class='id'>$task_title[0]</td>
							<td class='id'>$task_desc[0]</td>
							<td class='id'>$task_us[0]</td>
							<td class='id'>$task_pr[0]</td>
							<td class='id'><button class='inp" . $project->ID . "' name='edit' value='" . $project->ID . "'>Edit</button></td>
						</tr>";
		}
        ?>

        <form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="get">
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
                    <button name="add_task" value="true">Add Task</button>
                </td>
            </tr>

    </table>

    <input type="hidden" name="action" value="my_form4">
</form>
