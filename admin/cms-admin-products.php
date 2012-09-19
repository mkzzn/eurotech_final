<?php
// like i said, we must never forget to start the session
session_start();

// is the one accessing this page logged in or not?
if (!isset($_SESSION['db_is_logged_in']) || $_SESSION['db_is_logged_in'] !== true) {
	// not logged in, move to login page
	header('Location: login.php');
	exit;
}

?>

<?php
include 'library/config.php';
include 'library/opendb.php';


if(isset($_GET['del']))
{
	// remove the article from the database
	$query = "DELETE FROM products WHERE id = '{$_GET['del']}'";
	mysql_query($query) or die('Error : ' . mysql_error());
	
	// redirect to current page so when the user refresh this page
	// after deleting an article we won't go back to this code block
	//header('Location: cms-admin.php');
	//exit;
}
?>
<html>
<head>
<title>Admin Page For Content Management System (CMS)</title>

<LINK REL=StyleSheet HREF="admincss.css" TYPE="text/css" MEDIA=screen>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function delArticle(id, title)
{
	if (confirm("Are you sure you want to delete '" + title + "'"))
	{
		window.location.href = 'cms-admin-products.php?del=' + id;
	}
}
</script>
</head>

<body>

<div class=content>
<div ID=updatereport>

</div>

<?php include 'header.php'; ?>

<div id="subnav">
	<a href="reorderfront.php">Reorder products</a>
  <a href="cms-add-product.php">Add a product</a>
  <div class="clear"></div>
</div>

<?php
	$query = "SELECT id, product_name, product_id, product_text FROM products ORDER BY position ASC";
	$result = mysql_query($query) or die('Error : ' . mysql_error());
	
		while(list($id, $product_name, $product_id, $product_text) = mysql_fetch_array($result, MYSQL_NUM))
		{	
	?>



<div ID=sectionblock>
<table><tr><td>
<div ID=articlelist>

	<table width="400" border="0" cellpadding="5" cellspacing="1">
	 <tr align="center" bgcolor="#CCCCCC"> 
	  <td width="150" align="left"><strong><?php echo $product_name;?></strong></td>
	  <td width="250" align="center"><a href="cms-edit-product.php?id=<?php echo $id;?>">edit</a> | <a href="javascript:delArticle('<?php echo $id;?>', '<?php echo $product_name;?>');">delete</a></td>
	 </tr>
	 <tr bgcolor="#FFFFFF"> 
	  <td width="150"> 
	   Spec Sheet:
	  </td>
	  <td width="250" align="left">
	  <?php
	  $specquery = "SELECT name ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productSpecSheet'";
		$specresult = mysql_query($specquery) or die('Error : ' . mysql_error());
		list($specSheetName) = mysql_fetch_array($specresult, MYSQL_NUM);
	  	echo $specSheetName;
	  	
	  ?>
	  
	  </td>
	 </tr>
	 <tr bgcolor="#FFFFFF"> 
	  <td width="150"> 
	   Current Software:
	  </td>
	  <td width="250" align="left">
	   <?php
	  $softquery = "SELECT name ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productSoftwareUpdate'";
		$softresult = mysql_query($softquery) or die('Error : ' . mysql_error());
		list($softUpdateName) = mysql_fetch_array($softresult, MYSQL_NUM);
	  	echo $softUpdateName;
	  ?>

	  
	  </td>
	 </tr>
	 <tr bgcolor="#FFFFFF"> 
	  <td width="150"> 
	   Image Caption:
	  </td>
	  <td width="250" align="left">
	  <?php
		$imagequery = "SELECT path, caption ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productImage'";
		$imageresult = mysql_query($imagequery) or die('Error : ' . mysql_error());
		list($imageFilePath, $imageCaption) = mysql_fetch_array($imageresult, MYSQL_NUM);
		$short_caption = substr($imageCaption,0,150);
		echo $short_caption;
		echo "...";
?>
		
	  
	  </td>
	 </tr>
	<tr bgcolor="#FFFFFF"> 
	  <td width="150"> 
	   Product Description
	  </td>
	  <td width="250" align="left">
	  <?php 
	  $short_text = substr($product_text,0,200); 
	  echo $short_text;
	  echo "..."; 
	  ?></td>
	 </tr>

	 
	</table>
<br>
</div>
</td><td align="center">
<div ID=image>

		<img src="<?php echo $imageFilePath;?>" height=200 width=200>
</div>
</td></tr></table>
</div>
<br><br>

	 <?php
		}
			
	include 'library/closedb.php';

	?>



<div ID=footer>
(c) pg1000.com
</div>
</div>
</body>
</html>
