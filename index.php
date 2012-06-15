<!DOCTYPE html>

<?php
   include 'db/config.php';
   include 'db/open_db.php';
   $active_page = "home";
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
    
    <title>PG 1000 Cutting Tool Inspection System by Euro-Tech | Home</title>
    
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


<?php include "app/views/_nav.php"; ?>

<?php
   $result = mysql_query("select * from news where section = 'About';") or die('Query failed. ' . mysql_error());
   $about = mysql_fetch_assoc($result);
?>
      <div id="content">
        <h1>The Best in the Business</h1>
<div class='content large'>
  <h2><?php echo $about['title']; ?></h2>
  <div class='copy left'>
    <img src='images/homepage/machine1.jpg' width='320px' />
    <p>
      <?php echo $about['content']; ?>
    </p>
  </div>
</div>

<?php
   $result = mysql_query("select * from news where section = 'SubAbout';") or die('Query failed. ' . mysql_error());
   $sub_about = mysql_fetch_assoc($result);
?>

<div class='content small'>
  <h2><?php echo $sub_about['title']; ?></h2>
  <div class='copy right'>
  <p><?php echo $sub_about['content']; ?></p>
  </div>
</div>

<?php
  include '../close_db.php';
?>

<div class='clear'></div>

      </div>

      <?php include 'app/views/_footer.php'; ?>

      <div class="clear"></div>
	  </div>
  </body>
</html>
