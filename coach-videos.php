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
<body class="im-body">
<?php if (isset($_SESSION['changes_submitted'])): ?>
	<div id="extable-msgs" class="msgs-container show-block">
		<?php
			generate_status_msgbox_all();
		 	unset($_SESSION['changes_submitted']);
		?>
	</div>
<?php endif ?>

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
				<a href="coach-calendar.php" class="coach-menu-item w3-btn">
					<i class="ion-ios-calendar-outline"></i>
				</a>
				<a href="coach-videos.php" class="coach-menu-item w3-btn coach-menu-item-active">
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
      <article id="coach-main-left" class="w3-padding w3-col l9 w3-center">
      	<h1 class="w3-text-yellow" style="font-size: 3em;margin-top: 100px"><i class="icon2-traffic-cone"></i>&nbsp; UNDER CONSTRUCTION&nbsp; <i class="icon2-traffic-cone"></i></h1>
      </article>
      <article id="coach-sess-today" class="w3-col l3">
      	<section class="coach-sess-container w3-blue">
      		<article id="coach-sess-top" class="w3-center w3-display-container">
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
      		<article id="coach-sess-title" class="w3-center">
      			<h5>
      				<i class="lnr lnr-calendar-full"></i>&nbsp;&nbsp;Today's training sessions
      			</h5>
      		</article>
      		<article id="coach-sessions">
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
	let time_now = document.getElementById('coach-time-now'),
			date_today = document.getElementById('coach-date-today');

	setInterval(() => {
		time_now.textContent = Date().slice(16, -28);
		date_today.textContent = Date().slice(0, 16);
	}, 1000);

	let extable_msgs = document.getElementById('extable-msgs');
	if ( extable_msgs ) {
		setInterval(() => {
			hideElem(extable_msgs);
		}, 9700);
	}

  document.addEventListener('click', function(event) {
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

  	btnSelected.classList.add('active');
  	btnActive.classList.remove('active');
  	hideElem(extableFormShowing);
  	showElem(extableFormToshow, display='block');
  }
  function extableBtnHandler(event) {
    let target = event.target,
        targetTable = target.closest(".extable"),//action table
        targetRow = target.closest(".extable-row"),//action row
        trClasses = targetRow.classList,
        extableRowStud = targetTable.querySelector('.stud'),
        studExInstr = extableRowStud.querySelector(".extable-ex_instr"),
        //sequence string of wp_ids to delete
        deleteWpids = targetTable.querySelector('.delete-wp_ids'),
        deleteWpidsStr = deleteWpids.value,
        //exercise data
        exInstr = targetRow.querySelector(".extable-ex_instr"),
        //buttons
        btn = target.closest(".extable-btn"),
        btnClasses = btn.classList,
        //editing buttons
        btnEdits = targetRow.querySelector(".extable-btn-edits"),
        btnDefault = targetRow.querySelector(".extable-btn-default"),
        btnEditing = targetRow.querySelector(".extable-btn-editing"),
        btnEdited = targetRow.querySelector(".extable-btn-edited"),
        //delete buttons
        btnDels = targetRow.querySelector(".extable-btn-dels"),
        btnDelete = targetRow.querySelector(".extable-btn-delete"),
        //confirm delete buttons
        btnConfirm = targetRow.querySelector(".extable-confirm-delete"),
        btnCancelDelete = targetRow.querySelector(".extable-btn-cancel-delete"),
        btnConfirmDelete = targetRow.querySelector(".extable-btn-confirm-delete");

    if ( btnClasses.contains("extable-btn-submit") ) {
      submitHandler(event, targetTable, deleteWpids);
    } else if ( btnClasses.contains("extable-btn-default") || 
      btnClasses.contains("extable-btn-edited") ) {//default|edited -> editing
      hideElem(btn);
      showElem(btnEditing);

      trClasses.remove('edited-elem');
      trClasses.add('editing-elem');

      exInstr.removeAttribute('readonly');
    } else if ( btnClasses.contains("extable-btn-editing") ) {//editing -> edited
      hideElem(btn);
      showElem(btnEdited);

      trClasses.remove('editing-elem');
      if ( !trClasses.contains('new-elem') ) trClasses.add('edited-elem');

      exInstr.value = exInstr.value || studExInstr.value;
      exInstr.setAttribute('readonly', 'true');
    } else if ( btnClasses.contains("extable-btn-delete") ) {//default|edited|editing -> deleting      
      hideElem(btnEdits);
      hideElem(btnDelete);
      showElem(btnConfirm);
      
      trClasses.add("deleting-elem");
    } else if ( btnClasses.contains("extable-btn-cancel-delete") ) {//deleting -> default|edited|editing
      showElem(btnEdits);
      showElem(btnDelete);
      hideElem(btnConfirm);
      
      trClasses.remove("deleting-elem");
    } else if ( btnClasses.contains("extable-btn-confirm-delete") ) {//deleting -> deleted
      if (!trClasses.contains('new-elem')) {
        let wp_id = targetRow.querySelector('.extable-wp_id').value,
            delete_count_box = targetTable.querySelector('.delete-count');
        
        if ( deleteWpidsStr.length ) deleteWpidsStr += ',';
        deleteWpids.value = deleteWpidsStr + wp_id;//assumes wp_id exists and distinct
        
        ++delete_count_box.value;
      }
      targetRow.remove();
    } else if ( btnClasses.contains("extable-btn-add") ) {
      addExHandler(event, targetTable, extableRowStud);
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

    targetTable.closest('.extable-form').submit();
  }
  function addExHandler(event, targetTable=undefined, extableRowStud=undefined) {
    let target = event.target;
    targetTable = targetTable || target.closest(".extable");//action table
    let targetRow = target.closest(".extable-row"),//action row
        selectEx = targetRow.querySelector(".extable-select-ex"),
        selectExErrClasses = targetRow.querySelector(".select-ex-error").classList;

    if (selectEx.value == 'none') {
      selectExErrClasses.remove('hide');
      return;
    }
    selectExErrClasses.add('hide');

     extableRowStud = extableRowStud || targetTable.querySelector('.stud');
     let newExRow = extableRowStud.cloneNode(true),
        newExTitle = newExRow.querySelector('.extable-ex_title'),
        newExId = newExRow.querySelector('.extable-ex_id'),
        newExInstr = newExRow.querySelector('.extable-ex_instr'),
        studExInstr = extableRowStud.querySelector('.extable-ex_instr'),
        addInstr = targetRow.querySelector(".extable-add-instr"),
        selectedExOption = selectEx.options[selectEx.selectedIndex],
        rowSubmit = targetTable.querySelector(".extable-row-submit");//one per table

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
	$msgbox_class = "msgbox-" . ($success ? 'success' : 'fail');
	$msgbox_icon_class = $success ? 'icon-done' : 'ion-ios-close-outline';
	echo "
	<div class='msgbox $msgbox_class show-inline-block w3-animate-zoom' id=''>
		<div class='msg show-inline-block w3-padding' style='font-size: 18px'>
      <span>
      	<i class='$msgbox_icon_class' style='vertical-align: -2px'></i>
      	&nbsp;&nbsp;$msg
      </span>&nbsp;&nbsp;
	  </div>
   	<div class='closebtn show-inline-block w3-padding'>
   		<i class='ion-ios-close-outline' style='font-size: 1.2em'></i>
   	</div>
	</div>  ";
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