<?php
// like i said, we must never forget to start the session
session_start();

// is the one accessing this page logged in or not?
if (!isset($_SESSION['db_is_logged_in']) || $_SESSION['db_is_logged_in'] !== true) {
	// not logged in, move to login page
	header('Location: login.php');
	exit;
}
include 'library/config.php';
include 'library/opendb.php';

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
<?
// you can change this to any directory you want
// as long as php can write to it
$uploadDir = $_SERVER['DOCUMENT_ROOT']."/PG1000/";


if(isset($_POST['upload']))
{
	$fileName = $_FILES['userfile']['name'];
	$tmpName  = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type'];
	
	$fileName2 = $_FILES['userfile2']['name'];
	$tmpName2  = $_FILES['userfile2']['tmp_name'];
	$fileSize2 = $_FILES['userfile2']['size'];
	$fileType2 = $_FILES['userfile2']['type'];


 
	if($fileSize > 0) {
	// and now we have the unique file name for the upload file
    $filePath = $uploadDir . "pg1000_users_list.pdf";

    // move the files to the specified directory
	// if the upload directory is not writable or
	// something else went wrong $result will be false
    //$result    = move_uploaded_file($tmpName, $filePath);
     $result    = copy($tmpName, $filePath);

	if (!$result) {
		echo "Error uploading Users List";
		exit;
	}
	}
	
	if($fileSize2 > 0) {
	// and now we have the unique file name for the upload file
    $filePath2 = $uploadDir . "reticle_rental_agreement.pdf";

    // move the files to the specified directory
	// if the upload directory is not writable or
	// something else went wrong $result will be false
    //$result    = move_uploaded_file($tmpName, $filePath);
     $result    = copy($tmpName2, $filePath2);

	if (!$result) {
		echo "Error uploading Reticle Agreement";
		exit;
	}
	}

	
	    
    echo "<br>File(s) uploaded<br>";
}		
?>
</div>

<?php include 'header.php'; ?>


<div ID=addpost>
	<br>
	Select a new file to overwrite the old one and press upload.
	<br><br>
	<form action="cms-admin-pdfs.php" method="post" enctype="multipart/form-data" name="uploadform">
	<table width="700" border="0" cellpadding="2" cellspacing="1" class="box" align="center">
		
		<tr> 
		  <td width="180">Users List: </td>
		  <td>
		 <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
		<input name="userfile" type="file" class="box" id="userfile2">
		  </td>
		</tr>
		<tr> 
		  <td width="180">Reticle Agreement: </td>
		  <td>
		 <input type="hidden" name="MAX_FILE_SIZE" value="200000000">
		<input name="userfile2" type="file" class="box" id="userfile">
		  </td>
		</tr>
		<tr> 
		  <td width="180">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		<tr> 
		  <td colspan="2" align="center"><input name="upload" type="submit" class="box" id="upload" value="  Upload  "></td>
		</tr>
	</table>
	</form>
</div>


 <?php
	
	include 'library/closedb.php';
?>
<div ID=footer>
(c) pg1000.com
</div>
</div>
</body>
</html>
