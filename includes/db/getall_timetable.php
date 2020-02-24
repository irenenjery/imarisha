<?php require 'includes/db/connectdb_imarisha.php'; ?>
<?php require 'includes/db/db_functions.php' ?>

<?php 
$timetable_data = getTimetable($conn);
mysqli_close($conn);
?>