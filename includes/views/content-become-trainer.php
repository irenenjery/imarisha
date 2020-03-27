<div class="w3-content w3-padding-64" id="trainer-signup-container" style="margin-top: 50px">
	<section id="trainer-signup" class="w3-padding-0 w3-border-left w3-border-bottom <?php if ($app_success) echo 'w3-green' ?> <?php if ($app_exists) echo 'w3-red' ?>" style="width: 70%;margin: auto;min-height: 300px">
    <h2 class="service-title w3-padding-12 w3-center" style="letter-spacing: 2px;">
      <span class="selected_prog w3-padding">IM</span> Trainer Application
    </h2>
		<?php if ($app_success): ?>
	    <div class="w3-panel w3-green w3-center" id="msgbox">
	      <h3><span>Application sent successfully!</span></h3>
	      <p>You will be contacted soon by our team for your appointment.</p>
	    </div> 
	  <?php elseif ($app_success === false): ?>
	    <div class="w3-panel w3-red w3-center" id="msgbox">
	      <h3><span>Something went wrong, please try again later!</span></h3>
	    </div> 
	  <?php elseif ($app_exists): ?>
	    <div class="w3-panel w3-center" id="msgbox">
	      <h3><span>Application already sent!</span></h3>
	    </div>
		<?php endif ?>
		<?php if ($app_success === null && !$app_exists): ?>
			<form class="w3-container" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" name="trainer-signup" id="trainer-form" enctype="multipart/form-data" style="padding: 10px 30px;">
				<h2 class="w3-text-bronze"><i class="icon-user"></i>&nbsp;&nbsp;Personal info</h2>
				<p>
					<p class='w3-half'>
						<input class="w3-input w3-validate" type="text" name="fname" placeholder="first name" id="fname" value="<?php echo $fname; ?>" required>
					</p>
					<p class='w3-half'>
						<input class="w3-input w3-validate" type="text" name="lname" placeholder="family name" id="lname" value="<?php echo $lname; ?>" required>
					</p>
				</p>
				<p>
					<input class="w3-input" type="email" name="email" placeholder="email" id="email" value="<?php if ($email) echo $email ?>" required>
				</p>
				<p>
					<input class="w3-input" type="number" name="phone" placeholder="phone" id="phone" value="<?php if ($phone) echo $phone ?>" size="10" required>
				</p>
				<h2 class="w3-text-bronze"><i class="icon-work"></i>&nbsp;&nbsp;Work Experience</h2>
				<p>
					<p><label for="resume">
						<i class="icon-file-pdf-o"></i>&nbsp;<b>Upload Resume(pdf only):</b>
					</label></p>
					<input class="w3-border w3-padding" type="file" name="resume" id="resume" required>
					&nbsp;<span><i>3mb max</i></span>
					<?php if (isset($file_type) && $file_type !== 'pdf'): ?>
						&nbsp;<span class="w3-text-red"><b><i class="icon-warning"></i> PDFs only</b></span>
					<?php elseif ($too_large): ?>
						<p class="w3-text-red"><b><i class="icon-warning"></i> File too large, only files < 3mb uploadable</b></p>
					<?php endif ?>
				</p>
				<p>
					<p><label for="exp">
						<i class="icon-handshake-o"></i>&nbsp;<b>Level of Experience:</b>
					</label></p>
					<select class="w3-select w3-border" name="exp" id="exp" required>
						<option value="intern" selected>None - Intern</option>
						<option value="beginner">Beginner - 2 years or less</i></option>
						<option value="intermediate">Intermediate - 3 to 5 years</option>
						<option value="pro">Pro - 6 to 10 years</option>
						<option value="guru">Guru - 10+ years</option>
					</select>
				</p>
				<p>
					<p><label for="specialty">
						<i class="icon-tasks"></i>&nbsp;<b>Specialty:</b>
					</label></p>
						<select class="w3-select w3-border" name="specialty" id="specialty" style="text-transform: capitalize;">
						  <option value="none" selected>None</option>
						  <?php foreach ($programs as $prog_id => $prog): ?>
	        			<?php if ( $prog_id == $user['client_prog_id']) continue;?>
						  	<option value="<?php echo $prog_id ?>">
						  		<?php echo $prog['prog_title'] ?>
						  	</option>
						  <?php endforeach ?>
						  <option value="other" selected>Other</option>
						</select>
				</p>
				<p style="margin-top: 50px;">
				  <button type="submit" class="w3-btn-block w3-bronze w3-large" style="letter-spacing: 3px;">
					  <i class="icon-send"></i>&nbsp;&nbsp;Send Application
					</button>
				</p>
			</form>
		<?php endif ?>
	</section>
</div>