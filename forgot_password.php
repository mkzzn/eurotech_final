 <!DOCTYPE html>
<?php
  include 'db/config.php';
  include 'db/open_db.php';
  $active_page = "downloads";

  // like i said, we must never forget to start the session
  session_start();

$email = $_POST['email'];

// error checking
$errors = array();
$notices = array();

if ($_POST['form_type'] == "forgot-password") {
  if ($email == "") {
    $errors[] = "Please enter an email address.";
  } else {
    //grab all the usernames in the table
    $result = mysql_query("SELECT * FROM tbl_auth_user WHERE email = '$email' limit 1");
    $row1 = mysql_num_rows($result);

    if ($row1 == 0) {
      $errors[] = "Email does not exist in database.";
    } else {
      while($row = mysql_fetch_array($result)) {
        $notices[] = "Password reminder has been sent to your email address!  If it doesn't appear in your inbox please check your spam filter.";

        $password = $row['user_password'];
        $name = $row['custname'];

        $subject = "EuroTech PG-1000 Password Reminder";
        $message = "Hello $name!\n\nYour Password is: $password";
        $from = "info@pg1000.com";
        $headers = "From: $from";
        mail("mike@zop.io",$subject,$message,$headers);

      }
    }
  }
}

?>


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
    
    <title>PG 1000 Cutting Tool Inspection System by Euro-Tech | Forgot Password</title>
    
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
include 'app/views/_forgot_password_form.php';
?>
<div class='clear'></div>

      </div>

      <?php include 'app/views/_footer.php'; ?>

      <div class="clear"></div>
	  </div>
  </body>
</html>
