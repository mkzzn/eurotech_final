 <!DOCTYPE html>

<?php
   include 'db/config.php';
   include 'db/open_db.php';
   $active_page = "contact";
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
    
    <title>PG 1000 Cutting Tool Inspection System by Euro-Tech | Contact</title>
    
    <link rel="stylesheet" type="text/css" media="all" href="css/primary.css" />
    <link rel="stylesheet" type="text/css" media="all" href="css/contact.css" />
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
        <h1>Get In Touch</h1>
<div id='contact'>
  <div class='content'>
    <h2>
      Corporate
      <br />
      Offices
    </h2>
    <div class='copy'>

   <?php 
    $query = mysql_query("select * from offices where corporate = true") or die('Query failed. ' . mysql_error());

    // put all of the offics into an array
    $offices = array();
    while($office = mysql_fetch_assoc($query)) {
      $offices[] = $office;
    }

    // iterate over and print the offices 
    foreach($offices as $office) {
      $google_map_address = implode(" ", $office["address1"], $office["address2"], $office["city"], $office["city"],$office["state"],$office["zip"],$office["country"]);
      $google_map_address = str_replace(" ", "+", $google_map_address);
    ?>

      <div class='label'>Address</div>
      <div class='text'>
       <?php echo $office['addressee']; ?><br />
        <a href="http://maps.google.com?q=<?php echo $google_map_address; ?>">
       <?php echo $office['contact']; ?>
       <?php echo $office['address1']; ?>
       <?php echo $office['address2']; ?><br />
       <?php echo $office['city']; ?>, <?php echo $office['state']; ?> <?php echo $office['zip']; ?>
        </a>
      </div>
      <div class='label'>Phone</div>
    <div class='text'><?php echo $office['phone']; ?></div>
      <div class='label'>Fax</div>
      <div class='text'><?php echo $office['fax']; ?></div>
      <div class='label'>Email</div>
      <div class='text'><a href="mailto:<?php echo $office['email']; ?>"><?php echo $office['email']; ?></a></div>
      <br />

    <?php
    }
?>

      <div class='label heading'>Our Staff</div>
      <div class='label'>Accounting</div>
      <div class='text'>Ann</div>
      <div class='label'>Shipping and Receiving</div>
      <div class='text'>Rosemary</div>
      <div class='label'>Literature Requests</div>
      <div class='text'>Jan</div>
      <div class='label'>Website/Ads/Trade Shows</div>
      <div class='text'>Pat</div>
      <div class='label'>Design and Development</div>
      <div class='text'>Michael</div>
    </div>
  </div>
  <div class='content'>
    <h2>Domestic<br />Offices</h2>
    <div class='copy'>


      <div class='label heading'>Michigan Office</div>

   <?php 
    $query = mysql_query("select * from offices where domestic = true") or die('Query failed. ' . mysql_error());

    // put all of the offics into an array
    $offices = array();
    while($office = mysql_fetch_assoc($query)) {
      $offices[] = $office;
    }

    // iterate over and print the offices 
    foreach($offices as $office) {
      $google_map_address = implode(" ", $office["address1"], $office["address2"], $office["city"], $office["city"],$office["state"],$office["zip"],$office["country"]);
      $google_map_address = str_replace(" ", "+", $google_map_address);
    ?>

      <div class='label'>Contact</div>
      <div class='text'><?php echo $office['contact']; ?></div>


      <div class='label'>Address</div>
      <div class='text'>
       <?php if ($office['addressee']) { echo $office['addressee']; }; ?>
        <a href="http://maps.google.com?q=<?php echo $google_map_address; ?>">
       <?php echo $office['address1']; ?>
       <?php echo $office['address2']; ?><br />
       <?php echo $office['city']; ?>, <?php echo $office['state']; ?> <?php echo $office['zip']; ?>
        </a>
      </div>
      <div class='label'>Phone</div>
    <div class='text'><?php echo $office['phone']; ?></div>
      <div class='label'>Fax</div>
      <div class='text'><?php echo $office['fax']; ?></div>
      <div class='label'>Email</div>
      <div class='text'><a href="mailto:<?php echo $office['email']; ?>"><?php echo $office['email']; ?></a></div>
      <br />

    <?php
    }
?>

    </div>
  </div>
  <div class='content rightmost'>
    <h2>International Offices</h2>
    <div class='copy'>
      <div class='label heading'>Germany</div>
      <div class='label'>Address</div>
      <div class='text'>
        MESAS
        <br />
        Gesellschaft f&uuml;r Mess-,
        <br />
        Erfassungs- und Auswerte-
        <br />
        Computersysteme mbH
        <br />
        <a href="http://maps.google.com?q=hinten+auf+der+Gass+3+66646+Marpingen+Germany">
          Hinten auf der Gass 3
          <br />
          66646 Marpingen
        </a>
      </div>
      <div class='label'>Fax</div>
      <div class='text'>(+49) 6853 30858</div>
      <div class='label'>Email</div>
      <div class='text'><a href="mailto:info@mesas.de">info@mesas.de</a></div>
    </div>
  </div>
</div>

      </div>

      <?php include 'app/views/_footer.php'; ?>

      <div class="clear"></div>
	  </div>
  </body>
</html>