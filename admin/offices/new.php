<?php
  include '../session.php';
?>
<html>
  <head>
    <title>Admin Page For Content Management System (CMS)</title>

    <link rel="stylesheet" href="../admincss.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../../css/admin/users.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../../css/admin/users/edit.css" type="text/css" media="screen" />

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  </head>

  <body>

    <div class=content>

      <?php
        include '../header.php';
      ?>

      <form action="create.php" method="POST">
        <div id="users">
          <?php
            $checkbox_fields = array( 
              "International?"      => "international",
              "Domestic?" => "domestic",
              "Corporate?" => "corporate"
            );

            $text_fields = array(
              "Location Name"     => "location_name",
              "Contact"     => "contact",
              "Addressee"     => "addressee",
              "Address 1"     => "address1",
              "Address 2"     => "address2",
              "Address 3"     => "address3",
              "City"     => "city",
              "State"    => "state",
              "Zip"   => "zip",
              "Country"   => "country",
              "Fax"        => "fax",
              "Phone"       => "phone"
            );
          ?>

          <h1 class="page-title">Create Office</h1>

          <?php
            foreach($text_fields as $label => $field):
          ?>
            <div class="input_pair">
              <label><?php echo $label; ?></label>
              <input type="text" name="<?php echo $field; ?>" />
            </div>
          <?php
            endforeach;

            foreach($checkbox_fields as $label => $field):
          ?>
            <div class="input_pair">
              <label><?php echo $label; ?></label>
              <input type="checkbox" name="<?php echo $field; ?>" />
            </div>
          <?php
            endforeach;
          ?>

          <?php
            include '../library/closedb.php';
          ?>

          <input type="submit" />
        </div>
      </form>

      <div id="footer">
        (c) pg1000.com
      </div>
    </div>
  </body>
</html>
