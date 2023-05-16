<?php 
	session_start();
	require "../include/SiteName.php";

	$status = "";

	if (empty($_SESSION['firstname']) || empty($_SESSION['lastname']) ) {
		header("location: 4)SignIn_Name.php");
	}
	
	if (isset($_POST['btnBirthday'])) {
		if ( $_POST['Birthday'] != 'Day' && $_POST['BirthMonth'] != 'Month' && $_POST['BirthYear'] != 'Year' ) {
			$_SESSION['Birthday'] = $_POST['Birthday'];
			$_SESSION['BirthMonth'] = $_POST['BirthMonth'];
			$_SESSION['BirthYear'] = $_POST['BirthYear'];
			header("location: 6)SignIn_Gender.php");
		}
	 	else{
	 		$status = "Please provide your birthday!";
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
		<h1>What's Your Birthday?</h1>
		<p>
			Using your real informations make it easier for friends to recognise you.<br/>
			(RECOMMENDED)
		</p>
		<li id="status">
				<?php echo $status; ?>
		</li>
		<form action="" method="POST">
	    	<select name="Birthday" size="1" id="Birthday" class="SelectBirthday">
	    		<option selected="SELECTED">Day</option>
				<?php 
					for ($i=1; $i<=31 ; $i++) { 
						if ($i<10) {
							echo "<option>0$i</option>";
						} else {
							echo "<option>$i</option>";
						}
					}
				?>
	        </select>
	        <select name="BirthMonth" size="1" id="BirthMonth" class="SelectBirthday">
	        	<option selected="SELECTED">Month</option>
		    	<?php 
		    	 	for ($i=1; $i<=12; $i++) { 
		    	 		if ($i<10) {
	    	 				echo "<option>0$i</option>";
	    	 			} else {
	    	 				echo "<option>$i</option>";
	    	 			}
		    	 	}
		    	  ?>
	        </select>
	        <select name="BirthYear" size="1" id="BirthYear" class="SelectBirthday">
	        	<option selected="SELECTED">Year</option>
				<?php 
					for ($i=1975; $i<=2020 ; $i++) { 
						echo "<option>$i</option>";
					}
				?>
	        </select><br/>
	        <input type="submit" name="btnBirthday" id="btnBirthday" class="btn" value="Next">
		</form>
	</div>

</body>
</html>