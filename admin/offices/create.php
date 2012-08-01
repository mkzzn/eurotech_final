<?php
  include '../session.php';

  $fields = array( 
                  "Location Name"     => "location_name",
                  "International?"      => "international",
                  "Domestic?" => "domestic",
                  "Corporate?" => "corporate",
                  "Contact"     => "contact",
                  "Addressee"     => "addressee",
                  "Address1"     => "address1",
                  "Address2"     => "address2",
                  "Address3"     => "address3",
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
    $value = $_POST[$field];
    /* if ($field == "location_name" && ($value == null || $value == "")) { */
    /*   $value = "New Location"; */
    /* } */
    $values_array[] = $value;
  endforeach;

  $values = implode(", ", $values_array);
  $fields = implode(", ", $fields_array);
  
  $query_string = "insert into offices ($fields) values ($fields)";
  $result = mysql_query($query_string) or die('Query failed. ' . mysql_error());
  // echo $query_string;
  header( 'Location: index.php');
?>
