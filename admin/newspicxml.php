<?php

include '../admin/library/config.php';
include '../admin/library/opendb.php';

$query   = "SELECT path FROM upload WHERE section = 'News' ORDER BY id DESC LIMIT 1";
$result  = mysql_query($query) or die('Error, query failed');
list($filePath) = mysql_fetch_array($result);

	echo "<img src='http://www.michaelbaltus.com";
	echo "$filePath' height='200' width='200'>";  
  
		include 'admin/library/closedb.php';
?>


