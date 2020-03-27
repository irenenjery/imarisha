<!-- <?php #PHP variables ?> -->
<?php require 'includes/controllers/controller-password-reset.php'; ?>

<!-- HTML5 boilerplate -->
<?php require 'includes/views/head.php'; ?>

<!-- Navbar (sit on top) -->
<?php require 'includes/views/persistent-navbar-guest.php'; ?>

<!-- Page content -->
<?php require 'includes/views/content-password-reset.php'; ?>

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

<!-- Footer -->
<?php require 'includes/views/footer.php'; ?>
