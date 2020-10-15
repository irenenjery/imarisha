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

$coach_id = $_SESSION['coach']['coach_id'];
$coach = getCoaches($conn, "cw.coach_id=".$coach_id)[$coach_id];
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
	h1,h2,h3,h4,h5,h6,.w3-slim,.w3-wide{font-family: "Century Gothic","Segoe UI",Arial,sans-serif}
	body{background-color: #ff99cc;}
  #coach-edit-profile{margin: auto;height: 140px;}
  #coach-edit-pic{border-radius: 30px;height: inherit;overflow:hidden;background: url(public/images/default_coach.jpg);}
  #coach-pic{width: 208px;height: 140px;border-radius: inherit;}
  .pic-btn-container{width:75%; margin-bottom: 15px;}
  .pic-btn{color: white;font-size: 1em;}
  .pic-btn-edit a,.pic-btn-edit button{background: rgba(62, 193, 95, 0.9);}
  .pic-btn-delete a,.pic-btn-delete button{background: rgba(244, 67, 54, 0.9);}
  #coach-edit-about{height: inherit;border-radius: 30px;background-color: #eef4f7;}
  #coach-about-container{padding: 20px;}
  #coach-about{height: 85px;}
  .coach-about-btn{height: 50%;}
  .coach-about-btn-mode{height: inherit;padding: 10px 0;}
  .coach-pass-and-dets{margin-top: 40px;border-radius: 40px;}
  #coach-edit-password{border-radius: inherit;}
  .pass-box{background-color: inherit;border-radius: inherit;width: 250px;letter-spacing: 1px;}
  .pass-box-current{background-color: #323232;}
  .pass-box-new{margin-top: 15px;}
  .lock{font-size: 1.3em;width: 20px;margin-top: 7px;margin-left: 12px;color: white;position: absolute;}
  .pass-setting{width: 220px;margin-right: -5px;border: none;border-radius: inherit;padding: 10px 50px 10px 20px;background-color: #ebebeb!important;}
  .toggle-eye{font-size: 1.8em;position: absolute;right: 0px;top: 1.8px;padding: 0 10px;border-radius: inherit;color: #323232;cursor: pointer;}
  #submit-pass{position: absolute;right: -70px;top: 4px;color: white;border-radius: 40px;}
  #coach-dets-container{font-family: 'Courier New';padding-left: 40px;}
  .coach-dets-header{font-family: inherit;text-transform: uppercase;font-weight: bold;}
  .coach-dets{font-size: 18px;padding-top: 16px;line-height: 1.2;}
  .coach-dets-person{font-weight: bold;text-transform: capitalize;}
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
	<div id="coach-content-container" class="im-display-container">
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
				<a href="coach-videos.php" class="coach-menu-item w3-btn">
					<i class="ion-ios-videocam-outline"></i>
				</a>
				<a href="coach-settings.php" class="coach-menu-item w3-btn coach-menu-item-active">
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
      <article id="coach-sess-today" class="w3-col l3" style="margin-top: 50px">
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
              <h5 class="coach-session-time">
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
      <form id="coach-settings" name="coach-settings" method="POST" action="test2.php"  autocomplete="off" class="w3-padding w3-col l9">
        <input id="coach-setting" type="text" name="coach-setting" value="" hidden>
      	<section id="coach-edit-profile" class="w3-row">
          <article id="coach-edit-pic" class="w3-col l3 w3-display-container">
            <!-- Profile pic -->
            <img id="coach-pic" class="w3-image w3-display-middle" src="<?php echo 'public/images/'.$coach['coach_prof_pic'] ?>" alt="trainer">
            <!-- Profile pic btns -->
            <section class="pic-btn-container w3-display-bottommiddle hide">
              <!-- Edit btn -->
              <div class="pic-btn pic-btn-edit im-btn-round w3-animate-zoom show-inline-block">
                <a class="w3-padding w3-btn">
                  <i class="lnr lnr-pencil"></i>
                </a>&nbsp;
              </div><!-- div.pic-btn-edit -->
              <!-- Delete btn -->
              <div class="pic-btn pic-btn-delete im-btn-round w3-animate-zoom show-inline-block w3-right">
                <a class="w3-padding w3-btn">
                  <i class="lnr lnr-trash"></i>
                </a>                   
              </div><!-- div.pic-btn-delete -->
            </section><!-- section.pic-btn-container  -->
          </article>
          <article id="coach-edit-about" class="w3-row-padding w3-col l8">
            <div id="coach-about-container" class="w3-col l10 m10 s10">
              <textarea id="coach-about" class="im-textarea w3-input w3-border-0" name="coach-about" placeholder="Add a profile description (max chars 140)" maxlength="140" readonly data-og-value="<?php echo $coach['coach_prof'] ?>"><?php echo $coach['coach_prof'] ?></textarea>
            </div>
            <div class="w3-col l2 m2 s2" style="height: inherit;">
              <section class="coach-about-btn-container w3-display-container w3-padding" style="height: inherit;">
                <!-- Default mode -->
                <section class="coach-about-btn-mode coach-about-btn-mode-default">
                  <!-- Delete btn -->
                  <div class="im-btn-round coach-about-btn coach-about-btn-delete w3-animate-zoom show-block">
                    <button type="button" class="w3-padding w3-btn" style="background: rgba(244, 67, 54, 0.9);color: white;font-size: 1.1em">
                      <i class="lnr lnr-trash"></i>
                    </button>&nbsp;                  
                  </div><!-- div.coach-about-btn-delete -->
                  <!-- Edit btn -->
                  <div class="im-btn-round coach-about-btn coach-about-btn-edit w3-animate-zoom show-block">
                    <a class="w3-padding w3-btn w3-border w3-border-grey w3-text-grey">
                      <i class="icon2-quill" style="vertical-align: 1px"></i>
                    </a>&nbsp;
                  </div> <!-- div.coach-about-btn-edit -->
                </section>
                <!-- Edit mode -->
                <section class="coach-about-btn-mode coach-about-btn-mode-edit hide">
                  <!-- Cancel edit btn -->
                  <div class="im-btn-round coach-about-btn coach-about-btn-cancel-edit w3-animate-zoom show-block">
                    <a class="w3-padding w3-btn w3-border w3-border-grey w3-text-grey">
                      <i class="lnr lnr-cross"></i>
                    </a>&nbsp;
                  </div><!-- div.coach-about-btn-cancel-edit -->
                  <!-- Confirm edit btn -->
                  <div class="im-btn-round coach-about-btn coach-about-btn-confirm-edit w3-animate-zoom show-block">
                    <button type="submit" class="w3-padding w3-btn w3-green w3-border w3-border-green w3-card-8 disabled" disabled>
                      <i class="icon2-check" style="vertical-align: 0.5px"></i>
                    </button>&nbsp;
                  </div><!-- div.coach-about-btn-confirm-edit -->
                </section>
                <!-- Delete mode -->
                <section class="coach-about-btn-mode coach-about-btn-mode-delete hide">
                  <!-- Cancel delete btn -->
                  <div class="im-btn-round coach-about-btn coach-about-btn-cancel-delete w3-animate-zoom show-block">
                    <a class="w3-padding w3-btn w3-text-green w3-border w3-border-green">
                      <span style="vertical-align: 2px">No</span>
                    </a>&nbsp;                    
                  </div><!-- div.coach-about-btn-cancel-delete -->
                  <!-- Confirm delete btn -->
                  <div class="im-btn-round coach-about-btn coach-about-btn-confirm-delete w3-animate-zoom show-block">
                    <button type="submit" class="w3-padding w3-btn" style="background: rgba(244, 67, 54, 0.9);">
                      <span style="vertical-align: 2px">Del</span>
                    </button>&nbsp;                    
                  </div><!-- div.coach-about-btn-confirm-delete -->
                </section>
              </section>
            </div>
         </article>
        </section>
        <section class="coach-pass-and-dets w3-row-padding">
          <article id="coach-edit-password" class="w3-col l5">
            <article class="pass-box pass-box-current w3-display-container show-inline-block">
              <div class="lock show-inline-block w3-center">
                <i class="lnr lnr-lock"></i>
              </div>
              <input id="pass-current" type="password" name="pass-current" class="pass-setting pass-current w3-right w3-card-4" placeholder="current password">
              <div class="toggle-eye toggle-eye-disabled show-inline-block">
                <i class="ion-eye-disabled"></i>
              </div>
            </article>
            <article class="pass-box pass-box-new w3-display-container show-inline-block">
              <input id="pass-new" type="password" name="pass-new" class="pass-setting pass-new w3-right w3-card-8" placeholder="new password">
              <div class="toggle-eye toggle-eye-disabled show-inline-block">
                <i class="ion-eye-disabled"></i>
              </div>
              <button id="submit-pass" type="submit" class="show-inline-block w3-green w3-btn w3-padding disabled" disabled>
                <i class="icon-paper-plane"></i>
              </button>
            </article>
            <article class="pass-warning hide">
              <p class="pass-warning-missing w3-text-red hide"><i class="icon2-grin" style="vertical-align: 1px"></i>&nbsp;&nbsp;Please remember to enter your current password</p>
              <p class="pass-warning-match w3-text-red hide"><i class="icon2-wondering" style="vertical-align: 1px"></i>&nbsp;&nbsp;Those two look quite similar don't you think?</p>
              <p class="pass-warning-short w3-text-red hide"><i class="icon2-sad" style="vertical-align: 1px"></i>&nbsp;&nbsp;Password too short buddy, try more than 8 chars</p>
            </article>
            <article class="pass-valid hide">
              <p class="pass-warning-match w3-text-green"><i class="icon2-thumbs-up" style="vertical-align: 1px"></i>&nbsp;&nbsp;Yap, that'll do.</p>
            </article>
          </article>
          <article id="coach-dets-container" class="w3-col l7">
            <h3 class="coach-dets-header">Agent Profile</h3>
            <div class="coach-dets">
              <span class="coach-dets-person">
                <?php echo $coach['coach_name'] ?>,
                <?php echo $coach['coach_gender'] == 'f' ? 'female' : 'male' ?>,
                born <?php echo $coach['coach_dob'] ?>&nbsp;
              </span><br>
              <span>
                <b>Occupation:</b> Gym instructor, IMARISHA
              </span><br>
              <span style="text-transform: capitalize;">
                <b>Rank:</b> <?php echo $coach['coach_exp'] ?>
              </span><br>
              <span>
                <b>Role:</b> <?php echo $coach['coach_role'] ?>
              </span><br>
              <span>
                <b>Psych Eval:</b> <span style="text-decoration: line-through;">Being conducted</span> Fit for duty
              </span><br>
            </div>
          </article>
        </section>
      </form>
		</section>
	</div>
</div>

<script>
  document.addEventListener("input", function(event) {
    if ( event.target.id == "coach-about" ) {
      let editAbout = document.getElementById("coach-edit-about"),
          about = document.getElementById("coach-about"),
          submitEdit = editAbout.querySelector(".coach-about-btn-confirm-edit button");

      about.dataset.ogValue == about.value ? disableElem(submitEdit) : enableElem(submitEdit);
    } else if ( event.target.closest(".pass-setting") ) {
      let target = event.target,
          ce_pass = document.getElementById("coach-edit-password"),
          current_pass = document.getElementById("pass-current"),
          new_pass = document.getElementById("pass-new"),
          submit_pass = document.getElementById("submit-pass"),
          pass_warning = ce_pass.querySelector(".pass-warning"),
          pass_warning_missing = ce_pass.querySelector(".pass-warning-missing"),
          pass_warning_match = ce_pass.querySelector(".pass-warning-match"),
          pass_warning_short = ce_pass.querySelector(".pass-warning-short"),
          pass_valid = ce_pass.querySelector(".pass-valid");

      if ( !current_pass.value ) {
        hideElem(pass_valid);
        showElem(pass_warning);
        showElem(pass_warning_missing);
        disableElem(submit_pass);
      } else {
        hideElem(pass_warning_missing);
      }
      if ( current_pass.value == new_pass.value ) {
        hideElem(pass_valid);
        showElem(pass_warning);
        showElem(pass_warning_match);
        disableElem(submit_pass);
      } else {
        hideElem(pass_warning_match);
      }
      if ( new_pass.value.length > 0 && new_pass.value.length <= 8 ) {
        hideElem(pass_valid);
        showElem(pass_warning);
        showElem(pass_warning_short);
        disableElem(submit_pass);
      } else {
        hideElem(pass_warning_short);
      }
      if ( current_pass.value && 
        current_pass.value != new_pass.value && 
        new_pass.value.length > 8) {
        hideElem(pass_warning);
        showElem(pass_valid);
        enableElem(submit_pass);
      }
    }
  });

  document.addEventListener("DOMContentLoaded", function(event) {
    let time_now = document.getElementById('coach-time-now'),
        date_today = document.getElementById('coach-date-today'),
        extable_msgs = document.getElementById('extable-msgs'),
        about = document.getElementById("coach-about"),
        deleteBtn = document.querySelector('.coach-about-btn-delete button');

    if (!about.value) disableElem(deleteBtn);

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
    if ( event.target.closest(".coach-about-btn") ) {
      switchAboutBtnModes(event);
    } else if ( event.target.closest(".closebtn") ) {
      hideElem(event.target.closest(".msgbox"));
    } else if ( event.target.closest(".toggle-eye") ) {
      togglePasswordVisible(event);
    } else if ( event.target.closest("#submit-pass") ) {
      event.preventDefault();
      let form = document.getElementById("coach-settings"),
          coachSetting = document.getElementById("coach-setting");
      coachSetting.value = "coach-pass";

      form.submit();
    }
  });


  function togglePasswordVisible(event, 
    icon_class_visible="ion-eye", 
    icon_class_masked="ion-eye-disabled") {
    if ( !event.target.closest(".toggle-eye") ) return;

    let target = event.target,
          tg_eye = target.closest(".toggle-eye"),
          tg_eye_icon = tg_eye.querySelector("i"),
          passbox = tg_eye.closest(".pass-box"),
          inp = passbox.querySelector(".pass-setting");

    if ( tg_eye.classList.contains("toggle-eye-disabled") ) {
      tg_eye.classList.remove("toggle-eye-disabled");
      tg_eye_icon.classList.remove("ion-eye-disabled");
      tg_eye_icon.classList.add("ion-eye");
      inp.type = "text";
    } else {
      tg_eye.classList.add("toggle-eye-disabled");
      tg_eye_icon.classList.remove("ion-eye");
      tg_eye_icon.classList.add("ion-eye-disabled");
      inp.type = "password";
    }
  }
  function switchAboutBtnModes(event) {
    if ( !event.target.closest(".coach-about-btn") ) return;

    let target = event.target,
        targetClasses = target.classList,
        editAbout = document.getElementById("coach-edit-about"),
        aboutBtns = target.closest(".coach-about-btn-container"),
        form = document.getElementById("coach-settings"),
        coachSetting = document.getElementById("coach-setting");

    if ( target.closest(".coach-about-btn-delete") ) {
      let defaultBtnMode = aboutBtns.querySelector(".coach-about-btn-mode-default"),
          deleteBtnMode = aboutBtns.querySelector(".coach-about-btn-mode-delete");

      hideElem(defaultBtnMode);
      showElem(deleteBtnMode);

      editAbout.classList.add("deleting-elem");
    } else if ( target.closest(".coach-about-btn-cancel-delete") ) {
      let defaultBtnMode = aboutBtns.querySelector(".coach-about-btn-mode-default"),
          deleteBtnMode = aboutBtns.querySelector(".coach-about-btn-mode-delete");

      hideElem(deleteBtnMode);
      showElem(defaultBtnMode);

      editAbout.classList.remove("deleting-elem");
    } else if ( target.closest(".coach-about-btn-confirm-delete") ) {//TODO: submit changes logic
      event.preventDefault();
      let about = document.getElementById("coach-about");
      about.value = '';
      coachSetting.value = "coach-about";

      form.submit();
    } else if ( target.closest(".coach-about-btn-edit") ) {
      let defaultBtnMode = aboutBtns.querySelector(".coach-about-btn-mode-default"),
          editBtnMode = aboutBtns.querySelector(".coach-about-btn-mode-edit"),
          about = document.getElementById("coach-about");

      hideElem(defaultBtnMode);
      showElem(editBtnMode);

      editAbout.classList.add("editing-elem");

      about.removeAttribute("readonly");

      about.dataset.OgValue = about.value;
    } else if ( target.closest(".coach-about-btn-cancel-edit") ) {
      let defaultBtnMode = aboutBtns.querySelector(".coach-about-btn-mode-default"),
          editBtnMode = aboutBtns.querySelector(".coach-about-btn-mode-edit"),
          about = document.getElementById("coach-about"),
          submitEdit = editAbout.querySelector(".coach-about-btn-confirm-edit button");

      hideElem(editBtnMode);
      showElem(defaultBtnMode);

      editAbout.classList.remove("editing-elem");

      about.setAttribute("readonly", true);

      about.value = about.dataset.OgValue;

      disableElem(submitEdit);
    } else if ( target.closest(".coach-about-btn-confirm-edit") ) { 
      event.preventDefault();
      let about = document.getElementById("coach-about");
      coachSetting.value = "coach-about";

      if ( about.value !== about.dataset.OgValue ) form.submit();
    }
  }
  function disableElem(elem) {
    elem.classList.add("disabled");
    elem.setAttribute("disabled", true);
  }
  function enableElem(elem) {
    elem.classList.remove("disabled");
    elem.removeAttribute("disabled");
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
  $msgbox_icon_class = $success ? 'icon-done' : 'icon2-caution';
  echo "
  <div class='msgbox $msgbox_class show-inline-block w3-animate-zoom' id=''>
    <div class='msg show-inline-block w3-' style='font-size: 18px'>
      <div class='show-inline-block' style='vertical-align:2px'>
        &nbsp;&nbsp;&nbsp;<i class='$msgbox_icon_class' style='vertical-align:0.8px;font-size: 0.8em;'></i>
        &nbsp;$msg
      </div>&nbsp;
      <div class='closebtn show-inline-block w3-padding'>
        <i class='ion-ios-close-outline' style='font-size: 1.2em'></i>
      </div>
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