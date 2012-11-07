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

// if no id is specified, list the available articles
if(!isset($_GET['id']))
{
	$self   = $_SERVER['PHP_SELF'];

	$query  = "SELECT id, title FROM news ORDER BY id";
	$result = mysql_query($query) or die('Error : ' . mysql_error()); 
	
	// create the article list 
	$content =  '<ol>';
	while($row = mysql_fetch_array($result, MYSQL_NUM))
	{
		list($id, $title) = $row;
		$content .= "<li><a href=\"$self?id=$id\">$title</a></li>\r\n";
	}
	
	$content .= '</ol>';
	
	$title   = 'Available Articles';
} else {
	// get the article info from database
	$query   = "SELECT title, content FROM news WHERE id=".$_GET['id'];
	$result  = mysql_query($query) or die('Error : ' . mysql_error()); 
	$row     = mysql_fetch_array($result, MYSQL_ASSOC); 
	
	$title   = $row['title'];
	$content = $row['content'];
}	

include 'library/closedb.php';
?>


<html>
<head>
<title>Admin Page For Content Management System (CMS)</title>

<LINK REL=StyleSheet HREF="admincss.css" TYPE="text/css" MEDIA=screen>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<div class=content>
	<div ID=header>
	PG1000.com Administration Section
	</div>
	<div ID=logout>
	<br>
	<a href="logout.php">logout</a>
	</div>
	<div ID=toolbar>
		<div ID=toolbarsections>
		announcements  |  products
		</div>
	</div>
	<div ID=addpost>
		<div ID=title><?php echo $title;?></div>
		<br>
		<?php echo $content;?>
	   	<p>&nbsp;</p>
	</div>
	<div ID=footer>
	(c) pg1000.com
	</div>
</div>

</body>
</html>
