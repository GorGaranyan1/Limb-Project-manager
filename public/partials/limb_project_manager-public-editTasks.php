<?php
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