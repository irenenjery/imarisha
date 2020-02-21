<?php
/** Redirects to the specified page */
function redirect($redirect_to, $urlparams)
{
	header("Location: " . $redirect_to . "?" . $urlparams);
}
/** Sanitizes input data for db access. */
function sanitize($data)
{
	if ( isset($data) ) {
		$data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	}
  return $data;
}
/** Sanitizes input email for db access. */
function sanitizeEmail($email)
{
	return filter_var($email, FILTER_SANITIZE_EMAIL);
}
?>