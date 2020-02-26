<?php require 'includes/db/connectdb_imarisha.php'; ?>
<?php require 'includes/db/db_functions.php' ?>
<?php require 'includes/helper_functions.php'; ?>

<?php
$programs = getPrograms($conn);

$fname = isset($_POST['fname']) ? sanitize($_POST['fname']) : '';
$lname = isset($_POST['lname']) ? sanitize($_POST['lname']) : '';
$email = isset($_POST['email']) ? $_POST['email'] : false;
$phone = isset($_POST['phone']) ? sanitize($_POST['phone']) : '';
$exp = isset($_POST['exp']) ? $_POST['exp'] : '';
$specialty = isset($_POST['specialty']) ? $_POST['specialty'] : '';

$app_exists = $upload_failed = $too_large = $submit_app = $app_success = null;


//if email or phone exists, application already sent
//Check if applicant exists
if ( $email && $phone ) {
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$invalid_email_error = false;

	$app = getApplicants($conn, "app_email='$email' OR app_phone='$phone'");
	$app_exists = count($app) > 0;

	$target_dir = "uploads/";
	$target_file = $target_dir . $phone . "_" . basename($_FILES["resume"]["name"]);
	$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
	$too_large = $_FILES["resume"]["size"] > 3000000;//3mb

	$submit_app = !($app_exists || $file_type !== 'pdf' || $too_large);
}

if ($submit_app) {
	$upload_failed = file_exists($target_file) ? true : !move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);
	$name = $fname . " " . $lname;

	$sql_insert_applicant = "
		INSERT INTO applicants
		(app_name, app_email, app_phone, app_resume, app_exp, app_specialty) 
		VALUES ('$name', '$email', '$phone', '$target_file', '$exp', '$specialty')";

	$app_success = mysqli_query($conn, $sql_insert_applicant);
}

mysqli_close($conn);
?>

<!-- HTML5 boilerplate -->
<?php require 'includes/views/head.php'; ?>

<!-- Navbar (sit on top) -->
<!-- <?php #require 'includes/views/guest-persistent-navbar.php'; ?> -->

<!-- Page content -->
<div class="w3-content w3-padding-64" id="member-signup-container">
	<section id="member-signup" class="w3-panel w3-card-2 w3-padding-0">
		<div class="w3-container w3-black w3-center" style="letter-spacing: 2px;">
	  	<h2>Trainer Application <span class="w3-border w3-border-white w3-padding">IM</span></h2>
		</div>
		<?php if ($app_success): ?>
	    <div class="w3-green" id="msgbox">
	      <h3><span>Application sent successfully!</span></h3>
	    </div> 
	  <?php elseif ($app_success === false): ?>
	    <div class="w3-red" id="msgbox">
	      <h3><span>Something went wrong, please try again later!</span></h3>
	    </div> 
	  <?php elseif ($app_exists): ?>
	    <div class="w3-panel w3-red" id="msgbox">
	      <h3><span>Application already sent!</span></h3>
	    </div>
		<?php endif ?>
		<form class="w3-container w3-padding" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" name="trainer-signup" id="trainer-form" enctype="multipart/form-data">
			<h2>Personal info</h2>
			<p>
				<p class='w3-half'>
					<input class="w3-input w3-validate" type="text" name="fname" placeholder="first name" id="fname" value="<?php echo $fname; ?>" required>
				</p>
				<p class='w3-half'>
					<input class="w3-input w3-validate" type="text" name="lname" placeholder="family name" id="lname" value="<?php echo $lname; ?>" required>
				</p>
			</p>
			<p>
				<input class="w3-input" type="email" name="email" placeholder="email" id="email" value="<?php if ($email) echo $email ?>" required>
			</p>
			<p>
				<input class="w3-input" type="number" name="phone" placeholder="phone" id="phone" value="" required>
			</p>
			<h2>Work Experience</h2>
			<p>
				<p><label for="resume"><b>Upload Resume(pdf only):</b></label></p>
				<input class="w3-border w3-padding" type="file" name="resume" id="resume" required>
				<?php if (isset($file_type) && $file_type !== 'pdf'): ?>
					<p class="w3-text-red">PDFs only</p>
				<?php elseif ($too_large): ?>
					<p class="w3-text-red">File too large, only files < 3mb uploadable</p>
				<?php endif ?>
			</p>
			<p>
				<p><label for="exp"><b>Level of Experience:</b></label></p>
				<select class="w3-select w3-border" name="exp" id="exp" required>
					<option value="intern" selected>None - Intern</option>
					<option value="beginner">Beginner - 2 years or less</i></option>
					<option value="intermediate">Intermediate - 3 to 5 years</option>
					<option value="pro">Pro - 6 to 10 years</option>
					<option value="guru">Guru - 10+ years</option>
				</select>
			</p>
			<p>
				<p><label for="specialty"><b>Specialty:</b></label></p>
					<select class="w3-select w3-border" name="specialty" id="specialty" style="text-transform: capitalize;">
					  <option value="none" selected>None</option>
					  <?php foreach ($programs as $prog_id => $prog): ?>
        			<?php if ( $prog_id == $user['client_prog_id']) continue;?>
					  	<option value="<?php echo $prog_id ?>">
					  		<?php echo $prog['prog_title'] ?>
					  	</option>
					  <?php endforeach ?>
					  <option value="other" selected>Other</option>
					</select>
			</p>
			<p style="margin-top: 50px;">
			  <button type="submit" class="w3-btn-block w3-bronze w3-large">Send Application</button>
			</p>
		</form>
	</section>
</div>

<!-- Footer -->
<?php require 'includes/views/footer.php'; ?>