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

      <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
        <div id="users">
          <?php
            $result = mysql_query("select * from staff_members where id='" . $_GET['id']."'") or die('Query failed. ' . mysql_error());
            $staff_members = array(); // to use in the quote request form
            while($staff_member = mysql_fetch_assoc($result)) {
              $staff_members[] = $staff_member;
            }
            
            $staff_member = $staff_members[0];

            $text_fields = array(
              "Name"     => "name",
              "Role"     => "role"
            );

$all_fields = $text_fields;

            foreach($all_fields as $label => $field): 
              $$field = isset($_POST[$field]) ? $_POST[$field] : $staff_member[$field];
            endforeach;
          ?>

          <h1 class="page-title">Edit Staff Member "<?php echo $staff_member["name"]; ?>"</h1>

          <?php
            foreach($text_fields as $label => $field):
          ?>
            <div class="input_pair">
              <label><?php echo $label; ?></label>
              <input type="text" name="<?php echo $field; ?>" value="<?php echo $$field; ?>" />
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
