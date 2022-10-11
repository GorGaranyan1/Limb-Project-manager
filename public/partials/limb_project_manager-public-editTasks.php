<?php
global $wpdb;
$table_name = $wpdb->prefix . 'g_tasks';
if ( isset( $_GET['edit'] ) ) {
	$project_id = $_GET['edit'];
	$project    = get_post($project_id);
	$project_name = get_post_meta($project->ID, 'title');
	$project_desc = get_post_meta($project->ID, 'description');
	$project_us = get_post_meta($project->ID, 'user_id');
	$project_pr = get_post_meta($project->ID, 'project_id');//
//			var_dump($arr);
	?>
    <form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post">
        <table border="1px" align="center" style="text-align: center">
            <tr>
                <td>ID</td>
                <td><input value="<?php echo $project->ID; ?>" name="edit_id" type="text"></td>
            </tr>
            <tr>
                <td>Title</td>
                <td><input value="<?php echo $project_name[0]; ?>" name="edit_title" type="text"></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input value="<?php echo $project_desc[0]; ?>" name="edit_description" type="text"></td>
            </tr>
            <tr>
                <td>Project ID</td>
                <td><input value="<?php echo $project_pr[0]; ?>" name="edit_project" type="text"></td>
            </tr>
            <tr>
                <td>User ID</td>
                <td><input value="<?php echo $project_us[0]; ?>" name="edit_user" type="text"></td>
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