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

<?php
include 'library/config.php';
include 'library/opendb.php';

if(isset($_POST['caption']))
	{
		$id      = $_POST['id'];
		$caption = $_POST['caption'];
		
		if(!get_magic_quotes_gpc())
		{
			$caption   = addslashes($caption);
		}
		
		// update the article in the database
		$query = "UPDATE upload ".
				 "SET caption = '$caption' ".
				 "WHERE id = '$id'";
		mysql_query($query) or die('Error : ' . mysql_error());
		
		// now we will display $title & content
		// so strip out any slashes
		$caption   = stripslashes($caption);
			
	}



if(isset($_GET['del']))
{
	// remove the article from the database
	$query = "DELETE FROM news WHERE id = '{$_GET['del']}'";
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
		window.location.href = 'cms-admin.php?del=' + id;
	}
}
</script>
</head>

<body>

<div class=content>
<div ID=updatereport>
<?
// you can change this to any directory you want
// as long as php can write to it
$uploadDir = $_SERVER['DOCUMENT_ROOT']."/PG1000/upload/";


if(isset($_POST['upload']))
{
	$fileName = $_FILES['userfile']['name'];
	$tmpName  = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type'];
	$section = $_POST['section'];

    // get the file extension first
	$ext      = substr(strrchr($fileName, "."), 1); 
	
	// generate the random file name
	$randName = md5(rand() * time());
	
	// and now we have the unique file name for the upload file
    $filePath = $uploadDir . $randName . '.' . $ext;
    $shortFilePath = 'http://eurotechcorp.com.hosting.tds.net/PG1000/upload/'.$randName.'.'.$ext;
    
    

    // move the files to the specified directory
	// if the upload directory is not writable or
	// something else went wrong $result will be false
    //$result    = move_uploaded_file($tmpName, $filePath);
     $result    = copy($tmpName, $filePath);

	if (!$result) {
		echo "Error uploading file";
		exit;
	}
	
	
	
    include 'library/config.php';
    include 'library/opendb.php';

    if(!get_magic_quotes_gpc())
    {
        $fileName  = addslashes($fileName);
        $filePath  = addslashes($filePath);
    }  

	$query = "INSERT INTO upload (name, size, type, path, section ) ".
			 "VALUES ('$fileName', '$fileSize', '$fileType', '$shortFilePath', '$section')";

    mysql_query($query) or die('Error, query failed : ' . mysql_error());                    

    //include 'library/closedb.php';
    
    echo "<br>File uploaded<br>";
}		
?>
</div>

<?php include 'header.php'; ?>

	<div id="subnav">
	<a href="cms-add.php">Add an article</a>
  <div class="clear"></div>
	</div>

<div ID=sectionblock>
<table><tr><td>
<div ID=articlelist>

<?php
	$query = "SELECT id, title, section FROM news WHERE section = 'News' ORDER BY id";
	$result = mysql_query($query) or die('Error : ' . mysql_error());
?>

<table width="400" border="0" cellpadding="5" cellspacing="1">
 <tr align="center" bgcolor="#CCCCCC"> 
  <td width="220" align="left"><strong>News Section</strong></td>
  <td width="180"></td>
 </tr>
 <?php
	while(list($id, $title, $section) = mysql_fetch_array($result, MYSQL_NUM))
	{	
?>
 <tr bgcolor="#FFFFFF"> 
  <td width="220"> 
   <?php echo $title;?>
  </td>
  <td width="180" align="center"><a href="cms-edit.php?id=<?php echo $id;?>">edit</a> | <a href="javascript:delArticle('<?php echo $id;?>', '<?php echo $title;?>');">delete</a></td>
 </tr>
 <?php
	}
?>
</table>
<br>
<?php
	$query = "SELECT id, title, section FROM news WHERE section = 'Tradeshows' ORDER BY id";
	$result = mysql_query($query) or die('Error : ' . mysql_error());
?>

<table width="400" border="0" cellpadding="5" cellspacing="1">
 <tr align="center" bgcolor="#CCCCCC"> 
  <td width="220" align="left"><strong>Tradeshows Section</strong></td>
  <td width="180"></td>
 </tr>
 <?php
	while(list($id, $title, $section) = mysql_fetch_array($result, MYSQL_NUM))
	{	
?>
 <tr bgcolor="#FFFFFF"> 
  <td width="220"> 
   <?php echo $title;?>
  </td>
  <td width="180" align="center"><a href="cms-edit.php?id=<?php echo $id;?>">edit</a> | <a href="javascript:delArticle('<?php echo $id;?>', '<?php echo $title;?>');">delete</a></td>
 </tr>
 <?php
	}
?>
</table>
<br>
<div class="subtext">
Upload a new image:
<br>
	<form action="" method="post" enctype="multipart/form-data" name="uploadform">
		<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
		<input type="hidden" name="section" value="News">
		<input name="userfile" type="file" class="box" id="userfile">
		<input name="upload" type="submit" class="box" id="upload" value="  Upload  ">
		</form>


	Images should be cropped to 200 x 200 prior to uploading.
<br>
	
	
	<?php
		$query   = "SELECT id, caption, path FROM upload WHERE section = 'News' ORDER BY id DESC LIMIT 1";
		$result  = mysql_query($query) or die('Error, query failed');
		list($id, $caption, $filePath) = mysql_fetch_array($result);
		?>

	<br>Image Caption: <a href="cms-admin.php?imagecaption=news">edit</a><br>
	
	<?php
	if($_GET['imagecaption'] == "news")
	{
	?>
	<form method="post" action="cms-admin.php">
	<input type="hidden" name="id" value="<?=$id;?>">
<textarea name="caption" cols="45" rows="3" class="box" id="caption"><?=$caption;?></textarea><br>
	<input name="update" type="submit" class="box" id="update" value="update caption">
	
	<?php
	}
	else{
		if($caption == "")
		{
			echo "(no caption set)";
		} 
		else
		{
	?>
	<div ID=caption><?php echo $caption;?></div>
	
	<?php
		}
	}
	?>
	
</div>
</div>
</td><td align="center">
<div ID=image>
		<img src="<?php echo $filePath;?>" height=200 width=200>
</div>
</td></tr></table>
</div>
<br><br>


<div ID=sectionblock>
<table><tr><td>
<div ID=articlelist>

<?php
	$query = "SELECT id, title, section FROM news WHERE section = 'About' ORDER BY id";
	$result = mysql_query($query) or die('Error : ' . mysql_error());
?>

<table width="400" border="0" cellpadding="5" cellspacing="1">
 <tr align="center" bgcolor="#CCCCCC"> 
  <td width="220" align="left"><strong>About Section</strong></td>
  <td width="180"></td>
 </tr>
 <?php
	while(list($id, $title, $section) = mysql_fetch_array($result, MYSQL_NUM))
	{	
?>
 <tr bgcolor="#FFFFFF"> 
  <td width="220"> 
   <?php echo $title;?>
  </td>
  <td width="180" align="center"><a href="cms-edit.php?id=<?php echo $id;?>">edit</a> | <a href="javascript:delArticle('<?php echo $id;?>', '<?php echo $title;?>');">delete</a></td>
 </tr>
 <?php
	}
?>
</table>
<br>
<?php
	$query = "SELECT id, title, section FROM news WHERE section = 'SubAbout' ORDER BY id";
	$result = mysql_query($query) or die('Error : ' . mysql_error());
?>

<table width="400" border="0" cellpadding="5" cellspacing="1">
 <tr align="center" bgcolor="#CCCCCC"> 
  <td width="220" align="left"><strong>Sub-About Section</strong></td>
  <td width="180"></td>
 </tr>
 <?php
	while(list($id, $title, $section) = mysql_fetch_array($result, MYSQL_NUM))
	{	
?>
 <tr bgcolor="#FFFFFF"> 
  <td width="220"> 
   <?php echo $title;?>
  </td>
  <td width="180" align="center"><a href="cms-edit.php?id=<?php echo $id;?>">edit</a> | <a href="javascript:delArticle('<?php echo $id;?>', '<?php echo $title;?>');">delete</a></td>
 </tr>
 <?php
	}
?>
</table>
<div class="subtext">
<br>
Upload a new image:
<br>
	<form action="" method="post" enctype="multipart/form-data" name="uploadform">
		<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
		<input type="hidden" name="section" value="About">
		<input name="userfile" type="file" class="box" id="userfile">
		<input name="upload" type="submit" class="box" id="upload" value="  Upload  ">
		</form>


	Images should be cropped to 200 x 200 prior to uploading.
	
	<br>
	
	
	<?php
		$query   = "SELECT id, caption, path FROM upload WHERE section = 'About' ORDER BY id DESC LIMIT 1";
		$result  = mysql_query($query) or die('Error, query failed');
		list($id, $caption, $filePath) = mysql_fetch_array($result);
		?>

	<br>Image Caption: <a href="cms-admin.php?imagecaption=about">edit</a><br>
	
	<?php
	if($_GET['imagecaption'] == "about")
	{
	?>
	<form method="post" action="cms-admin.php">
	<input type="hidden" name="id" value="<?=$id;?>">
<textarea name="caption" cols="45" rows="3" class="box" id="caption"><?=$caption;?></textarea><br>
	<input name="update" type="submit" class="box" id="update" value="update caption">
	
	<?php
	}
	else{
		if($caption == "")
		{
			echo "(no caption set)";
		} 
		else
		{
	?>
	<div ID=caption><?php echo $caption;?></div>
	
	<?php
		}
	}
	?>
	
</div>
</div>
</td><td align="center">
<div ID=image>
		<img src="<?php echo $filePath;?>" height=200 width=200>
</div>
</td></tr></table>
</div>
<br><br>



 <?php
	
	include 'library/closedb.php';
?>
<div ID=footer>
(c) pg1000.com
</div>
</div>
</body>
</html>
