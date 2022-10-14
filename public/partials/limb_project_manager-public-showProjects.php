<?php
global $wpdb;
if ( isset( $_GET['action'] ) ) {
	$action = $_GET['action'];
	if ( $action == 'add_pr' ) {
		?>
        <form action="<?php admin_url( 'admin-post.php' ); ?>" method="post">
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
	} else {
		$project_id   = ltrim( $action, 'edit' );
		$project      = get_post( $project_id );
		$project_name = get_post_meta( $project->ID, 'name' );
		$project_desc = get_post_meta( $project->ID, 'description' );
		$project_date = get_post_meta( $project->ID, 'created_at' );
        $project_us   = get_post_meta( $project->ID, 'user_id' );
		?>

        <form action="<?php echo admin_url( 'admin-post.php' ) ?>" method="post">
            <table border="1px" align="center" style="text-align: center">
                <tr>
                    <td>ID</td>
                    <td><input value="<?php echo esc_html($project->ID); ?>" name="edit_id" type="text"></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <!-- sanitization -->
                    <td><input value="<?php echo esc_html($project_name[0]) ?>" name="edit_name" type="text"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><input value="<?php echo esc_html($project_desc[0]) ?>" name="edit_description" type="text"></td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td><input value="<?php echo esc_html($project_date[0]) ?>" name="edit_date" type="text"></td>
                </tr>
                <tr>
                    <td>User ID</td>
                    <td><input value="<?php echo esc_html($project_us[0]) ?>" name="edit_user" type="text"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Submit" name="edit_data"></td>
                </tr>
            </table>
            <input type="hidden" name="action" value="my_form2">
        </form>
		<?php
	}
}
?>
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
		$str        = "";
		$str_names = "";
		$str_desc = "";
        $str_users  = "";
        $str_date = "";
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
			echo "<tr class='tableRow' id='project" . esc_html($project->ID) . "'>
							<td id='lpm_tableItem'>".esc_html($project->ID)."</td>
							<td id='lpm_tableItem' class='inpp'>".esc_html($project_name[0])."<input type='text' class='inp' id='name".$project->ID."' name='pr_name".$project->ID."' value='".esc_html($project_name[0])
                 ."'></td>
							<td id='lpm_tableItem' class='inpp'>".esc_html($project_desc[0])."<input type='text' class='inp' id='desc".$project->ID."' name='pr_desc".$project->ID."' value='".esc_html($project_desc[0])
                 ."'></td>
							<td id='lpm_tableItem' class='inpp'>".esc_html($project_us[0])."<input type='text' class='inp' id='user_id".$project->ID."' name='pr_user".$project->ID."' value='".esc_html($project_us[0])."'></td>
							<td id='lpm_tableItem' class='inpp'>".esc_html($project_date[0])."<input type='text' class='inp' id='date".$project->ID."' name='pr_date".$project->ID."' value='".esc_html($project_date[0])
                 ."'></td>
							<td class='id'><a href='?action=edit" . esc_html($project->ID) . "'>Edit</a></td>
						</tr>";
            $str.=$project->ID."**";
            $str_names.=$project_name[0]."**";
			$str_desc.=$project_desc[0]."**";
			$str_users.=$project_us[0]."**";
			$str_date.=$project_date[0]."**";
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
                <!-- TODO remove form instead add a link to go to add project view -->
                <a href="?action=add_pr">Add Project</a>
            </td>
        </tr>
        <tr><td colspan="6"><button id="ajax_btn">Ajax Save</button></td></tr>
        <?php
        echo "<input type='hidden' id='hidden_ids' value='" . $str . "' name='ids'>";
        echo "<input type='hidden' id='hidden_names' value='" . $str_names . "' name='names'>";
        echo "<input type='hidden' id='hidden_desc' value='" . $str_desc . "' name='descriptions'>";
        echo "<input type='hidden' id='hidden_users' value='" . $str_users . "' name='users'>";
        echo "<input type='hidden' id='hidden_date' value='" . $str_date . "' name='date'>";
        ?>
    </table>
<?php
