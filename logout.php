<?php
// i will keep yelling this
// DON'T FORGET TO START THE SESSION !!!
session_start();

// if the user is logged in, unset the session
if (isset($_SESSION['db_is_logged_in'])) {
	unset($_SESSION['db_is_logged_in']);
}

if (isset($_SESSION['user_id'])) {
	unset($_SESSION['user_id']);
}

// now that the user is logged out,
// go to login page
header('Location: downloads.php');
?>