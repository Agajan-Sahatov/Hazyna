<?php 
	session_start();

	require "../include/SiteName.php";

	if ( empty($_SESSION['Password']) ){
		header("location: 7)SignIn_Password.php");
	}
?>
<html>
	<head>
		<title>Create Account</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="../include/css/style_SignIn.css">
	</head>
<body>
	<div>
		<h1>Finish Signing up</h1>
		<p>
			By signing up, you agree to our <a href="###"> <?php echo $Site_name; ?> Terms</a> and that you have read our 
			<a href="">Data Policy</a>. You may receive SMS Notifications from <?php echo $Site_name; ?> at any time.
		</p>
		<form action="TheLastPage.php">
			<input type="submit" name="btnsign_up" id="btnsign_up" class="btn" value="Sign Up">
		</form>
	</div>
</body>
</html>