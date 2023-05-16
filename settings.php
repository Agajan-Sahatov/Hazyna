<?php 
	session_start();
	require "include/SiteName.php";
	require "include/classes.php";
	$db = new database('hazyna');
	if(!$db) die('There was a problem connecting to the database');
	
	if(isset($_POST['set_lang'])){
		if(!empty($_POST['lang'])){
			$db->conn->query("UPDATE settings SET language = '" . $_POST['lang'] ."' WHERE user_id = '" . $_SESSION['user_id'] . "';");
			$_SESSION['lang'] = $_POST['lang'];
		}
	}
?>
<html>
	<head>
		<title><?php echo $Site_name . ".com";?></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="include/css/menu_style.css">
		<link rel="stylesheet" href="include/css/settings_style.css">
	</head>
	<body>
		<?php 
			require "menus.php";
		?>
		<div class="main">
			<div class="settings">
				<form method="POST" action="">
					<li>
						<label id="select_your_language">Select your language</label>
						<select name="lang" id="lang" size="1">
							<?php 
							echo "<option selected='selected'>" . $_SESSION['lang'] ."</option>";
							if($_SESSION['lang']!='english') echo '<option>english</option>';
							if($_SESSION['lang']!='türkmençe') echo '<option>türkmençe</option>';
							if($_SESSION['lang']!='русский') echo '<option>русский</option>';
							if($_SESSION['lang']!='türkçe') echo '<option>türkçe</option>';
							?>
						</select>
						<input type='submit' id='save' value="Save" class="btn" name="set_lang"/>
					</li>
				</form>
			</div>
		</div>
	</body>
</html>