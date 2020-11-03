<?php
// Start the session
session_start();
include_once "dbh.php";
if($_SESSION["user"]===""){
	header("Location: http://localhost:4000/Desktop/php/index.php?You-are-not-logged-in");
}
?>
<?php
unset($_SESSION["cart"]);
header("Location:http://localhost:4000/Desktop/php/main.php");
?>