<?php 
echo '
<div class="w3-content w3-padding-64" style="max-width:1564px;margin-top: 50px;">
	<section id="signup-form" class="w3-display-container w3-panel w3-card-2 w3-padding-0" style="width:60%;margin: auto;height: 400px;">
		<div class="w3-container w3-black w3-center" style="letter-spacing: 2px;">
	  	<h2><span class="w3-border w3-border-white w3-padding">IM</span> Login</h2>
		</div>

		<form class="w3-container" name="sign-in" action="login-controller.php" method="POST">
		  <p>
		  <label class="w3-label w3-validate">Email address</label>
		  <input class="w3-input" type="email" name="email" required></p>
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
</div>';
?>