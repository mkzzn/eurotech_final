<?php
// like i said, we must never forget to start the session
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

<script type="text/javascript" src="../js/jquery.js"></script>
<link rel="stylesheet" href="../js/redactor/redactor.css" type="text/css" >/
<script type="text/javascript" src="../js/redactor/redactor.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#content').redactor();
  });
</script>

</head>

<body>

<div class=content>
	<div ID=updatereport>
	<?php
	if(isset($_POST['save']))
	{
		$title   = $_POST['title'];
		$content = $_POST['content'];
		$section = $_POST['section'];
		
		if(!get_magic_quotes_gpc())
		{
			$title   = addslashes($title);
			$content = addslashes($content);
			$section = addslashes($section);
		}
		include 'library/config.php';
		include 'library/opendb.php';
		
		$query = "INSERT INTO news (title, content, section) VALUES ('$title', '$content', '$section')";
		mysql_query($query) or die('Error ,query failed');
		include 'library/closedb.php';
		
		echo "Article '$title' added";
		}
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
	<form method="post">
	  <table width="680" border="0" cellpadding="2" cellspacing="1" class="box" align="center">
		<tr> 
		  <td width="100">Title</td>
		  <td><input name="title" type="text" class="box" id="title" size=52></td>
		</tr>
		<tr> 
		  <td width="100">Section</td>
		  <td>
			<select name="section">
				<option selected>News</option>
				<option>Tradeshows</option>
				<option>About</option>
				<option>SubAbout</option>
			</select>
		  </td>
		</tr>
		<tr> 
		  <td width="100">Content</td>
		  <td><textarea name="content" cols="50" rows="20" class="box" id="content"></textarea></td>
		</tr>
		<tr> 
		  <td width="100">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		<tr> 
		  <td colspan="2" align="center"><input name="save" type="submit" class="box" id="save" value="Save Article"></td>
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
