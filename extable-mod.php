<?php 
session_start();
if ( !(isset($_SESSION['coach']) && isset($_POST['wp-day'])) ) {
  header('Location: index.php#sign-in');
}
?>

<?php require 'includes/functions-helper.php' ?>
<?php require 'includes/db/functions-db.php' ?>
<?php require 'includes/db/connectdb-imarisha.php'; ?>
<?php 
$wp_day = $_SESSION['wp-day'] = $_POST['wp-day'];
$prog_id = $_POST['prog-id'];

$db_wp_table = 'workoutplan_'.$prog_id;
$wp_ids_str = $_POST['delete-wp_ids'];
$wp_ids_arr = split_str_to_arr($wp_ids_str);

$insert_count = $_SESSION['insert_count'] = $_POST['insert-count'];
$update_count = $_SESSION['update_count'] = $_POST['update-count'];
$delete_count = $_SESSION['delete_count'] = count($wp_ids_arr);

//db access	
if ($insert_count) {
	$sql_insert_wp_ex = generate_sql_query_insert($db_wp_table, $wp_day, $insert_count);
	
	$_SESSION['insert_status'] = execute_sql_query($conn, $sql_insert_wp_ex, 'Insert');
}
if ($update_count) {
	$sql_update_wp_ex = generate_sql_query_update($db_wp_table, $update_count);

	$_SESSION['update_status'] = execute_sql_query($conn, $sql_update_wp_ex, 'Update');
}
if ($delete_count) {
	$sql_delete_wp_ex = generate_sql_query_delete($db_wp_table, $wp_ids_arr);

	$_SESSION['delete_status'] = execute_sql_query($conn, $sql_delete_wp_ex, 'Delete');
}

$_SESSION['changes_submitted'] = true;

mysqli_close($conn);

header('Location: coach-home.php');
?>

<?php 
function split_str_to_arr($string, $split=',')
{
	$arr = array();
	$token = strtok($string, $split);

	while ($token !== false)
	{
	array_push($arr, $token);
	$token = strtok($split);
	}

	return $arr;
}
function generate_sql_query_insert($db_wp_table, $wp_day, $insert_count)
{
	$sql_insert_workoutplan = "INSERT INTO `$db_wp_table` (`wp_day`, `ex_id`, `wp_ex_details`) VALUES";

	for ($i=0; $i < $insert_count; $i++) { 
		$ex_id = $_POST['insert-ex_id-'.$i];
		$ex_instr = sanitize($_POST['insert-ex_instr-'.$i]);

		$sql_insert_workoutplan .= " ('$wp_day', $ex_id, '$ex_instr')";
		$sql_insert_workoutplan .= $i+1 == $insert_count ? ";" : ",";
	}

	return $sql_insert_workoutplan;
}
function generate_sql_query_update($db_wp_table, $update_count)
{
	$sql_update_workoutplan = "";

	for ($i=0; $i < $update_count; $i++) { 
		$wp_id = $_POST['update-wp_id-'.$i];
		$ex_instr = sanitize($_POST['update-ex_instr-'.$i]);

		$sql_update_workoutplan .= "UPDATE `$db_wp_table` SET `wp_ex_details`='$ex_instr' WHERE `wp_id`=$wp_id;
		";
	}

	return $sql_update_workoutplan;
}
function generate_sql_query_delete($db_wp_table, $wp_ids_arr)
{
	$sql_delete_workoutplan = "";

	foreach ($wp_ids_arr as $key => $wp_id) {
		$sql_delete_workoutplan .= "DELETE FROM `$db_wp_table` WHERE `wp_id`=$wp_id; ";
	}

	return $sql_delete_workoutplan;
}
function execute_sql_query($conn, $sql_query, $query_type='Query')
{
	if (mysqli_multi_query($conn, $sql_query)) {
		$status_code = 1;
		switch ($query_type) {
			case 'Insert':
				$status_msg = "Added Successfully";
				break;
			case 'Update':
				$status_msg = "Updated Successfully";
				break;
			case 'Delete':
				$status_msg = "Deleted Successfully";
				break;
			default:
				$status_msg = 'Query Successful';
				break;
		}
	} else {
		$status_code = 0;
		$status_msg = "$query_type Error: " . mysqli_error($conn);
	}

	return array('status_code' => $status_code, 'status_msg' => $status_msg);
}
?>