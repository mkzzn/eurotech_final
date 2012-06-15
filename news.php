<!DOCTYPE html>

<?php
   include 'db/config.php';
   include 'db/open_db.php';
   $active_page = "news";
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
    
    <title>PG 1000 Cutting Tool Inspection System by Euro-Tech | News</title>
    
    <link rel="stylesheet" type="text/css" media="all" href="css/primary.css" />
    <link rel="stylesheet" type="text/css" media="all" href="css/news.css" />
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

      <div id="content">
        <h1>What's New?</h1>
<div id='news'>
  <div class='news left'>
    <h2>
      <div class='title'>
        Product Development
      </div>
      <div class='clear'></div>
    </h2>

<?php
   $result = mysql_query("select * from news where section = 'News'") or die('Query failed. ' . mysql_error());
?>


    <div class='body'>
      <div class='container'>
        <div class='description'>
          <?php
             while($row = mysql_fetch_assoc($result)) {
               if ($row['section'] == 'News') {
           ?>

            <p>
              <?php echo $row['content']; ?>
            </p>
          <?php
              }
            }
          ?>
        </div>
      </div>
      <div class='clear'></div>
    </div>
  </div>

  <?php
   $result = mysql_query("select * from news where section = 'Tradeshows'") or die('Query failed. ' . mysql_error());


     while($row = mysql_fetch_assoc($result)) {
       if ($row['section'] == 'Tradeshows') {
  ?>

    <div class='news'>
      <h2>
        <div class='title'>
            <?php echo $row['title']; ?>
        </div>
        <div class='clear'></div>
      </h2>
      <div class='body'>
        <div class='container'>
          <img src='images/products/pg1000_basic.jpg' width='210' />
          <div class='description'>
            <?php echo $row['content']; ?>
          </div>
        </div>
        <div class='clear'></div>
      </div>
    </div>

  <?php
      }
    }
  ?>

</div>
<div class='clear'></div>

      </div>

      <?php include 'app/views/_footer.php'; ?>

      <div class="clear"></div>
	  </div>
  </body>
</html>
