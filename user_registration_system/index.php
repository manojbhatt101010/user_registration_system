<?php
	
	session_start();

	$connection = mysqli_connect("localhost", "root", "Cl0ver@mysql");

	if(!connection) 
		echo "Couldn't connect to database server.";

	else {
		$create_database_query = "create database if not exists user_registration_system";

		if(!mysqli_query($connection, $create_database_query)) 
			echo "Couldn't create database.";

		else {
			$create_table_query = "create table if not exists user_registration_system.users (
			username varchar(20) primary key,
			email varchar(50) unique,
			name varchar(30),
			address varchar(100),
			phone varchar(10),
			password varchar(16))";

			if(!mysqli_query($connection, $create_table_query)) 
				echo "Couldn't create table.";

			else {
				$_SESSION["connection"] = true;
				header("location: signup.php");
				exit();
			}
		}
	}

?>