<?php 
	session_start();
	require "../include/SiteName.php"; 
	$status = "";
	if ( empty($_SESSION['Country']) || empty($_SESSION['MobileNumber'])) {
		header("location: 2)SignIn_MobileNumber.php");
	}

	if ( isset($_POST['btnEmail']) ) {
		if ( !empty($_POST['Email']) ) {
			$_SESSION['Email'] = $_POST['Email'];
	 		header("location: 4)SignIn_Name.php");
		}
	 	else{
	 		$status = "Please provide an email address:";
	 	}
	 }  
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Registering to <?php echo $Site_name ?></title>
	<link rel="stylesheet" href="../include/css/style_SignIn.css">
</head>
<body>
	<div>
		<h1>Enter Your <br>Email Address</h1>
		<p>
			You'll use this email address when you log in and if you ever need to reset your password
		</p>
		<li id="status">
			<?php echo $status; ?>
		</li>
		<form method="POST" action="">
	        <input type="text" name="Email" id="Email" class="txtbox" placeholder="Email address">
			<hr>
			<input type="submit" name="btnEmail" id="btnEmail" class="btn" value="Next">
		</form>
	</div>
</body>
</html>