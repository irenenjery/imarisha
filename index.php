<?php require 'includes/db/connectdb_imarisha.php'; ?>
<?php require 'includes/db/db_functions.php' ?>

<?php
$programs_data = getPrograms($conn);
$coaches_data = getCoaches($conn);
$timetable_data = getTimetable($conn);

mysqli_close($conn);
?>

<!-- HTML5 boilerplate -->
<?php require 'includes/views/head.php'; ?>

<!-- Navbar (sit on top) -->
<?php require 'includes/views/guest-persistent-navbar.php'; ?>

<!-- Header -->
<header class="w3-display-container w3-content w3-text-white" style="" id="homepage-header">
  <div id="welcome" class="w3-margin-top">
    <h1 class="w3-xxlarge w3-display-middle ">
    	Welcome to <span class="w3-border w3-border-white w3-padding">IMARISHA</span>
    	<span class="w3-hide-small">Gym</span>
    </h1>
    <div id="header-contacts" class="w3-bronze w3-hide-small w3-display-bottomright w3-row-padding w3-padding w3-center">
      <div class="w3-col m4 s6">
        <i class="lnr lnr-phone-handset"> </i> 0700000000
        <p class="w3-tiny">Work hours only</p>
      </div>
      <div class="w3-col m5 s6">
        <i class="lnr lnr-map-marker"> </i>West Wakanda 
        <p class="w3-tiny">911 FakeVille, Nowhere, USK</p>
      </div>
      <div class="w3-col m3">
        <i class="lnr lnr-calendar-full"> </i> All week
        <p class="w3-tiny">8am - 9pm</p>
      </div>
    </div><!-- div#header-contacts -->
  </div><!-- div#welcome -->
</header><!-- header#homepage-header -->

<!-- Page content -->
<div class="w3-content w3-padding" id="homepage-content">
  <!-- Featured Program Section -->
  <section class="service w3-container w3-padding-16" id="programs">
    <h2 class="service-title w3-padding-12 w3-center">
      Featured Programs
    </h2>
    <div class="w3-row-padding" id="program-list">
      <?php foreach ($programs_data as $prog_id => $program): ?>
        <article class="program w3-col l4" id='<?php echo "program-".$prog_id; ?>'>
          <div class="program-content w3-hover-shadow w3-display-container">
            <a href=<?php echo "member-signup.php?program_id=".$prog_id;?>>
              <h3 class="program-title w3-center w3-display-topleft w3-padding-8">
                <span class="program-name"><?php echo $program['prog_title']; ?></span> 
                <span style="font-size: 0.65em"><i class="lnr lnr-hourglass"></i> <?php echo $program['prog_duration'] ?> weeks</span>
              </h3>
              <img class="program-img" alt="program" src=<?php echo "public/images/".$program['prog_pic'];?>>
              <div class="program-pricing w3-display-bottomright">
               <p class="program-price w3-padding">
                Ksh <span><?php echo number_format($program['prog_price']); ?></span><sub>/course</sub></p>
              </div>
            </a>
          </div>
        </article><!-- article.program --> 
      <?php endforeach ?>
      <article class="program w3-col l4 m6" id='learn-more'>
        <div class="program-content w3-display-container">
          <a href="member-signup.php" class="w3-btn w3-white w3-border w3-border-blue w3-text-blue  w3-wide w3-display-middle" style="font-size: 1.3em">
            <span>Learn more</span>
            <span class="lnr lnr-chevron-right-circle" style="vertical-align: -3px;"></span>
          </a>
        </div>
      </article>
      
    </div>
  </section><!-- section#programs -->

  <!-- Trainers Section -->
  <section class="service w3-container w3-padding-16 w3-black" id="trainers">
    <h2 class="service-title w3-padding-12 w3-center">
      OUR COACHES
    </h2>
    <div id="trainer-list" class="w3-row-padding">
      <?php $i = 0; ?>
      <?php foreach ($coaches_data as $coach_id => $coach): ?>
        <?php if ($i++ >= 4) break; ?>
        <article class="trainer w3-col l6 w3-padding-0">
          <div class="trainer-content w3-row">
            <div class="trainer-img w3-col l6 w3-display-container">
              <img src="<?php echo 'public/images/'.$coach['coach_prof_pic'] ?>" alt="trainer">
              <div class="trainer-social w3-display-bottomleft w3-padding w3-black">
                <a href="#"><span class="trainer-social-icon icon-youtube"></span></a>
                <a href="#"><span class="trainer-social-icon icon-twitter"></span></a>
                <a href="#"><span class="trainer-social-icon icon-instagram"></span></a>
              </div>
            </div>
            <div class="trainer-det w3-col m6 l6 w3-padding">
              <span class="trainer-role w3-text-red">
                <?php echo $coach['coach_role'] ?>
              </span><br>
              <span class="trainer-name">
                <?php echo $coach['coach_name'] ?>
              </span>
              <p class="trainer-descr">
                <?php echo $coach['coach_prof'] ?>
              </p>
            </div>
          </div>
        </article><!-- article.trainer -->  
      <?php endforeach ?>
    </div><!-- div#trainer-list -->
    <div id="become-trainer" class="w3-center w3-padding w3-large">
      <a href="become-trainer.php" class="w3-btn w3-bronze w3-round" style="padding: 20px;width: 60%;">Become a trainer</a>
    </div>
  </section><!-- section#trainers -->

  <!-- Featured Exercises Section -->  
  <section class="service w3-container w3-padding-16" id="exercises">
    <h2 class="service-title w3-padding-12 w3-center">
      SOME OF OUR EXERCISES
    </h2>
    <ul id="exercise-list">
      <li class="exercise w3-hover-shadow w3-tag w3-padding w3-white w3-border w3-border-black" id="weight">
        <span class="exercise-icon flaticon-weightlifting"></span>&nbsp;&nbsp;
        <span class="exercise-name">Weight Lifting</span>
      </li>
      <li class="exercise w3-hover-shadow w3-tag w3-padding w3-white w3-border w3-border-black" id="lunge">
        <span class="exercise-icon flaticon-exercise"></span>&nbsp;&nbsp;
        <span class="exercise-name">Lunge Plunk</span>
      </li>
      <li class="exercise w3-hover-shadow w3-tag w3-padding w3-white w3-border w3-border-black" id="walk">
        <span class="exercise-icon flaticon-exercise-1"></span>&nbsp;&nbsp;
        <span class="exercise-name">Walking Exercise</span>
      </li>
      <li class="exercise w3-hover-shadow w3-tag w3-padding w3-white w3-border w3-border-black" id="belly">
        <span class="exercise-icon flaticon-exercise-2"></span>&nbsp;&nbsp;
        <span class="exercise-name">Belly Crunches</span>
      </li>
      <li class="exercise w3-hover-shadow w3-tag w3-padding w3-white w3-border w3-border-black" id="weight-partner">
        <span class="exercise-icon flaticon-weightlifting-1"></span>&nbsp;&nbsp;
        <span class="exercise-name">Weight Lifting Partner</span>
      </li>
      <li class="exercise w3-hover-shadow w3-tag w3-padding w3-white w3-border w3-border-black" id="roll">
        <span class="exercise-icon flaticon-exercise-3"></span>&nbsp;&nbsp;
        <span class="exercise-name">Rolling Exercise</span>
      </li>
    </ul>
  </section><!-- section#exercises -->

  <!-- Schedule Section -->  
  <section class="service w3-container w3-padding-16" id="timetable">
    <h2 class="service-title w3-padding-12 w3-center">
      SCHEDULE
    </h2>
    <div class="w3-row-padding" id="days-list">
      <?php require 'includes/views/function_generate_tt.php' ?>
      <?php generateTt($timetable_data) ?>
    </div>
  </section><!-- section#schedule -->
</div>

<!-- Footer -->
<?php require 'includes/views/footer.php'; ?>