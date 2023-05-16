<?php 
	session_start();
	require "include/SiteName.php";
	require "include/classes.php";
	$db = new database('hazyna_messages');
	if(!$db) die('There was a problem connecting to database');
	$str = new str();
	if(isset($_SESSION['user_id'])){ $me = $_SESSION['user_id']; }else{header("location:index.php");}
	if(isset($_GET['friend'])){
		$_SESSION['friend_id'] = $_GET['friend'];
		$_SESSION['fr_or_msg'] = 'messages.php';
		if(!empty($_SESSION['friend_id'])){
			header('location: messages/msg.php#msg_type');
		}
	}
	$tbl = $db->conn->query('show tables like "users_' . $me . '_%";');
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo "$Site_name" . ".com/Messages";?></title>
		<link rel="stylesheet" href="include/css/menu_style.css">
		<link rel="stylesheet" href="include/css/messages_style.css">
	</head>
	<body>
		<?php 
			require "menus.php";
		?>
		<div class="main" id="main">
			<div id="chatfield">
				<?php 
					//Getting the chats...
					$db = new database('hazyna_messages');
					if(!$db) die('There was a problem connecting to database');
					$tbl = $db->conn->query('show tables like "users_' . $me . '_%";');
					
					$db = new database('hazyna');
					if(!$db) die('There was a problem connecting to database');
					if(!empty($tbl)){
						foreach($tbl as $t){
							$table = $t;
							$s=$table['Tables_in_hazyna_messages (users_' . $me . '_%)'];
							$fr=$str->get_friend($s);
							$chats = $db->getrow('users', 'id', $fr);
							if($chats){
								foreach($chats as $chat){
									echo '<a href="?friend=' . $fr . '" id="fr">' .
											'<div class="elem" id="elem">' .
												'<img src="profilesettings/images/user' . $fr . '.jpg" alt="">'.
												'<li id="vr">|</li>'. 
												'<li id="usrname">' . $chat['firstname'] . ' ' . $chat['lastname'] .  '</li>' .
												'<li id="status"> ' . $str->show($chat['status'], 50) . '</li>' .
											'</div>' . 
										 '</a>';
								}
							}
						}
					}
				?>
			</div>
		</div>
	</body>
</html>