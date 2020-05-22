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
		$email = correct($_POST["email"]);
		$name = correct($_POST["name"]);
		$phone = correct($_POST["phone"]);
		$address = correct($_POST["address"]);
		$password = correct($_POST["password"]);
		$confirm_password = correct($_POST["confirm_password"]);

		$connection = mysqli_connect("localhost", "root", "password", "user_registration_system");

		$check_existing = "select * from users where username = '$username' or email = '$email'";
		$result = mysqli_query($connection, $check_existing);
		$user = mysqli_fetch_assoc($result);

		if($user) {
			if($user["email"] == $email) {
				$_SESSION["login_errors"] = "This email is already in use. Please login.<br>";
				header("location: login.php");
				exit();
			}

			else if($user["username"] == $username) {
				$_SESSION["signup_errors"] = "Username not available. Please choose a different one.<br>";
				header("location: signup.php");
				exit();
			}
		}

		if(empty($name)) {
			$_SESSION["signup_errors"] = "Name is required.<br>";
			header("location: signup.php");
			exit();
		}

		if(!preg_match("/^[a-zA-Z ]*$/", $name)) {
			$_SESSION["signup_errors"] = "Name should contain only letters and white spaces.<br>";
			header("location: signup.php");
			exit();
		}

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION["signup_errors"] = "Wrong email format.<br>";
			header("location: signup.php");
			exit();
		}

		if(strlen($phone) != 10) {
			$_SESSION["signup_errors"] = "Phone number should contain 10 digits.<br>";
			header("location: signup.php");
			exit();
		}

		if(!is_numeric($phone)) {
			$_SESSION["signup_errors"] = "Enter a valid phone number.<br>";
			header("location: signup.php");
			exit();
		}

		if(strlen($password) < 6 || strlen($password) > 16) {
			$_SESSION["signup_errors"] = "Password length should be min 6 characters and maximum 16 characters.<br>";
			header("location: signup.php");
			exit();
		}

		if($password != $confirm_password) {
			$_SESSION["signup_errors"] = "Passwords do not match.<br>";
			header("location: signup.php");
			exit();
		}

		$insert_query = "insert into users (username, email, name, address, phone, password) values ('$username', '$email', '$name', '$address', '$phone', '$password')";

		if(mysqli_query($connection, $insert_query)) {
			$_SESSION["username"] = $username;
			$_SESSION["password"] = $password;
			header("location: home.php");
			exit();
		}

		else {
			$_SESSION["signup_errors"] = "Couldn't create account. Please try again.<br>";
			header("location: signup.php");
			exit();
		}
	}

	else
		header("location: signup.php");

	exit();

?>
