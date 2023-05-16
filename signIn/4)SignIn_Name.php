<?php 
	session_start();
	require "../include/SiteName.php";
	
	$status = "";

	if ( empty($_SESSION['Email']) ) {
		header("location: 3)SignIn_Email.php");
	}

	if (isset($_POST['btnName'])) {
	 	if ( !empty($_POST['firstname']) && !empty($_POST['lastname']) ) {
	 		$_SESSION['firstname'] = $_POST['firstname'];
	 		$_SESSION['lastname'] = $_POST['lastname'];
	 		header("location: 5)SignIn_Birthday.php");
		 } 
		 else{
		 	$status = "Please provide your firstname and lastname:";
		 }
	 } 

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
			<h1>What's Your Name?</h1>
			<p>
				Using your real informations make it easier for friends to recognise you.<br/>
				(RECOMMENDED)
			</p>
			<li id="status">
				<?php echo $status; ?>
			</li>
			<form method="POST" action="">
				<div id="divName">
					<input type="text" name="firstname" id="firstname" class="txtbox" placeholder="First Name">
					<hr>
					<input type="text" name="lastname" id="lastname" class="txtbox" placeholder="Last Name">
					<hr>
				</div>
				<input type="submit" name="btnName" id="btnName" class="btn" value="Next">
			</form>
		</div>
	</body>
</html>