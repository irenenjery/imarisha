<?php require 'includes/db/connectdb-imarisha.php'; ?>
<?php require 'includes/db/functions-db.php' ?>
<?php require 'includes/functions-helper.php'; ?>

<?php
$fname = isset($_POST['fname']) ? sanitize($_POST['fname']) : '';
$lname = isset($_POST['lname']) ? sanitize($_POST['lname']) : '';
$username = isset($_POST['username']) ? sanitize($_POST['username']) : '';
$email = isset($_POST['email']) ? $_POST['email'] : false;
$pass = isset($_POST['pass']) ? password_hash($_POST['pass'], PASSWORD_DEFAULT) : '';
$prog_id = isset($_POST['prog_id']) ? $_POST['prog_id'] : '';

$username_error = $email_error = $invalid_email_error = false;
$programs_data = getPrograms($conn); 

//Validate username
if ( $username ) {
	$client = getAuthClient($conn, "client_username='".$username."'");
	$username_error = count($client) > 0;
}
//Validate email
if ( $email ) {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$invalid_email_error = true;
	} else {
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		$invalid_email_error = false;
		$client = getAuthClient($conn, "client_email='".$email."'");
		$email_error = count($client) > 0;
	}
}

//Add member and redirect to homepage
if ( !($username_error || $email_error || $invalid_email_error) 
	&& $fname	&& $lname	&& $username	&& $email	&& $pass && $prog_id
) {

	$name = $fname . " " . $lname;

	$sql_insert_client = "
		INSERT INTO clients
		(client_name) 
		VALUES ('$name')";

	if (mysqli_query($conn, $sql_insert_client)) {
	  $last_id = mysqli_insert_id($conn);
	} else {
	  echo "Error: " . $sql_insert_client . "<br>" . mysqli_error($conn);
	  redirect(htmlspecialchars($_SERVER['PHP_SELF']), 'invalid=client_name');
	}
	$sql_insert_client_auth = "
		INSERT INTO clients_auth
		(client_id, client_username, client_email, client_pass) 
		VALUES ('$last_id', '$username', '$email', '$pass')";

	if (!mysqli_query($conn, $sql_insert_client_auth)) {
	  redirect(htmlspecialchars($_SERVER['PHP_SELF']), 'invalid=client_auth');
	} 

	$sql_insert_client_sub = "
		INSERT INTO subscriptions
		(client_id, prog_id, sub_startdate, sub_enddate) 
		VALUES ('$last_id', '$prog_id', NOW(), NOW())";

	if (mysqli_query($conn, $sql_insert_client_sub)) {
		session_start();
		$_SESSION['client'] = getClients($conn, "client_id=".$last_id)[$last_id];
		$_SESSION['welcome'] = 'new';
		redirect('member-welcome.php', 'welcome='.$_SESSION['client']['client_username']);
	} else {
	  echo "Error: " . $sql_insert_client_sub . "<br>" . mysqli_error($conn);
	}
}
mysqli_close($conn);
?>