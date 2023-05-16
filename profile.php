<?php 
	session_start();
	
	if ( empty($_SESSION['Email']) || empty($_SESSION['Password']) || $_SESSION['Logged'] != true) {
		header("location: loginform.php");
	}
	
	require "include/classes.php";
	$db = new database('hazyna');
	if(!$db) die('There was a problem connecting to database');
	
	if(isset($_POST['btn_save'])){
		if(!empty($_POST['firstname'])){
			$db->conn->query('UPDATE users SET firstname = "' . $_POST['firstname'] . '" WHERE id = ' . $_SESSION['user_id'] . ';');
			$inf_PDO = $db->getrow('users', 'email', $_SESSION['Email']);
			foreach ($inf_PDO as $inf){ $user_inf = $inf;}
			$_SESSION['user_firstname'] = $user_inf['firstname'];
		}
		if(!empty($_POST['status'])){
			$db->conn->query('UPDATE users SET status = "' . $_POST['status'] . '" WHERE id = ' . $_SESSION['user_id'] . ';');
			$inf_PDO = $db->getrow('users', 'email', $_SESSION['Email']);
			foreach ($inf_PDO as $inf){ $user_inf = $inf; }
			$_SESSION['user_status'] = $user_inf['status'];
		}
	}
	//Getting the image
	if(isset($_SESSION['user_id']))
		$me = $_SESSION['user_id'];
	$ctrl = glob('profilesettings/images/*'. $me . '.jpg');
	$file = "";
	if(!empty($ctrl)) $file = $ctrl[0];
	if($file==("profilesettings/images/user" . $me . ".jpg")){
		$image_path = "profilesettings/images/user" . $me . ".jpg";
	}
	else{
		$image_path = "Image is not set";
	}
	
?>
<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="include/css/menu_style.css">
		<link rel="stylesheet" href="include/css/profile_style.css">
	</head>
	<body>
		<?php 
			require "menus.php";
		?>
		<div class="main">
			<div id="profile">
				<div id="imagefield">
					<div id="image">
						<?php 
							if($image_path=="Image is not set"){ echo "<li id='image_is_not_set'>" . $image_path . "</li>";}
							else{ echo '<img src="' . $image_path . ' " alt=""/>';}
						?>
					</div>
					<hr/>
					<li id="li_img"><a href="profilesettings/upload_image.php" id="Ch_P_image">Change profile image</a></li>
				</div>
					<ul>
						<li class="inf_name" id="first_name">First Name: </li>
						<li id="li_firstname" class="inf"><?php echo $_SESSION['user_firstname'];?></li>
						<li id="edit" class="edit">Edit</li>
						<form method="POST" id="form_firstname">
							<input type="text" name="firstname" class="txtbox">
							<input type = "submit" value="Save" class="btn" name="btn_save" id="save">
						</form>
					</ul>
					<ul>
						<li class="inf_name" id="last_name">Last Name: </li>
							<li id="li_lastname" class="inf"><?php echo $_SESSION['user_lastname'];?></li>
					</ul>
					<ul>	
						<li class="inf_name" id="country">Country: </li>
							<li id="li_country" class="inf"><?php echo $_SESSION['user_country'];?></li>
					</ul>
					<ul>		
						<li class="inf_name" id="mobile_number">Mobile Number: </li>
							<li id="li_mobilenumber" class="inf"><?php echo $_SESSION['user_mobilenumber'];?></li>
					</ul>
					<ul>		
						<li class="inf_name"id="gender">Gender: </li>
							<li id="li_gender" class="inf"><?php echo $_SESSION['user_gender'];?></li>
					</ul>
					<ul>		
						<li class="inf_name" id="email_address">Email Address: </li>
							<li id="li_email" class="inf"><?php echo $_SESSION['user_email'];?></li>
					</ul>
					<ul>	
						<li class="inf_name" id="password">Password: </li>
							<li id="li_password" class="inf"><?php echo $_SESSION['user_password'];?></li>
					</ul>
					<ul>
						<li class="inf_name" id="birthday">Birthday: </li>
							<li id="li_birthday" class="inf"><?php echo $_SESSION['user_birthday'];?></li>
					</ul>
					<ul>
						<li class="inf_name" id="status">Status: </li>
						<li id="li_status" class="inf"><?php echo $_SESSION['user_status'];?></li>
						<li id="edit_status" class="edit" id="edit">Edit</li>
						<form method="POST" id="form_status">
							<input type="text" name="status" class="txtbox">
							<input type = "submit" value="Save" class="btn" name="btn_save" id="save">
						</form>
					</ul>
			</div>
		</div>
		<script>
			/* for firstname */
			var edit_firstname = document.getElementById('edit_firstname');
			var edit_firstnameStyle = edit_firstname.style;
			var form_firstname = document.getElementById('form_firstname');
			var form_firstnameStyle = form_firstname.style;
			edit_firstname.onclick = function(){ edit_firstnameStyle.display = 'none'; form_firstnameStyle.display = 'inline'; }
			btn_firstname.onclick = function(){ edit_firstnameStyle.display = 'block'; form_firstnameStyle.display = 'none'; }
			
			/* for status */
			var edit_status = document.getElementById('edit_status');
			var edit_statusStyle = edit_status.style;
			var form_status = document.getElementById('form_status');
			var form_statusStyle = form_status.style;
			edit_status.onclick = function(){ edit_statusStyle.display = 'none'; form_statusStyle.display = 'inline'; }
			btn_status.onclick = function(){ edit_statusStyle.display = 'block'; form_statusStyle.display = 'none'; }
		</script>
	</body>
</html>