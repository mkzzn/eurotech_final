<?php

	include 'library/config.php';
	include 'library/opendb.php';
	
$i=1;
foreach($_POST['item_list'] as $key=>$value) {
mysql_query("UPDATE products SET position='".$i."' WHERE id ='".$value."'");
$i++;
}

	
	include 'library/closedb.php';
?>



