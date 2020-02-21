<?php session_start(); ?>
<?php require 'includes/db/connectdb_imarisha.php'; ?>
<?php require 'includes/db/db_functions.php' ?>

<?php
$user = $_SESSION["user"];
$user_type = $_SESSION["user_type"];
$timetable_data = getTimetable($conn);

mysqli_close($conn);
?>


<!-- HTML5 boilerplate -->
<?php require 'includes/views/head.php'; ?>

<div>
	<?php echo $user[$user_type.'_name'] ?>
</div>

<div class="w3-row-padding" id="days-list">
  <?php require 'includes/views/function_generate_tt.php' ?>
  <?php generateTt($timetable_data, 8) ?>
</div>
<!-- Footer -->
<?php require 'includes/views/footer.php'; ?>