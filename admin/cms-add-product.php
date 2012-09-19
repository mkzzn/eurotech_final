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

<html>
<head>
<title>Admin Page For Content Management System (CMS)</title>

<LINK REL=StyleSheet HREF="admincss.css" TYPE="text/css" MEDIA=screen>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<div class=content>
	<div ID=updatereport>
	<?php
	if(isset($_POST['save']))
	{
		$product_name   = $_POST['product_name'];
		$product_text = $_POST['product_text'];
		$product_caption = $_POST['product_caption'];
		
		srand ((double) microtime( )*1000000);
		$product_id  = rand( );
		
				
		if(!get_magic_quotes_gpc())
		{
			$product_name   = addslashes($product_name);
			$product_text = addslashes($product_text);
			$product_caption = addslashes($product_caption);
		}
		include 'library/config.php';
		include 'library/opendb.php';
		
		$query = "INSERT INTO products (product_name, product_text, product_caption, product_id) VALUES ('$product_name', '$product_text', '$product_caption','$product_id')";
		mysql_query($query) or die('Error ,query failed');
		include 'library/closedb.php';
		
		echo "Product '$product_name' added";
	
		// you can change this to any directory you want
		// as long as php can write to it
		$uploadDir = $_SERVER['DOCUMENT_ROOT']."/PG1000/upload/";
	
		
		//UPLOAD THE PRODUCT IMAGE
		$imageFileName = $_FILES['userfile']['name'];
		$imageTmpName  = $_FILES['userfile']['tmp_name'];
		$imageFileSize = $_FILES['userfile']['size'];
		$imageFileType = $_FILES['userfile']['type'];
		if($imageFileSize > 0) {
	
	
		// get the file extension first
		$imageExt      = substr(strrchr($imageFileName, "."), 1); 
		
		// generate the random file name
		$imageRandName = md5(rand() * time());
		
		// and now we have the unique file name for the upload file
		$imageFilePath = $uploadDir . $imageRandName . '.' . $imageExt;
		$imageShortFilePath = 'http://eurotechcorp.com.hosting.tds.net/PG1000/upload/'.$imageRandName.'.'.$imageExt;
		
		$section = "productImage";
	
		// move the files to the specified directory
		// if the upload directory is not writable or
		// something else went wrong $result will be false
		//$result    = move_uploaded_file($tmpName, $filePath);
		 $result    = copy($imageTmpName, $imageFilePath);
	
		if (!$result) {
			echo "Error uploading file";
			exit;
		}
		
		include 'library/config.php';
		include 'library/opendb.php';
	
		if(!get_magic_quotes_gpc())
		{
			$imageFileName  = addslashes($imageFileName);
			$imageFilePath  = addslashes($imageFilePath);
		}  
	
		$query = "INSERT INTO upload (name, size, type, path, section, caption, product_id ) ".
				 "VALUES ('$imageFileName', '$imageFileSize', '$imageFileType', '$imageShortFilePath', '$section','$product_caption','$product_id')";
	
		mysql_query($query) or die('Error, query failed : ' . mysql_error()); 
		}                   
	
		//END UPLOAD PRODUCT IMAGE	
		
		//UPLOAD THE PRODUCT specsheet
		$specsheetFileName = $_FILES['userfile2']['name'];
		$specsheetTmpName  = $_FILES['userfile2']['tmp_name'];
		$specsheetFileSize = $_FILES['userfile2']['size'];
		$specsheetFileType = $_FILES['userfile2']['type'];
		if($specsheetFileSize > 0) {
	
		// get the file extension first
		$specsheetExt      = substr(strrchr($specsheetFileName, "."), 1); 
		
		// generate the random file name
		$specsheetRandName = md5(rand() * time());
		
		// and now we have the unique file name for the upload file
		$specsheetFilePath = $uploadDir . $specsheetRandName . '.' . $specsheetExt;
		$specsheetShortFilePath = 'http://eurotechcorp.com.hosting.tds.net/PG1000/upload/'.$specsheetRandName.'.'.$specsheetExt;
		
		$section = "productSpecSheet";
	
		// move the files to the specified directory
		// if the upload directory is not writable or
		// something else went wrong $result will be false
		//$result    = move_uploaded_file($tmpName, $filePath);
		 $result    = copy($specsheetTmpName, $specsheetFilePath);
	
		if (!$result) {
			echo "Error uploading file";
			exit;
		}
		
		include 'library/config.php';
		include 'library/opendb.php';
	
		if(!get_magic_quotes_gpc())
		{
			$specsheetFileName  = addslashes($specsheetFileName);
			$specsheetFilePath  = addslashes($specsheetFilePath);
		}  
	
		$query = "INSERT INTO upload (name, size, type, path, section, product_id ) ".
				 "VALUES ('$specsheetFileName', '$specsheetFileSize', '$specsheetFileType', '$specsheetShortFilePath', '$section','$product_id')";
	
		mysql_query($query) or die('Error, query failed : ' . mysql_error());                    
	}
		//END UPLOAD PRODUCT specsheet
		
		//UPLOAD THE PRODUCT softwareUpdate
		
		$softwareUpdateFileName = $_FILES['userfile3']['name'];
		$softwareUpdateTmpName  = $_FILES['userfile3']['tmp_name'];
		$softwareUpdateFileSize = $_FILES['userfile3']['size'];
		$softwareUpdateFileType = $_FILES['userfile3']['type'];
		if($softwareUpdateFileSize > 0) {
	
		// get the file extension first
		$softwareUpdateExt      = substr(strrchr($softwareUpdateFileName, "."), 1); 
		
		// generate the random file name
		$softwareUpdateRandName = md5(rand() * time());
		
		// and now we have the unique file name for the upload file
		$softwareUpdateFilePath = $uploadDir . $softwareUpdateRandName . '.' . $softwareUpdateExt;
		$softwareUpdateShortFilePath = 'http://eurotechcorp.com.hosting.tds.net/PG1000/upload/'.$softwareUpdateRandName.'.'.$softwareUpdateExt;
		
		$section = "productSoftwareUpdate";
	
		// move the files to the specified directory
		// if the upload directory is not writable or
		// something else went wrong $result will be false
		//$result    = move_uploaded_file($tmpName, $filePath);
		 $result    = copy($softwareUpdateTmpName, $softwareUpdateFilePath);
	
		if (!$result) {
			echo "Error uploading file";
			exit;
		}
		
		include 'library/config.php';
		include 'library/opendb.php';
	
		if(!get_magic_quotes_gpc())
		{
			$softwareUpdateFileName  = addslashes($softwareUpdateFileName);
			$softwareUpdateFilePath  = addslashes($softwareUpdateFilePath);
		}  
	
		$query = "INSERT INTO upload (name, size, type, path, section, product_id) ".
				 "VALUES ('$softwareUpdateFileName', '$softwareUpdateFileSize', '$softwareUpdateFileType', '$softwareUpdateShortFilePath', '$section','$product_id')";
	
		mysql_query($query) or die('Error, query failed : ' . mysql_error());                    
		}
		//END UPLOAD PRODUCT softwareUpdate	
		
		echo "<br>Files uploaded<br>";
	}
		
?>
	</div>

  <?php include 'header.php'; ?>


		<div ID=toolbaradd>
		<a href="cms-admin-products.php">back to products admin</a>
  <div class="clear"></div>
		</div>
	<div ID=addpost>
	<br>
	<form method="post" enctype="multipart/form-data" name="uploadform">
		  <table width="700" border="0" cellpadding="2" cellspacing="1" class="box" align="center">
		<tr> 
		  <td width="100">Product Name</td>
		  <td><input name="product_name" type="text" class="box" id="product_name" size=52></td>
		</tr>
		<tr> 
		  <td width="100">Product Description</td>
		  <td><textarea name="product_text" cols="50" rows="20" class="box" id="product_text"></textarea></td>
		</tr>
		<tr> 
		  <td width="100">Product Image Caption</td>
		  <td><textarea name="product_caption" cols="50" rows="5" class="box" id="product_caption"></textarea></td>
		</tr>
		<tr> 
		  <td width="100">Product Image</td>
		  <td>
		  
		 <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
		<input name="userfile" type="file" class="box" id="userfile">

		  
		  </td>
		</tr>
		<tr> 
		  <td width="100">Product Spec Sheet</td>
		  <td>
		  
		 <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
		<input name="userfile2" type="file" class="box" id="userfile2">

		  
		  </td>
		</tr>
		<tr> 
		  <td width="100">Product Software Update</td>
		  <td>
		  
		 <input type="hidden" name="MAX_FILE_SIZE" value="200000000">
		<input name="userfile3" type="file" class="box" id="userfile3">

		  
		  </td>
		</tr>
		

		
		
		
		<tr> 
		  <td width="100">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		<tr> 
		  <td colspan="2" align="center"><input name="save" type="submit" class="box" id="save" value="Save Product"></td>
		</tr>
	  </table>
	</form>

	</div>

	<div ID=footer>
	(c) pg1000.com
	</div>
</div>

</body>
</html>
