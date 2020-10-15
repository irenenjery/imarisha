<!-- <?php #PHP variables ?> -->
<?php require 'includes/controllers/controller-member-settings.php'; ?>

<!-- HTML5 boilerplate -->
<?php require 'includes/views/head.php'; ?>

<!-- Navbar (sit on top) -->
<?php require 'includes/views/persistent-navbar-member.php'; ?>

<!-- Header -->
<?php require 'includes/views/header-member-settings.php'; ?>

<!-- Page Content -->
<?php require 'includes/views/content-member-settings.php'; ?>

<script>
	'use strict';

	function validate_password(pass, pass2, passwarning) {
		pass = pass || document.getElementById("pass");
		pass2 = pass2 || document.getElementById("pass2");
		pass_warning = || document.getElementById("passwarning");

		if ( pass.value != pass2.value ) {
			pass_warning.style.visibility = "visible";
			return false;
		} else {
			pass_warning.style.visibility = "hidden";
			return true;
		}
	}
  function validate_form(form) {
    let form_update = form || document.getElementById("form-update");
    // password
    if ( validate_password() === true ) form_update.submit();
  }
</script>

<!-- Footer -->
<?php require 'includes/views/footer.php'; ?>
