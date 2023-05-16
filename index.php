<?php 
	session_start();
	$_SESSION['lang_created'] = 0;
	require "include/classes.php";
	require "include/SiteName.php";
	$db = new database('hazyna');
	$tablename = 'users';
	if(!$db) die('There was a problem connecting to database');
	if ( isset($_SESSION['Signed']) && $_SESSION['Signed'] == true ){
		if ( $db->find($tablename,'email',$_SESSION['Email'])==true && $db->find($tablename,'password',$_SESSION['Password'])==true ) {
			$_SESSION['Signed'] = false;
			$_SESSION['Logged'] = true;
			$status =  'Hi ' . $_SESSION['firstname'] . " " . $_SESSION['lastname'] . ". Welcome to Hazyna!" . "<br>";
		}
	}
	if ( empty($_SESSION['Email']) || empty($_SESSION['Password']) || $_SESSION['Logged'] != true) {
		header("location: loginform.php");
	}
	else{
		$inf_PDO = $db->getrow($tablename, 'email', $_SESSION['Email']);
		foreach ($inf_PDO as $inf){
			$user_inf = $inf; 
		}
		$_SESSION['user_id'] = $user_inf['id']; 
		$_SESSION['user_firstname'] = $user_inf['firstname'];
		$_SESSION['user_lastname'] = $user_inf['lastname'];
		$_SESSION['user_country'] = $user_inf['country'];
		$_SESSION['user_mobilenumber'] = $user_inf['mobilenumber'];
		$_SESSION['user_gender'] = $user_inf['gender'];
		$_SESSION['user_email'] = $user_inf['email'];
		$_SESSION['user_birthday'] = $user_inf['birthday'];
		$_SESSION['user_status'] = $user_inf['status'];
		$_SESSION['user_password'] = $user_inf['password'];
		//Getting the which language has setted the user
		$languages = $db->conn->query('SELECT language FROM settings WHERE user_id = ' . $_SESSION['user_id'] . ';');
		if($languages->rowCount()>0){
			foreach ($languages as $lng){
				$lang = $lng; 
			}
			$language = $lang['language'];
		}
		else{
			$db->conn->query("INSERT INTO settings(user_id, language) VALUES('" . $_SESSION['user_id'] . "', 'english');");
			$language = "english";
		}
		$_SESSION['lang'] = $language;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo $Site_name . ".com";?></title>
		<link rel="stylesheet" href="include/css/menu_style.css">
		<link rel="stylesheet" href="include/css/index_style.css">
	</head>
	<body>
	<?php require "menus.php"; ?>
		<div class="main" id="main">
			<h1 id="hazyna"><?php echo $Site_name . ".com";?></h1>
		</div>
	</body>
</html>
