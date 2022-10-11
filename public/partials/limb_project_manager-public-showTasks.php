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
			$table_name = $wpdb->prefix . 'g_tasks';
			$limit      = 10;
			$offset     = ( $page_number - 1 ) * $limit;
			$rows       = $wpdb->get_var( "SELECT COUNT(ID) FROM $table_name" );
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
            <form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="get">
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
gi