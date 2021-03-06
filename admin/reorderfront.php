<?php
if (!isset($_SESSION)) {
// like i said, we must never forget to start the session
  session_start();
}

// is the one accessing this page logged in or not?
if (!isset($_SESSION['db_is_logged_in']) || $_SESSION['db_is_logged_in'] !== true) {
	// not logged in, move to login page
	header('Location: login.php');
	exit;
}

?>

<html>
<head>
<title>Admin Page For Content Management System (CMS)</title>

<LINK REL=StyleSheet HREF="admincss.css" TYPE="text/css" MEDIA=screen>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script src="../js/prototype.js" type="text/javascript"></script>
<script src="../js/scriptaculous/scriptaculous.js" type="text/javascript"></script>

</head>

<body>

<div class=content>
<div ID=updatereport>

</div>

  <?php include 'header.php'; ?>


	<div ID=toolbaradd>
	<a href="cms-add-product.php">Add a product</a>
  <div class="clear"></div>
	</div>
<br>
<h2>&nbsp;&nbsp;&nbsp;&nbsp;** to reorder the products simply drag and drop the product names in the list **</h2>
<br><br>

<ul id="item_list" class="sortable-list">

<?php

include 'library/config.php';
include 'library/opendb.php';

$query   = "SELECT * FROM products ORDER BY position ASC";

$result  = mysql_query($query) or die('Error, query failed');

while($row = mysql_fetch_array($result)) {
		$name = $row['product_name'];
		$id = $row['id'];	
		echo "<li id='item_$id' >$name</li>";
}

include 'library/closedb.php';

?>

</ul>

<br>

<script type="text/javascript">

function updateOrder(){
var options = {
method : 'post',
parameters : Sortable.serialize('item_list')
};

new Ajax.Request('reorder.php', options);
new Effect.Highlight(item_list, { startcolor: '#ffff99',
endcolor: '#fffffff' });
}

Sortable.create('item_list', {constraint:'vertical', onUpdate : updateOrder});
</script>





<div ID=footer>
(c) pg1000.com
</div>
</div>
</body>
</html>
