<?php 
session_start();
$user = $_SESSION['user'];
?>

<?php require 'includes/db/connectdb_imarisha.php'; ?>
<?php require 'includes/db/db_functions.php' ?>

<?php 
$programs = getPrograms($conn);
mysqli_close($conn);
?>

<?php 
date_default_timezone_set("Africa/Nairobi");
$active = strtotime("now") < strtotime($user['sub_enddate']);
?>

<!-- HTML5 boilerplate -->
<?php require 'includes/views/head.php'; ?>

<!-- Navbar (sit on top) -->
<section id="member_top" class="w3-top">
 	<article class="w3-navbar w3-display-container w3-white w3-wide w3-padding-8 w3-card-2">
    <section id="logo" class="w3-padding w3-display-left">
      <a href="member-home.php" class="w3-margin-left">
        <span class="w3-silver w3-padding"><b>IM</b></span> GYM
      </a>
		</section><!-- section#logo -->
      <ul class="w3-navbar w3-wide w3-display-middle w3-hide-medium w3-hide-small" style="display: inline-block;">
        <li><a href="member-home.php#sessions">Sessions</a></li>
        <li><a href="member-home.php#exercises">Exercises</a></li>
        <li><a href="member-home.php#timetable">Schedule</a></li>
      </ul>

    <section id="profile" class="w3-right w3-display-right">
      <span style="font-size: 1.3em;vertical-align: 10%">
        <?php echo $user['client_username']; ?>
      </span>
      <div class="w3-padding" style="display: inline-block;letter-spacing: normal;font-size: 1.4em;">
        <a href="logout.php" title="Logout">
          <i class="lnr lnr-exit"> </i>
        </a> &nbsp;&nbsp;
        <a href="member-settings.php" title="Account Settings">
          <i class="lnr lnr-cog"> </i> 
        </a>
      </div>
    </section><!-- section#profile -->
  </article><!-- article.w3-navbar -->
</section><!-- section.w3-top -->

<!-- Header -->
<header id="member_home" class="w3-display-container w3-content w3-center" style="max-width: 1500px;height: 250px;">
  <div id="welcome" class="w3-display-middle w3-margin-top">
    <h1 class="w3-xxlarge">
      Program <span class="w3-border w3-border-black w3-padding" style="text-transform: capitalize;">
      	<?php echo $user['client_sub_prog']; ?>
      </span><br>
      <?php if ( $active ): ?>
	      <sub class="w3-text-green">
	      	Active: ends <?php echo $user['sub_enddate']; ?><br>
	      </sub>
      <?php else: ?>
      	<sub class="w3-text-red">Inactive since <?php echo $user['sub_enddate'];?></sub><br>
    	<?php endif ?>
    </h1>
  </div><!-- div#welcome -->
</header><!-- header#member_home -->

<!-- Page Content -->
<div class="w3-content w3-padding" id="homepage-content">
  <section class="service w3-row-padding">
    <article class="w3-col l6 w3-card-2" id="subscription">
      <h2 class="service-title w3-padding-12 w3-center">
        Subscription details
      </h2>
      <table class="w3-padding" style="width: 70%;margin: auto;margin-top: -20px;text-transform: capitalize;">
        <tr>
        	<td>Program:</td>
        	<td><?php echo $user['client_sub_prog'] ?></td>
        </tr>
        <tr>
        	<td>Price:</td>
        	<td>ksh <?php echo number_format($programs[$user['client_prog_id']]['prog_price'])?> per month</td>
        </tr>
        <tr>
        	<td>Status:</td>
        	<?php if ( $active ): ?>
        		<td class="w3-text-green">active</td>
        	<?php else: ?>
        		<td class="w3-text-red">inactive</td>
        	<?php endif ?>
        </tr>
        <?php if ( $active ): ?>
	        <tr>
	        	<td>Subscription start date:</td>
	        	<td><?php echo $user['sub_startdate'] ?></td>
	        </tr>
	        <tr>
	        	<td>Subscription end date:</td>
	        	<td><?php echo $user['sub_enddate'] ?></td>
	        </tr>
        <?php endif ?>
      </table>
      <form class="w3-padding" id="change_prog">
        <p class="">You can request a change in program...</p>
        <ul id="program-list">
        	<?php foreach ($programs as $key => $prog): ?>
        		<?php 
        			if ( $prog['prog_id'] == $user['client_prog_id']) continue;
        			$p_id = $prog['prog_id'];
        			$p_title = $prog['prog_title'];
        			$p_price = $prog['prog_price'];
        			$p_descr = $prog['prog_descr'];
        		?>
	          <label for="<?php echo $p_id?>">
	            <li class="prog w3-hover-shadow w3-tag w3-padding w3-white w3-border w3-border-green">
	              <h4>
	              	<input type="radio" name="prog" value="<?php echo $p_id?>" id="<?php echo $p_id?>" data-prog>
	              	<?php echo $p_title?> - ksh <?php echo number_format($p_price); ?> per month
	              </h4>
	              <p><?php echo $p_descr?></p>
	            </li>
	          </label>
        	<?php endforeach ?>
        </ul>
      </form>
    </article>    
    <article class="w3-col l6" id="account">
      <h2 class="service-title w3-padding-12 w3-center">
        Account Details
      </h2>
      <form class="w3-container w3-padding" style="margin-top: -50px">
        <p>
        	<label for="name">Full name</label>
        	<input class="w3-input w3-validate" type="text" name="lname" placeholder="name" id="name" value="<?php echo $user['client_name'] ?>" disabled>
        <p>
        	<label for="username">Username</label>
          <input class="w3-input w3-validate" type="text" name="username" value="<?php echo $user['client_username'] ?>" id="username" disabled>
        </p>
        <p>
        	<label for="email">Email</label>
          <input class="w3-input" type="email" name="email" value="<?php echo $user['client_email'] ?>" id="email">
        </p>
        <p>
        	<label for="pass">Change password</label>
          <input class="w3-input" type="password" name="pass" placeholder="new password" id="pass" oninput="validatePassword()">
        </p>
        <p>
          <input class="w3-input" type="password" name="pass2" placeholder="confirm password" id="pass2" onchange="validatePassword()" oninput="validatePassword()">
          <span class="warning w3-text-red" id="passwarning" style="visibility: hidden;">Passwords don't match</span>
        </p>
        <p>
          <p>Change program to</p>
					<select class="w3-select w3-border" name="prog_id" id="programs" style="text-transform: capitalize;" required>
					  <option disabled selected>Select a program</option>
					  <?php foreach ($programs as $key => $prog): ?>
        			<?php if ( $prog['prog_id'] == $user['client_prog_id']) continue;?>
					  	<option value="<?php echo $prog['prog_id'] ?>">
					  		<?php echo $prog['prog_title'] ?>
					  	</option>
					  <?php endforeach ?>
					</select>
        </p>
        <p>
          <button type="submit" class="w3-btn-block w3-teal w3-large" style="">Change details</button>
          <!-- <submit class="w3-btn-block w3-teal w3-large" style="">Register</submit> -->
        </p>
      </form>
    </article>   
  </section> 
</div>

<!-- Footer -->
<?php require 'includes/views/footer.php'; ?>
<script>
	'use strict';
	let change_prog = document.getElementById('change_prog'),
			;
	change_prog.addEventListener('click', function(event) {
		if ( event.target.dataset.prog != undefined ) {
			let selected_prog = event.target.value;
		}
	})
</script>