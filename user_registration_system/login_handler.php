<?php
	
	session_start();

	function correct($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = correct($_POST["username"]);
		$password = correct($_POST["password"]);

		$connection = mysqli_connect("localhost", "root", "password", "user_registration_system");

		$check_existing = "select * from users where (username = '$username' or email = '$username') and password = '$password'";

		$result = mysqli_query($connection, $check_existing);
		$user = mysqli_fetch_assoc($result);

		if($user) {
			$_SESSION["username"] = $username;
			$_SESSION["password"] = $password;
			header("location: home.php");
			exit();
		}

		else {
			$_SESSION["login_errors"] = "Wrong username/email address or password";
			header("location: login.php");
			exit();
		}
	}

	else
		header("location: signup.php");

	exit();

?>
