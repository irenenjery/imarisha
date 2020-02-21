<?php 
echo '
<div class="w3-content w3-padding-64" style="max-width:1564px;margin-top: 50px;">
	<section id="member-signup-form" class="w3-panel w3-card-2 w3-padding-0" style="width:60%;margin: auto;">
		<div class="w3-container w3-black w3-center" style="letter-spacing: 2px;">
	  	<h2>Join <span class="w3-border w3-border-white w3-padding">IM</span> Gym</h2>
		</div>

		<form class="w3-container w3-padding" action="#" method="POST" name="signup" id="signup-form" onsubmit="validate();return false">
			<p>
				<input class="w3-input w3-validate" type="text" name="username" placeholder="username" id="username" required>
			</p>
			<p>
				<input class="w3-input" type="email" name="email" placeholder="email" id="email" required>
			</p>
			<p>
				<input class="w3-input" type="password" name="pass" placeholder="password" id="pass" oninput="validatePassword()" required>
			</p>
			<p>
				<input class="w3-input" type="password" name="pass2" placeholder="confirm password" id="pass2" onchange="validatePassword()" oninput="validatePassword()" required>
				<span class="warning w3-text-red" id="passwarning" style="visibility: hidden;">Passwords don\'t match</span>
			</p>
			<p>
				<select class="w3-select w3-border" name="program" id="program" style="text-transform: capitalize;">
				  <option value="" disabled selected>Select a program</option>
				  <option value="fitness">Fitness</option>
				  <option value="crossfit">Crossfit</option>
				  <option value="women-strength">Women Strength</option>
				  <option value="muscle">Muscle Building</option>
				  <option value="weightloss">Weight loss</option>
				  <option value="private">Private Training</option>
				</select>
			</p>
			<p>
			  <button type="submit" class="w3-btn-block w3-teal w3-large" style="">Register</button>
			  <!-- <submit class="w3-btn-block w3-teal w3-large" style="">Register</submit> -->
			</p>
		</form>
	</section>

	<section id="trainer-signup" class="w3-display-container w3-panel w3-card w3-center" style="width:80%;margin:auto;">
		<p>
			I want to <a href="become-trainer.php" class=" w3-bronze w3-padding" style="text-decoration:none;">Become a Trainer</a>
		</p>
	</section>
</div>';
?>