<?php
// Start the session
session_start();
session_destroy();
session_start();
include_once "dbh.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Test PHP</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>

	<?php
		$errorLabel = "";
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$user = input_test($_POST["username"]);
			$pass = input_test($_POST["password"]);

			$query = "SELECT * FROM users;";
			$resultSet = mysqli_query($conn,$query);
			if(empty($user) or empty($pass)){
				$errorLabel = "Username or Password field is empty";
			}
			else{
				while($row = mysqli_fetch_assoc($resultSet)){
					if($user == $row["user"] && $pass == $row["password"]){
						header("Location: http://localhost:4000/Desktop/php/main.php");
						$_SESSION["user"] = $user;
						$_SESSION["admin"] = $row["admin"];
					}
					else{
						$errorLabel = "Password or username is incorrect,pls try again";
					}		
				}				
			}
		}
		function input_test($input){
			$input = trim($input);
			$input = stripslashes($input);
			$input = htmlspecialchars($input);
			return $input;
		}

	?>


	<div class="header-div">
	<h3 style="text-align: left;margin-left: 100px;"><?php echo date("d/m/Y, l"); ?></h3>
	<h1 class="titles">Sign in to WebCart</h1>
	</div>
	<div class="login-form">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<label for="username" class="labels">Username</label>
			<input type="text" name="username" id="username" class="textfield" maxlength="50">
			<br><br>
			<label for="password" class="labels">Password</label>
			<input type="password" name="password" id="password" class="textfield" maxlength="30"><br><br>
			<span class="error" style="margin-left: 120px;"><?php echo $errorLabel;?></span><br><br>
			<input type="submit" value="Sign in" style="margin-left: 200px; width: 100px; height: 50px;"><br><br><br>
		</form>
	</div>
	<a href="http://localhost:4000/Desktop/php/register.php">Don't have an account? Sign in</a>

	
</body>
<html>

