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

    <script src="js/jquery.js"></script>
    <script src="js/columns/news.js"></script>
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

	<?php
		$query   = "SELECT id, caption, path FROM upload WHERE section = 'News' ORDER BY id DESC LIMIT 1";
		$result  = mysql_query($query) or die('Error, query failed');
		list($id, $caption, $filePath) = mysql_fetch_array($result);
	?>


<table id="content-table">
   <col class="large"></col>
   <col class="gap"></col>
   <col class="small"></col>
   <thead>
     <tr>
       <th>
         Product Development
       </th>
       <th class="blank"></th>
       <th>
         Trade Shows
       </th>
     </tr>
   </thead>
   <tbody>
   <tr>
     <td class="copy">
      <?php
       $result = mysql_query("select * from news where section = 'News'") or die('Query failed. ' . mysql_error());

         while($row = mysql_fetch_assoc($result)) {
           if ($row['section'] == 'News') {
      ?>
        <h3><?php echo $row['title']; ?></h3>
        <p>
 		      <img src="<?php echo $filePath;?>" style="max-width: 320px; padding-left: 0; padding-top: 8px;"/>
          <?php echo $row['content']; ?>
        </p>
      <?php
           }
         }
      ?>


     </td>
     <td class="blank"></td>
     <td class="copy small">
  <?php
   $result = mysql_query("select * from news where section = 'Tradeshows'") or die('Query failed. ' . mysql_error());


     while($row = mysql_fetch_assoc($result)) {
       if ($row['section'] == 'Tradeshows') {
  ?>

            <h3><?php echo $row['title']; ?></h3>
            <p><?php echo $row['content']; ?></p>


  <?php
      }
    }
  ?>
     </td>
   </tr>
   </tbody>
</table>

<div class='clear'></div>

      </div>

      <?php include 'app/views/_footer.php'; ?>

      <div class="clear"></div>
	  </div>
  </body>
</html>
