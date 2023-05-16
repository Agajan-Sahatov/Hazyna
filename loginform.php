<?php 
	session_start();

	require "include/SiteName.php";
	require "include/classes.php";

	$status = "";

	$db = new database('hazyna');
	$tablename = 'users';
	if(!$db) die('There was a problem connecting to database');

	if (isset($_POST['btnLogIn'])) {
		if ( !empty($_POST['txtEmail']) && !empty($_POST['txtPassword'])) {
			if ( ($db->find($tablename, 'email' , $_POST['txtEmail'])==true) && ($db->find($tablename, 'password' , $_POST['txtPassword'])==true) ){
				$_SESSION['Email'] = $_POST['txtEmail'];
				$_SESSION['Password'] = $_POST['txtPassword'];
				$_SESSION['Logged'] = true;
				header('location: index.php');
			}
			elseif ( ($db->find($tablename, 'email' , $_POST['txtEmail'])==false) && ($db->find($tablename, 'password' , $_POST['txtPassword'])==true) ){
				$status = "There is no account connected with the email address you entered";
			}
			elseif ( ($db->find($tablename, 'email' , $_POST['txtEmail'])==true) && ($db->find($tablename, 'password' , $_POST['txtPassword'])==false ) ){
				$status = "Wrong Password!";
			}
			else{
				$status = "Wrong email address and password!";
			}
		}	
		else{
			$status = "Please provide a valid email address and your password";
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo "$Site_name" . ".com";?></title>
		<link rel="stylesheet" href="include/css/style_loginform.css">
	</head>
	<body>
		<div id="div1">
			<h1><strong><?php echo "$Site_name";?></strong></h1>
			<div id="div2">
				<form id="form1" method="POST" action="">
					<li id="status1"><strong>Type your @mail & password to <br />Log in:</strong></li>
					<li id="status2"><?php echo $status; ?></li>
					<input type="text" name="txtEmail" class="txtbox" placeholder="Example@mail.com">
					<hr>
					<input type="password" name="txtPassword" class="txtbox" placeholder="Password">
					<hr>
					<input type="submit" name="btnLogIn" class="btn" value="LOG IN">
				</form>
				<a href="###">Forgotten password?</a>
			</div>

			<form id="form2" method="POST" action="SignIn/1)SignIn.php">
				<input type="submit" name="btnSignIn" class="btn" value="CREATE NEW HAZYNA ACCOUNT">
			</form>
		</div>
	</body>
</html>