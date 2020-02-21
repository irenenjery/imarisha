<?php 
echo '
<div class="w3-top">
 	<ul class="w3-navbar w3-white w3-wide w3-padding-8 w3-card-2">
    <li id="logo">
			<a href="index.php" class="w3-margin-left">
				<b class="w3-hide-medium">IMARISHA</b><b class="w3-hide-large w3-hide-small">IM</b>GYM
			</a>
		</li><!-- li#logo -->
		<!-- Show them on small screens -->
		<li id="btn-small" class="w3-hide-medium w3-hide-large">
			<a href="login.php" class="w3-btn w3-blue w3-tiny" style="display:inline-block;">login</a>
		</li><!-- li#btn-small -->
		<!-- Hide them on small screens -->
    <li id="top-form" class="w3-right w3-hide-small" style="margin-right:20px">
      <form id="sign-in" name="sign-in" action="#" method="POST">
        <input type="text" name="username" placeholder="username" required \>
        <input type="password" name="username" placeholder="password" required \>
        <button type="submit" class="w3-btn w3-blue">
          <span class="w3-small" style="letter-spacing: 4px">login</span>
        </button>
      </form><!-- form#sign-in -->
    </li><!-- li#top-form -->
  </ul><!-- ul.w3-navbar -->
</div><!-- div.w3-top -->';
?>