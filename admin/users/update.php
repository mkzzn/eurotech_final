<?php
  include '../session.php';

  $fields = array( 
    "isAdmin",
    "isFileAdmin",
    "private_download",
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
  endforeach;
  
  $fields_string = join(", ", $fields);
  $values_string = join(", ", $values);

  $result = mysql_query("insert into tbl_auth_user ($fields_string)
  values ($values_string) where user_id='" . $_GET['id']."'") or die('Query failed. ' . mysql_error());

  header( 'Location: index.php?user_id=' . $_POST['user_id'] ) ;
?>
