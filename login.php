 <!DOCTYPE html>

<?php
  include 'db/config.php';
  include 'db/open_db.php';
  $active_page = "downloads";

  $query   = "SELECT custname, user_id FROM tbl_auth_user WHERE BINARY user_id = '" . $_POST['username'] . "' AND user_password = '" . $_POST['password'] . "' LIMIT 1";
echo $query;

  $result  = mysql_query($query) or die('Error, query failed');

  $rowcount = mysql_num_rows($result);
  echo "success=$rowcount";

  while($row = mysql_fetch_array($result)) {
    $name = $row['custname'];
    $user_id = $_GET['username'];
    echo "&user_id=$user_id&custname=Welcome $name!";
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
include 'app/views/_login_form.php';
?>
<div class='clear'></div>

      </div>

      <?php include 'app/views/_footer.php'; ?>

      <div class="clear"></div>
	  </div>
  </body>
</html>
