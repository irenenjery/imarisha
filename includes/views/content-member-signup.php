<div class="w3-content w3-padding-16" id="member-signup-container">
	<section class="w3-row-padding">
		<article class="w3-col l6" id="signup-section" style="">
			<section id="member-signup" class="w3-panel w3-padding">
	      <h2 class="service-title w3-padding-12 w3-center">
	        Join <span class="w3-border w3-border-black w3-padding">IM</span> Gym
	      </h2>
				<form onsubmit='validate(); return false' class="w3-container w3-padding" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" name="signup" id="signup-form">
					<span class="warning w3-text-red" id="form_warning" style="display: none;">
						Please fill in all fields using valid info.
					</span>
					<p>
						<select class="prog-select w3-select w3-border" name="prog_id" id="prog-select" style="text-transform: capitalize;display: inline-block;width: 90%" required>
						  <option disabled selected>Select a program</option>
						  <?php foreach ($programs_data as $prog_id => $program): ?>
								<?php 
									$preselected = (isset($_GET['prog_id']) && $prog_id == $_GET['prog_id'])
										|| (isset($_POST['prog_id']) && $prog_id == $_POST['prog_id'])
										? $prog_id : false;
								?>
						  	<option value="<?php echo $prog_id ?>" <?php if (isset($_POST['prog_id']) && $_POST['prog_id'] == $prog_id) echo 'selected' ?>>
						  		<?php echo $program['prog_title'] ?>
						  	</option>
						  <?php endforeach ?>
						</select>&nbsp;
						<a href="#<?php if( isset($preselected) && $preselected ) echo "prog" . $preselected ?>" id="prog-more" style="text-decoration: none;"><i class="lnr lnr-question-circle"></i></a>
					</p>
					<p>
						<p class='w3-half'>
							<input class="w3-input w3-validate" type="text" name="fname" placeholder="first name" id="fname" value="<?php echo $fname; ?>" required>
						</p>
						<p class='w3-half'>
							<input class="w3-input w3-validate" type="text" name="lname" placeholder="family name" id="lname" value="<?php echo $lname; ?>" required>
						</p>
					</p>

					<p>
						<input class="w3-input" type="text" name="username" placeholder="username" id="username" value="<?php if ($username && !$username_error) echo $username?>" required>
						<?php if ( $username_error ): ?>
							<span id="username_warning" class="warning w3-text-red">
								<?php echo "username '<strong>$username</strong>' unavailable"; ?>
							</span>
						<?php endif ?>
					</p>
					<p>
						<input class="w3-input" type="email" name="email" placeholder="email" id="email" value="<?php if ($email && !($invalid_email_error || $email_error)) echo $email ?>" required>
						<?php if ( $invalid_email_error ): ?>
							<span class="warning w3-text-red">Invalid email</span>
						<?php endif ?>
						<?php if ( $email_error ): ?>
							<span class="warning w3-text-red">
								<?php echo "email '<strong>" . $email . "</strong>' already exists"; ?>
							</span>
						<?php endif ?>
					</p>
					<p>
						<input class="w3-input" type="password" name="pass" placeholder="password" id="pass" oninput="validate_password()" required>
					</p>
					<p>
						<input class="w3-input" type="password" name="pass2" placeholder="confirm password" id="pass2" oninput="validate_password()" required>
						<span class="warning w3-text-red" id="pass_warning" style="visibility: hidden;">Passwords don't match</span>
					</p>
					<p>
					  <button type="submit" class="w3-btn-block w3-teal w3-large">Register</button>
					</p>
				</form>
			</section>
			<section id="trainer-signup" class="w3-card w3-center w3-padding w3-wide" style="margin-top: 70px;">
				<p class="w3-panel">
					I want to <a href="become-trainer.php" class=" w3-bronze w3-padding" style="text-decoration:none;"><i class="ion-bowtie" style="vertical-align: -2px;font-size: 1.2em"></i>&nbsp;Become a Trainer</a>
				</p>
			</section>
		</article>
		<article class="w3-col l6" id="program-descr" style="margin-top: 30px;">
			<section class="w3-row">
			<?php foreach ($programs_data as $prog_id => $program): ?>
				<?php 
					$preselected = (isset($_GET['prog_id']) && $prog_id == $_GET['prog_id'])
						|| (isset($_POST['prog_id']) && $prog_id == $_POST['prog_id'])
				?>
				<div class="prog w3-col l6 w3-leftbar w3-bottombar w3-border-white w3-padding <?php echo $preselected ? 'selected_prog' : 'w3-black' ?> " id="prog<?php echo $prog_id ?>" style="height: 300px;">
					<h2 class="prog-title w3-padding-12 w3-center">
						<?php echo $program['prog_title'] ?>
					</h2>
					<p style="height: 90px;text-overflow: auto;"><?php echo $program['prog_descr'] ?></p>
					<p>
						<b>Price: </b> ksh <?php echo number_format($program['prog_price']) ?> per course <br>
						<b>Duration: </b> <?php echo $program['prog_duration'] ?> week course
					</p>
				</div>
			<?php endforeach ?>
			</section>
		</article>
	</section>
</div>