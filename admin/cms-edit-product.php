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
	include 'library/config.php';
	include 'library/opendb.php';
	
	//coming from the main page or a file delete
	if(isset($_GET['id']))
	{
		
		//Get info from the main products table for display
		$query = "SELECT id, product_name, sort_order, images_directory, image_name, image_quantity, product_text, product_caption, product_id ".
				 "FROM products ".
				 "WHERE id = '{$_GET['id']}'";
		$result = mysql_query($query) or die('Error : ' . mysql_error());
		list($id, $product_name, $sort_order, $images_directory, $image_name, $image_quantity, $product_text, $product_caption, $product_id) = mysql_fetch_array($result, MYSQL_NUM);
		
		$product_text = htmlspecialchars($product_text);
		
		
		//delete items if necessary
		if(isset($_GET['deletespec'])) {
			$query = "SELECT path, name ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productSpecSheet'";
			$result = mysql_query($query) or die('Error : ' . mysql_error());
			list($deletePath, $deleteName) = mysql_fetch_array($result, MYSQL_NUM);

			$deletePath = substr($deletePath, 46);
			$deletePath = ".." . $deletePath;
		
			//delete table entry
			
			$query = "DELETE FROM upload WHERE product_id = '$product_id' AND section = 'productSpecSheet'";
			mysql_query($query) or die('Error in table remove: ' . mysql_error());
			
			//delete file
			if (!unlink($deletePath))
 			 {
  				echo ("Error deleting $deleteName");
  			}
			else
  			{
  				echo ("Deleted $deleteName");
 			}

		}
		if(isset($_GET['deletesoft'])) {
			$query = "SELECT path, name ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productSoftwareUpdate'";
			$result = mysql_query($query) or die('Error : ' . mysql_error());
			list($deletePath, $deleteName) = mysql_fetch_array($result, MYSQL_NUM);

			$deletePath = substr($deletePath, 46);
			$deletePath = ".." . $deletePath;
		
			//delete table entry
			
			$query = "DELETE FROM upload WHERE product_id = '$product_id' AND section = 'productSoftwareUpdate'";
			mysql_query($query) or die('Error in table remove: ' . mysql_error());
			
			//delete file
			if (!unlink($deletePath))
 			 {
  				echo ("Error deleting $deleteName");
  			}
			else
  			{
  				echo ("Deleted $deleteName");
 			}
		}
		if(isset($_GET['deleteimage'])) {
			$query = "SELECT path, name ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productImage'";
			$result = mysql_query($query) or die('Error : ' . mysql_error());
			list($deletePath, $deleteName) = mysql_fetch_array($result, MYSQL_NUM);

			$deletePath = substr($deletePath, 46);
			$deletePath = ".." . $deletePath;
		
			//delete table entry
			
			$query = "DELETE FROM upload WHERE product_id = '$product_id' AND section = 'productImage'";
			mysql_query($query) or die('Error in table remove: ' . mysql_error());
			
			//delete file
			if (!unlink($deletePath))
 			 {
  				echo ("Error deleting $deleteName");
  			}
			else
  			{
  				echo ("Deleted $deleteName");
 			}

		}
		
		//get file info for display
		$query = "SELECT name ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productSpecSheet'";
		$result = mysql_query($query) or die('Error : ' . mysql_error());
		list($specSheetName) = mysql_fetch_array($result, MYSQL_NUM);
		
		$query = "SELECT name ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productSoftwareUpdate'";
		$result = mysql_query($query) or die('Error : ' . mysql_error());
		list($softwareUpdateName) = mysql_fetch_array($result, MYSQL_NUM);
		
		$query = "SELECT path ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productImage'";
		$result = mysql_query($query) or die('Error : ' . mysql_error());
		list($imageFilePath) = mysql_fetch_array($result, MYSQL_NUM);
		
		
	} 
	
	//coming from an edit
	else if(isset($_POST['product_name']))
	{
		$product_name   = $_POST['product_name'];
		$product_text = $_POST['product_text'];
		$sort_order = $_POST['sort_order'];
		$images_directory = $_POST['images_directory']; 
		$image_quantity = $_POST['image_quantity']; 
		$image_name = $_POST['image_name']; 
		$product_caption = $_POST['product_caption'];
		$product_id      = $_POST['product_id'];
		
		if(!get_magic_quotes_gpc())
		{
			$product_name   = addslashes($product_name);
			$images_directory   = addslashes($images_directory);
			$product_text = addslashes($product_text);
			$product_caption = addslashes($product_caption);
		}
		
		$query = "UPDATE products SET product_name = '$product_name', sort_order = '$sort_order', product_text = '$product_text', images_directory = '$images_directory', image_quantity = '$image_quantity', image_name = '$image_name', product_caption = '$product_caption' WHERE product_id = '$product_id'";
		mysql_query($query) or die('Error ,query failed');
		
		$section = "productImage";
		//update new caption info
		$query = "UPDATE upload SET caption = '$product_caption' WHERE product_id = '$product_id' AND section = '$section'";	
	
		mysql_query($query) or die('Error, query failed : ' . mysql_error());   
		
		echo "Product '$product_name' info updated.";
	
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
				
			if(!get_magic_quotes_gpc())
			{
				$imageFileName  = addslashes($imageFileName);
				$imageFilePath  = addslashes($imageFilePath);
			}                   
			
			//update new image info
			$query = "SELECT path ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productImage'";
			$result = mysql_query($query) or die('Error : ' . mysql_error());
			list($imageFilePath) = mysql_fetch_array($result, MYSQL_NUM);
			
			if($imageFilePath == "") {
			$query = "INSERT INTO upload (name, size, type, path, section, caption, product_id ) ".
				 "VALUES ('$imageFileName', '$imageFileSize', '$imageFileType', '$imageShortFilePath', '$section','$product_caption','$product_id')";
		
			mysql_query($query) or die('Error, query failed : ' . mysql_error());  
			}
			else { 
			$query = "UPDATE upload SET name = '$imageFileName', size ='$imageFileSize', type = '$imageFileType', path = '$imageShortFilePath' WHERE product_id = '$product_id' AND section = '$section'";	
		
			mysql_query($query) or die('Error, query failed : ' . mysql_error());    
			}
			$filesUploaded = true;
		
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
	
		if(!get_magic_quotes_gpc())
		{
			$specsheetFileName  = addslashes($specsheetFileName);
			$specsheetFilePath  = addslashes($specsheetFilePath);
		}  
	
	
	
		$query = "SELECT name ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productSpecSheet'";
		$result = mysql_query($query) or die('Error : ' . mysql_error());
		list($specSheetName) = mysql_fetch_array($result, MYSQL_NUM);
					
		if($specSheetName == "") {
			$query = "INSERT INTO upload (name, size, type, path, section, product_id ) ".
				 "VALUES ('$specsheetFileName', '$specsheetFileSize', '$specsheetFileType', '$specsheetShortFilePath', '$section','$product_id')";
	
			mysql_query($query) or die('Error, query failed : ' . mysql_error());   
			}
		else { 
				$query = "UPDATE upload SET name = '$specsheetFileName', size ='$specsheetFileSize', type = '$specsheetFileType', path = '$specsheetShortFilePath' WHERE product_id = '$product_id' AND section = '$section'";		
				mysql_query($query) or die('Error, query failed : ' . mysql_error());     
			}

	
	
	
	
			$filesUploaded = true;      
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
			
			if(!get_magic_quotes_gpc())
			{
				$softwareUpdateFileName  = addslashes($softwareUpdateFileName);
				$softwareUpdateFilePath  = addslashes($softwareUpdateFilePath);
			}  
		
			$query = "SELECT name ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productSoftwareUpdate'";
		$result = mysql_query($query) or die('Error : ' . mysql_error());
		list($softwareUpdateName) = mysql_fetch_array($result, MYSQL_NUM);
		
		if($softwareUpdateName == "") {
			$query = "INSERT INTO upload (name, size, type, path, section, product_id) ".
				 "VALUES ('$softwareUpdateFileName', '$softwareUpdateFileSize', '$softwareUpdateFileType', '$softwareUpdateShortFilePath', '$section','$product_id')";
	
		mysql_query($query) or die('Error, query failed : ' . mysql_error());   
			}
		else { 
				  
			$query = "UPDATE upload SET name = '$softwareUpdateFileName', size ='$softwareUpdateFileSize', type = '$softwareUpdateFileType', path = '$softwareUpdateShortFilePath' WHERE product_id = '$product_id' AND section = '$section'";	
			mysql_query($query) or die('Error, query failed : ' . mysql_error());            
			}  
			
			//END UPLOAD PRODUCT softwareUpdate	
			
			$filesUploaded = true;
			
		}
		if($filesUploaded){
			echo " Files Uploaded.";
		}
		
		//get current files info
		$query = "SELECT name ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productSpecSheet'";
		$result = mysql_query($query) or die('Error : ' . mysql_error());
		list($specSheetName) = mysql_fetch_array($result, MYSQL_NUM);
		
		$query = "SELECT name ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productSoftwareUpdate'";
		$result = mysql_query($query) or die('Error : ' . mysql_error());
		list($softwareUpdateName) = mysql_fetch_array($result, MYSQL_NUM);
		
		$query = "SELECT path ".
				 "FROM upload ".
				 "WHERE product_id = '$product_id' AND section = 'productImage'";
		$result = mysql_query($query) or die('Error : ' . mysql_error());
		list($imageFilePath) = mysql_fetch_array($result, MYSQL_NUM);

	}
	include 'library/closedb.php';
?>
	</div>
	<div ID=header>
	PG1000.com Administration Section
	</div>
	<div ID=logout>
	<br>
	<a href="logout.php">logout</a>
	</div>
	<div ID=toolbar>
		<div ID=toolbarsections>
<a href="cms-admin.php">news/about/tradeshows</a>  |  <a href="cms-admin-products.php">products</a>  |  <a href="cms-admin-pdfs.php">users list / reticle</a>  |  <a href="cms-admin-downloads.php">downloads</a>  |  <a href="cms-admin-privatedownloads.php">private downloads</a>
	</div>
		<div ID=toolbaradd>
		<a href="cms-admin-products.php">back to products admin</a>
		</div>
	</div>
	<div ID=addpost>
	<br>
	<form action="cms-edit-product.php" method="post" enctype="multipart/form-data" name="uploadform">
	<input type="hidden" name="product_id" value="<?=$product_id;?>">
		  <table width="700" border="0" cellpadding="2" cellspacing="1" class="box" align="center">
		<tr> 
		  <td width="180">Product Name</td>
		  <td><input name="product_name" type="text" class="box" id="product_name" size=52 value="<?=$product_name;?>"></td>
		</tr>

		<tr> 
		  <td width="180">Sort Order</td>
		  <td><input name="sort_order" type="text" class="box" id="product_name" size=52 value="<?=$sort_order;?>"></td>
		</tr>

		<tr> 
    <td width="180">360&deg; Images Directory</td>
		  <td><input name="images_directory" type="text" class="box" id="images_directory" size=52 value="<?=$images_directory;?>"></td>
		</tr>

		<tr> 
                             <td width="180">360&deg; Image Name</td>
		  <td><input name="image_name" type="text" class="box" id="image_name" size=52 value="<?=$image_name;?>"></td>
		</tr>


		<tr> 
                             <td width="180">360&deg; Images Quantity</td>
		  <td><input name="image_quantity" type="text" class="box" id="image_quantity" size=52 value="<?=$image_quantity;?>"></td>
		</tr>


		<tr> 
		  <td width="180">Product Description</td>
		  <td><textarea name="product_text" cols="50" rows="20" class="box" id="product_text"><?=$product_text;?></textarea></td>
		</tr>
		<tr> 
		  <td width="180">Product Image Caption</td>
		  <td><textarea name="product_caption" cols="50" rows="5" class="box" id="product_caption"><?=$product_caption;?></textarea></td>
		</tr>
		<tr> 
		  <td width="180">Product Image</td>
		  <td>
		  
		 <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
		<input name="userfile" type="file" class="box" id="userfile">

		  
		  </td>
		</tr>
		<tr> 
		  <td width="180">Current Image</td>
		  <td>

			<img src="<?php echo $imageFilePath;?>" height=200 width=200>
			<?php 
				if($imageFilePath != "") {
					echo" <a href='cms-edit-product.php?id=$id&deleteimage=yes'>delete</a>";
				}
		  	?>

		  </td>
		</tr>
		<tr> 
		  <td width="180">Product Spec Sheet</td>
		  <td>
		  
		 <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
		<input name="userfile2" type="file" class="box" id="userfile2">

		  
		  </td>
		</tr>
		<tr> 
		  <td width="180">Current Product Spec Sheet</td>
		  <td>

			<?=$specSheetName;?>  
		  <?php 
				if($specSheetName != "") {
					echo" <a href='cms-edit-product.php?id=$id&deletespec=yes'>delete</a>";
				}
		  	?>

	
		  
		  </td>
		</tr>
		<tr> 
		  <td width="180">Product Software Update</td>
		  <td>
		  
		 <input type="hidden" name="MAX_FILE_SIZE" value="200000000">
		<input name="userfile3" type="file" class="box" id="userfile3">

		  
		  </td>
		</tr>
		<tr> 
		  <td width="180">Current Software Update</td>
		  <td>

			<?=$softwareUpdateName;?>
			<?php 
				if($softwareUpdateName != "") {
					echo" <a href='cms-edit-product.php?id=$id&deletesoft=yes'>delete</a>";
				}
		  	?>
		  </td>
		</tr>
		
		
	
		
		
		
		<tr> 
		  <td width="180">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		<tr> 
		  <td colspan="2" align="center"><input name="update" type="submit" class="box" id="update" value="Save Product"></td>
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
