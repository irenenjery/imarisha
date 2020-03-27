<?php require 'includes/controllers/controller-member-general.php'; ?>

<!-- db data -->
<?php require 'includes/db/connectdb-imarisha.php'; ?>

<?php 
$timetable_data = getTimetable($conn, "tt_prog_id=$prog_id");
$wp_weekly = getWorkoutplan($conn, $prog_id);
$wp_today = $wp_weekly[$today];
$exercises_data = getExercises($conn);
mysqli_close($conn);
?>