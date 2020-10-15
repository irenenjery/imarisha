<?php require 'includes/functions-helper.php' ?>
<?php require 'includes/db/functions-db.php' ?>

<?php 
session_start();
if ( !isset($_SESSION['coach']) ) {
  header('Location: index.php#sign-in');
}

$coach = $_SESSION['coach'];
$coach_id = $coach['coach_id'];
$gender = $coach['coach_gender'];
?>
<?php require 'includes/db/connectdb-imarisha.php'; ?>

<?php 
date_default_timezone_set("Africa/Nairobi");
$today = get_today();
$prog_id = $coach['coach_progs'][0];
$coach_prog = getPrograms($conn, "prog_id=$prog_id")[$prog_id];
$timetable_data = getTimetable($conn, "tt_prog_id=$prog_id");
$exercises_data = getExercises($conn);
$wp_data = getWorkoutplan($conn, $prog_id);

/*$coach_progs_str = "";
foreach ($coach['coach_progs'] as $key => $prog) {
  $coach_progs_str .= $coach_progs_str == "" ? "(" : " ,";
  $coach_progs_str .= $prog;
}
$coach_progs_str .= ")";

$clients = getClients($conn, "client_prog_id IN $coach_progs_str");*/
$today = get_today();
mysqli_close($conn);
?>

<!-- HTML5 boilerplate -->
<?php require 'includes/views/head.php'; ?>

<!-- Navbar (sit on top) -->
<section id="coach_top" class="w3-top">
 	<article class="w3-navbar w3-display-container w3-white w3-wide w3-padding-8 w3-card-2">
    <section id="logo" class="w3-padding w3-display-left">
      <a href="coach-home.php" class="w3-margin-left">
        <div id="im-logo" class="<?php echo 'tt-text-code'.$prog_id ?>" style="display: inline-block;">
          <span class="w3-border <?php echo 'tt-border-code'.$prog_id ?> w3-padding"><b>IM</b></span>
          <sub style="font-size: 0.8em"> <b>coach</b></sub>
        </div>
        <sub class="" style="font-size: 0.85em;text-transform: capitalize;">
          <span class="w3-tiny w3-text-grey">|</span>
          <?php echo $today . ', ' . date('d.m.Y'); ?>
          <span class="w3-tiny w3-text-grey">|</span>
        </sub>
      </a>
		</section><!-- section#logo -->
    <section id="coach-prog" class="w3-display-middle" >
      <ul class="w3-navbar w3-wide w3-hide-medium w3-hide-small" style="display: inline-block;margin: 5px 0 0 40px">
        <li><a href="coach-home.php#videos">Videos</a></li>
        <li><a href="coach-home.php#exercises">Exercises</a></li>
        <li><a href="coach-home.php#weekly-sessions">Schedule</a></li>
      </ul>  
    </section>
    <section id="profile" class="w3-right w3-display-right">
      <span style="font-size: 1.2em;vertical-align: 10%">
        <a href="coach-home.php" style="margin-right: 10px">
          <?php if ( isset($_GET['welcome']) ): ?>
            <i class="ion-ios-rose-outline <?php echo 'tt-text-code'.$prog_id ?> "></i>
          <?php endif ?>
          <!-- username -->
          <div style="display: inline-block;font-size: 0.85em" class="">
            <?php echo $coach['coach_username']; ?>
          </div>
          <!-- username -->
          <?php if ( isset($_GET['welcome']) ): ?>
            <i class="ion-ios-rose-outline <?php echo 'tt-text-code'.$prog_id ?>"></i>
          <?php endif ?>
        </a>
      </span>
      <div class="" style="display: inline-block;letter-spacing: normal;font-size: 1.4em;">
        <a href="logout.php" title="Logout">
          <i class="ion-log-out" style="font-size: 1.1em"> </i>
        </a> &nbsp;
        <a href="coach-settings.php" title="Account Settings">
          <i class="ion-ios-settings" style="font-size: 1.1em"> </i>
        </a>
      </div>
    </section><!-- section#profile -->
  </article><!-- article.w3-navbar -->
</section><!-- section.w3-top -->

<!-- Page Content -->
<div class="w3-display-container w3-content" id="homepage-content" style="padding-top: 40px;background-color: rgba(246,243,238,0.9);">
  <section class="service w3-container w3-padding-32 w3-row-padding" id="activity-today">
    <article class="w3-col l3 w3-center hide" id="next-session-container" style="margin: 15px auto;">
      <a href="#timetable" style="text-decoration: none;">
        <div class="w3-padding w3-black" style="border-radius: 20px;">
          <h3 class="w3-center">
            TODAY'S SESSIONS
          </h3>    
          <h2 class="service-title w3-center" style="font-size: 30px;font-weight: 300;padding-top: 0px;">
            <?php 
              $no_gym = $today == 'sun' 
                || !array_key_exists($today, $timetable_data)
                || count($timetable_data[$today]) == 0;
              $gym_today = $no_gym ? null : $timetable_data[$today]; 
              ?>
            <?php if ($gym_today == null): ?>
              <p style="font-size: 30px;font-weight: 800;">No Session</p>
            <?php else: ?>
              <?php foreach ($gym_today as $key => $session): ?>              
                <div class="td_time">
                  <i class="ion-ios-clock-outline"></i> 
                  <?php echo substr($session['tt_starttime'], 0, 5) ?>
                </div>
              <?php endforeach ?>
            <?php endif ?>      
          </h2>
        </div>
      </a>
      <h3 id="coach-prog-title" class="w3-animate-left <?php echo 'tt-code'.$prog_id ?>" style=""> 
        <a href="coach-settings.php" style="text-decoration:none;">
          <span class="w3-card-16 w3-padding" style="text-transform: capitalize;display: inline-block;width: 100%">
            <i class="ion-android-bicycle"></i>
            <?php echo $coach_prog['prog_title']; ?>
          </span>
        </a>
      </h3>
    </article>

    <article class="w3-col l7">
      <section class="w3-white w3-padding w3-card-4" id="coach-today-workout">
        <h3 class="service-title w3-center w3-padding-0">
          Today's workout exercises
        </h3>
        <form id="" name="extable-form" method="POST" action="test.php">
          <table id="" class="extable w3-table w3-animate-opacity">
            <tbody>
              <tr class="stud new-elem extable-row extable-row-exercise w3-animate-opacity">
                <td class="extable-col extable-col-title">
                  <div class="w3-input w3-border-0">
                    <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                    <b class="extable-ex_title">No title</b>
                    <input class="extable-wp_id" type="text" name="wp_id" value="" hidden>
                    <input class="extable-ex_id" type="text" name="ex_id" value="" hidden>
                  </div>
                </td>
                <td class="extable-col extable-col-instr">
                  <input class="extable-ex_instr w3-input w3-border-0" type="text" name="ex_instr" value="No instructions provided" readonly>
                </td>
                <td class="extable-col extable-col-actionbtns w3-center">
                  <?php require 'includes/views/content-extable-col-actionbtns.php' ?>
                </td>
              </tr>              
              <?php foreach ($wp_data[$today] as $key => $ex_today): ?>
                <tr class="extable-row extable-row-exercise">
                  <td class="extable-col extable-col-title">
                    <div class="w3-input w3-border-0">
                      <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                      <b class="extable-ex_title">
                        <?php
                          $wp_id = $ex_today['wp_id'];
                          $ex_id = $ex_today['ex_id'];
                          $ex_title = $exercises_data[$ex_id]['ex_title'];
                          echo $ex_title;
                        ?>
                      </b>
                      <input class="extable-wp_id" type="text" name="wp_id" value="<?php echo $wp_id ?>" hidden>
                      <input class="extable-ex_id" type="text" name="ex_id" value="<?php echo $ex_id ?>" hidden>
                    </div>
                  </td>
                  <td class="extable-col extable-col-instr">
                    <input class="extable-ex_instr w3-input w3-border-0" type="text" name="ex_instr" value="<?php echo $ex_today['wp_ex_details'] ?>" readonly>
                  </td>
                  <td class="extable-col extable-col-actionbtns w3-center">
                    <?php require 'includes/views/content-extable-col-actionbtns.php' ?>
                  </td>
                </tr>
              <?php endforeach ?>
              <tr class="extable-row extable-row-submit w3-white">
                <td class="extable-col extable-col-submit-container" colspan="3" style="">
                  <!-- Hidden form data -->
                  <input type="text" name="wp-day" value="<?php echo $today ?>" hidden>
                  <input type="text" name="prog-id" value="<?php echo $prog_id ?>" hidden>
                  <input class="insert-count" type="text" name="insert-count" value="0" hidden>
                  <input class="update-count" type="text" name="update-count" value="0" hidden>
                  <input class="delete-count" type="text" name="delete-count" value="0" hidden>
                  <input class="delete-wp_ids" type="text" name="delete-wp_ids" value="" hidden>
                  <!-- End of Hidden form data -->

                  <div class="extable-btn w3-right extable-btn-submit show-inline-block">
                    <button type="submit" class="w3-btn w3-green" style=""><i class="icon-paper-plane"></i>&nbsp;&nbsp;Submit changes</button>
                  </div>
                </td>
              </tr>
              <tr class="extable-row extable-row-addExercise" style="">
                <td class="extable-col extable-col-select-ex" style="">
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
                <td class="extable-col extable-col-add-instr" style="">
                  <input class="extable-add-instr w3-input" type="text" placeholder="Add instructions e.g sets,reps" style="">
                </td>
                <td class="extable-col extable-col-addbtns w3-center" style="">
                  <div class="extable-btn extable-btn-add">
                    <a class="w3-btn w3-text-green w3-border w3-border-green" style=""><i class="icon2-pin"></i></a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </section>
    </article>
    <article class="w3-col l2 hide" style="margin: 15px auto;">
      <div class="w3-white w3-card-2" id="upload-video" style="border-radius: 20px; margin-top: 20px;padding-top: 5px;">        
        <h4 class="w3-center">
          TRAINING VIDEO
        </h4>
        <div id="video-drop" class="w3-center w3-text-grey w3-padding" style="width: 70%;border: 3px solid #d9d9d9;border-radius: 20px;margin: auto; height: 100px">
          <i class="ion-videocamera" style="font-size: 40px"></i><br>
          <span>Choose video</span>
        </div>
        <button class="w3-btn w3-blue" style="margin-top: 10px;width: 100%;border-bottom-left-radius: inherit;border-top-right-radius: inherit;"><i class="icon2-upload4" style="font-size: 1.2em;"></i>&nbsp;&nbsp;<span class="w3-wide" style="vertical-align: 2px;">upload</span></button>
      </div></article>
  </section><!-- section#activity-today -->
  <!-- Sessions Section -->  
  <section class="service w3-container w3-padding-8 w3-row-padding" id="weekly-sessions">
    <h3 class="service-title w3-center w3-padding-0" style="font-size: 30px">
      Your weekly schedule
    </h3>
    <article id="" class="w3-col l3 w3-padding">
      <div class="session w3-black w3-padding" style="border-radius: 20px;">
        <h3 class="w3-center">
          TODAY'S SESSIONS
        </h3>    
        <h2 class="service-title w3-center" style="font-size: 30px;font-weight: 300;padding-top: 0;">
          <?php if ($gym_today == null): ?>
            <p style="font-size: 30px;font-weight: 800;">No Session</p>
          <?php else: ?>
            <?php foreach ($gym_today as $key => $session): ?>              
              <div class="td_time">
                <i class="ion-ios-clock-outline"></i> 
                <?php echo substr($session['tt_starttime'], 0, 5) ?>
              </div>
            <?php endforeach ?>
          <?php endif ?>        
        </h2>
      </div>
    </article>
    <article id="" class="w3-col l3 w3-padding">
      <div class="session w3-black w3-padding" style="border-radius: 20px">
        <h3 class="w3-center">
          TODAY'S SESSIONS
        </h3>    
        <h2 class="service-title w3-center" style="font-size: 30px;font-weight: 300;padding-top: 0px;">
          <?php if ($gym_today == null): ?>
            <p style="font-size: 30px;font-weight: 800;">No Session</p>
          <?php else: ?>
            <?php foreach ($gym_today as $key => $session): ?>              
              <div class="td_time">
                <i class="ion-ios-clock-outline"></i> 
                <?php echo substr($session['tt_starttime'], 0, 5) ?>
                <?php break ?>
              </div>
            <?php endforeach ?>
          <?php endif ?>        
        </h2>
      </div>
    </article>
    <article id="" class="w3-col l3 w3-padding">
      <div class="session w3-black w3-padding" style="border-radius: 20px;">
        <h3 class="w3-center">
          TODAY'S SESSIONS
        </h3>    
        <h2 class="service-title w3-center" style="font-size: 30px;font-weight: 300;padding-top: 0;">
          <?php if ($gym_today == null): ?>
            <p style="font-size: 30px;font-weight: 800;">No Session</p>
          <?php else: ?>
            <?php foreach ($gym_today as $key => $session): ?>              
              <div class="td_time">
                <i class="ion-ios-clock-outline"></i> 
                <?php echo substr($session['tt_starttime'], 0, 5) ?>
              </div>
            <?php endforeach ?>
          <?php endif ?>        
        </h2>
      </div>
    </article>
    <article id="" class="w3-col l3 w3-padding">
      <div class="session w3-black w3-padding" style="border-radius: 20px;">
        <h3 class="w3-center">
          TODAY'S SESSIONS
        </h3>    
        <h2 class="service-title w3-center" style="font-size: 30px;font-weight: 300;padding-top: 0;">
          <p style="font-size: 30px;font-weight: 800;">No Session</p>        
        </h2>
      </div>
    </article>
    <article id="" class="w3-col l3 w3-padding">
      <div class="session w3-black w3-padding" style="border-radius: 20px;">
        <h3 class="w3-center">
          TODAY'S SESSIONS
        </h3>    
        <h2 class="service-title w3-center" style="font-size: 30px;font-weight: 300;padding-top: 0;">
          <?php if ($gym_today == null): ?>
            <p style="font-size: 30px;font-weight: 800;">No Session</p>
          <?php else: ?>
            <?php foreach ($gym_today as $key => $session): ?>              
              <div class="td_time">
                <i class="ion-ios-clock-outline"></i> 
                <?php echo substr($session['tt_starttime'], 0, 5) ?>
              </div>
            <?php endforeach ?>
          <?php endif ?>        
        </h2>
      </div>
    </article>
    <article id="" class="w3-col l3 w3-padding">
      <div class="session w3-black w3-padding" style="border-radius: 20px">
        <h3 class="w3-center">
          TODAY'S SESSIONS
        </h3>    
        <h2 class="service-title w3-center" style="font-size: 30px;font-weight: 300;padding-top: 0px;">
          <?php if ($gym_today == null): ?>
            <p style="font-size: 30px;font-weight: 800;">No Session</p>
          <?php else: ?>
            <?php foreach ($gym_today as $key => $session): ?>              
              <div class="td_time">
                <i class="ion-ios-clock-outline"></i> 
                <?php echo substr($session['tt_starttime'], 0, 5) ?>
                <?php break ?>
              </div>
            <?php endforeach ?>
          <?php endif ?>        
        </h2>
      </div>
    </article>
    <article id="" class="w3-col l3 w3-padding">
      <div class="session w3-black w3-padding" style="border-radius: 20px;">
        <h3 class="w3-center">
          TODAY'S SESSIONS
        </h3>    
        <h2 class="service-title w3-center" style="font-size: 30px;font-weight: 300;padding-top: 0;">
          <?php if ($gym_today == null): ?>
            <p style="font-size: 30px;font-weight: 800;">No Session</p>
          <?php else: ?>
            <?php foreach ($gym_today as $key => $session): ?>              
              <div class="td_time">
                <i class="ion-ios-clock-outline"></i> 
                <?php echo substr($session['tt_starttime'], 0, 5) ?>
              </div>
            <?php endforeach ?>
          <?php endif ?>        
        </h2>
      </div>
    </article>
  </section>
  <!-- Videos Section -->
  <!-- Section Videos -->  
  <section class="service w3-container w3-padding-16" id="videos">
    <h3 class="service-title w3-center w3-padding-0" style="font-size: 30px">
      Recorded Sessions
    </h3>
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
  </section><!-- section#videos -->
  <!-- Exercises Section -->  
  <section class="service w3-container w3-padding-32 w3-row-padding" id="weekly-exercises">
    <h3 class="service-title w3-center w3-padding-0" style="font-size: 30px">
      Trainee's weekly workout exercises
    </h3>
      <div id="mon">
        <h5 class="w3-blue w3-tag" style="border-radius: 10px; padding: 5px 16px">Mon</h5>
        <table class="w3-table" style="overflow-x:auto;">
          <tbody>
            <tr>
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr style="background-color: rgba(246,243,238,0.5);">
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td><h4>Add Exercise</h4></td>
            </tr>
            <tr style="background-color: rgba(246,243,238,0.5);">
              <td style="width: 30%">
                <select class="w3-select w3-border" name="" id="" style="text-transform: capitalize;display: inline-block;">
                  <option disabled selected>Select an exercise</option>
                </select>
              </td>
              <td class="" style="width: 40%">
                <input class="w3-input" type="text" placeholder="Add instructions e.g sets,reps" style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 2px">
              </td>
              <td class="w3-center" style="font-size: 1.1em;width: 20%;">
                <a class="w3-btn w3-white w3-text-green w3-border w3-border-green" style="border-radius: 20px;"><i class="icon2-plus"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
        <div id="" class="submit-container w3-padding-16">
          <button class="w3-btn w3-green w3-right w3-wide" style="border-radius: 10px;"><i class="icon-paper-plane"></i>&nbsp;Submit changes</button>
        </div>
        <!-- <ul class="" style="list-style-type: none;list-style-position: inside;margin: -10px 0 0 0">
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">
             <i class="icon2-pin"></i>&nbsp;&nbsp;<b><b>Bulgarian Split Squat</b></b> Sets: 4, Reps: 8-10, Rest: 45 sec.
          </li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">
             <i class="icon2-pin"></i>&nbsp;&nbsp;<b><b>Bulgarian Split Squat</b></b> Sets: 4, Reps: 8-10, Rest: 45 sec.
          </li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">me</li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">me</li>
        </ul> -->
        <div>
        </div>
      </div>
      <div id="tue">
        <h5 class="w3-blue w3-tag" style="border-radius: 10px; padding: 5px 16px">Tue</h5>
        <table class="w3-table" style="overflow-x:auto;">
          <tbody>
            <tr>
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr style="background-color: rgba(246,243,238,0.5);">
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td><h4>Add Exercise</h4></td>
            </tr>
            <tr style="background-color: rgba(246,243,238,0.5);">
              <td style="width: 30%">
                <select class="w3-select w3-border" name="" id="" style="text-transform: capitalize;display: inline-block;">
                  <option disabled selected>Select an exercise</option>
                </select>
              </td>
              <td class="" style="width: 40%">
                <input class="w3-input" type="text" placeholder="Add instructions e.g sets,reps" style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 2px">
              </td>
              <td class="w3-center" style="font-size: 1.1em;width: 20%;">
                <a class="w3-btn w3-white w3-text-green w3-border w3-border-green" style="border-radius: 20px;"><i class="icon2-plus"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
        <div id="" class="submit-container w3-padding-16">
          <button class="w3-btn w3-green w3-right w3-wide" style="border-radius: 10px;"><i class="icon-paper-plane"></i>&nbsp;Submit changes</button>
        </div>
        <!-- <ul class="" style="list-style-type: none;list-style-position: inside;margin: -10px 0 0 0">
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">
             <i class="icon2-pin"></i>&nbsp;&nbsp;<b><b>Bulgarian Split Squat</b></b> Sets: 4, Reps: 8-10, Rest: 45 sec.
          </li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">
             <i class="icon2-pin"></i>&nbsp;&nbsp;<b><b>Bulgarian Split Squat</b></b> Sets: 4, Reps: 8-10, Rest: 45 sec.
          </li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">me</li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">me</li>
        </ul> -->
        <div>
        </div>
      </div>
      <div id="wed">
        <h5 class="w3-blue w3-tag" style="border-radius: 10px; padding: 5px 16px">Wed</h5>
        <table class="w3-table" style="overflow-x:auto;">
          <tbody>
            <tr>
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr style="background-color: rgba(246,243,238,0.5);">
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td><h4>Add Exercise</h4></td>
            </tr>
            <tr style="background-color: rgba(246,243,238,0.5);">
              <td style="width: 30%">
                <select class="w3-select w3-border" name="" id="" style="text-transform: capitalize;display: inline-block;">
                  <option disabled selected>Select an exercise</option>
                </select>
              </td>
              <td class="" style="width: 40%">
                <input class="w3-input" type="text" placeholder="Add instructions e.g sets,reps" style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 2px">
              </td>
              <td class="w3-center" style="font-size: 1.1em;width: 20%;">
                <a class="w3-btn w3-white w3-text-green w3-border w3-border-green" style="border-radius: 20px;"><i class="icon2-plus"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
        <div id="" class="submit-container w3-padding-16">
          <button class="w3-btn w3-green w3-right w3-wide" style="border-radius: 10px;"><i class="icon-paper-plane"></i>&nbsp;Submit changes</button>
        </div>
        <!-- <ul class="" style="list-style-type: none;list-style-position: inside;margin: -10px 0 0 0">
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">
             <i class="icon2-pin"></i>&nbsp;&nbsp;<b><b>Bulgarian Split Squat</b></b> Sets: 4, Reps: 8-10, Rest: 45 sec.
          </li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">
             <i class="icon2-pin"></i>&nbsp;&nbsp;<b><b>Bulgarian Split Squat</b></b> Sets: 4, Reps: 8-10, Rest: 45 sec.
          </li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">me</li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">me</li>
        </ul> -->
        <div>
        </div>
      </div>
      <div id="thur">
        <h5 class="w3-blue w3-tag" style="border-radius: 10px; padding: 5px 16px">Thur</h5>
        <table class="w3-table" style="overflow-x:auto;">
          <tbody>
            <tr>
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr style="background-color: rgba(246,243,238,0.5);">
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td><h4>Add Exercise</h4></td>
            </tr>
            <tr style="background-color: rgba(246,243,238,0.5);">
              <td style="width: 30%">
                <select class="w3-select w3-border" name="" id="" style="text-transform: capitalize;display: inline-block;">
                  <option disabled selected>Select an exercise</option>
                </select>
              </td>
              <td class="" style="width: 40%">
                <input class="w3-input" type="text" placeholder="Add instructions e.g sets,reps" style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 2px">
              </td>
              <td class="w3-center" style="font-size: 1.1em;width: 20%;">
                <a class="w3-btn w3-white w3-text-green w3-border w3-border-green" style="border-radius: 20px;"><i class="icon2-plus"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
        <div id="" class="submit-container w3-padding-16">
          <button class="w3-btn w3-green w3-right w3-wide" style="border-radius: 10px;"><i class="icon-paper-plane"></i>&nbsp;Submit changes</button>
        </div>
        <!-- <ul class="" style="list-style-type: none;list-style-position: inside;margin: -10px 0 0 0">
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">
             <i class="icon2-pin"></i>&nbsp;&nbsp;<b><b>Bulgarian Split Squat</b></b> Sets: 4, Reps: 8-10, Rest: 45 sec.
          </li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">
             <i class="icon2-pin"></i>&nbsp;&nbsp;<b><b>Bulgarian Split Squat</b></b> Sets: 4, Reps: 8-10, Rest: 45 sec.
          </li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">me</li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">me</li>
        </ul> -->
        <div>
        </div>
      </div>
      <div id="fri">
        <h5 class="w3-blue w3-tag" style="border-radius: 10px; padding: 5px 16px">Fri</h5>
        <table class="w3-table" style="overflow-x:auto;">
          <tbody>
            <tr>
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr style="background-color: rgba(246,243,238,0.5);">
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td><h4>Add Exercise</h4></td>
            </tr>
            <tr style="background-color: rgba(246,243,238,0.5);">
              <td style="width: 30%">
                <select class="w3-select w3-border" name="" id="" style="text-transform: capitalize;display: inline-block;">
                  <option disabled selected>Select an exercise</option>
                </select>
              </td>
              <td class="" style="width: 40%">
                <input class="w3-input" type="text" placeholder="Add instructions e.g sets,reps" style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 2px">
              </td>
              <td class="w3-center" style="font-size: 1.1em;width: 20%;">
                <a class="w3-btn w3-white w3-text-green w3-border w3-border-green" style="border-radius: 20px;"><i class="icon2-plus"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
        <div id="" class="submit-container w3-padding-16">
          <button class="w3-btn w3-green w3-right w3-wide" style="border-radius: 10px;"><i class="icon-paper-plane"></i>&nbsp;Submit changes</button>
        </div>
        <!-- <ul class="" style="list-style-type: none;list-style-position: inside;margin: -10px 0 0 0">
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">
             <i class="icon2-pin"></i>&nbsp;&nbsp;<b><b>Bulgarian Split Squat</b></b> Sets: 4, Reps: 8-10, Rest: 45 sec.
          </li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">
             <i class="icon2-pin"></i>&nbsp;&nbsp;<b><b>Bulgarian Split Squat</b></b> Sets: 4, Reps: 8-10, Rest: 45 sec.
          </li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">me</li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">me</li>
        </ul> -->
        <div>
        </div>
      </div>
      <div id="sat">
        <h5 class="w3-blue w3-tag" style="border-radius: 10px; padding: 5px 16px">Sat</h5>
        <table class="w3-table" style="overflow-x:auto;">
          <tbody>
            <tr>
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr style="background-color: rgba(246,243,238,0.5);">
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td><h4>Add Exercise</h4></td>
            </tr>
            <tr style="background-color: rgba(246,243,238,0.5);">
              <td style="width: 30%">
                <select class="w3-select w3-border" name="" id="" style="text-transform: capitalize;display: inline-block;">
                  <option disabled selected>Select an exercise</option>
                </select>
              </td>
              <td class="" style="width: 40%">
                <input class="w3-input" type="text" placeholder="Add instructions e.g sets,reps" style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 2px">
              </td>
              <td class="w3-center" style="font-size: 1.1em;width: 20%;">
                <a class="w3-btn w3-white w3-text-green w3-border w3-border-green" style="border-radius: 20px;"><i class="icon2-plus"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
        <div id="" class="submit-container w3-padding-16">
          <button class="w3-btn w3-green w3-right w3-wide" style="border-radius: 10px;"><i class="icon-paper-plane"></i>&nbsp;Submit changes</button>
        </div>
        <!-- <ul class="" style="list-style-type: none;list-style-position: inside;margin: -10px 0 0 0">
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">
             <i class="icon2-pin"></i>&nbsp;&nbsp;<b><b>Bulgarian Split Squat</b></b> Sets: 4, Reps: 8-10, Rest: 45 sec.
          </li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">
             <i class="icon2-pin"></i>&nbsp;&nbsp;<b><b>Bulgarian Split Squat</b></b> Sets: 4, Reps: 8-10, Rest: 45 sec.
          </li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">me</li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">me</li>
        </ul> -->
        <div>
        </div>
      </div>
      <div id="sun">
        <h5 class="w3-blue w3-tag" style="border-radius: 10px; padding: 5px 16px">Sun</h5>
        <table class="w3-table" style="overflow-x:auto;">
          <tbody>
            <tr>
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr style="background-color: rgba(246,243,238,0.5);">
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%">
                <div class="w3-input w3-border-0">
                  <i class="icon2-pin" style=""></i>&nbsp;&nbsp;
                  <b>Bulgarian Split Squat</b>
                </div>
              </td>
              <td class="" style="width: 45%">
                <input class="w3-input" type="text" value="Sets: 3, Reps: 8-10, Rest: 30 sec." style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 1px;" readonly>
              </td>
              <td class="w3- w3-center" style="font-size: 1.1em;width: 20%">
                <button class="w3-padding w3-btn w3-white w3-border w3-border-grey w3-text-grey" style="border-radius: 20px;"><i class="lnr lnr-pencil"></i></button>&nbsp;
                <button class="w3-padding w3-btn w3-white w3-text-red w3-border w3-border-red" style="border-radius: 20px;">
                  <i class="lnr lnr-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td><h4>Add Exercise</h4></td>
            </tr>
            <tr style="background-color: rgba(246,243,238,0.5);">
              <td style="width: 30%">
                <select class="w3-select w3-border" name="" id="" style="text-transform: capitalize;display: inline-block;">
                  <option disabled selected>Select an exercise</option>
                </select>
              </td>
              <td class="" style="width: 40%">
                <input class="w3-input" type="text" placeholder="Add instructions e.g sets,reps" style="width: 100%;border: none;border-bottom: 2px solid #d9d9d9;background: inherit;letter-spacing: 2px">
              </td>
              <td class="w3-center" style="font-size: 1.1em;width: 20%;">
                <a class="w3-btn w3-white w3-text-green w3-border w3-border-green" style="border-radius: 20px;"><i class="icon2-plus"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
        <div id="" class="submit-container w3-padding-16">
          <button class="w3-btn w3-green w3-right w3-wide" style="border-radius: 10px;"><i class="icon-paper-plane"></i>&nbsp;Submit changes</button>
        </div>
        <!-- <ul class="" style="list-style-type: none;list-style-position: inside;margin: -10px 0 0 0">
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">
             <i class="icon2-pin"></i>&nbsp;&nbsp;<b><b>Bulgarian Split Squat</b></b> Sets: 4, Reps: 8-10, Rest: 45 sec.
          </li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">
             <i class="icon2-pin"></i>&nbsp;&nbsp;<b><b>Bulgarian Split Squat</b></b> Sets: 4, Reps: 8-10, Rest: 45 sec.
          </li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">me</li>
          <li class="ex w3-border-blue w3-light-grey" style="padding: 10px 20px;margin:10px 0 10px -30px; border-radius: inherit;">me</li>
        </ul> -->
        <div>
        </div>
      </div>
  </section>
</div>

<script>
  document.addEventListener('click', function(event) {
    if ( event.target.closest(".extable-btn") ) {
      extableBtnHandler(event);
    }
  });

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
      // alert(row.querySelector('.extable-ex_id').value);
      // alert(row.querySelector('.extable-ex_instr').name);
    }

    for (let i = 0; i < edited_rows.length; i++) {
      let row = edited_rows[i];
      update_count++;
      row.querySelector('.extable-wp_id').setAttribute('name', 'update-wp_id-'+i);
      row.querySelector('.extable-ex_id').setAttribute('name', 'update-ex_id-'+i);
      row.querySelector('.extable-ex_instr').setAttribute('name', 'update-ex_instr-'+i);
      // alert(row.querySelector('.extable-input-id').name);
      // alert(row.querySelector('.extable-ex_instr').name);
    }

    if (insert_count == 0 && update_count == 0 && delete_count == 0) return;

    let insert_count_box = targetTable.querySelector('.insert-count'),
        update_count_box = targetTable.querySelector('.update-count');

    alert(`Inserts: ${insert_count}, Updates: ${update_count}, Deletes: ${delete_count}`);
    insert_count_box.value = insert_count;
    update_count_box.value = update_count;

    // extableTodayForm.submit();
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