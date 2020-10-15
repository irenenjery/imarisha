<?php 
/**
Data to bind:
- $title, the page title, default='IMARISHA GYM'
- $prof_pic_src, img src of navtop, default='public/images/default.jpg'
- $navmain_links, default=array("home"=>"#", "calendar"=>"#", "videos"=>"#", "settings"=>"#")
- $username, $usr_position, $usr_status, $usr_prog_id, $usr_prog_name
- $main_content
- $aside_top
- $aside_title
- $aside_content
- $active_link
*/
$title='test-template';//TODO: REMOVE
$aside_top="<h2 class='im-time-now'></h2>";//TODO: REMOVE
$aside_title="<h5 class='im-date-today'></h5>";//TODO: REMOVE
if (!isset($title)) $title = 'IMARISHA GYM';
if (!isset($prof_pic_src)) $prof_pic_src = 'public/images/default.jpg';
if (!isset($navmain_links)) $navmain_links = array("home"=>$_SERVER['PHP_SELF'], "calendar"=>"#", "videos"=>"#", "settings"=>"#");
if (!isset($active_link)) $active_link = $navmain_links['home'];
if (!isset($username)) $username = 'You';
if (!isset($usr_position)) $usr_position = 'position';
if (!isset($usr_status)) $usr_status = 'status';
if (!isset($usr_prog_id)) $usr_prog_id = '';
if (!isset($usr_prog_name)) $usr_prog_name = 'IM program';
if (!isset($main_content)) $main_content = '<h1>Main Content</h1>';
if (!isset($aside_top)) $aside_top = 'Aside Top';
if (!isset($aside_title)) $aside_title = 'Aside Title';
if (!isset($aside_content)) $aside_content = 'Aside Content';
if (!isset($content_topright)) $content_topright = null;

function isLinkActive($link, $active_link)
{//TODO: proper check mechanism because URL
	return $link === $active_link ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<title><?php echo $title ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php require "includes/views/stylesheets.php"; ?>
</head>
<body class="im-body">
	<?php if (isset($_SESSION['msgs'])): ?>
		<div class="im-msgs-container">
			<?php
				display_msgs($_SESSION['msgs']);
			 	unset($_SESSION['msgs']);
			?>
		</div>
	<?php endif ?>
		<div id="extable-msgs" class="im-msgs-container show-block">
			<?php
				echo generate_msgbox('YES');
			?>
		</div>
	<div class="im-container">
		<div class="im-display-container">
			<section class="im-sidenav">
				<article class="im-navtop">
					<img class="w3-image" alt="user-image" src="<?php echo $prof_pic_src ?>" >
				</article>
				<nav id="coach-left-menu" class="im-navmain">
					<a href="<?php echo $navmain_links['home'] ?>" class="im-nav-btn w3-btn <?php echo isLinkActive($navmain_links['home'], $active_link) ?>">
						<i class="ion-ios-home-outline"></i>
					</a>
					<a href="<?php echo $navmain_links['calendar'] ?>" class="im-nav-btn w3-btn <?php echo isLinkActive($navmain_links['calendar'], $active_link) ?>">
						<i class="ion-ios-calendar-outline"></i>
					</a>
					<a href="<?php echo $navmain_links['videos'] ?>" class="im-nav-btn w3-btn <?php echo isLinkActive($navmain_links['videos'], $active_link) ?>">
						<i class="ion-ios-videocam-outline"></i>
					</a>
					<a href="<?php echo $navmain_links['settings'] ?>" class="im-nav-btn w3-btn <?php echo isLinkActive($navmain_links['settings'], $active_link) ?>">
						<i class="ion-ios-settings"></i>
					</a>
					<div class="im-nav-logo">
						<span><b>IM</b></span>
					</div>
				</nav>
			</section>
			<section class="im-main w3-row">
				<article class="im-content-top">
					<div class="im-prof-box">
						<h5 class="im-prof-name">
							<span>Hey <?php echo $username ?>&nbsp;</span>
			        <a class="im-prof-btn" href="logout.php" title="Logout">
			          <i class="ion-log-out"> </i>
			        </a> &nbsp;
			        <!-- <a class="im-prof-btn"  href="<?php #echo $navmain_links['settings'] ?>" title="Account Settings">
			          <i class="ion-ios-settings"> </i>
			        </a> -->
						</h5>
						<div class="im-prof-summ">
							<b><?php echo $usr_position ?></b>,
							<span><?php echo $usr_status ?></span>&nbsp;
							<span class="w3-tag <?php echo 'tt-code'.$usr_prog_id ?>"><?php echo $usr_prog_name ?></span>
						</div>
					</div>
					<?php if ($content_topright): ?>
						<div class="im-content-topright">
							<?php echo $content_topright ?>
							<!-- TODO: remove -->
							<a class="w3-btn w3-hover-none im-top-btn" href="#">
								Do Something
							</a>
							<!-- TODO: end remove -->
						</div>
					<?php endif ?>
				</article>
	      <article class="im-content-main w3-col l9"><!-- TODO: make content plugin -->
	      	<?php echo $main_content ?>
	      </article>
	      <article class="im-content-right w3-col l3"><!-- TODO: make content plugin -->
	      	<section class="im-aside">
	      		<article class="im-aside-top">
	      			<?php echo $aside_top ?>
	      		</article>
	      		<article class="im-aside-title">
	      			<?php echo $aside_title ?>
	      		</article>
	      		<article class="im-aside-content">
	      			<?php echo $aside_content ?>
	      		</article>
	      	</section>
	      </article>
			</section>
		</div>
	</div>
	<script src="public/javascripts/im.js"></script>
</body>
</html>
<?php
// TODO: PHPDoc
/** $msgs, a 2D array containing $msg=['status_code'=>int, 'status_msg'=>str] */
function display_msgs($msgs)
{
	foreach ($msgs as $key => $msg) {
		echo generate_msgbox($msg['status_msg'], $msg['status_code']);
	}
}
function generate_msgbox($msg, $success=true)
{
	$msgbox_class = "im-msgbox-" . ($success ? 'success' : 'fail');
	$msgbox_icon_class = $success ? 'icon-done' : 'icon2-caution';
	return "
	<article class='im-msgbox $msgbox_class'>
		<div class='im-msg'>
    	<i class='$msgbox_icon_class' style='font-size: 0.8em;'></i>
    	&nbsp;$msg
	  </div>
   	<button class='im-closebtn'>
   		<i class='ion-ios-close-outline' style='font-size: 1.2em'></i>
   	</button>
	</article>  ";
}
?>