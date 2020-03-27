<div class="w3-content w3-padding" id="homepage-content">
  <section class="service w3-row-padding" id="member-details"> 
    <article class="w3-col l6" id="account">
      <h2 class="service-title w3-padding-12 w3-center">
        Account Details
      </h2>
      <form onsubmit="validate_form(); return false" class="w3-container w3-padding" style="margin-top: -50px" autocomplete="off" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="form-update">
        <p>
          <label for="name" class="w3-text-grey">Full name</label>
          <input class="w3-input w3-validate" type="text" name="lname" placeholder="name" id="name" value="<?php echo $client['client_name'] ?>" readonly>
        <p>
          <label for="username" class="w3-text-grey">Username</label>
          <input class="w3-input w3-validate" type="text" name="username" value="<?php echo $client['client_username'] ?>" id="username" readonly>
        </p>
        <p>
          <label for="email" class="w3-text-grey">Email</label>
          <input class="w3-input" type="email" name="email" value="<?php echo $client['client_email'] ?>" id="email" readonly>
        </p>
        <p>
          <label for="pass">Change password</label>
          <input class="w3-input" type="password" name="pass" placeholder="new password" id="pass" value="" oninput="validate_password()" autocomplete="off">
        </p>
        <p>
          <input class="w3-input" type="password" name="pass2" placeholder="confirm password" id="pass2" onchange="validate_password()" oninput="validate_password()">
          <span class="warning w3-text-red" id="passwarning" style="visibility: hidden;">Passwords don't match</span>
        </p>
        <p>
          <button type="submit" class="w3-btn-block w3-teal w3-large">Change details</button>
        </p>
      </form>
    </article>  
    <article class="w3-col l6" id="subscription">
      <div id="sub-details" class="w3-card-8">
        <h2 class="service-title w3-padding-12 w3-center">
          Subscription details
        </h2>
        <table class="w3-large" style="width: 90%;margin: -20px 0 0 60px;padding: 10px;text-transform: capitalize;">
          <tr>
            <td>Program:</td>
            <td>
              <a href="#prog<?php echo $prog_id ?>" style="text-decoration: none;">
                <?php echo $client['client_sub_prog'] ?>
                 <i class="ion-ios-help-outline" style="font-size: 1.3em;vertical-align: -2px"></i>
              </a>
            </td>
          </tr>
          <tr>
            <td>Price:</td>
            <td>ksh <?php echo number_format($prog_data['prog_price'])?> per month</td>
          </tr>
          <tr>
            <td>Status:</td>
            <?php if ( $sub_active ): ?>
              <td class="w3-text-green">active</td>
            <?php else: ?>
              <td class="w3-text-red">inactive</td>
            <?php endif ?>
          </tr>
          <?php if ( $sub_active ): ?>
            <tr>
              <td>Subscription start date:</td>
              <td><?php echo $sub_startdate; ?></td>
            </tr>
            <tr>
              <td>Subscription end date:</td>
              <td><?php echo $sub_enddate; ?></td>
            </tr>
            <tr>
              <td>Program duration:</td>
              <td>
                <?php echo $prog_duration . " weeks"; ?>
              </td>
            </tr>
          <?php endif ?>
        </table>
      </div>
      <?php if (!$sub_active): ?>
        <div id="sub-how" class="w3-black w3-padding" style="margin-top: 20px;">
          <h2 class="service-title w3-padding-12 w3-center" style="font-size: 28px">
            How do i activate my subscription?
          </h2>
          <p class="" style="font-size: 1.1em;">To activate your subscription, visit us at:
            <blockquote><i class="lnr lnr-map-marker"></i>&nbsp;&nbsp;<span>West Wakanda 911 FakeVille, Nowhere, USK</span></blockquote>
            <span style="font-size: 1.1em;">or contact us:</span>
            <blockquote>
              <i class="lnr lnr-phone-handset"></i>&nbsp;&nbsp;<span>+254 70000000</span><br><br>
              <i class="lnr lnr-envelope"></i>&nbsp;&nbsp;<span>imarisha@fakemail.gym</span><br> 
            </blockquote>
          </p>
        </div>        
      <?php endif ?>
    </article>    
  </section><!-- section#member-details -->
  <section class="service" id="available-programs" style="margin-top: 50px;">
    <h2 class="service-title w3-padding-12 w3-center">
      Available Programs
    </h2>
    <p style="font-style: italic;">
      <i class="ex-info icon-info2 w3-text-blue" style="font-size: 1.4em;vertical-align: -3px"></i> To change your current program to another, please <a class="w3-text-blue" href="#footer">contact or visit us</a> for more info.
    </p>
    <article class="w3-row-padding" id="programs-list" style="margin-top: 30px;">
      <?php foreach ($programs as $p_id => $program): ?>
        <?php $preselected = $p_id == $prog_id; ?>
        <div class="prog w3-col l4 w3-leftbar w3-bottombar w3-border-white w3-padding <?php echo $preselected ? 'selected_prog' : 'w3-black' ?> " id="prog<?php echo $p_id ?>" style="height: 300px;">
          <h2 class="prog-title w3-padding-12 w3-center">
            <?php echo $program['prog_title'] ?>
          </h2>
          <p style="height: 90px;text-overflow: auto;"><?php echo $program['prog_descr'] ?></p>
          <p>
            <b>Price: </b> ksh <?php echo number_format($program['prog_price']) ?> per course <br>
            <b>Duration: </b> <?php echo $program['prog_duration'] ?> week course
          </p>
        </div>
      <?php endforeach ?>
    </article>
  </section><!-- section#available-programs -->
</div>