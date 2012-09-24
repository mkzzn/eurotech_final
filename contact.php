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

      <div id="primary-content">
        <h1>Get In Touch</h1>

<table id="content-table">
   <col class="content"></col>
   <col class="gap"></col>
   <col class="content"></col>
   <col class="gap"></col>
   <col class="content"></col>
   <thead>
     <tr>
       <th>Corporate Offices</th>
       <th class="blank"></th>
       <th>Offices</th>
       <th class="blank"></th>
       <th>Agents</th>
     </tr>
   </thead>
   <tbody>
   <tr>
     <td class="copy">


   <?php 
    $query = mysql_query("select * from offices where corporate = 'on'") or die('Query failed. ' . mysql_error());

    // put all of the offics into an array
    $offices = array();
    while($office = mysql_fetch_assoc($query)) {
      $offices[] = $office;
    }

    // iterate over and print the offices 
    foreach($offices as $office) {
    $address_array = array($office["address1"], $office["address2"], $office["address3"], $office["city"], $office["city"], $office["state"], $office["zip"], $office["country"]);
    $google_map_address = implode(" ", $address_array);
    $google_map_address = str_replace("-", "", $google_map_address);
    $google_map_address = str_replace("  ", " ", $google_map_address);
    $google_map_address = str_replace("   ", " ", $google_map_address);
      $google_map_address = str_replace(" ", "+", $google_map_address);
      $google_map_address = str_replace("++", "+", $google_map_address);

    /* $google_map_address = array(); */
    /* $address_fields = array("address1", "address2", "address3", "city", "state", "zip", "country"); */
    /* foreach($address_fields as $field): */
    /* $google_map_address[] = ($(office[$field]) || ""); */
    /* endforeach; */

    /* $google_map_address = implode(" ", $google_map_address); */
    /*   $google_map_address = str_replace(" ", "+", $google_map_address); */
    ?>


      <?php if ($office['contact'] && strlen($office['contact']) > 0) { ?>
        <div class='label'>Contact</div>
        <div class='text'><?php echo $office['contact']; ?></div>
      <?php } ?>

      <div class='label'>Address</div>
      <div class='text'>
       <?php if ($office['addressee'] && strlen($office['addressee']) > 0) { ?>
         <?php echo $office['addressee']; ?><br />
       <?php } ?>

       <a href="http://maps.google.com?q=<?php echo $google_map_address; ?>">

       <?php if ($office['address1'] && strlen($office['address1']) > 0) { ?>
         <?php echo $office['address1']; ?><br />
       <?php } ?>

       <?php if ($office['address2'] && strlen($office['address2']) > 0) { ?>
         <?php echo $office['address2']; ?><br />
       <?php } ?>

       <?php if ($office['city'] && strlen($office['city']) > 0) { echo $office['city'] . ", "; } ?>
       <?php if ($office['state'] && strlen($office['state']) > 0) { echo $office['state']; } ?>
       <?php if ($office['zip'] && strlen($office['zip']) > 0) { echo $office['zip']; } ?>
        </a>
      </div>
          <?php if ($office['phone'] && strlen($office['phone']) > 0) { ?>
         <div class='label'>Phone</div>
         <div class='text'><?php echo $office['phone']; ?></div>
       <?php } ?>

      <?php if ($office['fax'] && strlen($office['fax']) > 0) { ?>
        <div class='label'>Fax</div>
        <div class='text'><?php echo $office['fax']; ?></div>
      <?php } ?>

      <?php if ($office['email'] && strlen($office['email']) > 0) { ?>
        <div class='label'>Email</div>
        <div class='text'><a href="mailto:<?php echo $office['email']; ?>"><?php echo $office['email']; ?></a></div>
      <?php } ?>
      <br />

    <?php
    }
?>

      <div class='label heading'>Our Staff</div>
   <?php 
    $query = mysql_query("select * from staff_members") or die('Query failed. ' . mysql_error());

    // put all of the offics into an array
    $offices = array();
    while($office = mysql_fetch_assoc($query)) {
    ?>
      <div class='label'><?php echo $office['name']; ?></div>
      <div class='text'><?php echo $office['role']; ?></div>
    <?php
    }
   ?>
    </div>



     </td>
     <td class="blank"></td>
     <td class="copy column">

      <div class='label heading'>Michigan Office</div>

   <?php 
    $query = mysql_query("select * from offices where domestic = 'on'") or die('Query failed. ' . mysql_error());

    // put all of the offics into an array
    $offices = array();
    while($office = mysql_fetch_assoc($query)) {
      $offices[] = $office;
    }

    // iterate over and print the offices 
    foreach($offices as $office) {
    $address_array = array($office["address1"], $office["address2"], $office["address3"], $office["city"], $office["city"], $office["state"], $office["zip"], $office["country"]);
    $google_map_address = implode(" ", $address_array);
    $google_map_address = str_replace("-", "", $google_map_address);
    $google_map_address = str_replace("  ", " ", $google_map_address);
    $google_map_address = str_replace("   ", " ", $google_map_address);
      $google_map_address = str_replace(" ", "+", $google_map_address);
      $google_map_address = str_replace("++", "+", $google_map_address);
    ?>

      <?php if ($office['contact'] && strlen($office['contact']) > 0) { ?>
        <div class='label'>Contact</div>
        <div class='text'><?php echo $office['contact']; ?></div>
      <?php } ?>

      <div class='label'>Address</div>
      <div class='text'>
       <?php if ($office['addressee'] && strlen($office['addressee']) > 0) { echo $office['addressee'] ."<br />"; }; ?>
       <a href="http://maps.google.com?q=<?php echo $google_map_address; ?>">

       <?php if ($office['address1'] && strlen($office['address1']) > 0) { ?>
         <?php echo $office['address1']; ?>
         <br />
       <?php } ?>

       <?php if ($office['address2'] && strlen($office['address2']) > 0) { ?>
         <?php echo $office['address2']; ?><br />
       <?php } ?>

       <?php if ($office['city'] && strlen($office['city']) > 0) { echo $office['city'] . ", "; } ?>
       <?php if ($office['state'] && strlen($office['state']) > 0) { echo $office['state']; } ?>
       <?php if ($office['zip'] && strlen($office['zip']) > 0) { echo $office['zip']; } ?>
        </a>
      </div>
          <?php if ($office['phone'] && strlen($office['phone']) > 0) { ?>
         <div class='label'>Phone</div>
         <div class='text'><?php echo $office['phone']; ?></div>
       <?php } ?>

      <?php if ($office['fax'] && strlen($office['fax']) > 0) { ?>
        <div class='label'>Fax</div>
        <div class='text'><?php echo $office['fax']; ?></div>
      <?php } ?>

      <?php if ($office['email'] && strlen($office['email']) > 0) { ?>
        <div class='label'>Email</div>
        <div class='text'><a href="mailto:<?php echo $office['email']; ?>"><?php echo $office['email']; ?></a></div>
      <?php } ?>
      <br />

    <?php
    }
?>


     </td>
     <td class="blank"></td>
     <td class="copy column">


   <?php 
    $query = mysql_query("select * from offices where international = 'on'") or die('Query failed. ' . mysql_error());

    // put all of the offics into an array
    $offices = array();
    while($office = mysql_fetch_assoc($query)) {
      $offices[] = $office;
    }

    // iterate over and print the offices 
    foreach($offices as $office) {
    $address_array = array($office["address1"], $office["address2"], $office["address3"], $office["city"], $office["city"], $office["state"], $office["zip"], $office["country"]);
    $google_map_address = implode(" ", $address_array);
    $google_map_address = str_replace("-", "", $google_map_address);
    $google_map_address = str_replace("  ", " ", $google_map_address);
    $google_map_address = str_replace("   ", " ", $google_map_address);
      $google_map_address = str_replace(" ", "+", $google_map_address);
    ?>

      <?php if ($office['country'] && strlen($office['country']) > 0) { ?>
      <div class='label heading'><?php echo $office['country']; ?></div>
      <?php } ?>


      <?php if ($office['contact'] && strlen($office['contact']) > 0) { ?>
        <div class='label'>Contact</div>
        <div class='text'><?php echo $office['contact']; ?></div>
      <?php } ?>

      <div class='label'>Address</div>
      <div class='text'>
       <?php if ($office['addressee'] && strlen($office['addressee']) > 0) { ?>
         <?php echo $office['addressee']; ?><br />
       <?php } ?>

       <a href="http://maps.google.com?q=<?php echo $google_map_address; ?>">

       <?php if ($office['address1'] && strlen($office['address1']) > 0) { ?>
         <?php echo $office['address1']; ?><br />
       <?php } ?>

       <?php if ($office['address2'] && strlen($office['address2']) > 0) { ?>
         <?php echo $office['address2']; ?><br />
       <?php } ?>

       <?php if ($office['city'] && strlen($office['city']) > 0) { echo $office['city'] . ", "; } ?>
       <?php if ($office['state'] && strlen($office['state']) > 0) { echo $office['state']; } ?>
       <?php if ($office['zip'] && strlen($office['zip']) > 0) { echo $office['zip']; } ?>
        </a>
      </div>
          <?php if ($office['phone'] && strlen($office['phone']) > 0) { ?>
         <div class='label'>Phone</div>
         <div class='text'><?php echo $office['phone']; ?></div>
       <?php } ?>

      <?php if ($office['fax'] && strlen($office['fax']) > 0) { ?>
        <div class='label'>Fax</div>
        <div class='text'><?php echo $office['fax']; ?></div>
      <?php } ?>

      <?php if ($office['email'] && strlen($office['email']) > 0) { ?>
        <div class='label'>Email</div>
        <div class='text'><a href="mailto:<?php echo $office['email']; ?>"><?php echo $office['email']; ?></a></div>
      <?php } ?>
      <br />

    <?php
    }
?> </td>
   </tr>
   </tbody>
</table>


      </div>

      <?php include 'app/views/_footer.php'; ?>

      <div class="clear"></div>
	  </div>
  </body>
</html>