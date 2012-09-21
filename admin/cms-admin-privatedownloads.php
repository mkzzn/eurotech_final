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


if(isset($_GET['del']))
{
	//search for the path in the db
	$query   = "SELECT path FROM downloads WHERE id = '{$_GET['del']}'";
	$result  = mysql_query($query) or die('Error, query failed');
	list($path, $size) = mysql_fetch_array($result);
	
	//remove http://eurotechcorp.com.hosting.tds.net from path string
	if($size > 0):
	$newpath = str_replace("http://eurotechcorp.com.hosting.tds.net/", "/web/", $path);
	
	//unlink the file 
	
	unlink($newpath);
	endif;
	// remove the article from the database
	$query = "DELETE FROM downloads WHERE id = '{$_GET['del']}'";
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
function delFile(id, name)
{
	if (confirm("Are you sure you want to delete '" + name + "'"))
	{
		window.location.href = 'cms-admin-privatedownloads.php?del=' + id;
	}
}

</script>
</head>

<body>

<div class=content>
<?
// you can change this to any directory you want
// as long as php can write to it
$uploadDir = $_SERVER['DOCUMENT_ROOT']."/PG1000/upload/";


if(isset($_POST['link']))
{
	
	
	$link = $_POST['link'];
	$name = $_POST['name'];
	$section = $_POST['section'];
	$caption = $_POST['caption'];

   	
    include 'library/config.php';
    include 'library/opendb.php';

    
	$query = "INSERT INTO downloads (name, path, help_file, caption ) ".
			 "VALUES ('$name', '$link', '$help_file', '$caption')";

    mysql_query($query) or die('Error, query failed : ' . mysql_error());                    

    //include 'library/closedb.php';
    
    echo "<br>File added<br>";
}		

?>


<?php include 'header.php'; ?>

<div ID=sectionblock>

<table><tr><td>
<div ID=articlelist>
<br />
<?php
	$query = "SELECT id, name, caption, help_file, path FROM downloads ORDER BY id ASC"; 
	$result = mysql_query($query) or die('Error : ' . mysql_error());
 
while(list($id, $name, $caption, $help_file, $path) = mysql_fetch_array($result, MYSQL_NUM))
	{	
?>
<table width="400" border="0" cellpadding="5" cellspacing="1">
 <tr align="center" bgcolor="#CCCCCC"> 
  <td width="150" align="left"><strong><a href="<?php echo $path;?>"><?php echo $name;?></a></strong></td>
  <td width="250">Description</td>
 </tr>
 
 <tr bgcolor="#FFFFFF"> 
  <td width="150" align="center"><a href="javascript:delFile('<?php echo $id;?>', '<?php echo $name;?>');">delete</a>
  	<a href="cms-admin-privatedownloads-edit.php?id=<?php echo $id;?>">edit</a>
   
  </td>
  <td width="250" align="center"><?php echo $caption;?></td>
 </tr>
</table>
<br>
 <?php
	}
?>

<br>
<div ID=newpassword>
<h1>Upload a new file</h1>
	<form method="post" action="cms-admin-privatedownloads.php">
		<input type="hidden" name="int_section" value="<?=$int_section;?>">
		<input type="hidden" name="section" value="<?=$int_section;?>">

		Name
    <br/>
    <input name="name" type="text" class="box" id="name" size=30>
    <br/><br />

		Link to File
    <br/>
    <input name="link" type="text" class="box" id="link" size=30>
    <br/><br />

		Help File
    <br/>
    <input name="link" type="text" class="box" id="help_file" size=30>
    <br/><br />

		Description
    <br/>
    <textarea name="caption" cols="47" rows="2" class="box" id="caption"><?=$caption;?></textarea>
    <br />
    <br />
		<input name="upload" type="submit" class="box" id="upload" value="  Add  ">
		</form>
<br>
	
	
		
		
</div>
</div>
</td>
</tr></table>
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
