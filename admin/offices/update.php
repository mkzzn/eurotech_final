<?php
  include '../session.php';

  $fields = array( 
                  "International?"      => "international",
                  "Domestic?" => "domestic",
                  "Corporate?" => "corporate",
                  "Location Name"     => "location_name",
                  "Contact"     => "contact",
                  "Addressee"     => "addressee",
                  "Address1"     => "address1",
                  "Address2"     => "address2",
                  "City"     => "city",
                  "State"    => "state",
                  "Zip"   => "zip",
                  "Country"   => "country",
                  "Fax"        => "fax",
                  "Location Name"       => "location_name",
                  "Phone"       => "phone"
                   );
  
  $fields_array = array();
  $values_array = array();
  foreach($fields as $field): 
    $fields_array[] = $field;
    $values_array[] = $_POST[$field];
    $update_array[] = "$field = '$_POST[$field]'";
  endforeach;
  
  $update_string = join(", ", $update_array);
  $query_string = "update offices SET $update_string WHERE id='" . $_POST['id'] . "'";
  $result = mysql_query($query_string) or die('Query failed. ' . mysql_error());
  // echo $query_string;
  header( 'Location: index.php?id=' . $_POST['id'] ) ;
?>
