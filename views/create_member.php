<?php require '../includes/connectdb_imarisha.php'; ?>
<?php require '../includes/db_functions.php'; ?>
<?php require '../includes/helper_functions.php'; ?>

<?php 
$form_names = array('fname', 'lname', 'email', 'pass', 'prog_id');
$redirect_to = "member-signup.php";

redirectIfNull($redirect_to, $form_names);

$client_name = sanitize($_POST['fname']) . " " . sanitize($_POST['lname']);
$prog_id = sanitize($_POST['prog_id']);
$client_email = sanitizeEmail($_POST['email']);
$client_pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

$sql_select_client_email = "
	SELECT client_email
	FROM clients
	WHERE client_email='$client_email'";
$result = mysqli_query($conn, $sql_select_client_email);
if ($result && mysqli_num_rows($result) > 0) {
	redirect("login.php", "email=".$client_email);
	exit();
}

$sql_insert_client = "
	INSERT INTO clients
	(client_email, client_name, client_pass) 
	VALUES ('$client_email', '$client_name', '$client_pass')";

if (mysqli_query($conn, $sql_insert_client)) {
  $last_id = mysqli_insert_id($conn);
  echo "New client record created successfully";
} else {
  echo "Error: " . $sql_insert_client. "<br>" . mysqli_error($conn);
  exit();
}

$sql_insert_client_sub = "
	INSERT INTO subscriptions
	(client_id, prog_id, sub_startdate, sub_enddate) 
	VALUES ('$last_id', '$prog_id', NOW(), NOW())";

if (mysqli_query($conn, $sql_insert_client_sub)) {
  echo "New subscription record created successfully";
} else {
  echo "Error: " . $sql_insert_client_sub . "<br>" . mysqli_error($conn);
  exit();
}

redirect("member-homepage.php", "usr_id=".$last_id.";new=true");

mysqli_close($conn);
?>

