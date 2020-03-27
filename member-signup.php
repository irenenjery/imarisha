<!-- <?php #PHP variables ?> -->
<?php require 'includes/controllers/controller-member-signup.php'; ?>

<!-- HTML5 boilerplate -->
<?php require 'includes/views/head.php'; ?>

<!-- Navbar (sit on top) -->
<?php require 'includes/views/persistent-navbar-guest.php'; ?>

<!-- Page content -->
<?php require 'includes/views/content-member-signup.php'; ?>

<script>
	'use strict';
	let prog_select = document.getElementById('prog-select'),
			prog_more = document.getElementById('prog-more');

	prog_select.addEventListener('click', function(event) {
		if ( event.target.value != undefined ) {
			let sp = document.querySelectorAll('.selected_prog'),
					to_select = document.getElementById(`prog${prog_select.value}`);
			for (let i = 0; i < sp.length; i++) {
				sp[i].classList.remove('selected_prog');
				sp[i].classList.add('w3-black');
			}
			to_select.classList.remove('w3-black');
			to_select.classList.add('selected_prog');

			prog_more.href = `#prog${prog_select.value}`;
		}
	});

	bind_url_selected_program();
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
	/** Binds program from homepage url to .prog-select */
	function bind_url_selected_program() {
		let params = new URLSearchParams(location.search),
				urlprogram = params.get("prog_id"),
				prog_selects = document.querySelectorAll("select.prog-select");
		if ( !urlprogram ) return;

		for (let i = 0; i < prog_selects.length; i++) {
			let option = prog_selects[i].querySelector(`option[value="${urlprogram}"`);
			if ( option ){
				option.setAttribute("selected", true);
			}
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