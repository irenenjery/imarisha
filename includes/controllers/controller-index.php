<?php require 'includes/functions-helper.php'; ?>
<?php require 'includes/db/connectdb-imarisha.php'; ?>
<?php require 'includes/db/functions-db.php' ?>

<?php
$programs_data = getPrograms($conn);
$coaches_data = getCoaches($conn);
$timetable_data = getTimetable($conn);

mysqli_close($conn);
?>
