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
</head>

<body>

<div class=content>
<div ID=updatereport>

<?php
	include 'library/config.php';
	include 'library/opendb.php';
	
	if(isset($_GET['id']))
	{
		$query = "SELECT id, name, path, help_file, caption FROM downloads WHERE id = '{$_GET['id']}'";
		$result = mysql_query($query) or die('Error : ' . mysql_error());
		list($id, $name, $link, $section, $caption) = mysql_fetch_array($result, MYSQL_NUM);
		
		$caption = htmlspecialchars($caption);
	} 
	else if(isset($_POST['name']))
	{
		$id      = $_POST['id'];
		$name   = $_POST['name'];
		$link = $_POST['link'];
		$help_file = $_POST['help_file'];
		$caption = $_POST['caption'];
		
		if(!get_magic_quotes_gpc())
		{
			$name   = addslashes($name);
			$link = addslashes($link);
			$help_file = addslashes($help_file);
			$caption = addslashes($caption);
		}
		
		// update the article in the database
		$query = "UPDATE downloads ".
				 "SET name = '$name', path = '$link', help_file = '$help_file', caption = '$caption' ".
				 "WHERE id = '$id'";
		mysql_query($query) or die('Error : ' . mysql_error());
			
		echo "Download '$name' updated";
	
	}
	
	include 'library/closedb.php';
	?>


</div>
<?php include 'header.php'; ?>


<div ID=sectionblock>


<table><tr><td>
<div ID=articlelist>
<div ID=newpassword>
Edit File Attributes:
<br><br><br>
	<table><tr>
	<form method="post" action="cms-admin-privatedownloads-edit.php">
		<input type="hidden" name="section" value="<?=$section;?>">
		<input type="hidden" name="id" value="<?=$id;?>">
		<td> Name:</td><td>
    <input name="name" type="text" class="box" id="name" size=30 value="<?=$name;?>"></td></tr>
		<tr><td> Link to File:</td><td><input name="link" type="text" class="box" id="link" size=30 value="<?=$link;?>"></td></tr>
		<tr><td> Help File</td><td><input name="help_file" type="text" class="box" id="help_file" size=30 value="<?=$help_file;?>"></td></tr>
		<tr><td>Description:</td><td> <textarea name="caption" cols="47" rows="2" class="box" id="caption"><?=$caption;?></textarea></td></tr>
		<tr><td></td><td><input name="update" type="submit" class="box" id="update" value="  Update  "></td></tr>
		</form>
	</table>
<br>
	
	
		
		
</div>
</div>
</td><td align="center">
<div ID=image>


</div>
</td></tr></table>
</div>
<br><br>


<div ID=footer>
(c) pg1000.com
</div>
</div>
</body>
</html>
