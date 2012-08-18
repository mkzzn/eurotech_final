 <!DOCTYPE html>

<?php
   include 'db/config.php';
   include 'db/open_db.php';
   $active_page = "products";
   $tableName = "tbl_auth_user";
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

    <link rel="stylesheet" type="text/css" href="css/style4.css" />
    <link rel="stylesheet" type="text/css" media="all" href="css/products.css" />

    <script language="javascript" type="text/javascript" src="js/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="js/jquery.easing.js"></script>
    <script language="javascript" type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript">
     $(document).ready( function(){	
        // buttons for next and previous item						 
        var buttons = { previous:$('#jslidernews1 .button-previous') ,
                next:$('#jslidernews1 .button-next') };
         $obj = $('#jslidernews1').lofJSidernews( { interval : 4000,
                            easing			: 'easeInOutQuad',
                            duration		: 1200,
                            auto		 	: false,
                            maxItemDisplay  : 5,
                            startItem:0,
                            navPosition     : 'horizontal', // horizontal
                            navigatorHeight : null,
                            navigatorWidth  : null,
                            mainWidth:980,
                            buttons:buttons} );		
      });
    </script>

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




<div id="jslidernews1" class="lof-slidecontent">
	<div class="preload"><div></div></div>
    		 <div class="button-previous">Previous</div>
              <div  class="button-next">Next</div>
    		 <!-- MAIN CONTENT --> 

              <div id="products" class="main-slider-content" style="width:966px; height:480px;">
                <ul class="sliders-wrap-inner">

  <?php
    $result = mysql_query("select * from products") or die('Query failed. ' . mysql_error());

    $products = array(); // to use in the quote request form
    $productIds = array(); // to use in the quote request form   
    while($product = mysql_fetch_assoc($result)) {
     $products[] = $product;
     $productIds[] = $product["product_id"];
    }

    $productIdList = implode(", ", $productIds);

    $upload_query = mysql_query("select * from upload where product_id in ($productIdList)") or die('Query failed. ' . mysql_error());

    $uploads = array(); // to use in the quote request form   
    while($upload = mysql_fetch_assoc($upload_query)) {
     $uploads[] = $upload;
    }

    $productUploads = array();
    foreach($uploads as $upload) {
      if ($productUploads[$upload["product_id"]]) {
        $productUploads[$upload["product_id"]][$upload["section"]] = $upload["path"];
      } else {
        $productUploads[$upload["product_id"]] = array($upload["section"] => $upload["path"]);
      }
    }

  $counter = 0;
  foreach($products as $product) {

  if ($counter % 2 == 0) {
  ?>
  <li>

  <?php
    }
  ?>

     <div class='product <?php if ($counter % 2 == 0) { echo "left"; } ?>'>
       <h2>
         <div class='title'>
           <?php echo $product['product_name']; ?>
         <div class='model'>Model# <?php echo $product['product_name']; ?></div>
         </div>
         <div class='links'>
                                                                            <?php if($product['images_directory'] && strlen($product['images_directory']) > 0) { ?>
           <a class='view' href='view_product.php?id=<?php echo $product["id"]; ?>'>360&deg View</a>
           <br />
           <?php } ?>
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
    if ($counter % 2 == 1) {
  ?>
  </li>
  <?php
    }
    $counter++;
  }

  ?>
                  </ul>  	
            </div>
 		   <!-- END MAIN CONTENT --> 
           <!-- NAVIGATOR -->
           	<div class="navigator-content">
                  <div class="navigator-wrapper">
                        <ul class="navigator-wrap-inner">
                           <li><span>1</span></li>
                           <li><span>2</span></li>
                           <li><span>3</span></li>
                           <li><span>4</span></li>    
                           <li><span>5</span></li>
                           <li><span>6</span></li>       
                           <li><span>7</span></li>       
                           <li><span>8</span></li>          		
                        </ul>
                  </div>
             </div> 
          <!----------------- END OF NAVIGATOR --------------------->

      </div>
 
      <?php include 'app/views/_footer.php'; ?>

      <div class="clear"></div>
	  </div>
  </body>
</html>
