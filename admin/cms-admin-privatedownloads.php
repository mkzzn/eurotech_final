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


if(isset($_GET['del']))
{
	//search for the path in the db
	$query   = "SELECT path, size FROM upload WHERE id = '{$_GET['del']}'";
	$result  = mysql_query($query) or die('Error, query failed');
	list($path, $size) = mysql_fetch_array($result);
	
	//remove http://eurotechcorp.com.hosting.tds.net from path string
	if($size > 0):
	$newpath = str_replace("http://eurotechcorp.com.hosting.tds.net/", "/web/", $path);
	
	//unlink the file 
	
	unlink($newpath);
	endif;
	// remove the article from the database
	$query = "DELETE FROM upload WHERE id = '{$_GET['del']}'";
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

function change_int_section(int_section)
{
	window.location.href = "cms-admin-privatedownloads.php?int_section=" + int_section;
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


if(isset($_POST['link']))
{
	
	
	$link = $_POST['link'];
	$name = $_POST['name'];
	$section = $_POST['section'];
	$caption = $_POST['caption'];

   	
    include 'library/config.php';
    include 'library/opendb.php';

    
	$query = "INSERT INTO upload (name, path, section, caption ) ".
			 "VALUES ('$name', '$link', '$section', '$caption')";

    mysql_query($query) or die('Error, query failed : ' . mysql_error());                    

    //include 'library/closedb.php';
    
    echo "<br>File added<br>";
}		


	
if(isset($_POST['int_section'])) {

	$query = "SELECT user_id, download_alias, download_abbreviation FROM tbl_auth_user WHERE download_abbreviation = '" . $_POST['int_section'] . "'"; 
	$result = mysql_query($query) or die('Error : ' . mysql_error());
	while(list($user_id, $alias, $abbrv) = mysql_fetch_array($result, MYSQL_NUM)) {

    $int_section = "PrivateDownload";
    if ($abbrv != "USA") {
      $int_section .= "_" . $abbrv;
    }
    $int_section_user = $user_id;
    echo "<br>Now Editing $alias Private Downloads<br>";
  }

} else {
	$int_section_user = "US_downloads";
	$int_section = "PrivateDownload";
}
	
if(isset($_POST['password']))
	{
		$password      = $_POST['password'];
		$passwordverify = $_POST['passwordverify'];
		
		if($password == ""){
			echo "<br>Passwords cannot be blank.<br>";
		}
		
		else if($password == $passwordverify) {
		
		// update the article in the database
		$query = "UPDATE tbl_auth_user ".
				 "SET user_password = '$password' ".
				 "WHERE user_id = '$int_section_user'";
		mysql_query($query) or die('Error : ' . mysql_error());
		
		echo "<br>Password Changed.<br>";
		}
		
		else {
			echo "<br>Passwords are not the same.<br>";
		}

			
	}


?>

</div>


<?php include 'header.php'; ?>

<div ID=sectionblock>

<table><tr><td>
<div ID=articlelist>

<form method="post" action="cms-admin-privatedownloads.php">
<select name="int_section" id="int_section">
    <option value="">Select an international page...</option>

<?php
	$query = "SELECT user_id, download_alias, download_abbreviation FROM tbl_auth_user WHERE private_download = 'on' order by user_id ASC"; 
	$result = mysql_query($query) or die('Error : ' . mysql_error());
	while(list($user_id, $alias, $abbrv) = mysql_fetch_array($result, MYSQL_NUM)) {
?>	
  <option value=<?php echo $abbrv; ?> <?php if($int_section_user == $user_id)echo "SELECTED";?>><?php echo $alias; ?></option>

                                                                                                               <?php } ?>

</select>
<input name="int_section_select" type="submit" class="box" id="int_section_select" value="go">
</form>

<?php
	$query = "SELECT id, name, caption, path FROM upload WHERE section = '"; 
	$query .= $int_section; 
	$query .= "' ORDER BY id";
	$result = mysql_query($query) or die('Error : ' . mysql_error());
 
	while(list($id, $name, $caption, $path) = mysql_fetch_array($result, MYSQL_NUM))
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
Upload a new file:
<br>
	<form method="post" action="cms-admin-privatedownloads.php">
		<input type="hidden" name="int_section" value="<?=$int_section;?>">
		<input type="hidden" name="section" value="<?=$int_section;?>">
		<br><br> Name:<input name="name" type="text" class="box" id="name" size=30>
		<br><br> Link to File:<input name="link" type="text" class="box" id="link" size=30>
		<br><br>Description: <textarea name="caption" cols="47" rows="2" class="box" id="caption"><?=$caption;?></textarea>
		<input name="upload" type="submit" class="box" id="upload" value="  Add  ">
		</form>
<br>
	
	
		
		
</div>
</div>
</td><td align="center">
<div ID=image>

<?php
		$query   = "SELECT user_password FROM tbl_auth_user WHERE user_id = '" . $int_section_user . "' LIMIT 1";
		$result  = mysql_query($query) or die('Error, query failed');
		list($password) = mysql_fetch_array($result);
		?>
	<div ID=newpassword>
	<br><b>Username:</b> <?=$int_section_user;?><br>
	<b>Current Password:</b> <?php echo $password;?><br>
	
	<br>
	<form method="post" action="cms-admin-privatedownloads.php">
	<input type="hidden" name="int_section" value="<?=$int_section;?>">
	New Password: <input name="password" type="text" class="box" id="password" size=20><br>
	Verify Password: <input name="passwordverify" type="text" class="box" id="passwordverify" size=20><br>
	<input name="update" type="submit" class="box" id="update" value="update password">
	</form>
	</div>

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
