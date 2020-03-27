<header id="member_home" class="w3-display-container w3-content w3-center" style="max-width: 1500px;height: 200px;margin-top: 15px;">
  <?php if ($pass_update === true): ?>
    <div class="w3-tag w3-green w3-animate-left" id="msgbox">
      <h3>
        <span>
          <i class="icon-beenhere" style="vertical-align: -3px"></i>
          &nbsp;Password updated successfully!
        </span>&nbsp;&nbsp;
        <span onclick="this.parentElement.style.display='none'" class="w3-closebtn">&times;</span>
      </h3>
    </div> 
  <?php elseif ($pass_update === false): ?>
    <div class="w3-tag w3-red w3-animate-left" id="msgbox">
      <h3>
        <span><i class="frown-o"></i>&nbsp;Couldn't change password. Please Try again.</span>&nbsp;&nbsp;
       <span onclick="this.parentElement.style.display='none'" class="w3-closebtn">&times;</span> </h3>
    </div> 
  <?php endif ?>
  <div id="welcome" class="w3-display-middle w3-margin-top w3-hide-medium w3-hide-small">
    <h1 class="w3-xxlarge">
      Program <span class="w3-border w3-border-black w3-padding" style="text-transform: capitalize;">
      	<?php echo $client['client_sub_prog']; ?>
      </span>&nbsp;
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
  </div><!-- div#welcome -->
</header><!-- header#member_home -->