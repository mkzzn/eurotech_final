<?php
  // like i said, we must never forget to start the session
  session_start();

  // is the one accessing this page logged in or not?
  if (!isset($_SESSION['db_is_logged_in']) || $_SESSION['db_is_logged_in'] !== true) {
    // not logged in, move to login page
    header('Location: login.php');
    exit;
  }
  include '../library/config.php';
  include '../library/opendb.php';

?>
<html>
  <head>
    <title>Admin Page For Content Management System (CMS)</title>

    <link rel="stylesheet" href="../admincss.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../../css/admin/users.css" type="text/css" media="screen" />

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700"  type="text/css" media="screen" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" ></script>
    <script src="../../js/admin/delete_confirm.js" ></script>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  </head>

  <body>

    <div class=content>

      <?php
        include '../header.php';
      ?>
      <form action="../user_response.php" method="POST">
        <h1>Manage Staff Members</h1>
        <div class="controls">
          <a href="/admin/staff_members/new.php" class="new_resource">New Staff Member</a>
        </div>


        <table id="users">
          <col></col>
          <col></col>
          <thead> 
            <th>Name</th>
            <th>Role</th>
            <th>Delete Staff Member</th>
          </thead>

          <tbody>
            <?php
            $result = mysql_query("select * from staff_members order by id ASC") or die('Query failed. ' . mysql_error());

            $staff_members = array(); // to use in the quote request form
            while($staff_member = mysql_fetch_assoc($result)) {
              $staff_members[] = $staff_member;
            }

            $count = 0;
            foreach($staff_members as $staff_member) {
              $name = $staff_member['name'];
              $id = $staff_member['id'];
              $oddeven = ($count % 2) > 0 ? "even" : "odd";
              $count++;
            ?>

            <tr class="user <?php echo $oddeven; ?>">
              <td class="name">
                <a href="edit.php?id=<?php echo $id; ?>"><?php echo $name; ?>
              </td>
              <td class="role">
                <?php echo $staff_member['role']; ?>
              </td>
              <td class="delete_link">
                <a href="delete.php?id=<?php echo $id; ?>" class="delete_confirm">Delete</a>
              </td>
           </tr>


          <?php
            }
            include '../library/closedb.php';
          ?>
          </tbody>
        </table>
      </form>

      <div id="footer">
        (c) pg1000.com
      </div>
    </div>
  </body>
</html>
