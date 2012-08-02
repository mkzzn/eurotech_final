<?php
  include '../session.php';
  
  $query_string = "delete from offices WHERE id='" . $_GET['id'] . "'";
  $result = mysql_query($query_string) or die('Query failed. ' . mysql_error());
  // echo $query_string;
  header( 'Location: index.php?id=' . $_GET['id'] ) ;
?>
