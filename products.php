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
    
    <title>PG 1000 Cutting Tool Inspection System by Euro-Tech | Products</title>
    
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
        <h1>The PG 1000 Line</h1>
<div id='products'>

  <?php
    $result = mysql_query("select products.*, upload.path from products, upload where products.product_id = upload.product_id order by position ASC") or die('Query failed. ' . mysql_error());

    $productIds = array(); // to use in the quote request form   
    while($product = mysql_fetch_assoc($products)) {
     $productIds[] = $product['product_id'];
    }

    $productIdList = implode(", ", $productIds);

    while($row = mysql_fetch_assoc($result)) {

     //if ($row['product_id']) {     
     //  $upload_result = mysql_query("select * from upload where product_id = {$row['product_id']}") or die('Query failed. ' . mysql_error());
      // $upload = mysql_fetch_object($upload_result);
     //}
  ?>

     <div class='product'>
       <h2>
         <div class='title'>
           <?php echo $row['product_name']; ?>
         <div class='model'>Model# <?php echo $row['product_name']; ?></div>
         </div>
         <div class='links'>
           <a class='view' href='some_link.html'>360&deg View</a>
           <a href='screenshot.html'>Screenshot</a>
           <a href='spec_sheet.html'>Spec Sheet</a>
         </div>
         <div class='clear'></div>
       </h2>
       <div class='body'>
         <div class='container'>
           <img src='<?php echo $row['path']; ?>' width='210' />
           <div class='description'>
             <?php echo $row['product_text']; ?>
           </div>
         </div>
         <div class='clear'></div>
       </div>
     </div>

  <?php
    }
  ?>
</div>
<div class='clear'></div>

      </div>

      <div id="footer">
        <div class="footer-links pages">
          
            <a href="./" >
              Home
            </a>
          
            <a href="products.html" class="active" >
              Products
            </a>
          
            <a href="news.html" >
              News
            </a>
          
            <a href="software.html" >
              Software
            </a>
          
            <a href="downloads.html" >
              Downloads
            </a>
          
            <a href="contact.html" >
              Contact
            </a>
          
        </div>

        <div class="footer-links links">
          <a href="terms.html">Terms and Conditions</a>
          <a href="rental_agreement.html">Reticle Rental Agreement</a>
        </div>

        <div class="clear"></div>
      </div>
      <div class="clear"></div>
	  </div>
  </body>
</html>
