<?php
// Start the session
session_start();
include_once "dbh.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Test PHP Advanced</title>
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<?php

		echo "<h1>FFFFFFFFFFFFFFFFFF it worked, Welcome ".$_SESSION["user"]."</h1>";
		echo session_id()."<br>";
		$query = "SELECT * FROM users;";
		$resultSet = mysqli_query($conn,$query);
		$resultCheck = mysqli_num_rows($resultSet);
		if($resultCheck>0){
			while($row = mysqli_fetch_assoc($resultSet)){
				echo $row["user"]."<br>";
				echo $row["password"];
			}
		}
		else{
			echo "resultSet is Empty";
		}
		#$myfile = fopen("test.txt","w") or die("Unable to open file!");
		#$txt = "Mickey Mouse\n";
		#fwrite($myfile, $txt);
		#echo fread($myfile,filesize("test.txt"));
		#$txt = "Minnie Mouse\n";
		#fwrite($myfile, $txt);
		#echo fread($myfile,filesize("test.txt"));
		#fclose($myfile);
		
	?>
</body>
</html>