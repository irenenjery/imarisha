<!-- <?php #PHP variables ?> -->
<?php require 'includes/controllers/controller-member-welcome.php'; ?>

<!-- HTML5 boilerplate -->
<?php require 'includes/views/head.php'; ?>

<!-- Navbar (sit on top) -->
<?php require 'includes/views/persistent-navbar-member.php'; ?>

<!-- Header -->
<?php require 'includes/views/header-member-welcome.php'; ?>

<!-- Page Content -->
<?php require 'includes/views/content-member-welcome.php'; ?>

<script>
	'use strict';
	let details_form = document.forms.details_form,
			comp_descr_container = document.getElementById('comp_descr_container');

	function toggleTextarea(tgOn) {
		comp_descr_container.style.display = tgOn ? 'inline-block' : 'none';
	}
</script>

<!-- Footer -->
<?php require 'includes/views/footer.php'; ?>
