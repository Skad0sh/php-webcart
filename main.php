<?php
// Start the session
session_start();
include_once "dbh.php";
if($_SESSION["user"]==""){
	header("Location: http://localhost:4000/Desktop/php/index.php?You-are-not-logged-in");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP WebCart</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<h1 class = "titles">Welcome to WebCart, <?php echo $_SESSION["user"]; ?> </h1>

	<?php
		$query = "SELECT*FROM products;";
		$resultSet = mysqli_query($conn,$query);
		while($row = mysqli_fetch_assoc($resultSet)){
			$image = $row["proLink"];
			$name = $row["proName"];
			$price = $row["proPrice"];
			echo "<div>";
			echo "<table>";
			echo "<tr>";
			echo "<td><img src=".$image."></td>";
			echo "<td><p style='font-size:40px'>".$name."</p><br></td><br>";
			echo "</tr>";
			echo "</table>";
			echo "</div>";
		}
	?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
		<select id="qty1" name="qty1">
			<option value='1'>1</option>
			<option value='2'>2</option>
			<option value='3'>3</option>
			<option value='4'>4</option>
			<option value='5'>5</option>
		</select>
		<label class="labels" name="add2cart1">Add to cart</label>
		<input type="checkbox" name="item1" id="item1" value="Add to cart" for="add2cart1">
	</form>
</body>
</html>
