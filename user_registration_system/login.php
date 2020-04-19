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

<title>Login</title>
<link rel = "stylesheet" href = "styles/login.css">
<meta name="viewport" content = "width = device-width, initial-scale = 1.0">

<body>

	<br><b id = "login">Login</b><br><br><hr id = "line1"><br>
	<img src = "styles/login_image.jpg" alt = "login image">

	<p>
		<?php 
			if(isset($_SESSION["login_errors"]))
				echo "Error! ".$_SESSION["login_errors"];

			unset($_SESSION["login_errors"]);
		?>
	</p>

	<form method = "POST" action = "login_handler.php">

		<label for = "username">Username or Email</label><br>
		<input type = "text" name = "username" placeholder = "Enter your username or email address" required><br>

		<label for = "password">Password</label><br>
		<input type = "password" name = "password" placeholder = "Enter your password" required><br>

		<input type = "submit" value = "Login">

	</form><br>

	<b id = "or">OR</b><br><br><br>
	Don't have have an account? <a id = "signup" href = "signup.php">Signup</a><br><br>
	<hr id = "line2">

</body>
</html>