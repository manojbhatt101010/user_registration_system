<?php 
	session_start();

	if(!isset($_SESSION["username"])) {
		header("location: signup.php");
		exit();
	} 
?>

<!DOCTYPE html>
<html>

<title>Home</title>
<link rel = "stylesheet" href = "styles/home.css">
<meta name="viewport" content = "width = device-width, initial-scale = 1.0">

<body>

	<h1>Test Site: Home</h1>
	<span id = "welcome">Welcome</span>
	<span id = "username"><?php echo " ".$_SESSION["username"]; ?></span>
	<br><br><hr><br>

	<h2>Change Password</h2><hr><br>

	<p id = "error">
		<?php
			if(isset($_SESSION["home_errors"]))
				echo "Error! ".$_SESSION["home_errors"];
			
			unset($_SESSION["home_errors"]);
		?>
	</p>
	<p id = "success">
		<?php
			if(isset($_SESSION["home_success"]))
				echo $_SESSION["home_success"];
			
			unset($_SESSION["home_success"]);
		?>
	</p>

	<form method = "POST" action = "change_password.php">

		<label for = "old_password">Current Password:</label><br>
		<input type = "password" name = "old_password" placeholder = "Enter your current password" required><br>

		<label for = "new_password">New Password:</label><br>
		<input type = "password" name = "new_password" placeholder = "Enter your new password" required><br>

		<label for = "confirm_password">Confirm new Password:</label><br>
		<input type = "password" name = "confirm_password" placeholder = "Confirm new password" required><br>

		<input type = "submit" value = "Change Password"><br><br>

	</form>

	<hr><br><br>
	<button onclick = "location.href = 'logout.php'">Logout</button>


</body>
</html>
