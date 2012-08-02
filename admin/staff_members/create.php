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
    $value = $_POST[$field];
    $values_array[] = "'".$value."'";
  endforeach;

  $values = implode(", ", $values_array);
  $fields = implode(", ", $fields_array);
  
  $query_string = "insert into staff_members ($fields) values ($values)";
  $result = mysql_query($query_string) or die('Query failed. ' . mysql_error());
  // echo $query_string;
  header( 'Location: index.php');
?>
