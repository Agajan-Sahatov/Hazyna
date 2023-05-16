<?php	
	session_start();
	require "../include/classes.php";
	require "../include/SiteName.php";
	$db = new database('hazyna_messages');
	if(!$db) die('There was a problem connecting to database');
	$str = new str();
	if(isset($_SESSION['user_id']) && isset($_SESSION['friend_id'])){
			
			if(!empty($_POST) && !empty($_POST['msg'])){
				$t = $_POST['msg'];
				$s = '';
				for($i=0; $i<=$str->length($t);$i++){
					if($t[$i] == "'"){
						$s .= "\\'";
					}elseif($t[$i] == "\\"){
						$s .= "\\\\";
					}else{
						$s .= $t[$i];
					}
				}
				$db->conn->query('INSERT INTO ' . 'users_' . $_SESSION['user_id'] . '_' . $_SESSION['friend_id'] . 
				' (messages, user_id)' . 'values(\'' . htmlspecialchars($s) . '\', ' . $_SESSION['user_id'] . ');');
				$db->conn->query('INSERT INTO ' . 'users_' . $_SESSION['friend_id'] . '_' . $_SESSION['user_id'] . 
				' (messages, user_id)' . 'values(\'' . htmlspecialchars($s) . '\', ' . $_SESSION['user_id'] . ');');
			}
	}
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo $Site_name . ".com";?></title>
		<link rel="stylesheet" href="../include/css/msg_style.css">
	</head>
	<body>
		<div id="main"><br/>
			<a href=<?php if(isset($_SESSION['fr_or_msg'])){ echo '../' . $_SESSION['fr_or_msg'];}?> id="back_link"><li id="back">back<li/></a>
			<div id="msgs"><br/>
					<?php 
						if(isset($_SESSION['user_id']) && isset($_SESSION['friend_id'])){
							$messages = $db->conn->query('SELECT * FROM users_' . $_SESSION['user_id'] . '_' . $_SESSION['friend_id']);
							foreach($messages as $message){
								if($str->length($message['messages'])>30){
									$s = $str->divide($message['messages']);
									$wdth = 'article';
									$img_user = '<img src="../profilesettings/images/user' . $_SESSION['user_id'] . '.jpg" alt="" align="right" class="user_img1" />';
									$img_friend = '<img src="../profilesettings/images/user' . $_SESSION['friend_id'] . '.jpg" alt="" class="friend_img1" />';
									$spc1 = '<li class="spc">';
									$spc2 = '</li>';
								}
								else{
									$s = $message['messages'];
									$wdth = 'span';
									$spc1 = '&nbsp';
									$spc2 = '&nbsp';
									$img_user = '<img src="../profilesettings/images/user' . $_SESSION['user_id'] . '.jpg" alt="" align="right" class="user_img2" />';
									$img_friend = '<img src="../profilesettings/images/user' . $_SESSION['friend_id'] . '.jpg" alt="" class="friend_img2" />';
								}
								if($message['user_id'] == $_SESSION['user_id']){
									echo '<p align=right style="text-align:right"><' . $wdth . ' class="user_msg">' . $spc1 . $s . $spc2. '</' . $wdth . '>' . $img_user . '</p>';
								}
								else if($message['user_id'] == $_SESSION['friend_id']){
									echo '<p align=left style="text-align:left">' . $img_friend . '<' . $wdth . ' class="friend_msg">' . $spc1 . $s . $spc2. '</' . $wdth . '></p>';
								}
							}
						}
					?>
			</div>
			<div id="dvform">
				<form method="POST" action="#msg_type">
					<input type="text" name="msg" id="msg_type" class="txt" placeholder="Type your message here">
					<input type="submit" value="Send" name="btn" id="send" class="btn">
				</form>
			</div>
		</div>
	</body>
	<div id="lng" style="display:none;"><?php echo $_SESSION['lang'] ?></div>
	<script src="../include/js/msg_lang.js"></script>
</html>