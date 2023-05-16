<?php 

	session_start();
	
	require '../include/classes.php';
	$is_signed = false;
	$db = new database('hazyna');
	if(!$db) die('There was a problem connecting to database');
	
	if ( !empty($_SESSION['firstname']) && !empty($_SESSION['lastname']) && !empty($_SESSION['Country']) && !empty($_SESSION['MobileNumber']) && !empty($_SESSION['Email']) && !empty($_SESSION['Password']) && !empty($_SESSION['Birthday']) && !empty($_SESSION['BirthMonth']) && !empty($_SESSION['BirthYear']) && !empty($_SESSION['Gender']) ) {
		if ($db) {
			$db->query(
					"INSERT INTO users(firstname, lastname, country, mobilenumber, email, password, birthday, gender)" .  
					"Values(:firstname, :lastname, :country, :mobilenumber, :email, :password, :birthday, :gender)"  , 
					array(
						'firstname' => $_SESSION['firstname'], 
						'lastname' => $_SESSION['lastname'], 
						'country' => $_SESSION['Country'],
						'mobilenumber' => $_SESSION['MobileNumber'], 
						'email' => $_SESSION['Email'], 
						'password' => $_SESSION['Password'], 
						'birthday'=> $_SESSION['Birthday'] . "." . $_SESSION['BirthMonth'] . "." . $_SESSION['BirthYear'] ,
						'gender' => $_SESSION['Gender'] )
			);
			$is_signed = true;
		}
		
	}
	if($is_signed == true){
		$is_signed = false;
			$_SESSION['Signed'] = true;
				//Gets the id of the this user
				$idd = $db->conn->query('SELECT id FROM users WHERE email = "' . $_SESSION['Email'] . '";');
				foreach($idd as $t){
					$id = $t['id'];
				}
				//Sets language of user to english
				$db->conn->query('INSERT INTO settings(user_id, language) values(' . $id . ', "english");');
				//CREATES a table of friends in hazyna_friends
				$db = new database('hazyna_friends');	
				if(!$db) die('There was a problem connecting to database');
				
				$tbl = $db->conn->query('show tables;');

				$s = 'friends_of_' . $id;
					
				$bool = 0;
				if($tbl->rowCount()>0){
					foreach($tbl as $table){
						if($table['Tables_in_hazyna_friends'] == $s){
							$bool = 1;
						}
					}
				}
				if($bool == 0){
					$str = 'CREATE TABLE ' . $s . '(id INT AUTO_INCREMENT PRIMARY KEY, friend_id INT, accepted varchar(10) NOT NULL)';
					$db->conn->query($str);
				}
				//Creates a table for diary of the user
				$db = new database('hazyna_diaries');	
				if(!$db) die('There was a problem connecting to database');
				
				$tbl = $db->conn->query('show tables;');

				$s = 'diaries_of_' . $id;
					
				$bool = 0;
				if($tbl->rowCount()>0){
					foreach($tbl as $table){
						if($table['Tables_in_hazyna_diaries'] == $s){
							$bool = 1;
						}
					}
				}
					if($bool == 0){
						$str = 'CREATE TABLE ' . $s . '(id INT AUTO_INCREMENT PRIMARY KEY, date varchar(50) NOT NULL, title varchar(200) NOT NULL, body text)';
						$db->conn->query($str);
					}
			
		header("location: ../index.php?signed='true'");
	}
	else{
		$status = "Something went wrong. You aren't signed in!";
		$_SESSION = array();
		session_destroy();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Registration final</title>
</head>
<body>
	<h1><li id="li_lastpage"><?php echo $status; ?></li></h1>
</body>
</html>