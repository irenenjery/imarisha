<?php require 'includes/db/connectdb_imarisha.php'; ?>
<?php require 'includes/db/db_functions.php' ?>
<?php require 'includes/helper_functions.php'; ?>

<?php
$username = isset($_POST['username']) ? sanitize($_POST['username']) : '';
$email = isset($_POST['email']) ? $_POST['email'] : false;

$update_success = $mismatch = null;
$email_valid = $email && filter_var($email, FILTER_VALIDATE_EMAIL);

if ( isset($_POST['pass']) && $username && $email_valid ) {
	$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);

	if ( substr_compare(substr($username, 0, 1), '@', 0) == 0 ) {
		$coach = getCoaches($conn, "coach_username='$username' AND coach_email='$email'");
		$mismatch = count($coach) === 0;
		$sql_update_pass = "
	    UPDATE coaches 
	    SET coach_pass='$pass'
	    WHERE coach_username='$username'
	    	AND coach_email='$email'";
	} else {
		$client = getClients($conn, "client_username='$username' AND client_email='$email'");
		$mismatch = count($client) === 0;
		$sql_update_pass = "
	    UPDATE clients 
	    SET client_pass='$pass'
	    WHERE client_username='$username'
	    	AND client_email='$email'";
	 }

  if (!$mismatch) $update_success = mysqli_query($conn, $sql_update_pass);
}
mysqli_close($conn);
?>
<!-- HTML5 boilerplate -->
<?php require 'includes/views/head.php'; ?>

<!-- Navbar (sit on top) -->
<?php require 'includes/views/guest-persistent-navbar.php'; ?>


<!-- Page content -->
<div class="w3-content w3-padding-64" style="max-width: 1564px;margin-top: 50px;">
	<section id="reset" class="w3-display-container w3-panel w3-card-2 w3-padding-0" style="width: 60%;margin: auto;">
		<div class="w3-container w3-yellow" style="letter-spacing: 2px;">
	  	<h2>Reset your password</h2>
		</div>

		<form onsubmit="validate_form(); return false" class="w3-container w3-padding" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" name="reset" id="form-reset">
			<?php if ($update_success === false): ?>
				<p>
					<span class="w3-text-red">
						Something went wrong, please try again
					</span>
				</p>
			<?php elseif ($mismatch): ?>
				<p>
					<span class="w3-text-red">
						Username and email you entered don't match, please try again
					</span>
				</p>
			<?php endif ?>
			<p>
				<input class="w3-input" type="text" name="username" placeholder="username" id="username" value="<?php if ($update_success && $username) echo $username?>" required>
			</p>
			<p>
				<input class="w3-input" type="email" name="email" placeholder="email" id="email" value="<?php if ($update_success && $email_valid && $email) echo $email ?>" required>
				<?php if ( !$email_valid && $email ): ?>
					<span class="warning w3-text-red">Invalid email</span>
				<?php endif ?>
			</p>
      <?php if (!$update_success): ?>
	      <p>
	      	<label for="pass">Change password</label>
	        <input class="w3-input" type="password" name="pass" placeholder="New password" id="pass" value="" oninput="validate_password()" autocomplete="off">
	      </p>
	      <p>
	        <input class="w3-input" type="password" name="pass2" placeholder="Confirm password" id="pass2" onchange="validate_password()" oninput="validate_password()">
	        <span class="warning w3-text-red" id="passwarning" style="visibility: hidden;">Passwords don't match</span>
	      </p>
	      <p>
			  	<button class="w3-btn-block w3-green" style="height:50px;">Reset Password</button>
				</p>
			<?php else: ?>
		    <div class="w3-panel w3-green" id="msgbox">
		      <h3><span>Password updated successfully!</span></h3>
		    </div> 
      <?php endif ?>
		</form>
	</section>
</div>

<!-- Footer -->
<?php require 'includes/views/footer.php'; ?>
<script>
	'use strict';
	function validate_password() {
		let pass = document.getElementById("pass"),
				pass2 = document.getElementById("pass2"),
				pass_warning = document.getElementById("passwarning");

		if ( pass.value != pass2.value ) {
			pass_warning.style.visibility = "visible";
			return false;
		} else {
			pass_warning.style.visibility = "hidden";
			return true;
		}
	}
  function validate_form() {
    let form_reset = document.getElementById("form-reset");
    // password
    if ( validate_password() === true ) form_reset.submit();
  }
</script>