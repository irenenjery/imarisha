<?php require 'includes/db/connectdb_imarisha.php'; ?>
<?php require 'includes/db/db_functions.php' ?>
<?php require 'includes/helper_functions.php'; ?>

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
	$client = getClients($conn, "client_username='".$username."'");
	$username_error = count($client) > 0;
}
//Validate email
if ( $email ) {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$invalid_email_error = true;
	} else {
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		$invalid_email_error = false;
		$client = getClients($conn, "client_email='".$email."'");
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
		(client_email, client_name, client_pass, client_username) 
		VALUES ('$email', '$name', '$pass', '$username')";

	if (mysqli_query($conn, $sql_insert_client)) {
	  $last_id = mysqli_insert_id($conn);
	} else {
	  redirect(htmlspecialchars($_SERVER['PHP_SELF']), 'invalid');
	}

	$sql_insert_client_sub = "
		INSERT INTO subscriptions
		(client_id, prog_id, sub_startdate, sub_enddate) 
		VALUES ('$last_id', '$prog_id', NOW(), NOW())";

	if (mysqli_query($conn, $sql_insert_client_sub)) {
		session_start();
		$_SESSION['user'] = getClients($conn, "client_id=".$last_id)[$last_id];
		redirect('member-home.php', 'welcome=true');
	} else {
	  echo "Error: " . $sql_insert_client_sub . "<br>" . mysqli_error($conn);
	}
}
mysqli_close($conn);
?>

<!-- HTML5 boilerplate -->
<?php require 'includes/views/head.php'; ?>

<!-- Navbar (sit on top) -->
<?php require 'includes/views/guest-persistent-navbar.php'; ?>

<!-- Page content -->
<div class="w3-content w3-padding-64" id="member-signup-container">
	<section id="member-signup" class="w3-panel w3-card-2 w3-padding-0">
		<div class="w3-container w3-black w3-center" style="letter-spacing: 2px;">
	  	<h2>Join <span class="w3-border w3-border-white w3-padding">IM</span> Gym</h2>
		</div>

		<form class="w3-container w3-padding" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" name="signup" id="signup-form">
			<span class="warning w3-text-red" id="form_warning" style="display: none;">
				Please fill in all fields using valid info.
			</span>
			<p>
				<p class='w3-half'>
					<input class="w3-input w3-validate" type="text" name="fname" placeholder="first name" id="fname" value="<?php echo $fname; ?>" required>
				</p>
				<p class='w3-half'>
					<input class="w3-input w3-validate" type="text" name="lname" placeholder="family name" id="lname" value="<?php echo $lname; ?>" required>
				</p>
			</p>

			<p>
				<input class="w3-input" type="text" name="username" placeholder="username" id="username" value="<?php if ($username && !$username_error) echo $username?>" required>
				<?php if ( $username_error ): ?>
					<span id="username_warning" class="warning w3-text-red">
						<?php echo "username '<strong>" . $username . "</strong>' unavailable"; ?>
					</span>
				<?php endif ?>
			</p>
			<p>
				<input class="w3-input" type="email" name="email" placeholder="email" id="email" value="<?php if ($email && !($invalid_email_error || $email_error)) echo $email ?>" required>
				<?php if ( $invalid_email_error ): ?>
					<span class="warning w3-text-red">Invalid email</span>
				<?php endif ?>
				<?php if ( $email_error ): ?>
					<span class="warning w3-text-red">
						<?php echo "email '<strong>" . $email . "</strong>' already exists"; ?>
					</span>
				<?php endif ?>
			</p>
			<p>
				<input class="w3-input" type="password" name="pass" placeholder="password" id="pass" required>
			</p>
			<p>
				<input class="w3-input" type="password" name="pass2" placeholder="confirm password" id="pass2" oninput="validate_password()" required>
				<span class="warning w3-text-red" id="pass_warning" style="visibility: hidden;">Passwords don't match</span>
			</p>
			<p>
				<select class="w3-select w3-border" name="prog_id" id="program" style="text-transform: capitalize;" required>
				  <option disabled selected>Select a program</option>
				  <?php foreach ($programs_data as $key => $program): ?>
				  	<option value="<?php echo $program['prog_id'] ?>">
				  		<?php echo $program['prog_title'] ?>
				  	</option>
				  <?php endforeach ?>
				</select>
			</p>
			<p>
			  <button type="submit" class="w3-btn-block w3-teal w3-large">Register</button>
			</p>
		</form>
	</section>

	<section id="trainer-signup" class="w3-display-container w3-panel w3-card w3-center" style="width:80%;margin:auto;">
		<p>
			I want to <a href="become-trainer.php" class=" w3-bronze w3-padding" style="text-decoration:none;">Become a Trainer</a>
		</p>
	</section>
</div>

<!-- JS data validation -->
<script type="text/javascript">
	bind_selected_program();
	show_form_invalid_errors();

	function validate() {
		let signup_form = document.getElementById("signup-form");
		// password
		if ( validate_password() ) {
			signup-form.submit();
		}
	}
	function validate_password() {
		let pass = document.getElementById("pass"),
				pass2 = document.getElementById("pass2"),
				pass_warning = document.getElementById("pass_warning");

		if ( pass.value != pass2.value ) {
			pass_warning.style.visibility = "visible";
			return false;
		} else {
			pass_warning.style.visibility = "hidden";
			return true;
		}
	}
	/** Binds program from homepage url to select#program */
	function bind_selected_program() {
		let params = new URLSearchParams(location.search),
				urlprogram = params.get("program_id"),
				select_program = document.querySelector("select#program");
		if ( !urlprogram ) return;

		let option = select_program.querySelector(`option[value="${urlprogram}"`);

		if ( option ){
			option.setAttribute("selected", true);
		}
	}
	function show_form_invalid_errors() {
		let params = new URLSearchParams(location.search),
				urlinvalid = params.get("invalid"),
				form_warning = document.getElementById("form_warning"),
				email_warning = document.getElementById("email_warning");

		if (urlinvalid === null) return;

		switch(urlinvalid) {
			case 'empty':
			case '':
				form_warning.style.display = "block";
				break;
			case 'email_format':
				email_warning.style.display = "block";
				break;
			default:
				return;
		}
	}
</script>

<!-- Footer -->
<?php require 'includes/views/footer.php'; ?>