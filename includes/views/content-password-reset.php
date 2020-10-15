<div class="w3-content w3-padding-64" style="max-width: 1564px;margin-top: 50px;">
	<section id="reset" class="w3-display-container w3-panel w3-padding-0 w3-border-left w3-border-bottom" style="width: 60%;margin: auto;">
    <h2 class="service-title w3-padding-12 w3-center" style="letter-spacing: 2px;">
      <span class="selected_prog w3-padding">IM</span> Password Reset
    </h2>
    
		<form onsubmit="validate_form(); return false" class="w3-container w3-padding" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" name="reset" id="form-reset">
			<?php if ($update_successful === false): ?>
				<p>
					<span class="w3-text-red">
						<i class="lnr lnr-sad"></i> Something went wrong, please try again.
					</span>
				</p>
			<?php elseif ($authentic_user === false): ?>
				<p>
					<span class="w3-text-red">
						<i class="lnr lnr-warning"></i> Username and email you entered don't match, please try again.
					</span>
				</p>
			<?php elseif ($authentic_user): ?>
				<h3>
					<span class="w3-text-green">
						<i class="icon-verified_user"></i> User verified.
					</span>
				</h3>
			<?php endif ?>
			<p>
				<input class="w3-input <?php if ($authentic_user) echo 'w3-green' ?>" type="text" name="username" placeholder="username" id="username" value="<?php if ($username) echo $username?>" <?php echo $update_successful || ($authentic_user && $username) ? 'readonly' : 'required'?>>
			</p>
			<p>
				<input class="w3-input <?php if ($authentic_user) echo 'w3-green' ?>" type="email" name="email" placeholder="email" id="email" value="<?php if ($email) echo $email ?>" <?php echo $update_successful || ($authentic_user && $email) ? 'readonly' : 'required'?>>
			</p>
			<?php if ( !($authentic_user || $update_successful) ): ?>
	      <p>
			  	<button type="submit" class="w3-btn-block w3-yellow" style="height:50px;letter-spacing: 3px">
			  		<i class="icon-hand-stop-o"></i> Authenticate
			  	</button>
				</p>
			<?php endif ?>
      <?php if ($authentic_user && !$update_successful): ?>
	      <p>
	      	<label for="pass"><h4>Change password</h4></label>
	        <input class="w3-input" type="password" name="pass" placeholder="New password" id="pass" value="" oninput="validate_password()" autocomplete="off">
	      </p>
	      <p>
	        <input class="w3-input" type="password" name="pass2" placeholder="Confirm password" id="pass2" onchange="validate_password()" oninput="validate_password()">
	        <span class="warning w3-text-red" id="passwarning" style="visibility: hidden;">Passwords don't match</span>
	      </p>
	      <p>
			  	<button type="submit" class="w3-btn-block w3-teal" style="height:50px;letter-spacing: 3px;">
			  		<i class="icon-redo"></i> Reset Password
			  	</button>
				</p>
			<?php elseif ($update_successful): ?>
		    <div class="w3-panel w3-green msgbox" id="">
		      <h3 class="w3-center">
		      	<i class="icon-beenhere"></i>&nbsp;&nbsp;<span>Password updated successfully!</span></h3>
		    </div> 
      <?php endif ?>
		</form>
	</section>
</div>