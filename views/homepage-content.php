<?php 
echo '
<!-- Page content -->
<div class="w3-content w3-padding" id="homepage-content">
  <!-- Featured Program Section -->
  <section class="service w3-container w3-padding-16" id="programs">
    <h2 class="service-title w3-padding-12 w3-center">
      Featured Programs
    </h2>
    <div class="w3-row-padding" id="program-list">
      <article class="program w3-col l4" id="fitness">
        <div class="program-content w3-hover-shadow w3-display-container w3-grey">
          <a href="member-signup.php?program=fitness">
            <img class="program-img" src="../public/images/program-fitness.jpg" alt="program">
            <div class="program-pricing w3-display-bottomright">
             <p class="program-price w3-padding" style="">Ksh <span>1,500</span><sub>/month</sub></p>
            </div>
            <h3 class="program-title w3-center w3-display-topmiddle w3-padding-8">
              <span class="program-name">fitness</span>
            </h3>
          </a>
        </div>
      </article><!-- article.program -->
      <article class="program w3-col l4 m6" id="crossfit">
        <div class="program-content w3-hover-shadow w3-display-container">
          <a href="member-signup.php?program=crossfit">
            <img class="program-img" src="../public/images/program-crossfits.jpg" alt="program">
            <h3 class="program-title w3-center w3-display-topmiddle w3-padding-8">
              <span class="program-name">crossfit</span>
            </h3>
            <div class="program-pricing w3-display-bottomright">
             <p class="program-price w3-padding" style="">Ksh <span>25,000</span><sub>/yr</sub></p>
            </div>
          </a>
        </div>
      </article><!-- article.program -->
      <article class="program w3-col l4 m6" id="women-strength">
        <div class="program-content w3-hover-shadow w3-display-container">
          <a href="member-signup.php?program=women-strength">
            <img class="program-img" src="../public/images/program-women.jpg" alt="program">
            <h3 class="program-title w3-center w3-display-topmiddle w3-padding-8">
              <span class="program-name">Women Strength</span>
            </h3>
            <div class="program-pricing w3-display-bottomright">
             <p class="program-price w3-padding" style="">Ksh <span>2,000</span><sub>/month</sub></p>
            </div>
          </a>
        </div>
      </article><!-- article.program -->
      <article class="program w3-col l4 m6" id="muscle">
        <div class="program-content w3-hover-shadow w3-display-container">
          <a href="member-signup.php?program=muscle">
            <img class="program-img" src="../public/images/program-muscle.jpg" alt="program">
            <h3 class="program-title w3-center w3-display-topmiddle w3-padding-8">
              <span class="program-name">Muscle Building</span>
            </h3>
            <div class="program-pricing w3-display-bottomright">
             <p class="program-price w3-padding" style="">Ksh <span>2,399</span><sub>/month</sub></p>
            </div>
          </a>
        </div>
      </article><!-- article.program -->
      <article class="program w3-col l4 m6" id="weightloss">
        <div class="program-content w3-hover-shadow w3-display-container">
          <a href="member-signup.php?program=weightloss">
            <img class="program-img" src="../public/images/program-weightloss.jpg" alt="program">
            <h3 class="program-title w3-center w3-display-topmiddle w3-padding-8">
              <span class="program-name">Weight loss</span>
            </h3>
            <div class="program-pricing w3-display-bottomright">
             <p class="program-price w3-padding" style="">Ksh <span>1,599</span><sub>/month</sub></p>
            </div>
          </a>
        </div>
      </article><!-- article.program -->
      <article class="program w3-col l4 m6" id="private">
        <div class="program-content w3-hover-shadow w3-display-container">
          <a href="member-signup.php?program=private">
            <img class="program-img" src="../public/images/program-private3.jpg" alt="program">
            <h3 class="program-title w3-center w3-display-topmiddle w3-padding-8">
              <span class="program-name">Private Training</span>
            </h3>
            <div class="program-pricing w3-display-bottomright">
             <p class="program-price w3-padding" style="">Ksh <span>5,599</span><sub>/month</sub></p>
            </div>
          </a>
        </div>
      </article><!-- article.program -->
    </div>
  </section><!-- section#programs -->

  <!-- Trainers Section -->
  <section class="service w3-container w3-padding-16 w3-black" id="trainers">
    <h2 class="service-title w3-padding-12 w3-center">
      OUR COACHES
    </h2>
    <div id="trainer-list" class="w3-row-padding">
      <article class="trainer w3-col l6 w3-padding-0">
        <div class="trainer-content w3-row">
          <div class="trainer-img w3-col l6 w3-display-container">
            <img src="../public/images/img_baby_500x333.jpg" alt="trainer">
            <div class="trainer-social w3-display-bottomleft w3-padding w3-black">
              <a href="#"><span class="trainer-social-icon icon-youtube"></span></a>
              <a href="#"><span class="trainer-social-icon icon-twitter"></span></a>
              <a href="#"><span class="trainer-social-icon icon-instagram"></span></a>
            </div>
          </div>
          <div class="trainer-det w3-col l6 w3-padding">
            <span class="trainer-role w3-text-red">Head Coach</span><br>
            <span class="trainer-name">Maybe Babie</span>
            <p class="trainer-descr">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. </p>
          </div>
        </div>
      </article><!-- article.trainer -->
      <article class="trainer w3-col l6 w3-padding-0">
        <div class="trainer-content w3-row">
          <div class="trainer-img w3-col l6 w3-display-container">
            <img src="../public/images/img_arnie_500x333.jpg" alt="trainer">
            <div class="trainer-social w3-display-bottomleft w3-padding w3-black">
              <a href="#"><span class="trainer-social-icon icon-youtube"></span></a>
              <a href="#"><span class="trainer-social-icon icon-twitter"></span></a>
              <a href="#"><span class="trainer-social-icon icon-instagram"></span></a>
            </div>
          </div>
          <div class="trainer-det w3-col l6 w3-padding">
            <span class="trainer-role w3-text-red">Head Coach</span><br>
            <span class="trainer-name">arnie Sharzmwangi</span>
            <p class="trainer-descr">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. </p>
          </div>
        </div>
      </article><!-- article.trainer -->
      <article class="trainer w3-col l6 w3-padding-0">
        <div class="trainer-content w3-row">
          <div class="trainer-img w3-col l6 w3-display-container">
            <img src="../public/images/img_karate_500x333.jpg" alt="trainer">
            <div class="trainer-social w3-display-bottomleft w3-padding w3-black">
              <a href="#"><span class="trainer-social-icon icon-youtube"></span></a>
              <a href="#"><span class="trainer-social-icon icon-twitter"></span></a>
              <a href="#"><span class="trainer-social-icon icon-instagram"></span></a>
            </div>
          </div>
          <div class="trainer-det w3-col l6 w3-padding">
            <span class="trainer-role w3-text-red">Head Coach</span><br>
            <span class="trainer-name">karate kitty</span>
            <p class="trainer-descr">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. </p>
          </div>
        </div>
      </article><!-- article.trainer -->
      <article class="trainer w3-col l6 w3-padding-0">
        <div class="trainer-content w3-row">
          <div class="trainer-img w3-col l6 w3-display-container">
            <img src="../public/images/img_gymbeach_500x333.jpg" alt="trainer">
            <div class="trainer-social w3-display-bottomleft w3-padding">
              <a href="#"><span class="trainer-social-icon icon-youtube"></span></a>
              <a href="#"><span class="trainer-social-icon icon-twitter"></span></a>
              <a href="#"><span class="trainer-social-icon icon-instagram"></span></a>
            </div>
          </div>
          <div class="trainer-det w3-col l6 w3-padding">
            <span class="trainer-role w3-text-red">Head Coach</span><br>
            <span class="trainer-name">JimAt Beach</span>
            <p class="trainer-descr">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. </p>
          </div>
        </div>
      </article><!-- article.trainer -->
    </div><!-- div#trainer-list -->
    <div id="become-trainer" class="w3-center w3-padding w3-large">
      <a href="#" class="w3-btn w3-bronze w3-round" style="padding: 20px;width: 60%;">Become a trainer</a>
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
        <span class="exercise-name">Exercise Rolling</span>
      </li>
    </ul>
  </section><!-- section#exercises -->

  <!-- Schedule Section -->  
  <section class="service w3-container w3-padding-16" id="timetable">
    <h2 class="service-title w3-padding-12 w3-center">
      SCHEDULE
    </h2>
    <div class="w3-row-padding" id="days-list">
      <article class="tt-day w3-col l2" id="mon">
        <h3 class="title w3-red w3-padding">Monday</h3>
        
        <!-- Color-coded session stamps -->
        <div class="tt-session tt-code-fitness w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">Fitness</h5>
          <p><span class="tt-trainer">Jane Doe</span></p>
          <p class="w3-large"><span class="tt-time">09:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-weightloss w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">weight loss</h5>
          <p><span class="tt-trainer">Mike Dean</span></p>
          <p class="w3-large"><span class="tt-time">11:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-crossfit w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">Crossfit</h5>
          <p><span class="tt-trainer">John Doe</span></p>
          <p class="w3-large"><span class="tt-time">13:00</span></p>
        </div><!-- div.tt-session -->
      </article><!-- article.tt-day -->
      <article class="tt-day w3-col l2" id="tue">
        <h3 class="title w3-red w3-padding">Tuesday</h3>

        <div class="tt-session tt-code-weightloss w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">weight loss</h5>
          <p><span class="tt-trainer">Mike Dean</span></p>
          <p class="w3-large"><span class="tt-time">08:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-crossfit w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">crossfit</h5>
          <p><span class="tt-trainer">Jane Doe</span></p>
          <p class="w3-large"><span class="tt-time">10:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-fitness w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">Fitness</h5>
          <p><span class="tt-trainer">Jane Doe</span></p>
          <p class="w3-large"><span class="tt-time">14:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-muscle w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">muscle</h5>
          <p><span class="tt-trainer">Jane Doe</span></p>
          <p class="w3-large"><span class="tt-time">15:00</span></p>
        </div><!-- div.tt-session -->
      </article><!-- article.tt-day -->
      <article class="tt-day w3-col l2" id="wed">
        <h3 class="title w3-red w3-padding">Wednesday</h3>

        <div class="tt-session tt-code-fitness w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">fitness</h5>
          <p><span class="tt-trainer">Mike Dean</span></p>
          <p class="w3-large"><span class="tt-time">08:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-weightloss w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">weight loss</h5>
          <p><span class="tt-trainer">Mike Dean</span></p>
          <p class="w3-large"><span class="tt-time">10:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-women w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">women strength</h5>
          <p><span class="tt-trainer">Jane Doe</span></p>
          <p class="w3-large"><span class="tt-time">14:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-crossfit w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">crossfit</h5>
          <p><span class="tt-trainer">Jane Doe</span></p>
          <p class="w3-large"><span class="tt-time">17:00</span></p>
        </div><!-- div.tt-session -->
      </article><!-- article.tt-day -->
      <article class="tt-day w3-col l2" id="thu">
        <h3 class="title w3-red w3-padding">Thursday</h3>
        
        <!-- Color-coded session stamps -->
        <div class="tt-session tt-code-fitness w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">Fitness</h5>
          <p><span class="tt-trainer">Jane Doe</span></p>
          <p class="w3-large"><span class="tt-time">09:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-weightloss w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">weight loss</h5>
          <p><span class="tt-trainer">Mike Dean</span></p>
          <p class="w3-large"><span class="tt-time">11:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-crossfit w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">Crossfit</h5>
          <p><span class="tt-trainer">John Doe</span></p>
          <p class="w3-large"><span class="tt-time">13:00</span></p>
        </div><!-- div.tt-session -->
      </article><!-- article.tt-day -->
      <article class="tt-day w3-col l2" id="fri">
        <h3 class="title w3-red w3-padding">Friday</h3>

        <div class="tt-session tt-code-weightloss w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">weight loss</h5>
          <p><span class="tt-trainer">Mike Dean</span></p>
          <p class="w3-large"><span class="tt-time">08:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-crossfit w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">crossfit</h5>
          <p><span class="tt-trainer">Jane Doe</span></p>
          <p class="w3-large"><span class="tt-time">10:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-fitness w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">Fitness</h5>
          <p><span class="tt-trainer">Jane Doe</span></p>
          <p class="w3-large"><span class="tt-time">14:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-muscle w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">muscle</h5>
          <p><span class="tt-trainer">Jane Doe</span></p>
          <p class="w3-large"><span class="tt-time">15:00</span></p>
        </div><!-- div.tt-session -->
      </article><!-- article.tt-day -->
      <article class="tt-day w3-col l2" id="sat">
        <h3 class="title w3-red w3-padding">Saturday</h3>

        <div class="tt-session tt-code-fitness w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">fitness</h5>
          <p><span class="tt-trainer">Mike Dean</span></p>
          <p class="w3-large"><span class="tt-time">08:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-weightloss w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">weight loss</h5>
          <p><span class="tt-trainer">Mike Dean</span></p>
          <p class="w3-large"><span class="tt-time">10:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-women w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">women strength</h5>
          <p><span class="tt-trainer">Jane Doe</span></p>
          <p class="w3-large"><span class="tt-time">14:00</span></p>
        </div><!-- div.tt-session -->
        <div class="tt-session tt-code-crossfit w3-padding w3-center">
          <h5 class="tt-program w3-border-bottom w3-border-white">crossfit</h5>
          <p><span class="tt-trainer">Jane Doe</span></p>
          <p class="w3-large"><span class="tt-time">17:00</span></p>
        </div><!-- div.tt-session -->
      </article><!-- article.tt-day -->
    </div>
  </section><!-- section#schedule -->
</div>';
?>