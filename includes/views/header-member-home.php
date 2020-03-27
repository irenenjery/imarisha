<header id="member_home" class="w3-display-container w3-content w3-center" style="max-width: 1500px;height: 200px;margin-top: 15px;">
  <div id="welcome" class="w3-display-middle w3-margin-top">
    <?php if ($start_date === $end_date): ?>
      <h1 class="w3-green" style="padding: 10px 20px;text-transform: capitalize;">
        <i class="ion-ribbon-b"></i>&nbsp;
        <span class="w3-border w3-border-white w3-padding" style="text-transform: capitalize;"> <?php echo $client['client_sub_prog']; ?> </span>&nbsp; 
        course&nbsp;completed&nbsp;
        <i class="ion-ribbon-b"></i>
      </h1>      
    <?php else: ?>
      <h1 class="w3-xxlarge">
      	<a href="member-settings.php" style="text-decoration:none;">
        Program <span class="w3-border w3-border-black w3-padding" style="text-transform: capitalize;"> <?php echo $client['client_sub_prog']; ?> </span>&nbsp;
        </a>
        <?php if ( $sub_active ): ?>
  	      <span class="<?php echo 'tt-code'.$prog_id ?> w3-padding" style="font-size: 0.7em">
            Week <?php echo $week_count ?>
            <span style="font-size: 0.55em">
              / <?php echo $prog_duration ?>
            </span>
          </span><br>
        <?php else: ?>
        <a href="member-settings.php#sub-how" style="text-decoration:none;">
        	<sub class="w3-text-red">Inactive <i class="ion-ios-help-outline" style="vertical-align: -2px"></i></sub>
        </a>
      	<?php endif ?>
      </h1>
    <?php endif ?>
  </div><!-- div#welcome -->
</header><!-- header#member_home -->