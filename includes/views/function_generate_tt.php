<?php 
//TODO: Mod for conditions. Consider JS for this
function generateTt($timetable_data, $prog_id=null)
{	
  foreach ($timetable_data as $tt_day => $classes) {
  	echo '
    <article class="tt-day w3-col l2" id=' . $tt_day . '>
      <h3 class="tt-day-title w3-red w3-padding w3-center">
        ' . $tt_day . '
      </h3>
      <!-- Color-coded session stamps -->';
      foreach ($classes as $key => $class) {
      	if ($prog_id != null && $class['tt_prog_id'] != $prog_id) continue;
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
?>
