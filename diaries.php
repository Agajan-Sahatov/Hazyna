<?php 
	session_start();
	require "include/classes.php";
	require "include/SiteName.php";
	$str = new str();
	//getting the diary of the user
	$db = new database('hazyna_diaries');	
	if(!$db) die('There was a problem connecting to database');
	$s = 'diaries_of_' . $_SESSION['user_id'];	
	//determines the diaries table has created or not
	$tbl = $db->conn->query('show tables;');
	
	$bool = 0;
	if($tbl->rowCount()>0){
		foreach($tbl as $table){
			if($table['Tables_in_hazyna_diaries'] == $s){ $bool = 1;}
		}
	}
	//When the delete button is clicked, deletes that diary from $s
	if(isset($_POST['btn_delete'])){
		if(isset($_POST['value_id'])){
			$db->conn->query('DELETE FROM ' . $s . ' WHERE id="' . $_POST['value_id'] . '";');
		}
	}
	//When save button is clicked inserts a new row to $s 
	if(isset($_POST['btn_save'])){
		if(!empty($_POST['new_title'] && !empty($_POST['new_date']) && !empty($_POST['new_event']))){
			$db->conn->query('INSERT INTO ' . $s . '(date, title, body) values("' . 
								htmlspecialchars($str->clean($_POST['new_date'])) . '", "' . 
								htmlspecialchars($str->clean($_POST['new_title'])) . '", "' . 
								htmlspecialchars($str->clean($_POST['new_event'])) . '");');
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo $Site_name . "/diaries";?></title>
		<link rel="stylesheet" href="include/css/menu_style.css">
		<link rel="stylesheet" href="include/css/diaries_style.css">
	</head>
	<body>
		<?php require "menus.php"; ?>
		<div class="main">
			<div class="new_diary">
				
				<h3>Type your diary here</h3>
				<form method="POST" action="">
					<li>
						<label for="new_title">Enter title :</label><br/>
						<input type="text" name="new_title" id="new_title"/ required>
					</li>
					<li>
						<label for="new_date">Enter date :</label><br/>
						<input type="text" name="new_date" id="new_date"/ required>
					</li>
					<li>
						<label for="new_event">Write your diary :</label><br/>
						<textarea name="new_event" id="new_event" required></textarea>
					</li>
					<li>
						<input type="submit" name="btn_save" id="btn_save" class="btn" value="save"/>
					</li>
				</form>
			</div>
			<?php 
				if($bool == 1){
					$tbl = $db->conn->query('SELECT * FROM ' . $s . ' order by id desc;');
				}	
				if($tbl->rowCount()>0){
					foreach($tbl as $table){
						if($str->length($table['body'])>44){
							$t = $str->divide($table['body'], 44);
						}else $t = $table['body'];
						echo '<div class="diaries">';
							echo '<div class="title">' . 
									'<h2>' . $table['title'] . '</h2>' .
								'</div>'.
								'<div class="events">' .
									'<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp' . $t . '</p>' .
								'</div>'.
								'<footer>' . $table['date'] . '</footer>' .
								'<form method="POST" action="">' .
								'<input type="text" name="value_id" value="' . $table['id'] . '" style="display: none"/>' .
								'<input type="submit" value="Delete" id="btn_delete" name="btn_delete"/>' .
								'</form><br/><br/>';
						echo '</div>';
					}
				}
			?>
		</div>
	</body>
</html>