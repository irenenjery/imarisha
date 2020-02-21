<?php 
echo '
<script type="text/javascript">
	function validate() {
		let signup_form = document.getElementById("signup-form");
		// password
		if ( validatePassword() ) {
			signup-form.submit();
		}
	}
	function validatePassword() {
		let pass = document.getElementById("pass"),
				pass2 = document.getElementById("pass2"),
				passwarning = document.getElementById("passwarning");

		if ( pass.value != pass2.value ) {
			passwarning.style.visibility = "visible";
			return false;
		} else {
			passwarning.style.visibility = "hidden";
			return true;
		}
	}
	/** Binds program from homepage url to select#program */
	function bindSelectedProgram() {
		let params = new URLSearchParams(location.search),
				urlprogram = params.get("program"),
				select_program = document.querySelector("select#program");
		if ( !urlprogram ) return;

		let option = select_program.querySelector(`option[value="${urlprogram}"`);

		if ( option ){
			option.setAttribute("selected", true);
		}
	}
	bindSelectedProgram();
</script>';
?>