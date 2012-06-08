<!DOCTYPE html>

<?php

  include 'db/config.php';
  include 'db/open_db.php';
  $active_page = "downloads";

  // like i said, we must never forget to start the session
  session_start();

  if (isset($_SESSION['user_id'])) {
    $query   = "select * from tbl_auth_user where user_id = '" . $_SESSION['user_id'] . "'";
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
        <h1>Downloads</h1>

        <h3>General Downloads</h3>
      <div id="downloads">
    <?php

      $query   = "SELECT * from gen_downloads LIMIT 1";
      $result  = mysql_query($query) or die('Error, query failed');

      $title1 = "New PG1000 Install";
      $title2 = "Major PG1000 2010 Upgrade";
      $title3 = "Minor PG1000 2010 Upgrade";
      $title4 = "PG1000 2010 File Upgrade";
      $title5 = "PG1000 Help File Upgrade";

      while($row = mysql_fetch_array($result)) {
        $i = 1;
        while ($i < 6) {
          $n = strval($i);
          if (strlen($row['install'.$n]) > 0 || strlen($row['help'.$n]) > 0) {
          ?>

            <div class="download">
          <div class="title"><?php echo ${"title".$n}; ?></div>
              <?php
              if (strlen($row['install' . $n]) > 0) {
              ?>
              <a href="<?php echo $row['install'.$n]; ?>">Installation File</a>
              <?php
              } // end strlen install 1
              if (strlen($row['help'.$n]) > 0) {
              ?>
                <a href="<?php echo $row['help'.$n]; ?>">Help File</a>
              <?php 
              } // end strlen help 1 
              ?>    
          </div>
        <?php 
            } // end nested help
          $i++;
        } // end numerical while
      } // end query while

      echo $user['user_id'];
      if ($user['private_download'] == true) {
      ?>
        <h3>Private Downloads</h3>
      <?php
      }

    ?>    
    
        
<div class='clear'></div>

      </div>

      <?php include 'app/views/_footer.php'; ?>

      <div class="clear"></div>
	  </div>
  </body>
</html>
