<!DOCTYPE html>

<?php
   include 'db/config.php';
   include 'db/open_db.php';
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

      <div id="navigation">
        
          <a href="./" class="active home" >
            <div class="link-title">Home</div>
            <div class="link-summary">About the PG 1000</div>
          </a>
        
          <a href="products.html"  class="products" >
            <div class="link-title">Products</div>
            <div class="link-summary">View the entire PG product line</div>
          </a>
        
          <a href="news.html"  class="news" >
            <div class="link-title">News</div>
            <div class="link-summary">What's going on in our labs</div>
          </a>
        
          <a href="software.html"  class="software" >
            <div class="link-title">Software</div>
            <div class="link-summary">Cutting-edge user interfaces</div>
          </a>
        
          <a href="downloads.html"  class="downloads" >
            <div class="link-title">Downloads</div>
            <div class="link-summary">Software demos and updates</div>
          </a>
        
          <a href="contact.html"  class="contact" >
            <div class="link-title">Contact</div>
            <div class="link-summary">Corporate Offices and Representatives</div>
          </a>
        

        <div class="clear"></div>
      </div>

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

      <div id="footer">
        <div class="footer-links pages">
          
            <a href="./" class="active" >
              Home
            </a>
          
            <a href="products.html" >
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
