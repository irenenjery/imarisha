<?php require 'includes/db/connectdb_imarisha.php'; ?>
<?php require 'includes/db/db_functions.php' ?>

<?php 
$programs = getPrograms($conn);
mysqli_close($conn);
?>