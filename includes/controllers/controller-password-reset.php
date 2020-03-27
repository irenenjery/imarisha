<?php require 'includes/db/connectdb-imarisha.php'; ?>
<?php require 'includes/db/functions-db.php' ?>
<?php require 'includes/functions-helper.php'; ?>

<?php
$username = isset($_POST['username']) ? sanitize($_POST['username']) : false;
$email = isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : false;
$pass = isset($_POST['pass']) ? password_hash($_POST['pass'], PASSWORD_DEFAULT) : false;

$update_successful = $authentic_user = null;

if ( $username && $email && !$pass ) { //authenticate user
	if ( is_coach($username) ) {
		$coach = getAuthCoach($conn, "coach_username='$username' AND coach_email='$email'");
		$authentic_user = count($coach) > 0;
	} else {
		$client = getAuthClient($conn, "client_username='$username' AND client_email='$email'");
		$authentic_user = count($client) > 0;
	}
}
if ( $pass ) { // change password of authentic user
	if ( is_coach($username) ) {
		$sql_update_pass = "
	    UPDATE coaches_auth
	    SET coach_pass='$pass'
	    WHERE coach_username='$username'
	    	AND coach_email='$email'";
	} else {
		$sql_update_pass = "
	    UPDATE clients_auth
	    SET client_pass='$pass'
	    WHERE client_username='$username'
	    	AND client_email='$email'";
	}
	if (mysqli_query($conn, $sql_update_pass)) {
		$update_successful = true;
	} else {
		echo "Error: " . $sql_update_pass . "<br>" . mysqli_error($conn);
		$update_successful = false;		
	}
}
if ($update_successful) redirect("login.php", "pass_reset");
mysqli_close($conn);
?>