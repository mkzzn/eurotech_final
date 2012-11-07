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
    <link rel="stylesheet" type="text/css" media="all" href="css/index.css" />

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

   $result = mysql_query("select * from news where section = 'SubAbout';") or die('Query failed. ' . mysql_error());
   $sub_about = mysql_fetch_assoc($result);

?>
      <div id="primary-content">
        <h1 id="primary-bar">The Best in the Business</h1>

<table id="content-table">
   <col class="large"></col>
   <col class="gap"></col>
   <col class="small"></col>
   <thead>
     <tr>
       <th>
         <?php echo $about['title']; ?>
       </th>
       <th class="blank"></th>
       <th>
         <?php echo $sub_about['title']; ?>
       </th>
     </tr>
   </thead>
   <tbody>

	<?php
		$query   = "SELECT id, caption, path FROM upload WHERE section = 'About' ORDER BY id DESC LIMIT 1";
		$result  = mysql_query($query) or die('Error, query failed');
		list($id, $caption, $filePath) = mysql_fetch_array($result);
	?>


   <tr>
     <td class="copy">
		    <img src="<?php echo $filePath;?>" style="max-width: 320px;"/>
        <p>
          <?php echo $about['content']; ?>
        </p>
     </td>
     <td class="blank"></td>
     <td class="copy small">
       <?php echo $sub_about['content']; ?></p>
     </td>
   </tr>
   </tbody>
</table>


<div class='clear'></div>

      </div>

   <?php include('app/views/_footer.php'); ?>

      <div class="clear"></div>
	  </div>
  </body>
</html>
