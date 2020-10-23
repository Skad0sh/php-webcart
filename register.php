<?php
// Start the session
session_start();
include_once "dbh.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<?php
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			echo "check1";
			$user = input_test($_POST["username"]);
			echo $user;
			$email = $_POST["email"];
			echo $email;
			$pass = input_test($_POST["password"]);
			echo $pass;

			$query = "INSERT INTO users (user,password) VALUES('$user','$pass');";
			mysqli_query($conn,$query);
			echo "Registered successfully";
		}
		function input_test($input){
			$input = trim($input);
			$input = stripslashes($input);
			$input = htmlspecialchars($input);
			return $input;
		}

	?>
	<h1 class="titles">Sign up to Webcart</h1>
	<div class="login-form">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<label for="username" class="labels">Username</label>
			<input type="text" name="username" id="username" class="textfield" required maxlength="50"><br><br>
			<label for="email" class="labels">Email ID</label>
			<input type="text" name="email" id="email" class="textfield" required maxlength="50"><br><br>
			<label for="password" class="labels">Password</label>
			<input type="password" name="password" id="password" class="textfield" required maxlength="30"><br><br>
			<label for="repassword" class="labels">Re-password</label>
			<input type="password" name="repassword" id="repassword" class="textfield" required maxlength="30"><br><br>
			<input type=submit value="Sign up" style="margin-left: 200px; width: 100px; height: 50px;"><br>

		</form>
	</div>

</body>
</html>