<section id="member_top" class="w3-top">
 	<article class="w3-navbar w3-display-container w3-white w3-wide w3-padding-8 w3-card-2">
    <section id="logo" class="w3-padding w3-display-left">
      <a href="member-home.php" class="w3-margin-left">
        <span class="<?php echo 'tt-code'.$prog_id ?> w3-padding"><b>IM</b></span> GYM
        <sub class="" style="font-size: 0.85em;text-transform: capitalize;">
          <span class="w3-tiny w3-text-grey">|</span>
          <?php echo $today . ', ' . date('d.m.Y'); ?>
          <span class="w3-tiny w3-text-grey">|</span>
        </sub>
      </a>
		</section><!-- section#logo -->
    <?php if (!isset($_GET['welcome'])): ?>
      <ul class="w3-navbar w3-wide w3-display-middle w3-hide-medium w3-hide-small" style="display: inline-block;">
        <li><a href="member-home.php#videos">Videos</a></li>
        <li><a href="member-home.php#exercises">Exercises</a></li>
        <li><a href="member-home.php#timetable">Timetable</a></li>
      </ul>      
    <?php endif ?>
    <section id="profile" class="w3-right w3-display-right">
      <span style="font-size: 1.2em;vertical-align: 10%">
        <a href="member-home.php" style="margin-right: 10px">
        	<?php if ( isset($_GET['welcome']) ): ?>
            <i class="ion-ios-rose-outline <?php echo 'tt-text-code'.$prog_id ?> "></i>
        	<?php endif ?>
          <div class="w3-light-grey w3-text-grey pp-top" style="">
            <i class="icon2-profile-<?php echo $gender == 'f' ? 'female' : 'male'?>"></i>            
          </div>
        	<?php echo $client['client_username']; ?>
          <?php if ( isset($_GET['welcome']) ): ?>
            <i class="ion-ios-rose-outline <?php echo 'tt-text-code'.$prog_id ?>"></i>
          <?php endif ?>
        </a>
      </span>
      <div class="" style="display: inline-block;letter-spacing: normal;font-size: 1.4em;">
        <a href="logout.php" title="Logout">
          <i class="ion-log-out" style="font-size: 1.1em"> </i>
        </a> &nbsp;
        <a href="member-settings.php" title="Account Settings">
          <i class="ion-ios-settings" style="font-size: 1.1em"> </i>
        </a>
      </div>
    </section><!-- section#profile -->
  </article><!-- article.w3-navbar -->
</section><!-- section.w3-top -->