<?php 
session_start();
if ( !isset($_SESSION['coach']) ) {
  header('Location: index.php#sign-in');
}
?>

<?php require 'includes/functions-helper.php' ?>
<?php require 'includes/db/functions-db.php' ?>
<?php require 'includes/db/connectdb-imarisha.php'; ?>

<?php 
date_default_timezone_set("Africa/Nairobi");
$days = array('mon', 'tue', 'wed', 'thur', 'fri', 'sat', 'sun');
$today = get_today();
if ( isset($_SESSION['wp-day']) ) {
	$wp_day = $_SESSION['wp-day'];
	unset($_SESSION['wp-day']);
} else {
	$wp_day = $today;
}

$coach = $_SESSION['coach'];
$coach_id = $coach['coach_id'];
$prog_id = $coach['coach_progs'][0];

$coach_prog = getPrograms($conn, "prog_id=$prog_id")[$prog_id];
$timetable_data = getTimetable($conn, "tt_prog_id=$prog_id");
$wp_data = getWorkoutplan($conn, $prog_id);
$exercises_data = getExercises($conn);
$coach_clients = get_trainees($conn, $coach);

mysqli_close($conn);
?>

<?php require "includes/views/generic-head.php"; ?>
<style type="text/css">
	html,body{font-family:"Century Gothic",Verdana,sans-serif;}
	h1,h2,h3,h4,h5,h6,.w3-slim,.w3-wide{font-family:"Century Gothic","Segoe UI",Arial,sans-serif}
	body{background-color: #ff99cc;}
</style>
</head>
<body>
<div id="coach-container" class="im-container">
	<div id="coach-content-container" class="w3-display-container w3-row w3-white w3-card-8">
		<section id="coach-content-left" class="im-sidenav">
			<article id="coach-left-top" class="w3-center">
				<div id="coach-profile-pic">
					<img class="w3-image" src="<?php echo 'public/images/'.$coach['coach_prof_pic'] ?>" alt="trainer">
				</div>
			</article>
			<article id="coach-left-menu" class="w3-center">
				<a href="coach-home.php" class="coach-menu-item w3-btn">
					<i class="ion-ios-home-outline"></i>
				</a>
				<a href="coach-calendar.php" class="coach-menu-item w3-btn coach-menu-item-active">
					<i class="ion-ios-calendar-outline"></i>
				</a>
				<a href="coach-videos.php" class="coach-menu-item w3-btn">
					<i class="ion-ios-videocam-outline"></i>
				</a>
				<a href="coach-settings.php" class="coach-menu-item w3-btn">
					<i class="ion-ios-settings"></i>
				</a>
				<a href="#" class="coach-menu-item w3-btn">
					<i class="ion-ios-people-outline"></i>
				</a>
				<div id="coach-menu-logo" class="coach-menu-item w3-display-bottommiddle">
					<span><b>IM</b></span>
				</div>
			</article>
		</section>
		<section id="coach-main-content" class="w3-display-container w3-row">
			<article id="coach-main-top">
				<div id="coach-main-top-dets">
					<h5 class="w3-padding-0 coach-profile-name">
						<span>Hey <?php echo $coach['coach_username'] ?></span>&nbsp;
		        <a class="coach-btn" href="logout.php" title="Logout">
		          <i class="ion-log-out"> </i>
		        </a> &nbsp;
		        <!-- <a class="coach-btn"  href="#" title="Account Settings">
		          <i class="ion-ios-settings"> </i>
		        </a> -->
					</h5>
					<div id="coach-work-details">
						<b><?php echo $coach['coach_role'] ?></b>, <span><?php echo $coach['coach_exp'] ?></span>&nbsp;
						<span class="w3-tag <?php echo 'tt-code'.$prog_id ?>"><?php echo $coach_prog['prog_title'] ?></span>
					</div>
				</div>
				<div class="add-video-btn w3-right">
					<button class="w3-btn w3-hover-none">
						<i class="ion-ios-videocam-outline" style="font-size: 1.3em; vertical-align: -2px"></i>&nbsp;&nbsp;Add training video
					</button>
				</div>
			</article>
      <article id="coach-sess-calendar" class="">
      	<section class="coach-sess-container w3-blue" style="border-radius: 40px;padding-bottom: 40px;">
      		<article id="coach-sess-top" class="w3-center w3-display-container">
      			<div id="coach-datetime-container">
	      			<h3 id="coach-time-now" class="w3-padding-0 show-inline-block" style="font-size: 2em">Now</h3>&nbsp;&nbsp;
	      			<div id="coach-date-container" class="show-inline-block" style="font-size: 16px">
		      			<span id="coach-date-today" class="">Today</span>,&nbsp;&nbsp;
		      			<div id="coach-trainee-count" class="show-inline-block" style="vertical-align: -2px">
		      				<i class="ion-ios-people-outline" style="font-size: 1.6em;"></i>&nbsp;
		      				<span style="vertical-align: 3px"><?php echo count($coach_clients) ?></span>
		      			</div>
							</div>
      			</div>
      		</article>
      		<article class="coach-calendar-sessions w3-row" style="margin-top: -15px">
      			<?php foreach ($days as $key => $day): ?>
		      		<article id="coach-sessions" class="w3-col l3 m6" style="height: 200px;">
	        			<div class="extable-singleday-container show-inline-block" style="">
		        			<div id="<?php echo $day ?>" class="coach-calendar-day w3-animate-opacity w3-btn w3-padding w3-card-2" style="font-weight: normal;" value="<?php echo $day ?>"><?php echo $day == $today ? 'Today' : $day ?></div>
		        		</div>
			          <?php 
				          $no_gym = $day == 'sun' || 
				          	!array_key_exists($day, $timetable_data) || 
				          	count($timetable_data[$day]) == 0; 
			          ?>
				        <?php if ($no_gym): ?>
			      			<div class="coach-session w3-display-container w3-center">
			      				<h3 class="coach-session-time" style="">
					            No Session
			      				</h3>
			      			</div>
		      			<?php else: ?>
			            <?php foreach ($timetable_data[$day] as $key => $session): ?>
				      			<div class="coach-session w3-display-container w3-center">
				      				<h3 class="coach-session-starttime">
				      					<?php echo substr($session['tt_starttime'], 0, 5) ?>
				      				</h3>
				      				<div class="coach-session-btn coach-session-record w3-display-topright">
				      					<i class="lnr lnr-camera-video"></i>
				      				</div>
				      				<div class="coach-session-btn coach-session-endtime w3-display-bottomleft">
				      					<span>
				      						<i class="ion-ios-stopwatch-outline"></i>&nbsp;
				      						<?php echo $session['tt_endtime'] - $session['tt_starttime'] ?> hr
			    							</span>
				      				</div>
				      			</div>
			            <?php endforeach ?>
			          <?php endif ?>
		      		</article>
      			<?php endforeach ?>
      		</article>
      	</section>
      </article>
		</section>
	</div>
</div>

<script>
	let time_now = document.getElementById('coach-time-now'),
			date_today = document.getElementById('coach-date-today');

	setInterval(() => {
		time_now.textContent = Date().slice(16, -28);
		date_today.textContent = Date().slice(0, 16);
	}, 1000);
</script>

</body>
</html>

<?php
function get_trainees($conn, $coach)
{	
	$coach_progs_str = "";
	foreach ($coach['coach_progs'] as $key => $prog) {
	  $coach_progs_str .= $coach_progs_str == "" ? "(" : " ,";
	  $coach_progs_str .= $prog;
	}
	$coach_progs_str .= ")";

	return getClients($conn, "client_prog_id IN $coach_progs_str");
} 
?>