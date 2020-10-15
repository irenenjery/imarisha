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
<!DOCTYPE html>
<html lang="en-US">
<head>
<title>IMARISHA GYM</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php require "includes/views/stylesheets.php"; ?>
</head>
<body class="im-body">
<?php if (isset($_SESSION['changes_submitted'])): ?>
	<section id="extable-msgs" class="msgs-container show-block">
		<?php
			generate_status_msgbox_all();
		 	unset($_SESSION['changes_submitted']);
		?>
	</section>
<?php endif ?>
<div id="coach-container" class="im-container">
	<div id="coach-content-container" class="im-display-container">
		<section id="coach-content-left" class="im-sidenav">
			<article class="im-navtop">
				<img class="w3-image" alt="trainer" src="<?php echo 'public/images/'.$coach['coach_prof_pic'] ?>" >
			</article>
			<nav id="coach-left-menu" class="im-navmain">
				<a href="coach-home.php" class="im-nav-btn w3-btn active">
					<i class="ion-ios-home-outline"></i>
				</a>
				<a href="coach-calendar.php" class="im-nav-btn w3-btn">
					<i class="ion-ios-calendar-outline"></i>
				</a>
				<a href="coach-videos.php" class="im-nav-btn w3-btn">
					<i class="ion-ios-videocam-outline"></i>
				</a>
				<a href="coach-settings.php" class="im-nav-btn w3-btn">
					<i class="ion-ios-settings"></i>
				</a>
				<div id="coach-menu-logo" class="im-nav-logo">
					<span><b>IM</b></span>
				</div>
			</nav>
		</section>
		<section id="coach-main-content" class="im-main w3-row">
			<article id="coach-main-top" class="im-content-top">
				<div id="coach-main-top-dets" class="im-prof-box">
					<h5 class="coach-profile-name im-prof-name">
						<span>Hey <?php echo $coach['coach_username'] ?></span>&nbsp;
		        <a class="im-prof-btn" href="logout.php" title="Logout">
		          <i class="ion-log-out"> </i>
		        </a> &nbsp;
		        <a class="im-prof-btn"  href="#" title="Account Settings">
		          <i class="ion-ios-settings"> </i>
		        </a>
					</h5>
					<div id="coach-work-details" class="im-prof-summ">
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
      <article id="coach-main-left" class="im-content-main w3-col l9">
      	<div class="extable-header">
        	<h4 class="extable-title show-inline-block">Recommended Exercises</h4>
        	<div class="extable-days-container">
      			<div class="extable-singleday-container show-inline-block" style="">
        			<button id="<?php echo $today ?>" class="extable-tg-day 
        			<?php if ($today == $wp_day) echo 'active'; ?> w3-btn w3-padding w3-border-0 w3-card-2" value="<?php echo $today ?>"><?php echo 'Today'?></button>
        		</div>
        		<?php foreach ($days as $key => $day): ?>
        			<?php if ($day == $today) continue; ?>
        			<div class="extable-singleday-container show-inline-block" style="">
	        			<button id="<?php echo $day ?>" class="extable-tg-day <?php if ($day == $wp_day) echo 'active'; ?> w3-animate-opacity w3-btn w3-padding" value="<?php echo $day ?>"><?php echo $day ?></button>
	        		</div>
        		<?php endforeach ?>
        	</div>
      	</div>
      	<?php foreach ($days as $key => $day): ?>
	        <form id="<?php echo "extable-form-$day" ?>" class="extable-form <?php echo $day==$wp_day ? 'show-block' : 'hide' ?>" name="extable-form" method="POST" action="extable-mod.php">
	          <table id="" class="extable w3-table w3-animate-opacity">
	            <tbody>
	              <tr class="stud new-elem extable-row extable-row-exercise w3-animate-opacity">
	                <td class="extable-col extable-col-title">
	                  <div class="w3-input w3-border-0">
	                    <i class="icon2-pin"></i>&nbsp;&nbsp;
	                    <b class="extable-ex_title">No title</b>
	                    <input class="extable-wp_id" type="text" name="wp_id" value="" hidden>
	                    <input class="extable-ex_id" type="text" name="ex_id" value="" hidden>
	                  </div>
	                </td>
	                <td class="extable-col extable-col-instr">
	                	<textarea class="extable-ex_instr w3-input w3-border-0" name="ex_instr" maxlength=255 readonly>No instructions provided</textarea>
	                </td>
	                <td class="extable-col extable-col-actionbtns w3-center">
	                  <?php require 'includes/views/content-extable-col-actionbtns.php' ?>
	                </td>
	              </tr>              
	              <?php foreach ($wp_data[$day] as $key => $ex_day): ?>
	                <tr class="extable-row extable-row-exercise">
	                  <td class="extable-col extable-col-title">
	                    <div class="w3-input w3-border-0">
	                      <i class="icon2-pin"></i>&nbsp;&nbsp;
	                      <b class="extable-ex_title">
	                        <?php
	                          $wp_id = $ex_day['wp_id'];
	                          $ex_id = $ex_day['ex_id'];
	                          $ex_title = $exercises_data[$ex_id]['ex_title'];
	                          echo $ex_title;
	                        ?>
	                      </b>
	                      <input class="extable-wp_id" type="text" name="wp_id" value="<?php echo $wp_id ?>" hidden>
	                      <input class="extable-ex_id" type="text" name="ex_id" value="<?php echo $ex_id ?>" hidden>
	                    </div>
	                  </td>
	                  <td class="extable-col extable-col-instr">
	                    <!-- <input class="extable-ex_instr w3-input w3-border-0" type="text" name="ex_instr" value="<?php #echo $ex_day['wp_ex_details'] ?>" maxlength=255 readonly> -->
	                  	<textarea class="extable-ex_instr w3-input w3-border-0" name="ex_instr" maxlength=255 readonly data-og-value><?php echo $ex_day['wp_ex_details'] ?></textarea>
	                  </td>
	                  <td class="extable-col extable-col-actionbtns w3-center">
	                    <?php require 'includes/views/content-extable-col-actionbtns.php' ?>
	                  </td>
	                </tr>
	              <?php endforeach ?>
	              <tr class="extable-row extable-row-submit w3-white">
	                <td class="extable-col extable-col-submit-container" colspan="3">
	                  <!-- Hidden form data -->
	                  <input type="hidden" name="wp-day" value="<?php echo $day ?>">
	                  <input type="hidden" name="prog-id" value="<?php echo $prog_id ?>">
	                  <input class="insert-count" type="hidden" name="insert-count" value="0">
	                  <input class="update-count" type="hidden" name="update-count" value="0">
	                  <input class="delete-count" type="hidden" name="delete-count" value="0">
	                  <input class="delete-wp_ids" type="hidden" name="delete-wp_ids" value="">
	                  <!-- End of Hidden form data -->

	                  <div class="extable-btn w3-right extable-btn-submit show-inline-block">
	                    <button type="submit" class="w3-btn w3-green disabled" disabled><i class="icon-paper-plane" style="font-size: 0.8em"></i>&nbsp;&nbsp;Submit changes</button>
	                  </div>
	                </td>
	              </tr>
	              <tr class="extable-row extable-row-addExercise">
	                <td class="extable-col extable-col-select-ex">
	                  <select class="extable-select-ex w3-select w3-border" name="extable-select-ex">
	                    <option value="none" disabled selected>Add exercise</option>
	                    <?php foreach ($exercises_data as $ex_id => $ex): ?>
	                      <option value="<?php echo $ex_id ?>">
	                        <?php echo $ex['ex_title'] ?>                        
	                      </option>
	                    <?php endforeach ?>
	                  </select>
	                  <div class="select-ex-error w3-text-red hide">
	                    You must select an exercise
	                  </div>
	                </td>
	                <td class="extable-col extable-col-add-instr">
	                  <!-- <input class="extable-add-instr w3-input" type="text" placeholder="Add instructions e.g sets,reps"> -->
	                	<textarea class="extable-add-instr w3-input w3-border-0" maxlength=255 rows="2" placeholder="Add exercise instructions e.g sets, reps&nbsp;&nbsp;(max 255 chars)"></textarea>	
	                </td>
	                <td class="extable-col extable-col-addbtns w3-center">
	                  <div class="extable-btn extable-btn-add">
	                    <a class="w3-btn w3-text-green w3-border w3-border-green"><i class="icon2-pin"></i></a>
	                  </div>
	                </td>
	              </tr>
	            </tbody>
	          </table>
	        </form>
      	<?php endforeach ?>
      </article>
      <article id="coach-sess-today" class="im-content-right w3-col l3">
      	<section class="coach-sess-container w3-blue im-aside">
      		<article id="coach-sess-top" class="im-aside-top">
      			<div id="coach-datetime-container">
	      			<h3 id="coach-time-now" class="w3-padding-0" style="font-size: 2em">Now</h3>
	      			<div id="coach-date-container">
		      			<span id="coach-date-today" class="" style="vertical-align: 2px">Today</span>,&nbsp;&nbsp;
		      			<div id="coach-trainee-count" class="show-inline-block">
		      				<i class="ion-ios-people-outline" style="font-size: 1.6em;"></i>&nbsp;
		      				<span style="vertical-align: 2px"><?php echo count($coach_clients) ?></span>
		      			</div>
							</div>
      			</div>
      		</article>
      		<article id="coach-sess-title" class="im-aside-title">
      			<h5>
      				<i class="lnr lnr-calendar-full"></i>&nbsp;&nbsp;Today's training sessions
      			</h5>
      		</article>
      		<article id="coach-sessions" class="im-aside-content">
	          <?php 
		          $no_gym_today = $today == 'sun' || 
		          	!array_key_exists($today, $timetable_data) || 
		          	count($timetable_data[$today]) == 0; 
	          ?>
		        <?php if ($no_gym_today): ?>
	      			<div class="coach-session w3-display-container w3-center">
	      				<h5 class="coach-session-time" style="">
			            No Session
	      				</h5>
	      			</div>
      			<?php else: ?>
	            <?php foreach ($timetable_data[$today] as $key => $session): ?>
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
      	</section>
      </article>
		</section>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function(event) {
		let time_now = document.getElementById('coach-time-now'),
				date_today = document.getElementById('coach-date-today'),
				extable_msgs = document.getElementById('extable-msgs');

		setInterval(() => {
			time_now.textContent = Date().slice(16, -28);
			date_today.textContent = Date().slice(0, 16);
		}, 1000);

		if ( extable_msgs ) {
			setInterval(() => {
				hideElem(extable_msgs);
			}, 9800);
		}		
	});

  document.addEventListener("click", function(event) {
  	if ( event.target.closest(".extable-tg-day") ) {
      extableDayHandler(event);
    } else if ( event.target.closest(".extable-btn") ) {
      extableBtnHandler(event);
    } else if ( event.target.closest(".closebtn") ) {
      hideElem(event.target.closest(".msgbox"));
    }
  });

  function extableDayHandler(event) {
  	if (!event.target.closest('.extable-tg-day')) return;

  	let target = event.target,
  			btnSelected = target.closest('.extable-tg-day'),
  			daySelected = btnSelected.value,
  			coachMain = document.getElementById('coach-main-left'),
  			extableFormShowing = coachMain.querySelector('.extable-form.show-block'),
  			extableFormToshow = document.getElementById(`extable-form-${daySelected}`),
  			btnActive = coachMain.querySelector('.active');

  	if (btnActive == btnSelected) return;

  	//TODO: make fn; switchActiveBtn(btnSelected, btnActive)
  	btnSelected.classList.add('active');
  	btnActive.classList.remove('active');

  	hideElem(extableFormShowing);
  	showElem(extableFormToshow, display='block');
  }
  function extableBtnHandler(event) {
    let target = event.target;

    if ( target.closest(".extable-btn-submit") ) {
      submitHandler(event);
    } else if ( target.closest(".extable-btn-modes") ) {
    	modeTransitionHandler(event);
    } else if ( target.closest(".extable-btn-add") ) {
      addExHandler(event);
    }
  }
  function modeTransitionHandler(event) {
  	if (!event.target.closest(".extable-btn-modes")) return;

    let target = event.target,
        targetTable = target.closest(".extable"),//action table
        targetRow = target.closest(".extable-row"),//action row
        trClasses = targetRow.classList,
        extableRowStud = targetTable.querySelector(".stud"),
        studExInstr = extableRowStud.querySelector(".extable-ex_instr"),
        //target btn
        btn = target.closest(".extable-btn"),
        btnClasses = btn.classList,
        //submit button
        btnSubmit = targetTable.querySelector(".extable-btn-submit button");

    if ( btnClasses.contains("extable-btn-edit") ) {//default|edited -> editing
    	let defaultBtnMode = targetRow.querySelector(".extable-btn-mode-default"),
        	editBtnMode = targetRow.querySelector(".extable-btn-mode-edit"),
	        exInstr = targetRow.querySelector(".extable-ex_instr");

      hideElem(defaultBtnMode);
      showElem(editBtnMode);

      // trClasses.remove('edited-elem');
      trClasses.add('editing-elem');

      exInstr.removeAttribute('readonly');

      exInstr.dataset.OgValue = exInstr.value;
    } else if ( btnClasses.contains("extable-btn-confirm-edit") ) {//editing -> edited
    	let defaultBtnMode = targetRow.querySelector(".extable-btn-mode-default"),
        	editBtnMode = targetRow.querySelector(".extable-btn-mode-edit"),
	        exInstr = targetRow.querySelector(".extable-ex_instr");

      hideElem(editBtnMode);
      showElem(defaultBtnMode);

      trClasses.remove('editing-elem');
      exInstr.setAttribute('readonly', 'true');

      if ( exInstr.dataset.OgValue == exInstr.value ) return;//same as editing -> default
      //Dead code if no actual change made
      if ( !trClasses.contains('new-elem') ) trClasses.add('edited-elem');

      exInstr.value = exInstr.value || studExInstr.value;

    	//TODO: make fn;enableBtn(btn)
    	btnSubmit.classList.remove('disabled');
    	btnSubmit.removeAttribute('disabled');
    } else if ( btnClasses.contains("extable-btn-cancel-edit") ) {//editing -> default
    	let defaultBtnMode = targetRow.querySelector(".extable-btn-mode-default"),
        	editBtnMode = targetRow.querySelector(".extable-btn-mode-edit"),
	        //exercise data
	        exInstr = targetRow.querySelector(".extable-ex_instr");
	        
      hideElem(editBtnMode);
      showElem(defaultBtnMode);

      trClasses.remove('editing-elem');

      exInstr.value = exInstr.dataset.OgValue || studExInstr.value;
      exInstr.setAttribute('readonly', 'true');
    } else if ( btnClasses.contains("extable-btn-delete") ) {//default|edited -> deleting      
    	let defaultBtnMode = targetRow.querySelector(".extable-btn-mode-default"),
        	deleteBtnMode = targetRow.querySelector(".extable-btn-mode-delete");
	        
      hideElem(defaultBtnMode);
      showElem(deleteBtnMode);
      
      trClasses.add("deleting-elem");
    } else if ( btnClasses.contains("extable-btn-cancel-delete") ) {//deleting -> default|edited
    	let defaultBtnMode = targetRow.querySelector(".extable-btn-mode-default"),
        	deleteBtnMode = targetRow.querySelector(".extable-btn-mode-delete");
	        
      hideElem(deleteBtnMode);
      showElem(defaultBtnMode);
      
      trClasses.remove("deleting-elem");
    } else if ( btnClasses.contains("extable-btn-confirm-delete") ) {//deleting -> deleted
    	//TODO: when deleting a new row, submit btn remains active when no other activity
      if (!trClasses.contains('new-elem')) {
        let deleteWpids = targetTable.querySelector('.delete-wp_ids'),//sequence of wp_ids
		        deleteWpidsStr = deleteWpids.value,
        		wp_id = targetRow.querySelector('.extable-wp_id').value,
            delete_count_box = targetTable.querySelector('.delete-count');
        
        if ( deleteWpidsStr.length ) deleteWpidsStr += ',';
        deleteWpids.value = deleteWpidsStr + wp_id;//assumes wp_id exists and distinct
        
        ++delete_count_box.value;

    		btnSubmit.classList.remove('disabled');
    		btnSubmit.removeAttribute('disabled');
      }
      targetRow.remove();
    }
  }
  function submitHandler(event, targetTable=undefined) {
    event.preventDefault();

    targetTable = targetTable || event.target.closest(".extable");

    //Insert, Update, Delete
    let insert_count = update_count = 0,
        delete_count = targetTable.querySelector('.delete-count').value,
        deleteWpidsStr = targetTable.querySelector(".delete-wp_ids").value,
        new_rows = targetTable.querySelectorAll('tr.new-elem:not(.stud)'),
        edited_rows = targetTable.querySelectorAll('tr.edited-elem');

    for (let i = 0; i < new_rows.length; i++) {
      let row = new_rows[i];
      insert_count++;
      row.querySelector('.extable-ex_id').setAttribute('name', 'insert-ex_id-'+i);
      row.querySelector('.extable-ex_instr').setAttribute('name', 'insert-ex_instr-'+i);
    }

    for (let i = 0; i < edited_rows.length; i++) {
      let row = edited_rows[i];
      update_count++;
      row.querySelector('.extable-wp_id').setAttribute('name', 'update-wp_id-'+i);
      row.querySelector('.extable-ex_id').setAttribute('name', 'update-ex_id-'+i);
      row.querySelector('.extable-ex_instr').setAttribute('name', 'update-ex_instr-'+i);
    }

    if (insert_count == 0 && update_count == 0 && delete_count == 0) return;

    let insert_count_box = targetTable.querySelector('.insert-count'),
        update_count_box = targetTable.querySelector('.update-count');

    // alert(`Inserts: ${insert_count}, Updates: ${update_count}, Deletes: ${delete_count}`);
    insert_count_box.value = insert_count;
    update_count_box.value = update_count;

    targetTable.closest(".extable-form").submit();
  }
  function addExHandler(event, targetTable=undefined, extableRowStud=undefined) {
    let target = event.target,
    		targetRow = target.closest(".extable-row"),
        selectEx = targetRow.querySelector(".extable-select-ex"),
        selectExErrClasses = targetRow.querySelector(".select-ex-error").classList;

    if (selectEx.value == 'none') {
      selectExErrClasses.remove('hide');
      return;
    }
    selectExErrClasses.add('hide');
		
		targetTable = targetTable || target.closest(".extable");
    extableRowStud = extableRowStud || targetTable.querySelector(".stud");

    let btnSubmit = targetTable.querySelector(".extable-btn-submit button"),
    		newExRow = extableRowStud.cloneNode(true),
        newExTitle = newExRow.querySelector(".extable-ex_title"),
        newExId = newExRow.querySelector(".extable-ex_id"),
        newExInstr = newExRow.querySelector(".extable-ex_instr"),
        studExInstr = extableRowStud.querySelector(".extable-ex_instr"),
        addInstr = targetRow.querySelector(".extable-add-instr"),
        selectedExOption = selectEx.options[selectEx.selectedIndex],
        rowSubmit = targetTable.querySelector(".extable-row-submit");//one per table

  	//TODO: make fn;enableBtn(btn)
  	btnSubmit.classList.remove('disabled');
  	btnSubmit.removeAttribute('disabled');

    newExRow.classList.remove('stud');

    newExTitle.textContent = selectedExOption.textContent;

    newExId.value = selectEx.value;

    newExInstr.value = addInstr.value || studExInstr.value;     

    rowSubmit.before(newExRow);
  }
  function hideElem(elem) {
    elem.classList.remove('show-inline');
    elem.classList.remove('show-inline-block');
    elem.classList.remove('show-block');

    elem.classList.add('hide');
  }
  function showElem(elem, display='inline-block') {
    elem.classList.remove('hide');

    elem.classList.add(`show-${display}`);
  }
</script>

</body>
</html>

<?php 
function generate_status_msgbox_all() 
{
	$insert_status = isset($_SESSION['insert_status']) ? $_SESSION['insert_status'] : null;
	$update_status = isset($_SESSION['update_status']) ? $_SESSION['update_status'] : null;
	$delete_status = isset($_SESSION['delete_status']) ? $_SESSION['delete_status'] : null;
	
	generate_status_msgbox($insert_status);
	generate_status_msgbox($update_status);
	generate_status_msgbox($delete_status);
	
 	unset($_SESSION['insert_status']);
 	unset($_SESSION['update_status']);
 	unset($_SESSION['delete_status']);
}
function generate_status_msgbox($query_status)
{
	if ($query_status && $query_status['status_code']) {
		generate_msgbox_success($query_status['status_msg']);	
	} elseif ($query_status && !$query_status['status_code']) {
		generate_msgbox_fail($query_status['status_msg']);	
	}
}
function generate_msgbox($msg, $success=true)
{
	$msgbox_class = "im-msgbox-" . ($success ? 'success' : 'fail');
	$msgbox_icon_class = $success ? 'icon-done' : 'icon2-caution';
	echo "
	<article class='im-msgbox $msgbox_class'>
		<div class='im-msg'>
    	<i class='$msgbox_icon_class' style='font-size: 0.8em;'></i>
    	&nbsp;$msg
	  </div>
   	<button class='im-closebtn'>
   		<i class='ion-ios-close-outline' style='font-size: 1.2em'></i>
   	</button>
	</article>  ";
}
function generate_msgbox_success($msg)
{
	generate_msgbox($msg, true);
} 
function generate_msgbox_fail($msg)
{
	generate_msgbox($msg, false);
}
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