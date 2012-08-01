<?php
  include '../session.php';

  $fields = array( 
                  "Name"       => "name",
                  "Role"       => "role"
                   );
  
  $fields_array = array();
  $values_array = array();
  foreach($fields as $field): 
    $fields_array[] = $field;
    $values_array[] = $_POST[$field];
    $update_array[] = "$field = '$_POST[$field]'";
  endforeach;
  
  $update_string = join(", ", $update_array);
  $query_string = "update staff_members SET $update_string WHERE id='" . $_POST['id'] . "'";
  $result = mysql_query($query_string) or die('Query failed. ' . mysql_error());
  // echo $query_string;
  header( 'Location: index.php?id=' . $_POST['id'] ) ;
?>
