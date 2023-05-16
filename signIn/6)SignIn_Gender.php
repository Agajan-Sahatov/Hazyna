<?php 
	session_start();
	require "../include/SiteName.php";

	$status = "";

	if ( empty($_SESSION['Birthday']) || empty($_SESSION['BirthMonth']) || empty($_SESSION['BirthYear']) ) {
		header("location: 5)SignIn_Birthday.php");
	}

	if ( isset($_POST['btnGender']) ) {
		if (isset($_POST['Gender'])) {
			$_SESSION['Gender'] = $_POST['Gender'];
			header("location: 7)SignIn_Password.php");
		}
		else{
			$status = "Please provide your gender!";
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
		<h1>What's Your Gender?</h1>
		<p>
			<?php 
				echo "Providing your gender creates the best $Site_name experience for you.";
			?>
		</p>
		<li id="status">
			<?php echo $status; ?>
		</li>
		<form action="" method="POST">
	    	 <label for="Gender_0" class="lblgender" font-size="25px">
	    	 	<?php 
	    	 		echo "Male ";
	    	 		for ($i=1; $i<=37; $i++) { 
	    	 			echo "&nbsp;";
	    	 		}
	    	 	?>
	    	 </label> 
	    	 <input type="radio" name="Gender" value="Male" id="Gender_0" />
	    	 <br />
	    	 <label for="Gender_1" class="lblgender">
	    	 	<?php 
	    	 		echo "Female";
	    	 		for ($i=1; $i<=35; $i++) { 
	    	 			echo "&nbsp;";
	    	 		}
	    	 	?>
	    	 </label>
	    	 <input type="radio" name="Gender" value="Female" id="Gender_1" />
	    	 <br />
	    	 <input type="submit" name="btnGender" id="btnGender" class="btn" value="Next">
		</form>
	</div>
</body>
</html>