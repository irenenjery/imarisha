<?php require 'includes/helper_functions.php' ?>
<?php 
session_start();
if ( !isset($_SESSION['user']) ) {
  header('Location: index.php#sign-in');
}

date_default_timezone_set("Africa/Nairobi");
$user = $_SESSION['user'];
$sub_active = $_SESSION['sub_active'] = strtotime("now") < strtotime($user['sub_enddate']);
$sub_startdate = $_SESSION['sub_startdate'] = format_sqldate($user['sub_startdate']);
$sub_enddate = $_SESSION['sub_enddate'] = format_sqldate($user['sub_enddate']);
?>

<!-- db data -->
<?php require 'includes/db/getall_timetable.php' ?>

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
        <li><a href="#sessions">Sessions</a></li>
        <li><a href="#exercises">Exercises</a></li>
        <li><a href="#timetable">Schedule</a></li>
      </ul>

    <section id="profile" class="w3-right w3-display-right">
      <span style="font-size: 1.3em;vertical-align: 10%">
        <a href="member-home.php">
        	<?php if ( isset($_GET['welcome']) ): ?>
        		<span>Welcome</span>
        	<?php endif ?>
        	<?php echo $user['client_username']; ?>
        </a>
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
<header id="member_home" class="w3-display-container w3-content w3-center" style="max-width: 1500px;height: 200px;margin-top: 70px;">
  <div id="welcome" class="w3-display-middle w3-margin-top">
    <h1 class="w3-xxlarge">
    	<a href="member-settings.php" style="text-decoration:none;">
      Program <span class="w3-border w3-border-black w3-padding" style="text-transform: capitalize;">
      	<?php echo $user['client_sub_prog']; ?>
      </span><br>
      <?php date_default_timezone_set("Africa/Nairobi"); ?>
      <?php if ( $sub_active ): ?>
	      <sub class="w3-text-green">
	      	Active: ends <?php echo $sub_enddate; ?><br>
	      </sub>
      <?php else: ?>
      	<sub class="w3-text-red">Inactive since <?php echo $sub_enddate; ?></sub><br>
    	<?php endif ?>
    	</a>
    </h1>
  </div><!-- div#welcome -->
</header><!-- header#member_home -->


<!-- Page Content -->
<div class="w3-content w3-padding" id="homepage-content" style="">
  <!-- Schedule Section -->  
  <section class="service w3-container w3-padding-16" id="timetable">
    <h2 class="service-title w3-padding-12 w3-center">
      YOUR PROGRAM SCHEDULE
    </h2>
    <div class="w3-row-padding" id="days-list">
      <?php require 'includes/views/function_generate_tt.php' ?>
      <?php generateTt($timetable_data, $user['client_prog_id']) ?>
    </div>
  </section><!-- section#schedule -->
  <!-- Schedule Workout -->  
  <section class="service w3-container w3-padding-16" id="sessions">
    <h2 class="service-title w3-padding-12 w3-center">
      WORKOUT SESSIONS
    </h2>
    <div class="w3-row-padding" id="days-list">
      <article class="w3-col l4" style="height: 240px;overflow: hidden;">
        <video width="100%" height="240" controls>
          <source src="public/videos/mov_bbb.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </article> 
      <article class="w3-col l4"  style="height: 240px;">
        <video width="100%" height="240" controls>
          <source src="public/videos/You Gon Learn to Swim Today Thug Life.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </article>   
      <article class="w3-col l4" style="height: 240px;">
        <video width="100%" height="240" controls>
          <source src="public/videos/movie.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </article>    
    </div>
  </section>
  <!-- Schedule Recommended -->  
  <section class="service w3-container w3-padding-16" id="exercises">
    <h2 class="service-title w3-padding-12 w3-center">
      RECOMMENDED EXERCISES
    </h2>
    <p>Follow the sets described in that order</p>
    <ol class="w3-row-padding">
      <li class="probootstrap-program w3-col l4">
        <h3>DIP</h3>
        <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      </li>
      <li class="probootstrap-program w3-col l4">
        <h3>Bulgarian Split Squat</h3>
        <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      </li>
      <li class="probootstrap-program w3-col l4">
        <h3>DIP</h3>
        <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      </li>
      <li class="probootstrap-program w3-col l4">
        <h3>Russian Twist</h3>
        <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      </li>
      <li class="probootstrap-program w3-col l4">
        <h3>Dumbbell Squat</h3>
        <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      </li>
      <li class="probootstrap-program w3-col l4">
        <h3>Push Up</h3>
        <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      </li>
      <li class="probootstrap-program w3-col l4">
        <h3>Reverse Lunge</h3>
        <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      </li>
      <li class="probootstrap-program w3-col l4">
        <h3>Russian Twist</h3>
        <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      </li>
      <li class="probootstrap-program w3-col l4">
        <h3>Dumbbell Squat</h3>
        <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      </li>
      <li class="probootstrap-program w3-col l4">
        <h3>Push Up</h3>
        <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      </li>
      <li class="probootstrap-program w3-col l4">
        <h3>Reverse Lunge</h3>
        <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      </li>
    </ol>
  </section>
</div>

<!-- Footer -->
<?php require 'includes/views/footer.php'; ?>