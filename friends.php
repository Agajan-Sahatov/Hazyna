<?php 
	session_start();
	require "include/classes.php";
	require "include/SiteName.php";
	if(isset($_GET['friend'])){
		$_SESSION['friend_id'] = $_GET['friend'];
		if(!empty($_SESSION['friend_id'])){
			header('location: friends/friend_inf.php');
		}
	}
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title></title>
		<link rel="stylesheet" href="include/css/menu_style.css">
		<link rel="stylesheet" href="include/css/friends_style.css">
	</head>
	<body>
		<?php require "menus.php"; ?>
		<div class="main" id="main">
			<div id="friends">
			<!-- lay out -->
				<li><a href="friends/friends_search.php" id="search_people">Search people</a></li><hr/>
				<?php 
					$str = new str();
 					$db = new database('hazyna_friends');	
					if(!$db) die('There was a problem connecting to database');
					
					$s = 'friends_of_' . $_SESSION['user_id'];
					$a = $db->conn->query('SELECT * FROM ' . $s);
					
					$db = new database('hazyna');	
					if(!$db) die('There was a problem connecting to database');
					
					foreach($a as $t){
						$friends = $t; 
						if(strtolower($friends['accepted']) == 'yes'){
							$inf_PDO = $db->getrow('users', 'id', $friends['friend_id']);
							foreach ($inf_PDO as $inf){
								$friend_inf = $inf; 
							}
							//lay out
							echo '<a href="?friend=' . $friend_inf['id'] .'" id="fr">' .
									'<div class="elem" id="elem">' . 
										'<img src="profilesettings/images/user' . $friend_inf['id'] . '.jpg" alt="">' . 
										'<li id="vr">|</li>'. 
										'<li id="usrname">' . $friend_inf['firstname'] . ' ' . $friend_inf['lastname'] .  '</li>' .
										'<li id="status"> ' . $str->show($friend_inf['status'], 35) . '</li>' .
									'</div>' . 
								'</a>';
						}
					}
				?>
			</div>
		</div>
	
	</body>
</html>