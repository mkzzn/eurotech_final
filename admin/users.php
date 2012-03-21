<?php
// like i said, we must never forget to start the session
session_start();

// is the one accessing this page logged in or not?
if (!isset($_SESSION['db_is_logged_in']) || $_SESSION['db_is_logged_in'] !== true) {
	// not logged in, move to login page
	header('Location: login.php');
	exit;
}
include 'library/config.php';
include 'library/opendb.php';

?>
<html>
<head>
<title>Admin Page For Content Management System (CMS)</title>

<LINK REL=StyleSheet HREF="admincss.css" TYPE="text/css" MEDIA=screen>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<div class=content>

<?php
  include 'header.php';
?>

<form action="user_response.php" method="POST">
  <div id="users">
  <?php
  $result = mysql_query("select * from tbl_auth_user where user_id != '' and user_id is not null order by user_id ASC") or die('Query failed. ' . mysql_error());

  $users = array(); // to use in the quote request form
  while($user = mysql_fetch_assoc($result)) {
    $users[] = $user;
  }

  foreach($users as $user) {
    $user_id = $user['user_id'];
  ?>

  <div class="user">
    <div class="name"><?php echo $user_id; ?></div>
    <div class="inputs">
      <input name="private_downloads[]" type="checkbox" value="<?php echo $user_id; ?>" />
    </div>
  </div>

<?php
  }
  include 'library/closedb.php';
?>

  </div>
</form>

<div id="footer">
  (c) pg1000.com
</div>
</div>
</body>
</html>
