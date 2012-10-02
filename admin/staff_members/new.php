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
        include 'header.php';
      ?>

      <form action="create.php" method="POST">
        <div id="users">
          <?php

            $text_fields = array(
              "Name"     => "name",
              "Role"     => "role"
            );
          ?>

          <h1 class="page-title">Create Staff Member</h1>

          <?php
            foreach($text_fields as $label => $field):
          ?>
            <div class="input_pair">
              <label><?php echo $label; ?></label>
              <input type="text" name="<?php echo $field; ?>" />
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
