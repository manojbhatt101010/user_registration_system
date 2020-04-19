<?php
	session_start();
	
	$connection = mysqli_connect("localhost", "root", "Cl0ver@mysql", "user_registration_system");

	if($connection) {
		echo "connected";

	}

	else {
		echo "not connected";
	}

	$username = "maNoJbhatt101010@gmail.COM   ";
	$email =  "maNoJbhatt10101@gmail.COM   ";
	$password = "locall";

		$check_existing = "select * from users where (username = '$username' or email = '$email') and password = '$password'";

		$result = mysqli_query($connection, $check_existing);
		$user = mysqli_fetch_assoc($result);

		if($user) {
			$_SESSION["username"] = $username;
			header("location: home.php");
			exit();
		}

		else {
			$_SESSION["login_errors"] = "Wrong username/email address or password";
			header("location: login.php");
			exit();
		}
?>