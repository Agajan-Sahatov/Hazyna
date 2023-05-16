<?php 
	session_start();
	require "../include/SiteName.php"; 
	$status = "";
	if (empty($_SESSION['Gender'])) {
		header("location: 6)SignIn_Gender.php");
	}
	
	if (isset($_POST['btnPassword'])) {
	 	if ( !empty($_POST['Password']) && !empty($_POST['Password_2']) ) {
	 		if ($_POST['Password'] == $_POST['Password_2']) {
	 			$_SESSION['Password'] = $_POST['Password'];
	 			header("location: 8)SignIn_Finish.php");
	 		}
	 		else $status = "Passwords does not match. Type your password again, please!";
	 	}
	 	else{
	 		$status = "Please provide a password!";
	 	}
	 } 
?>

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Create Account</title>
	<link rel="stylesheet" href="../include/css/style_SignIn.css">
</head>
<body>
	<div>
		<h1>Choose a password</h1>
		<p>
			Remember this password. A password helps you to prevent strangers from using your account. 
		</p>
		<li id="status">
			<?php echo $status; ?>
		</li>
		<form action="" method="POST">
			<input type="password" name="Password" id="Password" class="txtbox" placeholder="Password">
			<hr>
			<input type="password" name="Password_2" id="Password_2" class="txtbox" placeholder="Re-type your Password">
			<hr>
			<input type="submit" name="btnPassword" id="btnPassword" class="btn" value="Next">
		</form>
	</div>
</body>
</html>