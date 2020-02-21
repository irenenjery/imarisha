<?php session_start(); ?>
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
	$user = getAuthCoach($conn, "coach_username='".$username."' OR coach_email='".$username."'");
  if ( password_verify($pass, $user['coach_pass']) ) {//password matches
		$mismatch = false;
		$_SESSION["user_type"] = "coach";
		$user_id = $user['coach_id'];
  }
} else {
	$user_type = "coach";
	$user = getAuthClient($conn, "client_username='".$username."' OR client_email='".$username."'");
  if ( password_verify($pass, $user['client_pass']) ) {//password matches
		$mismatch = false;
		$_SESSION["user_type"] = "client";
		$user_id = $user['client_id'];
  }
}

//username/email doesn't exist or password doesn't match
if ( $mismatch  ) {
	redirect('login.php', 'auth_fail=match_error');
} 

$_SESSION["user"] = $user;
redirect('temp.php', 'user_id='.$user_id);//redirect to client/coach

mysqli_close($conn);
?>