-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2020 at 10:58 AM
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
  `client_email` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_pass` varchar(255) NOT NULL,
  `client_username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_email`, `client_name`, `client_pass`, `client_username`) VALUES
(2, 'johndoe@fake.com', 'John Dorean', '$2y$10$EEpIQ26qpXNBL1/JCjE6fumm0OtUJJyL/6n6iYkX7cSa0Pyn53DLa ', 'johndoe'),
(19, 'daphneduck@theducks.com', 'daphne duck', '$2y$10$z8ARdY0E7hVaQ8arnQwL5ukXdNKQxDyjbvYSGLnif0WXj86EOVHXy', 'daphne'),
(20, 'johnduck@theducks.com', 'john duck', '$2y$10$OudG0ooLNXtmHhWov5diceeP/P.N3.59rbI6WD5t2wdIKb4NR088i', 'johnduck'),
(21, 'mikedean@fake.com', 'mike dean', '$2y$10$Bfe5sI6bNhDCATWJpNlCg..IV/qJ9KfpzpmKNUamVH5u3ETiyHgm.', 'mikedean');

-- --------------------------------------------------------

--
-- Stand-in structure for view `clients_view`
--
CREATE TABLE `clients_view` (
`client_id` int(11)
,`client_email` varchar(255)
,`client_username` varchar(255)
,`client_name` varchar(255)
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
  `coach_username` varchar(255) NOT NULL,
  `coach_email` varchar(255) NOT NULL,
  `coach_name` varchar(255) NOT NULL,
  `coach_pass` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '3',
  `coach_prof` varchar(255) NOT NULL,
  `prof_pic` varchar(255) NOT NULL DEFAULT 'default_coach.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`coach_id`, `coach_username`, `coach_email`, `coach_name`, `coach_pass`, `role_id`, `coach_prof`, `prof_pic`) VALUES
(4, '@johnlifts', 'johnlifts@fake.com', 'John Lifts', '$2y$10$c7vhnC1grn33u9aCk5WgX.UN9TNdU0SnisCEejgihXmfnauLoLJuy', 4, 'Fitness trainer for everyone- man or woman, beginner or advanced', 'default_coach.jpg'),
(5, '@Jimat', 'jim@BEACH.com', 'Jimat Beach', '$2y$10$JdRMxc4G3rjorsBhx38CYeN5wauepCaEyZ0/Vy40JlikxBtryozZq', 4, 'I think, I can, I am\r\nI think, I can, I am', 'prof_gymbeach_500x333.jpg'),
(6, '@maybeBabie', 'maybebabie@fake.com', 'Maybe Babie', '$2y$10$YiHw3UF3GT5DeWLPcalvwekVawsWHwFWVpa0TWOvEfanDbur2QXyW', 7, 'Weight loss babie', 'prof_baby_500x333.jpg'),
(7, '@karatekitty', 'karatekitty@fake.com', 'karate kitty', '$2y$10$FjytIJry3tvp2IhjvmnTLuQFf815sjTQXc6lnO41pfK8UycKz5AHC', 6, 'I specialize in muscle mass building for women6', 'prof_karate_500x333.jpg'),
(8, '@arnie', 'arnie@fake.com', 'arnie shwarz', '$2y$10$AlqmVVtM8V5eGDyXsDZ8xOl8DkEzchVK44QF09WZ5YqkRhh3EUYlC', 8, 'Get to the chopper', 'prof_arnie_500x333.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `coaches_view`
--
CREATE TABLE `coaches_view` (
`coach_id` int(11)
,`coach_username` varchar(255)
,`coach_email` varchar(255)
,`coach_name` varchar(255)
,`coach_prof` varchar(255)
,`coach_role` varchar(255)
,`coach_prof_pic` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `prog_id` int(11) NOT NULL,
  `prog_title` varchar(255) NOT NULL,
  `prog_price` int(11) NOT NULL,
  `prog_descr` text NOT NULL,
  `recommended_routine` text NOT NULL,
  `prog_pic` varchar(255) NOT NULL DEFAULT 'default_program.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`prog_id`, `prog_title`, `prog_price`, `prog_descr`, `recommended_routine`, `prog_pic`) VALUES
(4, 'fitness', 1500, 'General fitness training works towards  broad goals of overall health and well-being.', 'Barbell squats: 5 sets of 5 reps<br>\r\nBarbell Deadlifts: 3 sets of 3 reps<br>\r\nPush-ups (or dips): 3 sets of 15 reps<br>\r\nPull-ups (or Inverted Rows): 3 sets of 8 reps<br>\r\nPlanks: 3 sets, 1 minute hold each<br>\r\n', 'program_fitness.jpg'),
(5, 'crossfit', 2099, 'A fitness program that combines a wide variety of functional movements into a timed or scored workout.', '7 handstand push-ups<br>\r\n135 lb thruster, 7 reps<br>\r\n7 knees to elbows<br>\r\n245 lb deadlift, 7 reps<br>\r\n7 burpees<br>\r\n7 kettlebell swings, 2 pood (72 lb)<br>\r\n7 pull-ups<br>\r\n', 'program_crossfit.jpg'),
(6, 'women strength', 2000, 'Get strong and fit with this strength training workout plan for women. Build sexy muscles all over your body', 'Start with hands on wall and low back flat to floor<br>\r\nKeep hands pressing into wall<br>\r\nLift legs to 90 degrees, knees bent<br>\r\nSlowly reach one leg out, pause and exhale through mouth<br>\r\nPress low back into floor as you exhale<br>\r\nYou should feel abs working<br>\r\nStart with 3 sets of 5 reps/leg<br>\r\n', 'program_womenstrength.jpg'),
(7, 'weight loss', 1599, 'Attack your weight-loss goals by diving into this minimal-equipment, fat-burning routine', 'Circuit Training<br>\r\nSquat + Curl<br>\r\nPush Ups<br>\r\nDumbbell Row + Fly<br>\r\nBench Step Ups<br>\r\nLunge + Front Raise<br>\r\nRenegade Rows<br>\r\nIncline Dumbbell Press<br>\r\n', 'program_weightloss.jpg'),
(8, 'muscle building', 2399, 'This workout is designed to increase your muscle mass as much as possible', 'Barbell Bench Press: 4<br>\r\nIncline Bench Press: 3<br>\r\nDecline Bench Press: 3<br>\r\nDumbbell Flys: 2<br>\r\n', 'program_muscle.jpg');

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
(2, 2, 8, '2020-01-01', '2020-02-29'),
(13, 19, 5, '2020-02-20', '2020-02-20'),
(14, 20, 7, '2020-02-22', '2020-05-31'),
(15, 21, 8, '2020-02-24', '2020-02-24');

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
-- Structure for view `clients_view`
--
DROP TABLE IF EXISTS `clients_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `clients_view`  AS  select `c`.`client_id` AS `client_id`,`c`.`client_email` AS `client_email`,`c`.`client_username` AS `client_username`,`c`.`client_name` AS `client_name`,`p`.`prog_id` AS `client_prog_id`,`p`.`prog_title` AS `client_sub_prog`,`s`.`sub_startdate` AS `sub_startdate`,`s`.`sub_enddate` AS `sub_enddate` from ((`clients` `c` left join `subscriptions` `s` on((`s`.`client_id` = `c`.`client_id`))) left join `programs` `p` on((`s`.`prog_id` = `p`.`prog_id`))) order by `p`.`prog_id` ;

-- --------------------------------------------------------

--
-- Structure for view `coaches_view`
--
DROP TABLE IF EXISTS `coaches_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `coaches_view`  AS  select `c`.`coach_id` AS `coach_id`,`c`.`coach_username` AS `coach_username`,`c`.`coach_email` AS `coach_email`,`c`.`coach_name` AS `coach_name`,`c`.`coach_prof` AS `coach_prof`,`r`.`role_title` AS `coach_role`,`c`.`prof_pic` AS `coach_prof_pic` from (`coaches` `c` left join `roles` `r` on((`r`.`role_id` = `c`.`role_id`))) order by `r`.`role_id`,`c`.`coach_id` ;

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
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `client_name` (`client_email`);

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`coach_id`),
  ADD UNIQUE KEY `uc_CoachID` (`coach_email`),
  ADD UNIQUE KEY `coach_name` (`coach_name`),
  ADD KEY `coaches_ibfk_1` (`role_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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
-- Constraints for table `coaches`
--
ALTER TABLE `coaches`
  ADD CONSTRAINT `coaches_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`prog_id`) REFERENCES `programs` (`prog_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
