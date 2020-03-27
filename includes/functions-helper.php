<?php
/** Returns today as one of 'mon', 'tue', 'wed', 'thur', 'fri', 'sat', 'sun' */
function get_today()
{
  $days = array('mon', 'tue', 'wed', 'thur', 'fri', 'sat', 'sun');
  return $days[(getdate()['wday'] + 6)%7];
}
/** Generates a class timetable given a program and/or coach */
function generate_timetable($timetable_data, $prog_id=null, $coach_id=null)
{	
  foreach ($timetable_data as $tt_day => $classes) {
  	echo '
    <article class="tt-day w3-col l2" id=' . $tt_day . '>
      <h3 class="tt-day-title w3-padding w3-center">
        ' . $tt_day . '
      </h3>
      <!-- Color-coded session stamps -->';
      foreach ($classes as $key => $class) {
      	if ($prog_id != null && $class['tt_prog_id'] != $prog_id) continue;
        if ($coach_id != null && $class['tt_coach_id'] != $coach_id) continue;
      	echo '
        <div class="tt-session w3-padding w3-center tt-code'.$class['tt_prog_id'].'">
          <h5 class="tt-program w3-border-bottom w3-border-white" style="font-size: 0.9em">
            ' . $class['tt_program'] . '
          </h5>
          <p><span class="tt-trainer">
            ' . $class['tt_coach'] . '
          </span></p>
          <p class="w3-large"><span class="tt-time">
            ' . substr($class['tt_starttime'], 0, 5) . '
          </span></p>
        </div> <!-- div.tt-session-->';
    	}
    echo '
    </article><!-- article.tt-day -->';
  }     
}
/** Returns true is user is a coach */
function is_coach($username)
{
	return substr_compare(substr($username, 0, 1), '@', 0) == 0;
}
/** Formats SQL date as d.m.Y */
function format_sqldate($sqldate)
{
	return date('d.m.Y', strtotime($sqldate));
}
/** Redirects to the specified page */
function redirect($redirect_to, $urlparams)
{
	header("Location: " . $redirect_to . "?" . $urlparams);
}
/** Sanitizes input data for db access. */
function sanitize($data)
{
	if ( isset($data) ) {
		$data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	}
  return $data;
}
/** Sanitizes input email for db access. */
function sanitizeEmail($email)
{
	return filter_var($email, FILTER_SANITIZE_EMAIL);
}
?>