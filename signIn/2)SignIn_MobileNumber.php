<?php 
	session_start();
	require "../include/SiteName.php"; 
	require "../include/classes.php";
	$status = "";

	$db = new database('hazyna');
	$tablename = 'users';
	if(!$db) die('There was a problem connecting to database');

	if ( isset($_POST['btnMobileNumber']) ) {
		if( $_POST['Country'] != "Select Country" && !empty($_POST['MobileNumber']) ){
			if ($db->find($tablename, 'mobilenumber' , $_POST['MobileNumber'])==false) {
				$_SESSION['Country'] = $_POST['Country'];
				$_SESSION['MobileNumber'] = $_POST['MobileNumber'];
				header("Location: " . "3)SignIn_Email.php");
			}else $status = 'There is an account already connected to this mobile number. Please use another';
		}else $status = 'Please provide all informations: Select your country and type your mobile number';
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
		<h1>Enter Your Mobile Number</h1>
		<p>
			You'll use this number when you log in and if you ever need to reset your password
		</p>
		<li id="status">
			<?php echo $status; ?>
		</li>
		<form method="POST" action="">
			<select name="Country" id="Country" size="1" >

	    	 	<option selected="selected">
	    	 		<?php 
	    	 			if (isset($_POST['Country'])) echo $_POST['Country'];
	    	 			else echo "Select Your Country";
	    	 		?>
	    	 	</option>
	    	 	<option>Türkmenistan</option>
				<option>Russia</option>
				<option>Belorussia</option>
				<option>Ukrain</option>
				<option>Azerbaýjan</option>
				<option>Uzbekistan</option>
				<option>Iran</option>
				<option>England</option>
				<option>USA</option>
				<option>France</option>
				<option>Spain</option>
				<option>Italy</option>
	        </select>
	        <?php 
	        	$value = "";
	        	if(isset($_POST['MobileNumber'])){
	        		$value = $_POST['MobileNumber'];
	        	}
	        	echo "<input type=\"text\" name=\"MobileNumber\" id=\"MobileNumber\" " . 
	        		 " class=\"txtbox\" placeholder=\"Mobile Number\" value=\"" . $value .  "\">";
	        ?>
			<hr>
			<input type="submit" name="btnMobileNumber" id="btnMobileNumber" class="btn" value="Next">
		</form>
	</div>
</body>
</html>