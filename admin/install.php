<?php 
	require "../include/classes.php";
	$db = new database('a');
	if(!$db){
		echo "Open the 'classes.php' with your text editor and set there configuration options" . '<br/>';
		die('There was a problem with connecting to database');
	}else{
		$dtb = $db->conn->query('SHOW DATABASES');
		$hazyna = 0;
		$hazyna_friends = 0;
		$hazyna_messages = 0;
		$hazyna_diaries = 0;
		if(!empty($dtb)){
			foreach($dtb as $t){
				$db_names = $t;
				if($db_names['Database'] == 'hazyna' ){ $hazyna = 1;}
				if($db_names['Database'] == 'hazyna_friends' ){ $hazyna_friends = 1;}
				if($db_names['Database'] == 'hazyna_messages' ){ $hazyna_messages = 1;}
				if($db_names['Database'] == 'hazyna_diaries' ){ $hazyna_diaries = 1;}
			}
		}
		if($hazyna == 0){			
			$db->conn->query('CREATE DATABASE hazyna');
			$db = new database('hazyna');
			$db->conn->query('CREATE TABLE users(id INT AUTO_INCREMENT PRIMARY KEY, ' . 
							'firstname varchar(50) NOT NULL, ' . 
							'lastname varchar(50) NOT NULL, ' . 
							'self_id varchar(50) NOT NULL, ' .
							'country varchar(50) NOT NULL, ' .
							'region varchar(50) NOT NULL, ' . 
							'city_village varchar(50) NOT NULL, ' .
							'gender varchar(50) NOT NULL, ' .
							'mobilenumber varchar(100) NOT NULL, ' .
							'email varchar(50) NOT NULL, ' . 
							'password varchar(20) NOT NULL, ' . 	
							'birthday varchar(50) NOT NULL, ' . 							
							'status varchar(50) NOT NULL, ' . 	
							'education_place varchar(200) NOT NULL, ' . 	
							'work_place varchar(50) NOT NULL);'	
			);
			
			 $db->conn->query('CREATE TABLE settings(' . 
							'user_id INT, ' . 
							'language varchar(50) NOT NULL);'	
			);
			
		}
		if($hazyna_friends == 0){
			$db->conn->query('CREATE DATABASE hazyna_friends');
		}
		if($hazyna_messages == 0){
			$db->conn->query('CREATE DATABASE hazyna_messages');
		}
		if($hazyna_diaries == 0){
			$db->conn->query('CREATE DATABASE hazyna_diaries');
		}
		if($hazyna == 1 && $hazyna_friends == 1 && $hazyna_messages == 1 && $hazyna_diaries == 1){
			echo "You have already installed the HAZYNA!!!";
		}
	}
?>