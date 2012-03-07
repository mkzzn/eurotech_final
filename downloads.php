 <!DOCTYPE html>

      <?php
        include 'db/config.php';
        include 'db/open_db.php';
        $active_page = "downloads";
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
    
    <title>PG 1000 Cutting Tool Inspection System by Euro-Tech | Downloads</title>
    
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
        <h1>Downloads</h1>
<div id='register'>
  <h2>Register</h2>
  <form>
    <div class='labels'>
      <label for='name'>Name</label>
      <label for='company'>Company</label>
      <label for='address1'>Address1</label>
      <label for='address2'>Address2</label>
      <label for='city'>City</label>
      <label for='state'>State</label>
      <label for='zip'>Zip Code</label>
      <label for='country'>Country</label>
      <label for='phone'>Phone</label>
      <label for='fax'>Fax</label>
      <label for='email'>Email</label>
      <label for='username'>Username</label>
      <label for='password'>Password</label>
      <label for='confirm_password'>Confirm Password</label>
    </div>
    <div class='inputs'>
      <input name='name' type='text' />
      <input name='company' type='text' />
      <input name='address1' type='text' />
      <input name='address2' type='text' />
      <input name='city' type='text' />
      <input name='state' type='text' />
      <input name='zip' type='text' />
      <input name='country' type='text' />
      <input name='phone' type='text' />
      <input name='fax' type='text' />
      <input name='email' type='text' />
      <input name='username' type='text' />
      <input name='password' type='password' />
      <input name='confirm_password' type='password' />
      <input type='submit' />
    </div>
  </form>
</div>
<div id='login'>
  <h2>Login</h2>
  <form>
    <div class='labels'>
      <label for='username'>Username</label>
      <label for='password'>Password</label>
    </div>
    <div class='inputs'>
      <input name='username' type='text' />
      <input name='password' type='password' />
      <input type='submit' />
      <a href='forgot_password.html'>Forgot Your Password?</a>
    </div>
  </form>
</div>
<div class='clear'></div>

      </div>

      <div id="footer">
        <div class="footer-links pages">
          
            <a href="./" >
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
          
            <a href="downloads.html" class="active" >
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
