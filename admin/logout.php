<?php
if (!isset($_SESSION)) {
// like i said, we must never forget to start the session
  session_start();
}

// if the user is logged in, unset the session
if (isset($_SESSION['db_is_logged_in'])) {
	unset($_SESSION['db_is_logged_in']);
}

// now that the user is logged out,
// go to login page
header('Location: login.php');
?>