<?php
if (!isset($_SESSION)) {
// like i said, we must never forget to start the session
  session_start();
}

$errorMessage = '';
if (isset($_POST['txtUserId']) && isset($_POST['txtPassword'])) {
	include 'library/config.php';
	include 'library/opendb.php';
	
	$userId   = $_POST['txtUserId'];
	$password = $_POST['txtPassword'];

	
	// check if the user id and password combination exist in database
	$sql = "SELECT user_id 
	        FROM tbl_auth_user
			WHERE user_id = '$userId' AND user_password = '$password'";
	
	$result = mysql_query($sql) or die('Query failed. ' . mysql_error()); 
	
	if (mysql_num_rows($result) == 1) {
		// the user id and password match, 
		// set the session
		$_SESSION['db_is_logged_in'] = true;
		
		// after login we move to the main page
		header('Location: cms-admin.php');
		exit;
	} else {
		$errorMessage = 'Sorry, wrong user id / password';
	}
	
	include 'library/closedb.php';
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
	<div ID=header>
	PG1000.com Administration Section
	</div>
	<div ID=logout>
	<br>
	<a href="logout.php">logout</a>
	</div>

	
	<?php
	if ($errorMessage != '') {
	?>
	<p align="center"><strong><font color="#990000"><?php echo $errorMessage; ?></font></strong></p>
	<?php
	}
	?>
	<br>
	<form action="" method="post" name="frmLogin" id="frmLogin">
	 <table width="400" align="center" cellpadding="2" cellspacing="2">
	  <tr>
	   <td width="150">User Id</td>
	   <td><input name="txtUserId" type="text" id="txtUserId"></td>
	  </tr>
	  <tr>
	   <td width="150">Password</td>
	   <td><input name="txtPassword" type="password" id="txtPassword"></td>
	  </tr>
	  <tr>
	   <td width="150">&nbsp;</td>
	   <td><input name="btnLogin" type="submit" id="btnLogin" value="Login"></td>
	  </tr>
	 </table>
	</form>
	


	<div ID=footer>
	(c) pg1000.com
	</div>
</div>

</body>
</html>