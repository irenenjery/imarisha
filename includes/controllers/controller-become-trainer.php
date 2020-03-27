<?php require 'includes/db/connectdb-imarisha.php'; ?>
<?php require 'includes/db/functions-db.php' ?>
<?php require 'includes/functions-helper.php'; ?>

<?php
$programs = getPrograms($conn);

$fname = isset($_POST['fname']) ? sanitize($_POST['fname']) : '';
$lname = isset($_POST['lname']) ? sanitize($_POST['lname']) : '';
$email = isset($_POST['email']) ? $_POST['email'] : false;
$phone = isset($_POST['phone']) ? $_POST['phone'] : false;
$exp = isset($_POST['exp']) ? $_POST['exp'] : '';
$specialty = isset($_POST['specialty']) ? $_POST['specialty'] : '';

$app_exists = $upload_failed = $too_large = $submit_app = $app_success = null;


//if email or phone exists, application already sent
//Check if applicant exists
if ( $email && $phone ) {
	echo "entered";
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$invalid_email_error = false;

	$app = getApplicants($conn, "app_email='$email' OR app_phone='$phone'");
	$app_exists = count($app) > 0;

	$target_dir = "uploads/";
	$target_file = $target_dir . $phone . "_" . basename($_FILES["resume"]["name"]);
	$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
	$too_large = $_FILES["resume"]["size"] > 3000000;//3mb

	$submit_app = !$app_exists && $file_type === 'pdf' && !$too_large;
}
if ($submit_app) {
	$upload_failed = file_exists($target_file) ? true : !move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);
	$name = $fname . " " . $lname;

	$sql_insert_applicant = "
		INSERT INTO applicants
		(app_name, app_email, app_phone, app_resume, app_exp, app_specialty) 
		VALUES ('$name', '$email', '$phone', '$target_file', '$exp', '$specialty')";

	if ( mysqli_query($conn, $sql_insert_applicant) ) {
		$app_success = true;
	} else {
		$app_success = false;
	  echo "Error: " . $sql_insert_applicant . "<br>" . mysqli_error($conn);
	}
}

mysqli_close($conn);
?>