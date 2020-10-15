<?php 
session_start();
if ( !isset($_SESSION['coach']) ) {
  header('Location: index.php#sign-in');
} elseif ( !isset($_POST['coach-setting']) ) {
	header('Location: coach-settings.php');
}
?>

<?php require 'includes/functions-helper.php' ?>
<?php require 'includes/db/functions-db.php' ?>
<?php require 'includes/db/connectdb-imarisha.php'; ?>
<?php 
$coach = $_SESSION['coach'];
$coach_id = $coach['coach_id'];
$coach_setting = $_POST['coach-setting'];

switch ($coach_setting) {
	case 'coach-about':
		$update_status = update_about($conn, $coach_id);
		break;

	case 'coach-pass':
		$update_status = update_password($conn, $coach_id);
		break;
	
	default:
		$update_status = array('status_code' => 0, 
			'status_msg' => 'Error: Something went wrong');
		break;
}
$_SESSION['update_status'] = $update_status;
$_SESSION['changes_submitted'] = true;

mysqli_close($conn);

header('Location: coach-settings.php');
?>

<?php 
function update_about($conn, $coach_id)
{
	$new_about = sanitize($_POST['coach-about']);
	$sql_update_coaches = "
		UPDATE `coaches`
		SET `coach_prof`='$new_about' 
		WHERE `coach_id`=$coach_id;";

		if (mysqli_query($conn, $sql_update_coaches)) {
			$status_code = 1;
			$status_msg = "Profile Updated Successfully";
		} else {
			$status_code = 0;
			$status_msg = "Profile Update Error: " . mysqli_error($conn);
		}
		return array('status_code' => $status_code, 
			'status_msg' => $status_msg);
} 
function update_password($conn, $coach_id)
{ 
  $pass_current = $_POST['pass-current'];
	$coach_auth = getAuthCoach($conn, "coach_id=$coach_id");

  if ( password_verify($pass_current, $coach_auth['coach_pass']) ) {
  	$pass_new = password_hash($_POST['pass-new'], PASSWORD_DEFAULT);
		$sql_update_coaches_auth = "
			UPDATE `coaches_auth`
			SET `coach_pass`='$pass_new' 
			WHERE `coach_id`=$coach_id;";

		if (mysqli_query($conn, $sql_update_coaches_auth)) {
			$status_code = 1;
			$status_msg = "Password Updated Successfully";
		} else {
			$status_code = 0;
			$status_msg = "Password Update Error: " . mysqli_error($conn);
		}
  } else {
		$status_code = 0;
		$status_msg = "Current password incorrect";
  }
	return array('status_code' => $status_code, 'status_msg' => $status_msg);
}
?>