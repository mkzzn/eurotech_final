<?php
  include '../session.php';

  $fields = array( 
    "isAdmin",
    "isFileAdmin",
    "private_download",
    "download_alias",
    "company",
    "custname",
    "address1",
    "address2",
    "city",
    "state",
    "zipcode",
    "phone",
    "fax"
  );
  
  $fields_array = array();
  $values_array = array();
  foreach($fields as $field): 
    $fields_array[] = $field;
    $values_array[] = $_POST[$field];
    $update_array[] = "$field = '$_POST[$field]'";
  endforeach;
  
  $update_string = join(", ", $update_array);
  $query_string = "update tbl_auth_user SET $update_string WHERE user_id='" . $_POST['user_id'] . "'";
  $result = mysql_query($query_string) or die('Query failed. ' . mysql_error());
  // echo $query_string;
  header( 'Location: index.php?user_id=' . $_POST['user_id'] ) ;
?>
