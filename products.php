 <!DOCTYPE html>

<?php
   include 'db/config.php';
   include 'db/open_db.php';
   $active_page = "products";
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
    $result = mysql_query("select * from products order by position ASC") or die('Query failed. ' . mysql_error());

    $products = array(); // to use in the quote request form
    $productIds = array(); // to use in the quote request form   
    while($product = mysql_fetch_assoc($result)) {
     $products[] = $product;
     $productIds[] = $product["product_id"];
    }
    echo(count($products));

    foreach($products as $product) {
      echo $product["product_id"]."\n";
    }

    foreach($productIds as $productId) {
      echo $productId."\n";
    }

    $productIdList = implode(", ", $productIds);

    $upload_query = mysql_query("select * from upload where product_id in ($productIdList)") or die('Query failed. ' . mysql_error());

    $uploads = array(); // to use in the quote request form   
    while($upload = mysql_fetch_assoc($upload_query)) {
     $uploads[] = $upload;
    }
    echo(count($uploads));

    $productUploads = array();
    foreach($uploads as $upload) {
      if ($productUploads[$upload["product_id"]]) {
        $productUploads[$upload["product_id"]][$upload["section"]] = $upload["path"];
      } else {
        $productUploads[$upload["product_id"]] = array($upload["section"] => $upload["path"]);
      }
    }

    foreach($productUploads as $productUpload) {
      echo $productUpload["productImage"];
    }

    foreach($products as $product) {
  ?>

     <div class='product'>
       <h2>
         <div class='title'>
           <?php echo $product['product_name']; ?>
         <div class='model'>Model# <?php echo $product['product_name']; ?></div>
         </div>
         <div class='links'>
           <a class='view' href='some_link.html'>360&deg View</a>
           <a href='screenshot.html'>Screenshot</a>
           <?php 
              if ($productUploads[$product["product_id"]]['productSpecSheet']) {
           ?>
           <a href='<?php echo $productUploads[$product["product_id"]]['productSpecSheet']; ?>'>Spec Sheet</a>
           <?php
              }
           ?>
         </div>
         <div class='clear'></div>
       </h2>
       <div class='body'>
         <div class='container'>
           <?php
             if (!!$productUploads[$product["product_id"]]['productImage']) {
           ?>
           <img src='<?php echo $productUploads[$product["product_id"]]['productImage']; ?>' width='210' />
           <?php
             }
           ?>
           <div class='description'>
             <?php echo $product['product_text']; ?>
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
