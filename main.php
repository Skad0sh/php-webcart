<?php
// Start the session
session_start();
include_once "dbh.php";
if($_SESSION["user"]===""){
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
	<div style="margin-left: 400px;margin-right: 400px;">
	<h1 class = "titles">Welcome to WebCart, <?php echo $_SESSION["user"]; ?> </h1>
	</div>
	<div style="margin-left: 400px;margin-right: 400px;">
	<button class="nav-button" onclick="window.location.assign('http://localhost:4000/Desktop/php/cart.php')">Buy Cart🛒</button>
	<button class="nav-button" onclick="window.location.assign('http://localhost:4000/Desktop/php/admin.php')">Admin CP</button>
	<button class="nav-button" onclick="window.location.assign('http://localhost:4000/Desktop/php/')">Logout</button>
</div>
	<hr>

	<?php
		$query = "SELECT*FROM products;";
		$resultSet = mysqli_query($conn,$query);
		if(!isset($cartList)){
			$cartList=array();
			#echo "check1";
		}
	?>
		<form method = "POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="proForm">
	<?php
		while($row = mysqli_fetch_assoc($resultSet)){
			$image = $row["proLink"];
			$name = $row["proName"];
			$price = $row["proPrice"];
			$sn = $row["Sn"];
			echo "<div>";
			echo "<table style='border-spacing: 30px;'>";
			echo "<tr>";
			echo "<td><img src=".$image."></td>";
			echo "<td><p style='font-size:40px'>".$name."</p><br><p style='font-size:20px'>Price: ".$price."</p></td>";
			echo "<td><br><br><button class='cart-button' name='add-to-cart' type='submit' form='proForm' value=".$sn.">Add to cart🛒</button></td>";
			echo "</tr>";
			echo "</table>";
			echo "</div>";
		}
		echo "</form>";
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			$query = "SELECT*FROM products;";
			$resultSet = mysqli_query($conn,$query);
			#echo $_POST["Sn"];
			while($row = mysqli_fetch_assoc($resultSet)){
				if($row["Sn"] == $_POST["add-to-cart"]){
					#$cartList[count($cartList)] = $row["proName"];
					if(isset($_SESSION["cart"])){
						$proID = array_column($_SESSION["cart"],"id");
						if(!in_array($_POST["add-to-cart"],$proID)){
							$count = count($_SESSION["cart"]);
							$cartList = array(
							"id" => $row["Sn"],
							"product" => $row["proName"],
							"price" => $row["proPrice"]
							);
							$_SESSION["cart"][$count] = $cartList;
						}
						else{
							echo "<script>alert('Item is already in the cart!')</script>";
						}
					}
					else{
						$cartList = array(
							"id" => $row["Sn"],
							"product" => $row["proName"],
							"price" => $row["proPrice"]
						);
						$_SESSION["cart"][0] = $cartList;

					}

				}
			}
		}
	?>
</body>
</html>
