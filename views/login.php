<!-- HTML5 boilerplate -->
<?php require 'includes/views/head.php'; ?>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <ul class="w3-navbar w3-white w3-wide w3-padding-8 w3-card-2">
    <li id="logo">
      <a href="index.php" class="w3-margin-left">
        <b class="w3-hide-medium">IMARISHA</b><b class="w3-hide-large w3-hide-small">IM</b>GYM
      </a>
    </li><!-- li#logo -->
    <!-- Show them on small screens -->
    <li id="btn-small" class="w3-hide-medium w3-hide-large">
      <a href="login.php" class="w3-btn w3-blue w3-tiny" style="display:inline-block;">login</a>
      <a href="member-signup.php" class="w3-btn w3-black w3-tiny" style="display:inline-block;">Join IM</a>
    </li><!-- li#btn-small -->
    <!-- Hide them on small screens -->
    <li id="top-form" class="w3-right w3-hide-small" style="margin-right:20px">
      <form id="sign-in" name="sign-in" action="start_session.php" method="POST">
        <input type="email" name="email" placeholder="email" required \>
        <input type="password" name="pass" placeholder="password" required \>
        <button type="submit" class="w3-btn w3-blue">
          <span class="w3-small" style="letter-spacing: 4px">login</span>
        </button>
        <a href="member-signup.php" class="w3-btn w3-black w3-small" style="display:inline-block;">Join IM
        </a>  
      </form><!-- form#sign-in -->
    </li><!-- li#top-form -->
  </ul><!-- ul.w3-navbar -->
</div><!-- div.w3-top -->

<!-- Page content -->
<div class="w3-content w3-padding-64" style="max-width:1564px;margin-top: 50px;">
	<section id="signup-form" class="w3-display-container w3-panel w3-card-2 w3-padding-0" style="width:60%;margin: auto;height: 400px;">
		<div class="w3-container w3-black w3-center" style="letter-spacing: 2px;">
	  	<h2><span class="w3-border w3-border-white w3-padding">IM</span> Login</h2>
		</div>

		<form class="w3-container" name="sign-in" action="start_session.php" method="POST">
		  <p>
		  <label class="w3-label w3-validate">Email address</label>
		  <input class="w3-input" id="email" type="email" name="email" required></p>
		  <p style="margin-top:50px;">
		  <label class="w3-label w3-validate">Password</label>
		  <a href="password_reset.php" class="w3-right">Forgot password?</a>
		  <input class="w3-input" type="password" name="pass" required></p>
		  <button class="w3-btn-block w3-blue" style="height:50px;margin-top:50px;">Sign in</button></p>
		</form>
	</section>

		<div id="signup-container" class="w3-display-container w3-panel w3-card w3-center" style="width:80%;margin:auto;">
			<p>New to <a href="index.php" class="w3-border w3-border-black w3-padding" style="text-decoration:none;">IM</a> <span class="w3-hide-small">Gym</span>? <a href="member-signup.php">Join us</a></p>
		</div>
</div>

<!-- Internal scripts -->
<script type="text/javascript">
	bind_selected_program();
	show_form_invalid_errors();

	/** Binds program from homepage url to select#program */
	function bind_selected_program() {
		let params = new URLSearchParams(location.search),
				urlemail = params.get("email"),
				email = document.getElementById('email');
		if ( !urlemail ) return;

		email.setAttribute('value', urlemail);
	}
</script>

<!-- Footer -->
<?php require 'footer.php'; ?>