<!DOCTYPE html>

<?php

  include 'db/config.php';
  include 'db/open_db.php';
  $active_page = "downloads";

  // like i said, we must never forget to start the session
  session_start();

  if (isset($_SESSION['user_id'])) {
    $query   = "select * from tbl_auth_user where user_id = '" . $_SESSION['user_id'] . "' limit 1";
    $result  = mysql_query($query) or die('Error, query failed');
    while($row = mysql_fetch_array($result)) {
      $user = $row;
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
    
    <title>PG 1000 Cutting Tool Inspection System by Euro-Tech | Downloads</title>
    
    <link rel="stylesheet" type="text/css" media="all" href="css/primary.css" />
    <link rel="stylesheet" type="text/css" media="all" href="css/downloads.css" />
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
        <h1 class="download-headline">Downloads</h1>
        <div class="user-info">
          <?php if( $_SESSION['user_id'] ) { ?>
            <a href="logout.php">Logout</a>
            <div class="logged-in-as">You are logged in as <?php echo $_SESSION['user_id']; ?></div>
          <?php } ?>
          <div class="clear-right"></div>
        </div>

      <div id="downloads">

     <?php

      $query = "SELECT * from downloads";
      $result  = mysql_query($query) or die('Error, query failed');

      while($row = mysql_fetch_array($result)) {
      ?>

         <div class="private_download">
           <div class="name">
             <?php echo $row["name"]; ?>
         <?php if ((int)$row["size"] > 0) { ?>
             <span class="size"> (<?php echo $row["size"]; ?> bytes)</span>
         <?php } ?>
           </div>
           <?php if ($row["caption"] && strlen($row["caption"]) > 0) { ?>
             <div class="caption"><?php echo $row["caption"]; ?></div>
           <?php } ?>
           <div class="filetype"><?php echo $row["type"]; ?></div>
           <div class="download_link"><a href="<?php echo $row["path"]; ?>">Download</a></div>
         </div>
      <?php
         }
// }

    ?>    
    
        
<div class='clear'></div>

      </div>

      <?php include 'app/views/_footer.php'; ?>

      <div class="clear"></div>
	  </div>
  </body>
</html>
