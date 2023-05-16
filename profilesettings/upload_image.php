<?php
	SESSION_START();
	require "../include/SiteName.php";
	if(isset($_SESSION['user_id']))
		$me = $_SESSION['user_id'];
	
	if(isset($_POST['btn']) && isset($_FILES['image']) && !empty($me)){
		$errors= array();
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_tmp = $_FILES['image']['tmp_name'];
		$file_type = $_FILES['image']['type'];
		$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
		$expensions = array("jpeg","jpg","png");
		if(in_array($file_ext,$expensions)=== false){
			$errors="extension not allowed, please choose a JPEG or PNG file.";
		}
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"images/user" . $me . '.jpg');
			header('location: ../profile.php');
		}
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo "$Site_name" . ".com";?></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="../include/css/style_upload_image.css">
	</head>
	<body>
		<div class="main">
			<h1><?php echo "$Site_name" . ".com";?></h1>
		</div>
		<form action = "" method = "POST" enctype = "multipart/form-data">
			<ul>
				<li><input type = "file" name = "image" id="file"></li>
				<li><input type = "submit" value="Send" class="btn" name="btn"></li>
			</ul>
		</form>
	</body>
</html>