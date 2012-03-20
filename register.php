 <!DOCTYPE html>

      <?php
        include 'db/config.php';
        include 'db/open_db.php';
        $active_page = "downloads";

$tableName = "tbl_auth_user";

//Post all of the users information (md5 Encrypt the password)

$form_name = $_POST['form_name'];
$name = $_POST['name'];
$company = $_POST['company'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$country = $_POST['country'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$email = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// error checking
$errors = array();

if ($password != $confirm_password) {
  $errors[] = "Password and confirmation do not match.";
}

if ($login == "") {
  $errors[] = "Login cannot be blank.";
} else {
  //grab all the usernames in the table
  $sql1 = mysql_query("SELECT * FROM $tableName WHERE user_id = '$login'");
  $row1 = mysql_num_rows($sql1);

  if ($row1 > 0) {
    $errors[] = "Login is already in use.";
  }
}

if ($email == "") {
  $errors[] = "Email cannot be blank.";
} else {
  //grab all the emails in the table
  $sql2 = mysql_query("SELECT * FROM $tableName WHERE email = '$email'");
  $row2 = mysql_num_rows($sql2);

  if($row2 > 0) {
    $errors[] = "Email is already in use.";
  }
}
	
if (count($errors) == 0) {
	//if there was no existing username or email, insert all their information into the database.
	$insert = mysql_query("INSERT INTO $tableName (custname,company,address1,address2,city,state,zipcode,country,phone,fax,email,user_id,user_password) VALUES ('$name','$company','$address1','$address2','$city','$state','$zip','$country','$phone','$fax','$email','$login','$password')") or die(mysql_error());
	//This is required for and HTML email to be sent through PHP.
	
	$subject = "Thanks for registering with PG1000.com!";
	$message = "Hello $name! Thank you for registering with PG1000.com.\n\nYour username is: $login \n\nYour Password is: $password";
	$from = "info@pg1000.com";
	$headers = "From: $from";
	mail($email,$subject,$message,$headers);
	
	$email2 = "michael@eurotechcorp.com";
	$subject2 = "A new user has registered at PG1000.com";	
	$message2 = "A new user has registered at PG1000.com:\n\n
	Name: $name\n
	Company: $company\n
	Address: $address1\n$address2\n$city, $state  $zip\n$country\n
	Phone: $phone\n
	Fax: $fax\n
	Email: $email";
	mail($email2,$subject2,$message2,$headers);
	//and echo "Successfully registered!" and take them to a "thanks for registering" frame in flash
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
include 'app/views/_registration_form.php';
?>

<div class='clear'></div>

      </div>

      <?php include 'app/views/_footer.php'; ?>

      <div class="clear"></div>
	  </div>
  </body>
</html>
