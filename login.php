<?php
ob_start();

if (!isset($_SESSION)) {
  // like i said, we must never forget to start the session
  session_start();
}

// is the one accessing this page logged in or not?
if (isset($_SESSION['db_is_logged_in']) && $_SESSION['db_is_logged_in'] == true) {
	// not logged in, move to login page
	header('Location: view_downloads.php');
	exit;
}

  include 'db/config.php';
  include 'db/open_db.php';
  $active_page = "downloads";


$login = $_POST['username'];
$password = $_POST['password'];

// error checking
$errors = array();

if ($_POST['form_type'] == "login") {
  if ($login == "") {
    $errors[] = "Username cannot be blank.";
  } else {
    //grab all the usernames in the table
    $sql1 = mysql_query("SELECT * FROM tbl_auth_user WHERE user_id = '$login'");
    $row1 = mysql_num_rows($sql1);

    if ($row1 == 0) {
      $errors[] = "Username does not exist in database.";
    }
  }

  if ($password == "") {
    $errors[] = "Password cannot be blank.";
  } else {
    //grab all the passwords in the table
    $sql2 = mysql_query("SELECT * FROM tbl_auth_user WHERE user_id = '$login' and user_password = '$password'");
    $row2 = mysql_num_rows($sql2);

    if($row2 == 0) {
      $errors[] = "Password does not match the provided username.";
    }
  }
}


  $query   = "SELECT custname, user_id FROM tbl_auth_user WHERE BINARY user_id = '" . $_POST['username'] . "' AND user_password = '" . $_POST['password'] . "' LIMIT 1";
//echo $query;

  $result  = mysql_query($query) or die('Error, query failed');

  $rowcount = mysql_num_rows($result);
//echo "success=$rowcount";

  while($row = mysql_fetch_array($result)) {
    $name = $row['custname'];
    $user_id = $row['user_id'];
    $_SESSION['db_is_logged_in'] = true;
    $_SESSION['user'] = $row;
    $_SESSION['user_id'] = $user_id;
    //echo "&user_id=$user_id&custname=Welcome $name!";
  }

ob_flush();
?>

<!DOCTYPE html>
<html>
  <head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Euro Tech, PG 1000" />
    <meta name="description" content="PG 1000 Cutting Tool Inspection System by Euro Tech" />
    <meta name="author" content="PG 1000" />
    <meta name="copyright" content="Copyright © 2012" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />
    <meta name="rating" content="general" />
    <meta name="expires" content="never" />
    <meta name="distribution" content="global" /><meta name="robots" content="index,follow" /><meta name="revisit-after" content="15 days" />
    
    <title>PG 1000 Cutting Tool Inspection System by Euro-Tech | Downloads</title>
    
    <link rel="stylesheet" type="text/css" media="all" href="css/primary.css" />
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans|Cabin|Ubuntu|Cantarell|Open+Sans|Nobile|Telex' rel='stylesheet' type='text/css'>
  </head>

  <body>
    <div id="container">
      <div id="header">
        <img id="pg1000_logo" src="images/pg1000_logo_small.png" />
        <img id="eurotech_logo" src="images/euro_tech_logo_large.png" height="160" />
        <div class="clear"></div>
      </div>
      <div class="clear"></div>

      <?php include 'app/views/_nav.php'; ?>

      <div id="content">
        
<?php
// include forms
include 'app/views/_login_form.php';
?>
<div class='clear'></div>

      </div>

      <?php include 'app/views/_footer.php'; ?>

      <div class="clear"></div>
	  </div>
  </body>
</html>
