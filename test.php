<!-- HTML5 boilerplate -->
<?php 
session_start();
if ( !(isset($_SESSION['coach']) && isset($_POST['wp-day'])) ) {
  header('Location: index.php#sign-in');
}
?>

<?php require 'includes/views/head.php'; ?>
<?php require 'includes/functions-helper.php' ?>
<?php require 'includes/db/functions-db.php' ?>
<?php require 'includes/db/connectdb-imarisha.php'; ?>
<?php 
$wp_day = $_POST['wp-day'];
$prog_id = $_POST['prog-id'];
$db_wp_table = 'workoutplan_'.$prog_id;
$wp_ids_str = $_POST['delete-wp_ids'];
$wp_ids_arr = split_str_to_arr($wp_ids_str);
$insert_count = $_SESSION['insert_count'] = $_POST['insert-count'];
$update_count = $_SESSION['update_count'] = $_POST['update-count'];
$delete_count = $_SESSION['delete_count'] = count($wp_ids_arr);

$exercises_data = getExercises($conn);
$wp_data_day = getWorkoutplan($conn, $prog_id)[$wp_day];

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
<div class="w3-container">
	<div class="w3-tag w3-padding">
		<?php echo "Inserts: $insert_count, Updates: $update_count, Deletes: ".count($wp_ids_arr) ?>
	</div>
	<h1 style="">
		<?php echo "Table $db_wp_table on $wp_day" ?></span>
	</h1>
	
	<h4>Insert</h4>
	<table class="w3-table extable" id="inserts">
		<thead>
			<tr>
				<th>Exercise ID</th>
				<th>Exercise Title</th>
				<th>Exercise Instr</th>
			</tr>
		</thead>
		<tbody>
			<?php for ($i=0; $i < $insert_count; $i++): ?>
				<tr>
					<td class="ex_id"><?php echo $_POST['insert-ex_id-'.$i] ?></td>
					<td class="ex_title"><?php echo $exercises_data[$_POST['insert-ex_id-'.$i]]['ex_title'] ?></td>
					<td class="ex_instr"><?php echo $_POST['insert-ex_instr-'.$i] ?></td>
				</tr>
			<?php endfor ?>
		</tbody>
	</table>
	<?php echo generate_sql_query_insert($db_wp_table, $wp_day, $insert_count); ?>

	<h4>Update</h4>
	<table class="w3-table extable" id="updates">
		<thead>
			<tr>
				<th>Workoutplan ID</th>
				<th>Exercise ID</th>
				<th>Exercise Title</th>
				<th>Exercise Prev Instr</th>
				<th>Exercise New Instr</th>
			</tr>
		</thead>
		<tbody>
			<?php for ($i=0; $i < $update_count; $i++): ?>
				<tr>
					<td class="wp_id">
						<?php echo $_POST['update-wp_id-'.$i] ?>
						</td>
					<td class="ex_id">
						<?php echo $_POST['update-ex_id-'.$i] ?>
					</td>
					<td class="ex_title">
						<?php echo $exercises_data[$_POST['update-ex_id-'.$i]]['ex_title'] ?>
					</td>
					<td class="ex_instr_prev" style="background-color: #fee8e7!important;">
						<?php echo $wp_data_day[$_POST['update-wp_id-'.$i]]['wp_ex_details'] ?>
					</td>
					<td class="ex_instr_new" style="background-color: #e9fce9!important;">
						<?php echo sanitize($_POST['update-ex_instr-'.$i]) ?>
					</td>
				</tr>
			<?php endfor ?>
		</tbody>
	</table>
	<?php echo generate_sql_query_update($db_wp_table, $update_count); ?>

	<h4>Delete</h4>
	<table class="w3-table extable" id="deletes">
		<thead>
			<tr>
				<th>Workoutplan ID</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($wp_ids_arr as $key => $ex): ?>				
				<tr>
					<td class="wp_id"><?php echo $ex ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<?php echo generate_sql_query_delete($db_wp_table, $wp_ids_arr); ?>
</div>


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
		$query_status = array('status_code' => 1, 'status_msg' => "$query_type Successful");
	} else {
		$status_msg = "$query_type Error: " . mysqli_error($conn);
		$query_status = array('status_code' => 0, 'status_msg' => $status_msg);
	}
	return $query_status;
}
?>