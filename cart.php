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
		<title>Purchase Cart</title>
		<link href="style.css" rel="stylesheet">
	</head>
	<body>
		<h1 class="titles">Here is your cart, <?php echo $_SESSION["user"]; ?></h1>
		<table style="border:3px solid black;border-collapse: collapse;text-align: center;margin-left: auto;margin-right: auto;">
			<tr>
				<th style="border:3px solid black;border-collapse: collapse;">
				Product ID
				</th>
				<th style="border:3px solid black;border-collapse: collapse;">
				Product Name
				</th>
				<th style="border:3px solid black;border-collapse: collapse;">
				Product Price
				</th>
			</tr>
			<?php
			$totalPrice = 0;
			foreach($_SESSION["cart"] as $key => $value){
				echo "<tr>";
			foreach($value as $name => $val){
				#echo "key=".$name." value=".$val."<br>";
				$totalPrice = $totalPrice + $value["price"];
				echo "<td style='border:3px solid black;border-collapse: collapse;'>".$val."</td>";

			}
			echo "</tr>";
			}	
			#echo count($_SESSION["cart"]);
			?>
			<tr>
				<th>Total</th>
				<td><?php echo $totalPrice/3; ?></td>
				<td></td>
			</tr>
		</table>
		<br><br>
		<button style="width:200px;height:40px;margin-left: 650px;margin-right: 500px;" onclick="cartDestroy()">Purchase cart!</button>
		<script type="text/javascript">
			function cartDestroy(){
				alert("Thank you for shopping with us <3. Your products will be shipped shortly");
				window.location.assign("http://localhost:4000/Desktop/php/delcart.php");

			}
		</script>
	</body>
<html>