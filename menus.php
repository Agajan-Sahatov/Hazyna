<?php 
	//first set the $Session['menu'] and then goes to that page
	$hrefs = array('index.php', 'profile.php', 'friends.php', 'messages.php', 'diaries.php', '', '', '', '', '', '', '', '', '', 'settings.php');
	if(isset($_GET['menu'])){
		if($_GET['menu'] == "15"){
			session_destroy();
			$_SESSION = array();
			header("location: loginform.php");
		}
		else{
			$_SESSION['menu'] = $_GET['menu'];
			header("location:" . $hrefs[$_GET['menu']]);
		}
	}
	//gets the id of selected menu item - sets it 'selected' others to 'items'
	$a = array();
	for($i=0;$i<15;$i++){ $a[$i] = "items"; }
	if(!isset($_SESSION['menu'])){ $_SESSION['menu'] = 0; }
	$a[$_SESSION['menu']] = "selected";
?>
<div class="menu" id="menu">
	
	<div id="btn"><li id="btn_top">_____</li><li>_____</li><li>_____<li/></div>
	<!-- it sets the which languages has selected -->
	<div id="lng"><?php echo $_SESSION['lang'] ?></div>
	<h1 id="pagename"></h1>
	<div class="menus" id="menus">
	
		<?php 
			if(isset($_SESSION['user_id'])){
				echo 	'<img src="profilesettings/images/user' . $_SESSION['user_id'] . '.jpg" alt="" id="profile_img"/>'.
						'<li id="username">' . $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname'] .'</li>' . 
						'<li id="userstatus">' . $_SESSION['user_status'] .'</li>';
			}
		?>
		<hr class="menuhr"/>
			<ul>
				<a id="<?php echo $a[0]; ?>" href="?menu=0">
					<img src='include/css/images/icons/home.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="menus_main">Main</li>
				</a><br/>
				<a id="<?php echo $a[1]; ?>" href="?menu=1">
					<img src='include/css/images/icons/profile.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="my_profile">My profile</li>
				</a><br/>
				<a id="<?php echo $a[2]; ?>" href="?menu=2">
					<img src='include/css/images/icons/friends.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="my_friends">My friends</li>
				</a><br/>
				<a id="<?php echo $a[3]; ?>" href="?menu=3">
					<img src='include/css/images/icons/messages.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="my_messages">My messages</li>
				</a><br/>
				<a id="<?php echo $a[4]; ?>" href="?menu=4">
					<img src='include/css/images/icons/diaries.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="my_diaries">My diaries</li>
				</a><br/>
				<a id="<?php echo $a[5]; ?>" href="?menu=5">
					<img src='include/css/images/icons/images.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="my_images">My images</li>
				</a><br/>
				<a id="<?php echo $a[6]; ?>" href="?menu=6">
					<img src='include/css/images/icons/audio.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="my_audios">My audios</li>
				</a><br/>
				<a id="<?php echo $a[7]; ?>" href="?menu=7">
					<img src='include/css/images/icons/video.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="my_videos">My videos</li>
				</a><br/>
				<a id="<?php echo $a[8]; ?>" href="?menu=8">
					<img src='include/css/images/icons/news.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="news">News</li>
				</a><br/>
				<a id="<?php echo $a[9]; ?>" href="?menu=9">
					<img src='include/css/images/icons/timeline.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="timeline">Timeline</li>
				</a><br/>
				<a id="<?php echo $a[10]; ?>"href="?menu=10">
					<img src='include/css/images/icons/officials.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="officials">Officials</li>
				</a><br/>
				<a id="<?php echo $a[11]; ?>"href="?menu=11">
					<img src='include/css/images/icons/games.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="games">Games</li>
				</a><br/>
				<a id="<?php echo $a[12]; ?>"href="?menu=12">
					<img src='include/css/images/icons/online_shop.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="online_shop">Online shop</li>
				</a><br/>
				<a id="<?php echo $a[13]; ?>"href="?menu=13">
					<img src='include/css/images/icons/music.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="music_zone">Music zone</li>
				</a><br/>
				<a id="<?php echo $a[14]; ?>"href="?menu=14">
					<img src='include/css/images/icons/settings.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="settings">Settings</li>
				</a><br/>
				<a id="items" href="?menu=15">
					<img src='include/css/images/icons/log_out.png' class='icon'/>
					<img src='include/css/images/icons/vr.png' class='vr'/>
					<li id="log_out">Log out</li>
				</a><br/>
			</ul>
		<hr class="menuhr"/>
	</div>
		<script src="include/js/lang.js"></script>
		<script src="include/js/menu.js"></script>
</div>