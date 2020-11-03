<?php
// Start the session
session_start();
include_once "dbh.php";
if($_SESSION["admin"]!=="True"){
	die("You are not an Admin!");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin CP</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<h1 class = "titles">Welcome to the WebCart Admin CP , <?php echo $_SESSION["user"]; ?></h1>
	<?php
		$errorLabel = "";
		$errorLabel2 = "";
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			$product = input_test($_POST["proName"]);
			$price = input_test($_POST["proPrice"]);
			$link = $_POST["proLink"];
			$adminName = input_test($_POST["adminName"]);
			if(empty($product)){
				$errorLabel = "Product Name cannot be empty!";
			}else if(empty($price)){
				$errorLabel = "Product price cannot be empty!";
			}else{
				$query = "INSERT INTO products(proName,proPrice,proLink) VALUES('$product','$price','$link');";
				$stat = mysqli_query($conn,$query);
				if($stat){
					$errorLabel = "Successfuly Added new product to database!";
				}else{
					$errorLabel = "Error adding new product to database!";
				}
			}
			if(empty($adminName)){
				$errorLabel2 = "";
			}else{
				$query = "UPDATE users SET admin='True' WHERE user='$adminName';";
				$stat = mysqli_query($conn,$query);
				if($stat){
					$errorLabel2 = "Successfuly Added ".$adminName." as an Admin!";
				}else{
					$errorLabel2 = "Error adding".$adminName." as an Admin!";
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
	<div class="login-form">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
		<label for="proName" class="labels">Product Name: </label>
		<input type="text" name="proName" id="proName" class="textfield" maxlength="50" required><br><br>
		<label for="proPrice" class="labels">Product Price: </label>
		<input type="text" name="proPrice" id="proPrice" class="textfield" maxlength="50" required><br><br>
		<label for="proLink" class="labels">Product Image: </label>
		<input type="text" name="proLink" id="proLink" class="textfield" maxlength="500" required><br><br>
		<span class="error" style="margin-left: 120px;"><?php echo $errorLabel;?></span><br><br>
		<input type="submit" value="Add Product" style="margin-left: 200px; width: 100px; height: 50px;">
	</form>
	</div>
	<h3>Add new Admin</h3>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
			<label for="adminName" class="labels">Username: </label>
			<input type="text" name="adminName" id="adminName" class="textfield" maxlength="50" required>
			<input type="submit" value="Make user Admin"><br>
			<span class="error" style="margin-left: 120px;"><?php echo $errorLabel2;?></span>
	</form>
</body>
</html>
