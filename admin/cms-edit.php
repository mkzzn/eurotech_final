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
	
	if(isset($_GET['id']))
	{
		$query = "SELECT id, title, content, section ".
				 "FROM news ".
				 "WHERE id = '{$_GET['id']}'";
		$result = mysql_query($query) or die('Error : ' . mysql_error());
		list($id, $title, $content, $section) = mysql_fetch_array($result, MYSQL_NUM);
		
		$content = htmlspecialchars($content);
	} 
	else if(isset($_POST['title']))
	{
		$id      = $_POST['id'];
		$title   = $_POST['title'];
		$content = $_POST['content'];
		$section = $_POST['section'];
		
		if(!get_magic_quotes_gpc())
		{
			$title   = addslashes($title);
			$content = addslashes($content);
			$section = addslashes($section);
		}
		
		// update the article in the database
		$query = "UPDATE news ".
				 "SET title = '$title', content = '$content', section = '$section' ".
				 "WHERE id = '$id'";
		mysql_query($query) or die('Error : ' . mysql_error());
			
		echo "Article '$title' updated";
		
		// now we will display $title & content
		// so strip out any slashes
		$title   = stripslashes($title);
		$content = stripslashes($content);
		$section = stripslashes($section);
	
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
		<a href="cms-admin.php">back to admin</a>
		</div>
	</div>
	<div ID=addpost>
	<br>
	<form method="post" action="cms-edit.php">
	<input type="hidden" name="id" value="<?=$id;?>">
	  <table width="700" border="0" cellpadding="2" cellspacing="1" class="box" align="center">
		<tr> 
		  <td width="100">Title</td>
		  <td><input name="title" type="text" class="box" id="title" value="<?=$title;?>"></td>
		</tr>
		<tr> 
		  <td width="100">Section</td>
		  <td>
			<select name="section">
				<option selected><?=$section;?></option>
				<option>News</option>
				<option>Tradeshows</option>
				<option>About</option>
				<option>SubAbout</option>
			</select>
		  
		  
		  
		  </td>
		</tr>
		<tr> 
		  <td width="100">Content</td>
		  <td><textarea name="content" cols="50" rows="10" class="box" id="content"><?=$content;?></textarea></td>
		</tr>
		<tr> 
		  <td width="100">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		<tr> 
		  <td colspan="2" align="center"><input name="update" type="submit" class="box" id="update" value="Update Article"></td>
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
