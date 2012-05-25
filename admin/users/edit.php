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

      <form action="update.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $_GET['id']; ?>" />
        <div id="users">
          <?php
            $result = mysql_query("select * from tbl_auth_user where user_id='" . $_GET['id']."'") or die('Query failed. ' . mysql_error());
            $users = array(); // to use in the quote request form
            while($user = mysql_fetch_assoc($result)) {
              $users[] = $user;
            }
            
            $user = $users[0];

            $checkbox_fields = array( 
              "Admin?"      => "isAdmin",
              "File Admin?" => "isFileAdmin",
              "Private Download?" => "private_download"
            );

            $text_fields = array(
              "Company"     => "company",
              "Customer Name"     => "custname",
              "Download Alias"     => "download_alias",
              "address1"    => "address1",
              "Address 2"   => "address2",
              "City"        => "city",
              "State"       => "state",
              "Zip"         => "zipcode",
              "Phone"       => "phone",
              "Fax"         => "fax"
            );

            $all_fields = array_merge($text_fields, $checkbox_fields);

            foreach($all_fields as $label => $field): 
              $$field = isset($_POST[$field]) ? $_POST[$field] : $user[$field];
            endforeach;
          ?>

          <h1 class="page-title">Edit User "<?php echo $user["user_id"]; ?>"</h1>

          <?php
            foreach($text_fields as $label => $field):
          ?>
            <div class="input_pair">
              <label><?php echo $label; ?></label>
              <input type="text" name="<?php echo $field; ?>" value="<?php echo $$field; ?>" />
            </div>
          <?php
            endforeach;

            foreach($checkbox_fields as $label => $field):
          ?>
            <div class="input_pair">
              <label><?php echo $label; ?></label>
              <input type="checkbox" name="<?php echo $field; ?>" <?php echo $$field ? "checked='checked'" : ""; ?> />
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
