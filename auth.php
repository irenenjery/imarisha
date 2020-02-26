<?php require 'includes/db/connectdb_imarisha.php'; ?>
<?php require 'includes/db/db_functions.php' ?>
<?php require 'includes/helper_functions.php'; ?>

<?php 
//empty fields
if ( !(isset($_POST['username']) && isset($_POST['pass'])) ) {
	redirect('login.php', 'auth_fail=empty_fields');
}

$username = sanitize($_POST['username']);
$pass = $_POST['pass'];
$mismatch = true;

// Trainer login; username starts with @
if ( substr_compare(substr($username, 0, 1), '@', 0) == 0 ) {
	echo "coach";
	$user = getAuthCoach($conn, "coach_username='".$username."'");
  if ( password_verify($pass, $user['coach_pass']) ) {//password matches
		$mismatch = false;
		$user_type = 'coach';
		$user_id = $user['coach_id'];
  }
} else {
	$user = getAuthClient($conn, "client_username='".$username."' OR client_email='".$username."'");
  if ( password_verify($pass, $user['client_pass']) ) {//password matches
		$mismatch = false;
		$user_type = 'client';
		$user_id = $user['client_id'];
  }
}

//username/email doesn't exist or password doesn't match
if ( $mismatch  ) {
	$redirect_to = 'login.php';
	$urlparams = 'auth_fail=match_error';
} else {
	session_start();
	$urlparams = 'user_id='.$user_id;
	if ( $user_type == 'client' ) {
		$redirect_to = 'member-home.php';
		$_SESSION['user'] = getClients($conn, "client_id=".$user_id)[$user_id];
	} elseif ( $user_type == 'coach' ) {
		$redirect_to = 'coach-home.php';
		$_SESSION['user'] = getCoaches($conn, "coach_id=".$user_id)[$user_id];
	}
}
redirect($redirect_to, $urlparams);
mysqli_close($conn);
?>