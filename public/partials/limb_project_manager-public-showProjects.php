<?php
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
		$table_name = $wpdb->prefix . 'posts';
		$limit      = 10;
		$offset     = ( $page_number - 1 ) * $limit;
		$rows       = $wpdb->get_var( "SELECT COUNT(ID) FROM $table_name WHERE post_type='project' AND post_title='My Project'" );
		$pages      = ceil( $rows / $limit );
		$args = array(
            'post_type'=>'project',
            'post_title'=>'My Project'
        );

		$projects   = $wpdb->get_results( "SELECT ID FROM $table_name WHERE post_type='project' AND post_title='My Project' LIMIT $offset , $limit" );
        foreach ( $projects as $project ) {
            $project_name = get_post_meta($project->ID, 'name');
	        $project_desc = get_post_meta($project->ID, 'description');
	        $project_us = get_post_meta($project->ID, 'user_id');
	        $project_date = get_post_meta($project->ID, 'created_at');
			echo "<tr class='tableRow' id='project" . $project->ID . "'>
							<td class='id'>$project->ID</td>
							<td class='id'>$project_name[0]</td>
							<td class='id'>$project_desc[0]</td>
							<td class='id'>$project_us[0]</td>
							<td class='id'>$project_date[0]</td>
							<td class='id'><button class='inp" . $project->ID . "' name='edit_pr' value='" . $project->ID . "'>Edit</button></td>
						</tr>";
		}
		echo "<tr class='last_row'>";
		echo "<td colspan='6' class='pages'>";
		$row_count = $wpdb->get_var( "SELECT COUNT(ID) FROM $table_name" );
		for ( $i = 0; $i <$pages; $i ++ ) {
			echo "<a style='margin: 2px' class='page_links' href='?gago=" . ( $i + 1 ) . "'>" . ( $i + 1 ) . "</a>";
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


