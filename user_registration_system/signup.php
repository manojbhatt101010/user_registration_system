<?php 
	session_start();

	if(!isset($_SESSION["connection"])) {
		header("location: index.php");
		exit();
	}

	if(isset($_SESSION["username"])) {
		header("location: home.php");
		exit();
	} 
?>

<!DOCTYPE html>
<html>

<title>Signup</title>
<link rel = "stylesheet" href = "styles/signup.css">
<meta name="viewport" content = "width = device-width, initial-scale = 1.0">

<body>

	<h1>Welcome to Test Site</h1><hr>
	<h2><u>Create new account:</h2></u><hr><br>

	<p>
		<?php 
			if(isset($_SESSION["signup_errors"]))
				echo "Error! ".$_SESSION["signup_errors"];

			unset($_SESSION["signup_errors"]);
		?>
	</p>

	<form action = "signup_handler.php" method = "POST">

		<label for = "username">Username:</label><br>
		<input type = "text" name = "username" placeholder = "Enter a username" required><br>

		<label for = "name">Name:</label><br>
		<input type = "text" name = "name" placeholder = "Enter your name" required><br>

		<label for = "email">Email address:</label><br>
		<input type = "email" name = "email" placeholder = "Enter your email address" required><br>

		<label for = "phone">Phone number:</label><br>
		<input type = "text" name = "phone" placeholder = "Enter your phone number" required><br>

		<label for = "address">Address:</label><br>
		<input type = "text" name = "address" placeholder = "Enter your full address" required><br>

		<lable for = "password">Password:</lable><br>
		<input type = "password" name = "password"  placeholder = "Enter a password" required><br>

		<lable for = "confirm_password">Confirm password:</lable><br>
		<input type = "password" name = "confirm_password"  placeholder = "Confirm your password" required><br>

		<input type = "submit" value = "Sign Up">

	</form><br><br>

	<b id = "or">OR</b><br><br><br>

	<div>Already have have an account? <a id = "login" href = "login.php">Login</a><br><br>
	<hr id = "line"></div>

</body>
</html>