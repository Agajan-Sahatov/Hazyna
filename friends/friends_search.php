<?php
	session_start();
	require "../include/classes.php";
	require "../include/SiteName.php";
	
	$db = new database('hazyna_friends');	
	if(!$db) die('There was a problem connecting to database');
	
	if(isset($_POST['btn_send'])){
		if(($db->find('friends_of_' . $_SESSION['user_id'], 'friend_id' , $_GET['friend_id'])==false)){// biriniňkide bar bolup beýlekisiniňkide ýok bolsa näme etmeli?
			$db->conn->query('INSERT INTO friends_of_' . $_SESSION['user_id'] . '(friend_id, accepted) VALUES(' . $_GET['friend_id'] . ', "sent")');
			$db->conn->query('INSERT INTO friends_of_' . $_GET['friend_id'] . '(friend_id, accepted) VALUES(' . $_SESSION['user_id'] . ', "invited")');
		}
	}
	
	if(isset($_POST['btn_accept'])){
		$db->conn->query('UPDATE friends_of_' . $_SESSION['user_id'] . ' SET accepted = "yes" WHERE friend_id="' . $_GET['request_id'] . '";');
		$db->conn->query('UPDATE friends_of_' . $_GET['request_id'] . ' SET accepted = "yes" WHERE friend_id="' . $_SESSION['user_id'] . '";');
	}
	if(isset($_POST['btn_deny'])){
		$db->conn->query('DELETE FROM friends_of_' . $_SESSION['user_id'] . ' WHERE friend_id="' . $_GET['request_id'] .'";');
		$db->conn->query('DELETE FROM friends_of_' .  $_GET['request_id'] . ' WHERE friend_id="' . $_SESSION['user_id'] .'";');
	}
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title></title>
		<link rel="stylesheet" href="../include/css/friend_search.css">
	</head>
	<body>
		<div id="lng" style="display:none;"><?php echo $_SESSION['lang'] ?></div>
		<!-- lay out -->
		<form method="POST" action="">
			<input type="text" name="txtbox">
			<input type="submit" name="btn_search" value="Search" id="search" class="btn">
		</form>
			<?php 
				if(isset($_POST['btn_search']) && !empty($_POST['txtbox'])){
					$db = new database('hazyna');	
					if(!$db) die('There was a problem connecting to database');
					$exists = false;
					$inf_PDO = $db->getrow('users', 'firstname', $_POST['txtbox']);
					if($inf_PDO !=false){
						foreach ($inf_PDO as $inf){
							$friend_inf = $inf; 
						}
						if(strtolower($friend_inf['firstname'])==strtolower($_POST['txtbox'])){
							$exists = true;
						}
					}
					if($exists == true && ($_SESSION['user_id'] != $friend_inf['id'])){
						echo "<li id='results'>Results</li>";
						echo 	'<div>' . 
									'<img src="../profilesettings/images/user' . $friend_inf['id'] . '.jpg" alt=""/>'.
									'<ul>' .
										'<li id="user_name">' . $friend_inf['firstname'] . ' ' . $friend_inf['lastname'] . '</li>' . 
									'</ul>' .
									'<form method="POST" action="?friend_id=' . $friend_inf['id'] .'" >' .
										'<input type="submit" name="btn_send" value="Send request for friendship" id="btn_send" class="btn_found">' . '<br/>' .
										'<input type="submit" name="btn_chat" value="Chat" id="chat" class="btn_found">' .
									'</form>' .
								'</div>';
					}
					//need to fix
					elseif($exists == true && ($_SESSION['user_id'] == $friend_inf['id'])){
						echo '<div>' . 
								'<img src="../profilesettings/images/user' . $friend_inf['id'] . '.jpg" alt=""/>'.
								'<ul>' . 
									'<li id="user_name">' . $friend_inf['firstname'] . ' ' . $friend_inf['lastname'] . '</li>' . 
									'<li class="warner" id="yourself_warner">You cannot add yourself as a friend</li>' .
								'</ul>' .
							'</div>';
					}//need to fix
					else{
						echo '<li class="warner" style="margin-left: 0px">' . $_POST['txtbox'] . '<p id="is_not_found" style="display:inline;"> is not found!!!</p></li>';
					}
				}
				
				
				$db = new database('hazyna_friends');	
				if(!$db) die('There was a problem connecting to database');
				$s = 'friends_of_' . $_SESSION['user_id'];
				$a = $db->conn->query('SELECT * FROM ' . $s);
				
				$db = new database('hazyna');	
				if(!$db) die('There was a problem connecting to database');
				
				foreach($a as $t){
					$friends = $t; 
					if(strtolower($friends['accepted']) == 'invited'){
						$inf_PDO = $db->getrow('users', 'id', $friends['friend_id']);
						foreach ($inf_PDO as $inf){
							$user_inf = $inf; 
						}//Lay out
						echo '<article>' . 
								'<img src="../profilesettings/images/user' . $friends['friend_id'] . '.jpg" alt=""'.
								'<ul>' .
									'<li id="user_name">' . $user_inf['firstname'] . ' ' . $user_inf['lastname'] . '</li>' . 
								'</ul>' .
								'<form method="POST" action="?request_id=' . $friends['friend_id'] . '" >' .
									'<input type="submit" name="btn_accept" id="btn_accept" value="Accept" class="btn_found">' . '<br/>' .
									'<input type="submit" name="btn_deny" id="btn_deny" value="Deny" class="btn_found">' .
								'</form>' .
							'</article><br/>';
					}
				}
			?>
			<a id="back" href="../friends.php">Back</a>
	</body>
	<script src="../include/js/friends_search_lang.js"></script>
</html>