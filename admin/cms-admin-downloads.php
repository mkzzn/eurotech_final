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
	$uploadDir = $_SERVER['DOCUMENT_ROOT']."/PG1000/upload/";
	
	
	if(isset($_POST['install1']))
	{
		
		include 'library/config.php';
		include 'library/opendb.php';
	
		$install1 = $_POST['install1'];
		$help1 = $_POST['help1'];
		$install2 = $_POST['install2'];
		$help2 = $_POST['help2'];
		$install3 = $_POST['install3'];
		$help3 = $_POST['help3'];
		$install4 = $_POST['install4'];
		$help4 = $_POST['help4'];
		$install5 = $_POST['install5'];
		$help5 = $_POST['help5'];
		
		$query = "UPDATE gen_downloads SET install1='$install1', help1='$help1', install2='$install2', help2='$help2', install3='$install3', help3='$help3', install4='$install4', help4='$help4', install5='$install5', help5='$help5' ".
				 "WHERE id = 177";
	
		mysql_query($query) or die('Error, query failed : ' . mysql_error());                    
	
		//include 'library/closedb.php';
		
		echo "<br>File updated.<br>";
	}		
	
	
	?>
	
	</div>
  <?php include 'header.php'; ?>
	
	<div ID=sectionblock>
	
		
		<div ID=articlelist>
		
			<?php
				$query = "SELECT install1, help1, install2, help2, install3, help3, install4, help4, install5, help5 FROM gen_downloads WHERE id = 177"; 
				$result = mysql_query($query) or die('Error : ' . mysql_error());
			
				while(list($install1, $help1, $install2, $help2, $install3, $help3, $install4, $help4, $install5, $help5 ) = mysql_fetch_array($result, MYSQL_NUM))
				{	
			?>
			
			<br>
			<div ID=newpassword>
				<form method="post" action="cms-admin-downloads.php">
					New PG1000 Install
					<br> Install:<input name="install1" type="text" class="box" id="install1" value="<?php echo $install1;?>" size=60>
					<br> Help File:<input name="help1" type="text" class="box" id="help1" value="<?php echo $help1;?>" size=60>
					<br><br>Major PG1000 Upgrade
					<br> Install:<input name="install2" type="text" class="box" id="install2" value="<?php echo $install2;?>" size=60>
					<br> Help File:<input name="help2" type="text" class="box" id="help2" value="<?php echo $help2;?>" size=60>
					<br><br>Minor PG1000 Upgrade
					<br> Install:<input name="install3" type="text" class="box" id="install3" value="<?php echo $install3;?>" size=60>
					<br> Help File:<input name="help3" type="text" class="box" id="help3" value="<?php echo $help3;?>" size=60>
					<br><br>PG1000 File Upgrade
					<br> Install:<input name="install4" type="text" class="box" id="install4" value="<?php echo $install4;?>" size=60>
					<br> Help File:<input name="help4" type="text" class="box" id="help4" value="<?php echo $help4;?>" size=60>
					<br><br>PG1000 Help File Upgrade
					<br> Install:<input name="install5" type="text" class="box" id="install5" value="<?php echo $install5;?>" size=60>
					<br> Help File:<input name="help5" type="text" class="box" id="help5" value="<?php echo $help5;?>" size=60>
					<br><br>
					
					
					<input name="update" type="submit" class="box" id="update" value="  Update  ">
				</form>
			<br>
			<?php
				}
			?>
		</div>
	</div>
	

</div>
<br><br>


<?php
	
	include 'library/closedb.php';
?>
<div ID=footer>
(c) pg1000.com
</div>

</body>
</html>
