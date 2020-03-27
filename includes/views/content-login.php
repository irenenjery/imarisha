<div class="w3-content w3-padding-64" style="max-width: 1564px;margin-top: 50px;">
	<section id="login-form" class="w3-display-container w3-panel w3-padding-0 w3-border-left w3-border-bottom" style="width: 60%;margin: auto;">
    <h2 class="service-title w3-padding-12 w3-center" style="letter-spacing: 2px;">
      <span class="selected_prog w3-padding">IM</span> Login
    </h2>

		<form class="w3-container" name="sign-in" action="auth.php" method="POST">
			<?php if (isset($_GET['auth_error'])): ?>
				<p class="warning w3-text-red" id="auth_error" style="">
					<i class="lnr lnr-warning"></i> The username and password don't match, please try again
				</p>
			<?php elseif (isset($_GET['pass_reset'])): ?>
		    <div class="w3-panel w3-green w3-animate-left" id="msgbox">
		      <h3>
		        <span>
		        	<i class="icon-done" style="vertical-align: -3px"></i>
		        	&nbsp;Password updated successfully!
		        </span>&nbsp;&nbsp;
		       	<span onclick="this.parentElement.style.display='none'" class="w3-closebtn">&times;</span>
		    	</h3>
		    </div> 
			<?php endif ?>
		  <p>
		  <label class="w3-label w3-validate">Username</label>
		  <input class="w3-input" id="username" type="username" name="username" required></p>
		  <p style="margin-top:50px;">
		  <label class="w3-label w3-validate">Password</label>
		  <a href="password-reset.php" class="w3-right w3-text-blue" style="letter-spacing: 2px;text-decoration: none;"><i class="icon-edit"></i> Forgot password?</a>
		  <input class="w3-input" type="password" name="pass" autocomplete="off" required></p>
		  <button class="w3-btn-block w3-blue" style="height: 50px;margin-top: 50px;letter-spacing: 2px;">Sign in</button></p>
		</form>
	</section>

		<div id="signup-container" class="w3-display-container w3-panel w3-card w3-center" style="width:80%;margin:auto;">
			<p>New to <a href="index.php" class="w3-border w3-border-black w3-padding" style="text-decoration:none;">IM</a> <span class="w3-hide-small">Gym</span>? <a href="member-signup.php">Join us</a></p>
		</div>
</div>