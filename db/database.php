<?php

function open_db() {
  $conn = mysql_connect ($dbhost, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
  mysql_select_db ($dbname);
}

function close_db() {
  mysql_close($conn);
}

?>
