<!-- member-settings-data -->
<!-- session_start();
if ( !isset($_SESSION['client']) ) {
  header('Location: index.php#sign-in');
}

$client = $_SESSION['client'];
$username = $client['client_username'];
$dob = $client['client_dob'];
$gender = $client['client_gender'];
$exp = $client['client_exp'];

if ( is_null($dob) || is_null($gender) || is_null($exp) ) {
  redirect('member-welcome.php', 'user='.$username);
}

date_default_timezone_set("Africa/Nairobi");
$prog_id = $client['client_prog_id'];
$sub_active = $_SESSION['sub_active'];
$sub_startdate = $_SESSION['sub_startdate'];
$sub_enddate = $_SESSION['sub_enddate'];
$program_data = $_SESSION['program'];
$prog_duration = $program_data[$prog_id]['prog_duration'];
$week_count = $_SESSION['week_count'];
$today = $_SESSION['today']; -->





<?php if (count($wp_today) == 1): ?>
  <?php $routine = $wp_today[0]; $ex = $exercises_data[$routine['ex_id']]; ?>
  <div class="ex">
    <h2 class="w3-accordion" style="text-transform: uppercase;">
      <?php echo $ex['ex_title'] ?>
      <i class="ex-info icon-info2 w3-text-blue" style="font-size: 0.8em;font-weight: lighter;"></i>
    </h2>
    <h3><?php echo $routine['wp_ex_details'] ?></h3>
    <div class="ex-descr w3-accordion-content w3-container w3-blue w3-animate-zoom" style="width: 300px;position: absolute;">
      <p class="">
        <?php echo $ex['ex_descr'] == '' ? 'No description' : $ex['ex_descr']?>
      </p>  
    </div>
  </div>
<?php else: ?>
  <ol id="ex-today" class="w3-row-padding" style="position: relative;">
    <?php foreach ($wp_today as $key => $routine): ?>
      <?php $ex = $exercises_data[$routine['ex_id']] ?>
      <li class="ex w3-col l4">
        <h3 class="w3-accordion" style="text-transform: capitalize;">
          <?php echo $ex['ex_title'] ?>
          <i class="ex-info icon-info2 w3-text-blue" style="font-size: 0.8em;font-weight: lighter;"></i>
        </h3>
        <p><?php echo $routine['wp_ex_details'] ?></p>
        <div class="ex-descr w3-accordion-content w3-container w3-blue w3-animate-zoom" style="width: 300px;position: absolute;">
          <p class="">
            <?php echo $ex['ex_descr'] == '' ? 'No description' : $ex['ex_descr']?>
          </p>  
        </div>
      </li>            
    <?php endforeach ?>
    <!-- <li class="ex w3-col l4">
      <h3 class="w3-accordion">Bulgarian Split Squat
        <i class="ex-info icon-info2 w3-text-blue" style="font-size: 0.8em;font-weight: lighter;"></i>
      </h3>
      <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      <div class="ex-descr w3-accordion-content w3-container w3-blue w3-animate-zoom" style="width: 300px;position: absolute;">
        <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        </p>  
      </div>
    </li>
    <li class="ex w3-col l4">
      <h3 class="w3-accordion">Bulgarian Split Squat
        <i class="ex-info icon-info2 w3-text-blue" style="font-size: 0.8em;font-weight: lighter;"></i>
      </h3>
      <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      <div class="ex-descr w3-accordion-content w3-container w3-blue w3-animate-zoom" style="width: 300px;position: absolute;">
        <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        </p>  
      </div>
    </li>
    <li class="ex w3-col l4">
      <h3 class="w3-accordion">DIP <i class="icon2-info-with-circle w3-text-blue" style="font-size: 0.7em;"></i>
      </h3>
      <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      <div class="ex-descr w3-accordion-content w3-container w3-blue w3-animate-zoom" style="width: 300px;position: absolute;">
        <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        </p>  
      </div>
    </li>
    <li class="ex w3-col l4">
      <h3>Russian Twist
        <i class="ex-info icon-info2 w3-text-blue" style="font-size: 0.8em;font-weight: lighter;"></i>
      </h3>
      <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      <div class="ex-descr w3-accordion-content w3-container w3-blue w3-animate-zoom" style="width: 300px;position: absolute;">
        <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        </p>  
      </div>
    </li>
    <li class="ex w3-col l4">
      <h3>Dumbbell Squat
        <i class="ex-info icon-info2 w3-text-blue" style="font-size: 0.8em;font-weight: lighter;"></i>
      </h3>
      <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      <div class="ex-descr w3-accordion-content w3-container w3-blue w3-animate-zoom" style="width: 300px;position: absolute;">
        <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        </p>  
      </div>
    </li>
    <li class="ex w3-col l4">
      <h3>Push Up
        <i class="ex-info icon-info2 w3-text-blue" style="font-size: 0.8em;font-weight: lighter;"></i>
      </h3>
      <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
      <div class="ex-descr w3-accordion-content w3-container w3-blue w3-animate-zoom" style="width: 300px;position: absolute;">
        <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        </p>  
      </div>
    </li> -->
  </ol>




<?php for ($i=1; $i<=7; $i++): ?>
  <div class="w3-col l4">
    <h3 class="w3-padding w3-center <?php echo 'tt-code'.$prog_id ?>">
      <?php echo "Day " . $i ?>
    </h3>
    <?php if ($i == 2 || $i == 4): ?>
      <h1 class="w3-center"><i>REST</i></h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
    <?php else: ?>
      <ol class="" style="position: relative;">
        <li class="ex">
          <h4 class="w3-accordion">DIP
            <i class="ex-info icon-info2 w3-text-blue" style="font-size: 0.8em;font-weight: lighter;"></i>       
          </h4>
          <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
          <hr>
          <!-- <p>
            <span class="w3-half">Sets:</span><span class="w3-half">3</span><br>
            <span class="w3-half">Reps:</span><span class="w3-half">8-10</span><br>
            <span class="w3-half">Rest:</span><span class="w3-half">30 sec</span><br>
          </p> -->
          <div class="ex-descr w3-accordion-content w3-container w3-blue w3-animate-zoom" style="width: 300px;position: absolute;z-index: 1">
            <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            </p>  
          </div>
        </li>
        <li class="ex">
          <h4 class="w3-accordion">Bulgarian Split Squat
            <i class="ex-info icon-info2 w3-text-blue" style="font-size: 0.8em;font-weight: lighter;"></i>
          </h4>
          <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
          <hr>
          <!-- <p>
            <span class="w3-half">Sets:</span><span class="w3-half">3</span><br>
            <span class="w3-half">Reps:</span><span class="w3-half">8-10</span><br>
            <span class="w3-half">Rest:</span><span class="w3-half">30 sec</span><br>
          </p> -->
          <div class="ex-descr w3-accordion-content w3-container w3-blue w3-animate-zoom" style="width: 300px;position: absolute;">
            <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            </p>  
          </div>
        </li>
        <li class="ex">
          <h4>Russian Twist
            <i class="ex-info icon-info2 w3-text-blue" style="font-size: 0.8em;font-weight: lighter;"></i>
          </h4>
          <p>Sets: 3, Reps: 8-10, Rest: 30 sec.</p>
          <!-- <p>
            <span class="w3-half">Sets:</span><span class="w3-half">3</span><br>
            <span class="w3-half">Reps:</span><span class="w3-half">8-10</span><br>
            <span class="w3-half">Rest:</span><span class="w3-half">30 sec</span><br>
          </p> -->
          <div class="ex-descr w3-accordion-content w3-container w3-blue w3-animate-zoom" style="width: 300px;position: absolute;">
            <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            </p>  
          </div>
        </li>
      </ol>
    <?php endif ?>
  </div>        
<?php endfor ?>


<?php if (count($wp_daily) == 1): ?>
  <?php $routine = $wp_daily[0]; $ex = $exercises_data[$routine['ex_id']]; ?>
  <div class="ex">
    <h2 class="w3-accordion" style="text-transform: uppercase;">
      <?php echo $ex['ex_title'] ?>
      <i class="ex-info icon-info2 w3-text-blue" style="font-size: 0.8em;font-weight: lighter;"></i>
    </h2>
    <h3><?php echo $routine['wp_ex_details'] ?></h3>
    <div class="ex-descr w3-accordion-content w3-container w3-blue w3-animate-zoom" style="width: 300px;position: absolute;">
      <p class="">
        <?php echo $ex['ex_descr'] == '' ? 'No description' : $ex['ex_descr']?>
      </p>  
    </div>
  </div>
<?php else: ?>
  <ol id="ex-today" class="w3-row-padding" style="position: relative;">
    <?php foreach ($wp_daily as $key => $routine): ?>
      <?php $ex = $exercises_data[$routine['ex_id']] ?>
      <li class="ex w3-col l4">
        <h3 class="w3-accordion" style="text-transform: capitalize;">
          <?php echo $ex['ex_title'] ?>
          <i class="ex-info icon-info2 w3-text-blue" style="font-size: 0.8em;font-weight: lighter;"></i>
        </h3>
        <p><?php echo $routine['wp_ex_details'] ?></p>
        <div class="ex-descr w3-accordion-content w3-container w3-blue w3-animate-zoom" style="width: 300px;position: absolute;">
          <p class="">
            <?php echo $ex['ex_descr'] == '' ? 'No description' : $ex['ex_descr']?>
          </p>  
        </div>
      </li>            
    <?php endforeach ?>
  </ol>