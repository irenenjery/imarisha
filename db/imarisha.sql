-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2020 at 06:57 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imarisha`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `app_id` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_email` varchar(255) NOT NULL,
  `app_phone` int(11) NOT NULL,
  `app_resume` varchar(255) NOT NULL,
  `app_exp` enum('intern','beginner','intermediate','pro','guru') NOT NULL,
  `app_specialty` varchar(255) NOT NULL DEFAULT 'intern'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class_schedule`
--

CREATE TABLE `class_schedule` (
  `class_day` enum('mon','tue','wed','thur','fri','sat','sun') NOT NULL,
  `class_time` time NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '2',
  `prog_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_schedule`
--

INSERT INTO `class_schedule` (`class_day`, `class_time`, `duration`, `prog_id`, `coach_id`) VALUES
('mon', '07:30:00', 2, 4, 4),
('mon', '10:00:00', 2, 7, 6),
('mon', '14:00:00', 2, 5, 5),
('mon', '16:00:00', 2, 8, 8),
('mon', '18:00:00', 2, 5, 5),
('tue', '07:30:00', 2, 7, 6),
('tue', '10:00:00', 2, 4, 4),
('tue', '14:00:00', 2, 6, 7),
('tue', '16:00:00', 2, 6, 7),
('tue', '18:00:00', 2, 5, 5),
('wed', '07:30:00', 2, 5, 5),
('wed', '10:00:00', 2, 7, 6),
('wed', '14:00:00', 2, 4, 4),
('wed', '16:00:00', 2, 8, 8),
('wed', '18:00:00', 2, 7, 6),
('thur', '07:30:00', 2, 5, 5),
('thur', '10:00:00', 2, 7, 6),
('thur', '14:00:00', 2, 4, 4),
('thur', '16:00:00', 2, 8, 8),
('thur', '18:00:00', 2, 5, 5),
('fri', '07:30:00', 2, 4, 4),
('fri', '10:00:00', 2, 4, 4),
('fri', '14:00:00', 2, 7, 6),
('fri', '16:00:00', 2, 6, 7),
('fri', '18:00:00', 2, 5, 5),
('sat', '07:30:00', 2, 4, 4),
('sat', '10:00:00', 2, 7, 6),
('sat', '14:00:00', 2, 4, 5),
('sat', '16:00:00', 2, 8, 8),
('sat', '18:00:00', 2, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_gender` enum('m','f') DEFAULT NULL,
  `client_dob` date DEFAULT NULL,
  `client_exp` enum('beginner','intermediate','advanced') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`, `client_gender`, `client_dob`, `client_exp`) VALUES
(2, 'John Dorean', 'm', '1997-01-28', 'intermediate'),
(19, 'daphne duck', 'f', '1999-05-14', 'beginner'),
(20, 'john duck', 'm', '1992-03-03', 'advanced'),
(21, 'mike dean', 'm', '2000-02-29', 'beginner'),
(22, 'eye reen', 'f', '1997-04-14', 'advanced'),
(24, 'captain awesome', 'm', '1995-03-03', 'advanced'),
(27, 'captain obvious', 'f', '1999-04-21', 'intermediate'),
(30, 'you you', 'f', '1997-09-17', 'intermediate'),
(31, 'shrek shrek', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients_auth`
--

CREATE TABLE `clients_auth` (
  `client_id` int(11) NOT NULL DEFAULT '0',
  `client_username` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients_auth`
--

INSERT INTO `clients_auth` (`client_id`, `client_username`, `client_email`, `client_pass`) VALUES
(2, 'johndoe', 'johndoe@fake.com', '$2y$10$DaoguGek6xxeC5SkvoPaqOKl9U0o5pVkgDMLrF2n2XtJjIaacCWJO'),
(19, 'daphne', 'daphneduck@theducks.com', '$2y$10$S.A/ThYJxjg3dTfQ8kJ2I..thL0Sg53ai1LSQm3LCdoT6Zp0fiXvm'),
(20, 'johnduck', 'johnduck@theducks.com', '$2y$10$OudG0ooLNXtmHhWov5diceeP/P.N3.59rbI6WD5t2wdIKb4NR088i'),
(21, 'mikedean', 'mikedean@fake.com', '$2y$10$Bfe5sI6bNhDCATWJpNlCg..IV/qJ9KfpzpmKNUamVH5u3ETiyHgm.'),
(22, 'eyeReen', 'eyereen@fake.com', '$2y$10$HA0sVP4WNSDt2HJJsWGgdeyfDM579WIEoo16/.m/GZChhxUlXJ.h6'),
(24, 'awesome', 'awesome@captain.com', '$2y$10$.T4JGo7tiGPmmKQtE4lYau4GrIByMsVtogyqJwohiQ1HlppQO7Ywy'),
(27, 'obvious', 'obvious@captain.com', '$2y$10$SRMQGZ5XG3esZ6aFQAChR.7SligofqWuCA8D2tALz3vwRA/GM/7i2'),
(30, 'you', 'you@you.you', '$2y$10$Wp0OnHOBNGroc/xVUO9E.OQf3Y/fS5a33bciujunKTpSaBHNsFbIe'),
(31, 'shrek', 'shrek@shrek.shrek', '$2y$10$bM3vMBtBoBkrmXWxWvXg/uAi8BsdP/AQ4ULtioenBaR31uBAu3tIe');

-- --------------------------------------------------------

--
-- Stand-in structure for view `clients_view`
--
CREATE TABLE `clients_view` (
`client_id` int(11)
,`client_name` varchar(255)
,`client_username` varchar(255)
,`client_email` varchar(255)
,`client_gender` enum('m','f')
,`client_dob` date
,`client_exp` enum('beginner','intermediate','advanced')
,`client_prog_id` int(11)
,`client_sub_prog` varchar(255)
,`sub_startdate` date
,`sub_enddate` date
);

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `coach_id` int(11) NOT NULL,
  `coach_name` varchar(255) NOT NULL,
  `coach_gender` enum('m','f') NOT NULL,
  `coach_dob` date NOT NULL,
  `coach_exp` enum('intern','beginner','intermediate','pro','guru') NOT NULL DEFAULT 'intern',
  `role_id` int(11) NOT NULL DEFAULT '3',
  `coach_prof` varchar(255) NOT NULL,
  `prof_pic` varchar(255) NOT NULL DEFAULT 'default_coach.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`coach_id`, `coach_name`, `coach_gender`, `coach_dob`, `coach_exp`, `role_id`, `coach_prof`, `prof_pic`) VALUES
(4, 'John Lifts', 'm', '1988-11-11', 'pro', 4, 'Fitness trainer for everyone- man or woman, beginner or advanced', 'default_coach.jpg'),
(5, 'Jimat Beach', 'm', '1990-08-25', 'beginner', 4, 'I think, I can, I am\r\nI think, I can, I am', 'prof_gymbeach_500x333.jpg'),
(6, 'Maybe Babie', 'f', '1992-07-17', 'intermediate', 7, 'Weight loss babie', 'prof_baby_500x333.jpg'),
(7, 'karate kitty', 'f', '1987-03-15', 'guru', 6, 'I specialize in muscle mass building for women', 'prof_karate_500x333.jpg'),
(8, 'arnie shwarz', 'm', '1987-06-30', 'guru', 8, 'Get to the chopper', 'prof_arnie_500x333.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `coaches_auth`
--

CREATE TABLE `coaches_auth` (
  `coach_id` int(11) NOT NULL DEFAULT '0',
  `coach_username` varchar(255) NOT NULL,
  `coach_email` varchar(255) NOT NULL,
  `coach_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coaches_auth`
--

INSERT INTO `coaches_auth` (`coach_id`, `coach_username`, `coach_email`, `coach_pass`) VALUES
(4, '@johnlifts', 'johnlifts@fake.com', '$2y$10$c7vhnC1grn33u9aCk5WgX.UN9TNdU0SnisCEejgihXmfnauLoLJuy'),
(5, '@Jimat', 'jim@BEACH.com', '$2y$10$JdRMxc4G3rjorsBhx38CYeN5wauepCaEyZ0/Vy40JlikxBtryozZq'),
(6, '@maybeBabie', 'maybebabie@fake.com', '$2y$10$YiHw3UF3GT5DeWLPcalvwekVawsWHwFWVpa0TWOvEfanDbur2QXyW'),
(7, '@karatekitty', 'karatekitty@fake.com', '$2y$10$FjytIJry3tvp2IhjvmnTLuQFf815sjTQXc6lnO41pfK8UycKz5AHC'),
(8, '@arnie', 'arnie@fake.com', '$2y$10$AOwr6fgm/soswNEOeTERkeQWAntWulAMcQJ8Mmt.PnBvnX.fnZHfS');

-- --------------------------------------------------------

--
-- Stand-in structure for view `coaches_view`
--
CREATE TABLE `coaches_view` (
`coach_id` int(11)
,`coach_username` varchar(255)
,`coach_email` varchar(255)
,`coach_name` varchar(255)
,`coach_gender` enum('m','f')
,`coach_dob` date
,`coach_exp` enum('intern','beginner','intermediate','pro','guru')
,`coach_prof` varchar(255)
,`coach_role` varchar(255)
,`coach_prof_pic` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `ex_id` int(11) NOT NULL,
  `ex_title` varchar(255) NOT NULL,
  `ex_descr` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`ex_id`, `ex_title`, `ex_descr`) VALUES
(1, 'Dip', ''),
(2, 'Bulgarian Split Squat', ''),
(3, 'Russian Twist', ''),
(4, 'Dumbbell Squat', ''),
(5, 'Push Up', 'Put your hands up in the air just like you don\'t care.'),
(6, 'Reverse Lunge', ''),
(7, 'Rest', '');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `prog_id` int(11) NOT NULL,
  `prog_title` varchar(255) NOT NULL,
  `prog_price` int(11) NOT NULL,
  `prog_duration` int(11) NOT NULL DEFAULT '4',
  `prog_descr` text NOT NULL,
  `prog_pic` varchar(255) NOT NULL DEFAULT 'default_program.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`prog_id`, `prog_title`, `prog_price`, `prog_duration`, `prog_descr`, `prog_pic`) VALUES
(4, 'fitness', 1500, 3, 'General fitness training works towards  broad goals of overall health and well-being.', 'program_fitness.jpg'),
(5, 'crossfit', 2999, 8, 'A fitness program that combines a wide variety of functional movements into a timed or scored workout.', 'program_crossfit.jpg'),
(6, 'women strength', 2399, 6, 'Get strong and fit with this strength training workout plan for women. Build sexy muscles all over your body', 'program_womenstrength.jpg'),
(7, 'weight loss', 1599, 4, 'Attack your weight-loss goals by diving into this minimal-equipment, fat-burning routine', 'program_weightloss.jpg'),
(8, 'muscle building', 5399, 12, 'This workout is designed to increase your muscle mass as much as possible', 'program_muscle.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_title` varchar(255) NOT NULL,
  `role_descr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_title`, `role_descr`) VALUES
(1, 'Head Coach', 'Oversees all training sessions'),
(2, 'Assistant Head Coach', 'Plans class sessions; time, coach and place under head coach'),
(3, 'Intern Coach', 'Coach under review and works under all other coaches.'),
(4, 'Fitness Trainer', 'Involved in fitness and crossfit classes'),
(6, 'Women Strength Trainer', 'Strength training specific for women'),
(7, 'Weight Loss Trainer', 'Weight loss and nutrition training for both men and women'),
(8, 'Muscle Building', 'Involves men and women strength and muscle building training');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `sub_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `prog_id` int(11) NOT NULL,
  `sub_startdate` date NOT NULL,
  `sub_enddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`sub_id`, `client_id`, `prog_id`, `sub_startdate`, `sub_enddate`) VALUES
(2, 2, 8, '2020-02-25', '2020-05-19'),
(13, 19, 5, '2020-03-09', '2020-05-11'),
(14, 20, 7, '2020-03-17', '2020-04-14'),
(15, 21, 8, '2020-01-21', '2020-04-14'),
(16, 22, 4, '2020-03-13', '2020-04-03'),
(18, 24, 4, '2020-03-17', '2020-03-04'),
(21, 27, 8, '2020-03-03', '2020-05-26'),
(24, 30, 4, '2020-03-13', '2020-04-03'),
(25, 31, 7, '2020-03-19', '2020-03-19');

-- --------------------------------------------------------

--
-- Stand-in structure for view `timetable_view`
--
CREATE TABLE `timetable_view` (
`tt_day` enum('mon','tue','wed','thur','fri','sat','sun')
,`tt_starttime` time
,`tt_endtime` time
,`tt_prog_id` int(11)
,`tt_program` varchar(255)
,`tt_coach_id` int(11)
,`tt_coach` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `training_exercises`
--

CREATE TABLE `training_exercises` (
  `prog_id` int(11) NOT NULL,
  `routine` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_exercises`
--

INSERT INTO `training_exercises` (`prog_id`, `routine`) VALUES
(4, 'Barbell squats: 5 sets of 5 reps<br>\r\nBarbell Deadlifts: 3 sets of 3 reps<br>\r\nPush-ups (or dips): 3 sets of 15 reps<br>\r\nPull-ups (or Inverted Rows): 3 sets of 8 reps<br>\r\nPlanks: 3 sets, 1 minute hold each<br>\r\n'),
(5, '7 handstand push-ups<br>\n135 lb thruster, 7 reps<br>\n7 knees to elbows<br>\n245 lb deadlift, 7 reps<br>\n7 burpees<br>\n7 kettlebell swings, 2 pood (72 lb)<br>\n7 pull-ups<br>\n'),
(6, 'Start with hands on wall and low back flat to floor<br>\r\nKeep hands pressing into wall<br>\r\nLift legs to 90 degrees, knees bent<br>\r\nSlowly reach one leg out, pause and exhale through mouth<br>\r\nPress low back into floor as you exhale<br>\r\nYou should feel abs working<br>\r\nStart with 3 sets of 5 reps/leg<br>\r\n'),
(7, 'Circuit Training<br>\r\nSquat + Curl<br>\r\nPush Ups<br>\r\nDumbbell Row + Fly<br>\r\nBench Step Ups<br>\r\nLunge + Front Raise<br>\r\nRenegade Rows<br>\r\nIncline Dumbbell Press<br>\r\n'),
(8, 'Barbell Bench Press: 4<br>\r\nIncline Bench Press: 3<br>\r\nDecline Bench Press: 3<br>\r\nDumbbell Flys: 2<br>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `workoutplan_4`
--

CREATE TABLE `workoutplan_4` (
  `wp_id` int(11) NOT NULL,
  `wp_day` enum('mon','tue','wed','thur','fri','sat','sun') NOT NULL,
  `ex_id` int(11) NOT NULL DEFAULT '7',
  `wp_ex_details` varchar(255) NOT NULL DEFAULT 'Take a walking exercise, a jog or skip rope. No intensive workouts'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workoutplan_4`
--

INSERT INTO `workoutplan_4` (`wp_id`, `wp_day`, `ex_id`, `wp_ex_details`) VALUES
(1, 'mon', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(2, 'mon', 2, 'Sets: 4, Reps: 8-10, Rest: 45 sec.'),
(3, 'mon', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(4, 'tue', 3, 'Sets: 5, Reps: 5-7, Rest: 15 sec.'),
(5, 'tue', 4, 'Sets: 10, Reps: 3-5, Rest: 30 sec.'),
(6, 'tue', 5, 'Sets: 20, Reps: 3-5, Rest: 30 sec.'),
(7, 'thur', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(8, 'thur', 2, 'Sets: 4, Reps: 8-10, Rest: 45 sec.'),
(9, 'thur', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec'),
(10, 'fri', 3, 'Sets: 5, Reps: 5-10, Rest: 45 sec.'),
(11, 'fri', 3, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(12, 'fri', 5, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(13, 'wed', 7, 'Take a walking exercise, a jog or skip rope. No intensive workouts'),
(14, 'sat', 7, 'Take a walking exercise, a jog or skip rope. No intensive workouts'),
(15, 'sun', 7, 'Take a walking exercise, a jog or skip rope. No intensive workouts');

-- --------------------------------------------------------

--
-- Table structure for table `workoutplan_5`
--

CREATE TABLE `workoutplan_5` (
  `wp_id` int(11) NOT NULL,
  `wp_day` enum('mon','tue','wed','thur','fri','sat','sun') NOT NULL,
  `ex_id` int(11) NOT NULL DEFAULT '7',
  `wp_ex_details` varchar(255) NOT NULL DEFAULT 'Take a walking exercise, a jog or skip rope. No intensive workouts'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workoutplan_5`
--

INSERT INTO `workoutplan_5` (`wp_id`, `wp_day`, `ex_id`, `wp_ex_details`) VALUES
(1, 'mon', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(2, 'mon', 2, 'Sets: 4, Reps: 8-10, Rest: 45 sec.'),
(3, 'mon', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(4, 'tue', 3, 'Sets: 5, Reps: 5-7, Rest: 15 sec.'),
(5, 'tue', 4, 'Sets: 10, Reps: 3-5, Rest: 30 sec.'),
(6, 'tue', 5, 'Sets: 20, Reps: 3-5, Rest: 30 sec.'),
(7, 'thur', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(8, 'thur', 2, 'Sets: 4, Reps: 8-10, Rest: 45 sec.'),
(9, 'thur', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec'),
(10, 'fri', 3, 'Sets: 5, Reps: 5-10, Rest: 45 sec.'),
(11, 'fri', 3, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(12, 'fri', 5, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(13, 'wed', 7, 'Take a walking exercise, a jog or skip rope. No intensive workouts'),
(14, 'sat', 7, 'Take a walking exercise, a jog or skip rope. No intensive workouts'),
(15, 'sun', 7, 'Take a walking exercise, a jog or skip rope. No intensive workouts');

-- --------------------------------------------------------

--
-- Table structure for table `workoutplan_6`
--

CREATE TABLE `workoutplan_6` (
  `wp_id` int(11) NOT NULL,
  `wp_day` enum('mon','tue','wed','thur','fri','sat','sun') NOT NULL,
  `ex_id` int(11) NOT NULL DEFAULT '7',
  `wp_ex_details` varchar(255) NOT NULL DEFAULT 'Take a walking exercise, a jog or skip rope. No intensive workouts'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workoutplan_6`
--

INSERT INTO `workoutplan_6` (`wp_id`, `wp_day`, `ex_id`, `wp_ex_details`) VALUES
(1, 'mon', 5, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(2, 'mon', 4, 'Sets: 4, Reps: 8-10, Rest: 45 sec.'),
(3, 'mon', 3, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(4, 'tue', 2, 'Sets: 5, Reps: 5-7, Rest: 15 sec.'),
(5, 'tue', 1, 'Sets: 10, Reps: 3-5, Rest: 30 sec.'),
(6, 'tue', 3, 'Sets: 20, Reps: 3-5, Rest: 30 sec.'),
(7, 'thur', 5, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(8, 'thur', 3, 'Sets: 4, Reps: 8-10, Rest: 45 sec.'),
(9, 'thur', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(10, 'fri', 5, 'Sets: 5, Reps: 5-10, Rest: 45 sec.'),
(11, 'fri', 4, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(12, 'fri', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(13, 'wed', 5, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(14, 'wed', 6, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(15, 'wed', 2, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(16, 'sat', 7, 'Take a walking exercise, a jog or skip rope. No intensive workouts'),
(17, 'sun', 7, 'Take a walking exercise, a jog or skip rope. No intensive workouts');

-- --------------------------------------------------------

--
-- Table structure for table `workoutplan_7`
--

CREATE TABLE `workoutplan_7` (
  `wp_id` int(11) NOT NULL,
  `wp_day` enum('mon','tue','wed','thur','fri','sat','sun') NOT NULL,
  `ex_id` int(11) NOT NULL DEFAULT '7',
  `wp_ex_details` varchar(255) NOT NULL DEFAULT 'Take a walking exercise, a jog or skip rope. No intensive workouts'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workoutplan_7`
--

INSERT INTO `workoutplan_7` (`wp_id`, `wp_day`, `ex_id`, `wp_ex_details`) VALUES
(1, 'mon', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(2, 'mon', 2, 'Sets: 4, Reps: 8-10, Rest: 45 sec.'),
(3, 'mon', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(4, 'tue', 3, 'Sets: 5, Reps: 5-7, Rest: 15 sec.'),
(5, 'tue', 4, 'Sets: 10, Reps: 3-5, Rest: 30 sec.'),
(7, 'thur', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(8, 'thur', 2, 'Sets: 4, Reps: 8-10, Rest: 45 sec.'),
(10, 'fri', 3, 'Sets: 5, Reps: 5-10, Rest: 45 sec.'),
(11, 'fri', 3, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(13, 'wed', 6, 'Sets: 4, Reps: 8-10, Rest: 45 sec.'),
(14, 'sat', 4, 'Sets: 4, Reps: 8-10, Rest: 45 sec.'),
(15, 'sun', 7, 'Take a walking exercise, a jog or skip rope. No intensive workouts'),
(16, 'wed', 4, 'Sets: 4, Reps: 8-10, Rest: 45 sec'),
(17, 'wed', 5, 'Sets: 4, Reps: 8-10, Rest: 45 sec'),
(18, 'fri', 1, 'Sets: 4, Reps: 8-10, Rest: 45 sec'),
(19, 'sat', 3, 'Sets: 4, Reps: 8-10, Rest: 45 sec.'),
(20, 'sat', 4, 'Sets: 4, Reps: 8-10, Rest: 45 sec.');

-- --------------------------------------------------------

--
-- Table structure for table `workoutplan_8`
--

CREATE TABLE `workoutplan_8` (
  `wp_id` int(11) NOT NULL,
  `wp_day` enum('mon','tue','wed','thur','fri','sat','sun') NOT NULL,
  `ex_id` int(11) NOT NULL DEFAULT '7',
  `wp_ex_details` varchar(255) NOT NULL DEFAULT 'Take a walking exercise, a jog or skip rope. No intensive workouts'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workoutplan_8`
--

INSERT INTO `workoutplan_8` (`wp_id`, `wp_day`, `ex_id`, `wp_ex_details`) VALUES
(1, 'mon', 5, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(2, 'mon', 4, 'Sets: 4, Reps: 8-10, Rest: 45 sec.'),
(3, 'mon', 3, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(4, 'tue', 2, 'Sets: 5, Reps: 5-7, Rest: 15 sec.'),
(5, 'tue', 1, 'Sets: 10, Reps: 3-5, Rest: 30 sec.'),
(6, 'tue', 3, 'Sets: 20, Reps: 3-5, Rest: 30 sec.'),
(7, 'thur', 5, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(8, 'thur', 3, 'Sets: 4, Reps: 8-10, Rest: 45 sec.'),
(9, 'thur', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(10, 'fri', 5, 'Sets: 5, Reps: 5-10, Rest: 45 sec.'),
(11, 'fri', 4, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(12, 'fri', 1, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(13, 'wed', 5, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(14, 'wed', 6, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(15, 'wed', 2, 'Sets: 3, Reps: 8-10, Rest: 30 sec.'),
(16, 'sat', 7, 'Take a walking exercise, a jog or skip rope. No intensive workouts'),
(17, 'sun', 7, 'Take a walking exercise, a jog or skip rope. No intensive workouts');

-- --------------------------------------------------------

--
-- Structure for view `clients_view`
--
DROP TABLE IF EXISTS `clients_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `clients_view`  AS  select `c`.`client_id` AS `client_id`,`c`.`client_name` AS `client_name`,`ca`.`client_username` AS `client_username`,`ca`.`client_email` AS `client_email`,`c`.`client_gender` AS `client_gender`,`c`.`client_dob` AS `client_dob`,`c`.`client_exp` AS `client_exp`,`p`.`prog_id` AS `client_prog_id`,`p`.`prog_title` AS `client_sub_prog`,`s`.`sub_startdate` AS `sub_startdate`,`s`.`sub_enddate` AS `sub_enddate` from (((`clients` `c` left join `clients_auth` `ca` on((`ca`.`client_id` = `c`.`client_id`))) left join `subscriptions` `s` on((`s`.`client_id` = `c`.`client_id`))) left join `programs` `p` on((`s`.`prog_id` = `p`.`prog_id`))) order by `p`.`prog_id` ;

-- --------------------------------------------------------

--
-- Structure for view `coaches_view`
--
DROP TABLE IF EXISTS `coaches_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `coaches_view`  AS  select `c`.`coach_id` AS `coach_id`,`ca`.`coach_username` AS `coach_username`,`ca`.`coach_email` AS `coach_email`,`c`.`coach_name` AS `coach_name`,`c`.`coach_gender` AS `coach_gender`,`c`.`coach_dob` AS `coach_dob`,`c`.`coach_exp` AS `coach_exp`,`c`.`coach_prof` AS `coach_prof`,`r`.`role_title` AS `coach_role`,`c`.`prof_pic` AS `coach_prof_pic` from ((`coaches` `c` left join `coaches_auth` `ca` on((`ca`.`coach_id` = `c`.`coach_id`))) left join `roles` `r` on((`r`.`role_id` = `c`.`role_id`))) order by `r`.`role_id`,`c`.`coach_id` ;

-- --------------------------------------------------------

--
-- Structure for view `timetable_view`
--
DROP TABLE IF EXISTS `timetable_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `timetable_view`  AS  select `cs`.`class_day` AS `tt_day`,`cs`.`class_time` AS `tt_starttime`,(`cs`.`class_time` + interval `cs`.`duration` hour) AS `tt_endtime`,`p`.`prog_id` AS `tt_prog_id`,`p`.`prog_title` AS `tt_program`,`c`.`coach_id` AS `tt_coach_id`,`c`.`coach_name` AS `tt_coach` from ((`class_schedule` `cs` join `programs` `p`) join `coaches` `c`) where ((`cs`.`prog_id` = `p`.`prog_id`) and (`cs`.`coach_id` = `c`.`coach_id`)) order by `cs`.`class_day`,`cs`.`class_time` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`app_id`),
  ADD UNIQUE KEY `app_email` (`app_email`),
  ADD UNIQUE KEY `app_phone` (`app_phone`);

--
-- Indexes for table `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD PRIMARY KEY (`class_day`,`class_time`),
  ADD KEY `prog_id` (`prog_id`),
  ADD KEY `coach_id` (`coach_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `clients_auth`
--
ALTER TABLE `clients_auth`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `client_id` (`client_id`);

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`coach_id`),
  ADD UNIQUE KEY `coach_name` (`coach_name`),
  ADD KEY `coaches_ibfk_1` (`role_id`);

--
-- Indexes for table `coaches_auth`
--
ALTER TABLE `coaches_auth`
  ADD PRIMARY KEY (`coach_id`),
  ADD UNIQUE KEY `coach_id` (`coach_id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`ex_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`prog_id`),
  ADD UNIQUE KEY `prog_title` (`prog_title`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `uc_RoleID` (`role_title`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `prog_id` (`prog_id`);

--
-- Indexes for table `training_exercises`
--
ALTER TABLE `training_exercises`
  ADD PRIMARY KEY (`prog_id`);

--
-- Indexes for table `workoutplan_4`
--
ALTER TABLE `workoutplan_4`
  ADD PRIMARY KEY (`wp_id`),
  ADD KEY `ex_id` (`ex_id`);

--
-- Indexes for table `workoutplan_5`
--
ALTER TABLE `workoutplan_5`
  ADD PRIMARY KEY (`wp_id`),
  ADD KEY `ex_id` (`ex_id`),
  ADD KEY `ex_id_2` (`ex_id`);

--
-- Indexes for table `workoutplan_6`
--
ALTER TABLE `workoutplan_6`
  ADD PRIMARY KEY (`wp_id`),
  ADD KEY `ex_id` (`ex_id`);

--
-- Indexes for table `workoutplan_7`
--
ALTER TABLE `workoutplan_7`
  ADD PRIMARY KEY (`wp_id`),
  ADD KEY `ex_id` (`ex_id`);

--
-- Indexes for table `workoutplan_8`
--
ALTER TABLE `workoutplan_8`
  ADD PRIMARY KEY (`wp_id`),
  ADD KEY `ex_id` (`ex_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `prog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `workoutplan_4`
--
ALTER TABLE `workoutplan_4`
  MODIFY `wp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `workoutplan_5`
--
ALTER TABLE `workoutplan_5`
  MODIFY `wp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `workoutplan_6`
--
ALTER TABLE `workoutplan_6`
  MODIFY `wp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `workoutplan_7`
--
ALTER TABLE `workoutplan_7`
  MODIFY `wp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `workoutplan_8`
--
ALTER TABLE `workoutplan_8`
  MODIFY `wp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD CONSTRAINT `class_schedule_ibfk_1` FOREIGN KEY (`prog_id`) REFERENCES `programs` (`prog_id`),
  ADD CONSTRAINT `class_schedule_ibfk_2` FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`coach_id`);

--
-- Constraints for table `clients_auth`
--
ALTER TABLE `clients_auth`
  ADD CONSTRAINT `clients_auth_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `coaches`
--
ALTER TABLE `coaches`
  ADD CONSTRAINT `coaches_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Constraints for table `coaches_auth`
--
ALTER TABLE `coaches_auth`
  ADD CONSTRAINT `coaches_auth_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`coach_id`);

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`prog_id`) REFERENCES `programs` (`prog_id`);

--
-- Constraints for table `workoutplan_4`
--
ALTER TABLE `workoutplan_4`
  ADD CONSTRAINT `workoutplan_4_ibfk_1` FOREIGN KEY (`ex_id`) REFERENCES `exercises` (`ex_id`);

--
-- Constraints for table `workoutplan_5`
--
ALTER TABLE `workoutplan_5`
  ADD CONSTRAINT `workoutplan_5_ibfk_1` FOREIGN KEY (`ex_id`) REFERENCES `exercises` (`ex_id`);

--
-- Constraints for table `workoutplan_6`
--
ALTER TABLE `workoutplan_6`
  ADD CONSTRAINT `workoutplan_6_ibfk_1` FOREIGN KEY (`ex_id`) REFERENCES `exercises` (`ex_id`);

--
-- Constraints for table `workoutplan_7`
--
ALTER TABLE `workoutplan_7`
  ADD CONSTRAINT `workoutplan_7_ibfk_1` FOREIGN KEY (`ex_id`) REFERENCES `exercises` (`ex_id`);

--
-- Constraints for table `workoutplan_8`
--
ALTER TABLE `workoutplan_8`
  ADD CONSTRAINT `workoutplan_8_ibfk_1` FOREIGN KEY (`ex_id`) REFERENCES `exercises` (`ex_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
