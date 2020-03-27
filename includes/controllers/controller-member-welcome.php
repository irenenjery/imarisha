<?php require 'includes/functions-helper.php' ?>
<?php 
session_start();
if ( !isset($_SESSION['client']) ) {
  header('Location: index.php#sign-in');
}

$client = $_SESSION['client'];
$id = $client['client_id'];
$username = $client['client_username'];
$dob = $client['client_dob'];
$gender = $client['client_gender'];
$exp = $client['client_exp'];

if ( !is_null($dob) && !is_null($gender) && !is_null($exp) ) {
  redirect('member-home.php', 'user='.$username);
}
date_default_timezone_set("Africa/Nairobi");
$prog_id = $client['client_prog_id'];
$start_str = $client['sub_startdate'];
$start_date = date_create($start_str);
$end_str = $client['sub_enddate'];
$end_date = date_create($end_str);
$sub_active = strtotime("now") < strtotime($end_str);
$sub_startdate = format_sqldate($start_str);
$sub_enddate = format_sqldate($end_str);

$today = get_today();
?>

<?php if ( isset($_POST['gender']) && isset($_POST['dob']) && isset($_POST['exp']) ): ?>
	<?php require 'includes/db/connectdb-imarisha.php'; ?>
	<?php require 'includes/db/functions-db.php' ?>

	<?php
		$gender = $_POST['gender'];
		$dob = $_POST['dob'];
		$exp = $_POST['exp'];

		$sql_update_client = "
			UPDATE clients 
			SET client_gender='$gender', client_dob='$dob', client_exp='$exp' 
			WHERE client_id=$id";

		if ( mysqli_query($conn, $sql_update_client) ) {
			$_SESSION['client'] = getClients($conn, "client_id=".$id)[$id];
			$username = $_SESSION['client']['client_username'];
  		redirect('member-home.php', 'welcome&user='.$username);
		} else {
			echo "Error: " . $sql_update_client . "<br>" . mysqli_error($conn);
		}

    mysqli_close($conn);
	?>
<?php endif ?>