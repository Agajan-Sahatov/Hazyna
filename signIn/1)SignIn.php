<?php 
	require "../include/SiteName.php"; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Account</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="../include/css/style_SignIn.css">
</head>
<body>
	<div>
		<h1><?php echo "Join " . $Site_name; ?></h1>
		<p>
			<?php echo "We'll help you to create a new $Site_name account in a few easy steps.";?>
		</p>
		<form method="POST" action="2)SignIn_MobileNumber.php">
			<input type="submit" name="btn1" id="btn1" class="btn" value="Next">
		</form>
	</div>
</body>
</html>