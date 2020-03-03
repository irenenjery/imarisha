<?php
// Create Views
/**
 Creates a timetable_view by populating the class_schedule table
 data.

 The timetable_view contains the following columns:
 - 'tt_day', member from the set ('mon', 'tue', 'wed', 'thur', 'fri', 'sat', 'sun')
 - 'tt_starttime', the start time of a class
 - 'tt_endtime', the end time of a class
 - 'tt_prog_id'
 - 'tt_program', the scheduled program title
 - 'tt_coach_id'
 - 'tt_coach', the name of the assigned coach for the class
 */
function createviewTimetable($conn)
{
	$sql_create_tt_view = "
    CREATE OR REPLACE VIEW timetable_view AS
    SELECT cs.class_day AS tt_day,
      cs.class_time AS tt_starttime,
      DATE_ADD(cs.class_time, INTERVAL cs.duration HOUR) AS tt_endtime,
      p.prog_id AS tt_prog_id,
      p.prog_title AS tt_program,
      c.coach_id AS tt_coach_id,
      c.coach_name AS tt_coach
    FROM class_schedule AS cs, programs AS p, coaches AS c
    WHERE cs.prog_id = p.prog_id
    	AND cs.coach_id = c.coach_id
    ORDER BY tt_day ASC, tt_starttime ASC";        

	if (mysqli_query($conn, $sql_create_tt_view)) {
  	echo "Timetable view created successfully";
	} else {
  	echo "Error creating table: " . mysqli_error($conn);
	}
}
/**
 Creates client_view by merging clients and subscriptions table
 data.

 The client_view contains the following columns:
 - 'client_id', 
 - 'client_name', 
 - 'client_username',
 - 'client_email',
 - 'client_gender',
 - 'client_dob', the client's date of birth
 - 'client_exp', the client's level of experience in the gym
 - 'client_sub_prog', the client's subscribed program
 - 'sub_startdate', the subscription's start date
 - 'sub_enddate', the subscription's end date
 */
function createviewClients($conn)
{
	$sql_create_clients_view = "
    CREATE OR REPLACE VIEW clients_view AS
    SELECT c.client_id AS client_id, 
      c.client_name AS client_name, 
      ca.client_username AS client_username, 
      ca.client_email AS client_email, 
      c.client_gender AS client_gender,
      c.client_dob AS client_dob,
      c.client_exp AS client_exp,
      p.prog_id AS client_prog_id,
      p.prog_title AS client_sub_prog,
      s.sub_startdate AS sub_startdate,
      s.sub_enddate AS sub_enddate
    FROM clients AS c
    LEFT JOIN clients_auth AS ca
    ON ca.client_id = c.client_id
    LEFT JOIN subscriptions AS s
    ON s.client_id = c.client_id
    LEFT JOIN programs AS p
    ON s.prog_id = p.prog_id
    ORDER BY client_prog_id";

	if (mysqli_query($conn, $sql_create_clients_view)) {
    echo "Clients view created successfully";
	} else {
    echo "Error creating table: " . mysqli_error($conn);
	}
}
/**
 Creates coaches_view by merging coaches and roles table
 data.

 The coach_view contains the following columns:
 - 'coach_id',
 - 'coach_username',
 - 'coach_email',
 - 'coach_name',
 - 'coach_gender',
 - 'coach_dob', coach's date of birth
 - 'coach_exp', coach's level of gym-work experience
 - 'coach_prof', the coach's profile
 - 'coach_role', the role title of the coach
 */
function createviewCoaches($conn)
{
	$sql_create_coaches_view = "
    CREATE OR REPLACE VIEW coaches_view AS
    SELECT c.coach_id AS coach_id,
      ca.coach_username AS coach_username,
      ca.coach_email AS coach_email,
      c.coach_name AS coach_name,
      c.coach_gender AS coach_gender,
      c.coach_dob AS coach_dob,
      c.coach_exp AS coach_exp,
      c.coach_prof AS coach_prof,
      r.role_title AS coach_role,
      c.prof_pic AS coach_prof_pic
    FROM coaches AS c
    LEFT JOIN coaches_auth AS ca
    ON ca.coach_id = c.coach_id
    LEFT JOIN roles AS r
    ON r.role_id = c.role_id
    ORDER BY r.role_id, c.coach_id";

	if (mysqli_query($conn, $sql_create_coaches_view)) {
  	echo "Coaches view created successfully";
	} else {
  	echo "Error creating table: " . mysqli_error($conn);
	}
}

// Select Data
/** Returns a client's authentication details */
function getAuthClient($conn, $condition)
{
	$sql_select_clients = "
		SELECT * 
		FROM clients_auth
		WHERE " . $condition;
	$result = mysqli_query($conn, $sql_select_clients);
	$client_auth_data = array();

	if ($result && mysqli_num_rows($result) == 1) {
    while($row = mysqli_fetch_assoc($result)) {
      $client_auth_data = $row;
    }
	}
	return $client_auth_data;
}
/** Returns a coach's authentication details */
function getAuthCoach($conn, $condition)
{
	$sql_select_coaches = "
		SELECT * 
		FROM coaches_auth
		WHERE " . $condition;
	$result = mysqli_query($conn, $sql_select_coaches);
	$coach_auth_data = array();

	if ($result && mysqli_num_rows($result) == 1) {
    while($row = mysqli_fetch_assoc($result)) {
      $coach_auth_data = $row;
    }
	}
	return $coach_auth_data;
}

/**
 Returns a two-dimensional associative array of trainer applicants filtered by a specified condition.
 
 The outer array is indexed by `app_id` and each indexed member is an
 associative array, $applicant, containing:
 - $applicant['app_id']
 - $applicant['app_name']
 - $applicant['app_email']
 - $applicant['app_phone']
 - $applicant['app_resume'], applicant's uploaded resume file name
 - $applicant['app_exp'], applicant's level of experience.
 - $applicant['app_specialty'], applicant's specialty.
 */
function getApplicants($conn, $condition=true)
{
	$sql_select_applicants = "
		SELECT * 
		FROM applicants
		WHERE " . $condition;
	$result = mysqli_query($conn, $sql_select_applicants);
	$applicants_data = array();

	if ($result && mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
    	$applicants_data[$row['app_id']] = $row;
    }
	}
	return $applicants_data;
}
/**
 Returns a two-dimensional associative array of registered clients filtered by a specified condition.
 
 The outer array is indexed by `client_id` and each indexed member is an
 associative array, $client, containing:
 - $client['client_id']
 - $client['client_name']
 - $client['client_username']
 - $client['client_email']
 - $client['client_gender']
 - $client['client_dob']
 - $client['client_exp'], client's level of gym experience.
 - $client['client_sub_prog'], the program id of the program a client is subscribed to.
 - $client['sub_startdate'], subscription start date.
 - $client['sub_enddate'], subscription end date.
 */
function getClients($conn, $condition=true)
{
	$sql_select_clients = "
		SELECT * 
		FROM clients_view
		WHERE " . $condition;
	$result = mysqli_query($conn, $sql_select_clients);
	$clients_data = array();

	if ($result && mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
    	$clients_data[$row['client_id']] = $row;
    }
	}
	return $clients_data;
}
/**
 Returns a two-dimensional associative array of registered coaches filtered by a specified condition.
 
 The outer array is indexed by `coach_id` and each indexed member is an
 associative array, $coach, containing:
 - $coach['coach_id']
 - $coach['coach_username']
 - $coach['coach_email']
 - $coach['coach_name']
 - $coach['coach_gender']
 - $coach['coach_dob'], coach's date of birth
 - $coach['coach_exp'], coach's level of gym-work experience
 - $coach['coach_prof']
 - $coach['coach_role']
 - $coach['coach_progs'], array of `prog_id`s associated with a coach
 */
function getCoaches($conn, $condition=true)
{		
	$sql_select_coaches = "
		SELECT cw.coach_id AS coach_id,
      cw.coach_username AS coach_username,
      cw.coach_email AS coach_email,
      cw.coach_name AS coach_name,
      cw.coach_gender AS coach_gender,
      cw.coach_dob AS coach_dob,
      cw.coach_exp AS coach_exp,
      cw.coach_prof AS coach_prof,
      cw.coach_role AS coach_role,
      cw.coach_prof_pic AS coach_prof_pic,
      cs.prog_id AS prog_id
		FROM coaches_view AS cw, class_schedule AS cs
		WHERE cw.coach_id = cs.coach_id
			AND " . $condition;
	$result = mysqli_query($conn, $sql_select_coaches);
	$coaches_data = array();

	if ($result && mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
    	$coach_id = $row['coach_id'];
	  	if ( array_key_exists($coach_id, $coaches_data) ) {
	  		if ( !in_array($row['prog_id'], $coaches_data[$coach_id]['coach_progs']) ) {
					array_push($coaches_data[$coach_id]['coach_progs'], $row['prog_id']);
				}
			} else {
				$coaches_data[$coach_id] = $row;
				$coaches_data[$coach_id]['coach_progs'] = array($row['prog_id']);
			}
    }
	}
	return $coaches_data;
}
/**
 Returns a two-dimensional associative array of roles filtered by a specified condition.
 
 The outer array is indexed by `role_id` and each indexed member is an
 associative array, $role, containing:
 - $role['role_id']
 - $role['role_title']
 - $role['role_descr']
 */
function getRoles($conn, $condition=true)
{		
	$sql_select_roles = "
		SELECT * 
		FROM roles
		WHERE " . $condition;
	$result = mysqli_query($conn, $sql_select_roles);
	$roles_data = array();

	if ($result && mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $roles_data[$row['role_id']] = $row;
    }
	}
	return $roles_data;
}
/**
 Returns a two-dimensional associative array of programs filtered by a specified condition.
 
 The outer array is indexed by `prog_id` and each indexed member is an
 associative array, $program, containing:
 - $program['prog_id']
 - $program['prog_title']
 - $program['prog_price']
 - $program['prog_descr']
 - $program['recommended_routine']
 */
function getPrograms($conn, $condition=true)
{		
	$sql_select_prog = "
		SELECT *
	  FROM programs
		WHERE " . $condition;

	$result = mysqli_query($conn, $sql_select_prog);
	$programs_data = array();

	if ($result && mysqli_num_rows($result) > 0) {
	  while($row = mysqli_fetch_assoc($result)) {
	  	$programs_data[$row['prog_id']] = $row;
	  }
	}
	return $programs_data;
}
/**
 Returns a timetable of scheduled classes grouped by days as an associative array.

 Each member represents a day of the week,  
 	$days = array('mon', 'tue', 'wed', 'thur', 'fri', 'sat', 'sun')
 and each day contains all programs scheduled for that day:
 - $tt[$day][$index]['tt_day'], eg $tt['mon'][0]['tt_day'] == 'mon'
 - $tt[$day][$index]['tt_starttime'], eg $tt['mon'][0]['tt_starttime'] == '07:30:00'
 - $tt[$day][$index]['tt_endtime'], eg $tt['mon'][0]['tt_endtime'] == '09:30:00'
 - $tt[$day][$index]['tt_prog_id']
 - $tt[$day][$index]['tt_program'], eg $tt['mon'][0]['tt_program'] == 'crossfit'
 - $tt[$day][$index]['tt_coach_id']
 - $tt[$day][$index]['tt_coach'], eg $tt['mon'][0]['tt_coach'] == 'Jane Doe'
 */
function getTimetable($conn, $condition=true)
{
	$sql_select_tt = "
		SELECT *
		FROM timetable_view
		WHERE " . $condition;
	$result = mysqli_query($conn, $sql_select_tt);

	$tt_data = array();

	if ($result && mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
    	$tt_day = $row['tt_day'];

	  	if ( array_key_exists($tt_day, $tt_data) ) {
				array_push($tt_data[$tt_day], $row);
			} else {
				$tt_data[$tt_day] = array($row);
			}
		}
	}
	return $tt_data;
}
?>