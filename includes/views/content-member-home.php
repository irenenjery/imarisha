<div class="w3-content w3-padding" id="homepage-content">
  <!-- Section Today's Activity -->  
  <section class="service w3-container w3-row-padding" id="activity">
    <article class="w3-col l3" id="next-session-container" style="margin-top: 10px;">
      <a href="#timetable" style="text-decoration: none;">
        <div class="w3-black w3-padding" style="width: 80%;">
          <h3 class="w3-center">
            TODAY'S SESSIONS
          </h3>    
          <h2 class="service-title w3-center" style="font-size: 30px;font-weight: 300;padding-top: 10px;">
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
            <!-- <div class="td_time w3-text-red" style="text-decoration: line-through;">
              <i class="ion-ios-clock-outline"></i> 07:30
            </div>
            <div class="td_time w3-text-red" style="text-decoration: line-through;">
              <i class="ion-ios-clock-outline"></i> 10:00
            </div>
            <div class="td_time w3-text-green">
              <i class="ion-ios-clock-outline"></i> 16:00
            </div> -->
          </h2>
        </div>
      </a>
    </article>
    <article class="w3-col l9 w3-card-4" style="padding-left: 30px;">
      <a href="#exercises" style="text-decoration: none;" title="Check out weekly workout routines">
        <h2 class="service-title w3-padding-0 w3-center" style="font-size: 30px;">
          TODAY'S EXERCISES
        </h2>
      </a>
      <?php if ($sub_active): ?>
        <?php if (count($wp_today) == 0): ?>
          <h2><i class="ion-happy-outline"></i> Sorry, no prescribed exercises</h2>
        <?php elseif (count($wp_today) == 1): ?>
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
          </ol>
        <?php endif ?>  
      <?php else: ?>
        <h3 class="w3-text-red"><i class="ion-happy-outline"></i> Sorry, You cannot view the workout plan when your subscription is inactive. Please <a class="w3-text-blue" href="#footer">contact or visit us</a> for more info.</h3>
      <?php endif ?>
    </article>
  </section><!-- section#activity -->
  <!-- Section Videos -->  
  <section class="service w3-container w3-padding-16" id="videos">
    <h2 class="service-title w3-padding-12 w3-center" style="z-index: -1;">
      WORKOUT VIDEOS
    </h2>
    <?php if ($sub_active): ?>
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
    <?php else: ?>
      <h3 class="w3-text-red"><i class="ion-happy-outline"></i> Sorry, You cannot view the workout videos when your subscription is inactive. Please <a class="w3-text-blue" href="#footer">contact or visit us</a> for more info.</h3>
    <?php endif ?>
  </section><!-- section#videos -->
  <!-- Section Timetable -->  
  <section class="service w3-container w3-padding-16" id="timetable">
    <h2 class="service-title w3-padding-12 w3-center">
      GYM SESSIONS
    </h2>
    <div class="w3-row-padding" id="days-list">
      <?php generate_timetable($timetable_data) ?>
    </div>
  </section><!-- section#timetable -->
  <!-- Section Exercises -->  
  <section class="service w3-container w3-padding-16" id="exercises">
    <h2 class="service-title w3-padding-12 w3-center">
      WEEKLY EXERCISES
    </h2>
    <?php if ($sub_active): ?>
      <article id="weekly-plans" class="w3-row-padding">
        <?php foreach ($wp_weekly as $day => $wp_daily): ?>
          <div class="w3-col l4" style="min-height: 400px">
            <h3 class="w3-padding w3-center <?php echo 'tt-code'.$prog_id ?>" style="text-transform: capitalize;">
              <?php echo $day ?>
            </h3>
            <?php if (count($wp_daily) == 0): ?>
              <h2><i class="ion-happy-outline"></i> Sorry, no prescribed exercises</h2>
            <?php elseif (count($wp_daily) == 1): ?>
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
              <ol id="ex-today" class="" style="position: relative;">
                <?php foreach ($wp_daily as $key => $routine): ?>
                  <?php $ex = $exercises_data[$routine['ex_id']] ?>
                  <li class="ex">
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
            <?php endif ?>
          </div>        
        <?php endforeach ?>
      </article>
      <?php else: ?>
        <h3 class="w3-text-red"><i class="ion-happy-outline"></i> Sorry, You cannot view the workout plan when your subscription is inactive. Please <a class="w3-text-blue" href="#footer">contact or visit us</a> for more info.</h3>
      <?php endif ?>
  </section><!-- section#exercises -->
</div>