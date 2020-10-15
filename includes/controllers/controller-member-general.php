<?php require 'includes/functions-helper.php' ?>
<?php require 'includes/db/functions-db.php' ?>

<?php
session_start();
if ( !isset($_SESSION['client']) ) {
  header('Location: index.php#sign-in');
} 

$client = $_SESSION['client'];
$username = $client['client_username'];
$dob = $client['client_dob'];
$gender = $client['client_gender'];
$exp = $client['client_exp'];

if ( is_null($dob) || is_null($gender) || is_null($exp) ) {
  redirect('member-welcome.php', 'user='.$username.'&welcome');
}

date_default_timezone_set("Africa/Nairobi");
$prog_id = $client['client_prog_id'];
$start_str = $client['sub_startdate'];
$start_date = date_create($start_str);
$end_str = $client['sub_enddate'];
$end_date = date_create($end_str);
$sub_active = strtotime("now") < strtotime($end_str);
$sub_startdate = format_sqldate($start_str);
$sub_enddate = format_sqldate($end_str);

$today = get_today();
?>

<!-- db data -->
<?php require 'includes/db/connectdb-imarisha.php'; ?>

<?php 
$programs = getPrograms($conn);
$prog_data = $programs[$prog_id];//The client's subscribed program's data
mysqli_close($conn);
?>

<?php
$time_left = date_diff(date_create('now'), $end_date);
$prog_duration = $prog_data['prog_duration'];

$week_count = $sub_active ? min($prog_duration + 1 - ceil($time_left->format('%R%a')/7), $prog_duration) : null; 
?>