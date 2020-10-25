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
		$errorLabel = "";
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			$user = input_test($_POST["username"]);
			$pass = input_test($_POST["password"]);
			$repass = input_test($_POST["repassword"]);

			$query = "SELECT*FROM users;";
			$results = mysqli_query($conn,$query);
			$duplicate = 0;
			while($row = mysqli_fetch_assoc($results)){
				if($row["user"]==$user){
					$duplicate = 1;
				}
			}
			if($duplicate == 1){
				$errorLabel = "Account with this name already exists!";
			}
			elseif($pass!=$repass){
				$errorLabel = "Password's does not match!";
			}
			else{
				$query = "INSERT INTO users (user,password) VALUES('$user','$pass');";
				mysqli_query($conn,$query);
				$errorLabel = "Account successfuly created!";
			}

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
			<label for="password" class="labels">Password</label>
			<input type="password" name="password" id="password" class="textfield" required maxlength="30"><br><br>
			<label for="repassword" class="labels">Re-password</label>
			<input type="password" name="repassword" id="repassword" class="textfield" required maxlength="30"><br><br>
			<span class="error" style="margin-left: 120px;"><?php echo $errorLabel;?></span><br><br>
			<input type=submit value="Sign up" style="margin-left: 200px; width: 100px; height: 50px;"><br>
		</form>
	</div>
	<button><a href="http://localhost:4000/Desktop/php/">Go back to Login</a></button>

</body>
</html>
