<?php

	session_start();

	function correct($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$password = $_SESSION["password"];
		$old_password = correct($_POST["old_password"]);
		$new_password = correct($_POST["new_password"]);
		$confirm_password = correct($_POST["confirm_password"]);
		$username = $_SESSION["username"];

		if($password != $old_password) {
			$_SESSION["home_errors"] = "Wrong password.<br>";
			header("location: home.php");
			exit();
		}

		if(strlen($new_password) < 6 || strlen($new_password) > 16) {
			$_SESSION["home_errors"] = "Password length should be min 6 characters and maximum 16 characters.<br>";
			header("location: home.php");
			exit();
		}

		if($new_password != $confirm_password) {
			$_SESSION["home_errors"] = "Passwords do not match.<br>";
			header("location: home.php");
			exit();
		}

		$connection = mysqli_connect("localhost", "root", "Cl0ver@mysql", "user_registration_system");

		$change_password_query = "update users set password = '$new_password' where username = '$username'";

		if(mysqli_query($connection, $change_password_query)) {
			$_SESSION["home_success"] = "Password changed successfully.<br>";
			$_SESSION["password"] = $new_password;
			header("location: home.php");
			exit();
		}

		else {
			$_SESSION["home_errors"] = "Couldn't change password. Please try again.<br>";
			header("location: home.php");
			exit();
		}
	}

?>