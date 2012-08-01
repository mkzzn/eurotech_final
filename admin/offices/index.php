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

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  </head>

  <body>

    <div class=content>

      <?php
        include '../header.php';
      ?>

      <form action="../user_response.php" method="POST">
  
        <a href="/admin/offices/new.php">New Office</a>
        <table id="users">
          <col></col>
          <col></col>
          <thead> 
            <th>Office Name</th>
            <th>Country</th>
          </thead>

          <tbody>
            <?php
            $result = mysql_query("select * from offices order by id ASC") or die('Query failed. ' . mysql_error());

            $offices = array(); // to use in the quote request form
            while($office = mysql_fetch_assoc($result)) {
              $offices[] = $office;
            }

            $count = 0;
            foreach($offices as $office) {
              $location_name = $office['location_name'];
              $id = $office['id'];
              $oddeven = ($count % 2) > 0 ? "even" : "odd";
              $count++;
            ?>

            <tr class="user <?php echo $oddeven; ?>">
              <td class="username">
                <a href="edit.php?id=<?php echo $id; ?>"><?php echo $location_name; ?>
              </td>
              <td class="private_download">
                <?php echo $office['country']; ?>
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
