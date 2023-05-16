<?php
	SESSION_START();
	require "../include/classes.php";
	require "../include/SiteName.php";
	$db = new database('hazyna');	
	if(!$db) die('There was a problem connecting to database');
	
	$inf_PDO = $db->getrow('users', 'id', $_SESSION['friend_id']);
	foreach ($inf_PDO as $inf){
		$friend_inf = $inf; 
	}
	$gender1 = array('Male' => "He", 'Female' => "She");
	$gender2 = array('Male' => "His", 'Female' => "Her");
	
	//When isset Chat button
	if(isset($_POST['btn_chat'])){
		$_SESSION['fr_or_msg'] = 'friends/friend_inf.php';
		$db = new database('hazyna_messages');
		if(!$db) die('There was a problem connecting to database');
		
		$s1 = 'users_' . $_SESSION['user_id'] . '_' . $_SESSION['friend_id'];
		$s2 = 'users_' . $_SESSION['friend_id'] . '_' . $_SESSION['user_id'];
		$bl = 0;$bol = 0;
		$tbl = $db->conn->query('show tables;');
		$table = array();
		foreach($tbl as $table){
			if($table['Tables_in_hazyna_messages']==$s2){
				$bol = 1;
			}
			if($table['Tables_in_hazyna_messages']==$s1){
				$bl = 1;
			}
		}
		
		if($bl==1 && $bol==1){ 
			header('location: ../messages/msg.php');
		}
		elseif($bl==0 && $bol==0){
			$str = 'CREATE TABLE ' . $s1 . '(id INT AUTO_INCREMENT PRIMARY KEY, messages text NOT NULL, user_id INT)';
			$db->conn->query($str);
			$str = 'CREATE TABLE ' . $s2 . '(id INT AUTO_INCREMENT PRIMARY KEY, messages text NOT NULL, user_id INT)';
			$db->conn->query($str);
			header('location: ../messages/msg.php');
		}
		elseif($bl==1 && $bol==0){ 
			$str = 'CREATE TABLE ' . $s2 . '(id INT AUTO_INCREMENT PRIMARY KEY, messages text NOT NULL, user_id INT)';
			$db->conn->query($str);
			header('location: ../messages/msg.php');
		}
		if($bl==0 && $bol==1){ 
			$str = 'CREATE TABLE ' . $s1 . '(id INT AUTO_INCREMENT PRIMARY KEY, messages text NOT NULL, user_id INT)';
			$db->conn->query($str);
			header('location: ../messages/msg.php');
		}
	}
?>

<html>
	<head>
		<meta charset="utf-8"/>
		<title></title>
		<style>
			div{
				height: 400px;
				width: 300px;
			}
			img{
				height: 2cm;
				weight: 1.5cm;
				float: left;
			}
			form submit{
				border: none;
			}
			.identificator{
				list-style: none;
				display:inline;
				text-decoration: none;
			}
			h1{
				margin-bottom: 0px;
			}
			nav{
				height: 50px;
			}
		</style>
	</head>
	<body>
		<div id="lng" style="display:none;"><?php echo $_SESSION['lang'] ?></div>
		<div>
			<img src="<?php echo '../profilesettings/images/user' . $friend_inf['id'] . '.jpg' ?>" alt="">
			<h1><?php echo $friend_inf['firstname'] . ' ' . $friend_inf['lastname'];?></h1>
			<nav><?php echo $friend_inf['firstname'] . '<li id="is_from" class="identificator"> is from </li>' . $friend_inf['country'] .
			'. <li class="identificator" id="' . $gender1[$friend_inf['gender']] . '">And ' . $gender1[$friend_inf['gender']] . ' was born in </li>' . $friend_inf['birthday'] ;?></nav>

			<form method="POST" action="">
				<input type="submit" value="Chat" name="btn_chat" id="btn_chat"/>
				<input type="submit" value="Add to favourites" name="btn_fav" id="btn_fav"/>
				<input type="submit" value="Block" name="btn_block" id="btn_block"/>
				<input type="submit" value="Delete" name="btn_delete" id="btn_delete"/>
			</form>
			<a href="../friends.php">Back</a>
		</div>
	</body>
	<script src="../include/js/friend_inf_lang.js"></script>
</html>