<?php require 'connectdb-controller.php'; ?>

<?php 
if ( !(isset($_POST['email']) && isset($_POST['pass'])) ) {
	# code...
}

if ( isset($_POST['email']) ) {
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
}

$pass = $_POST['pass'];


echo "$username, $pass";
?>

