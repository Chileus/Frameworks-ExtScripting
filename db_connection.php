<?php
$conn;

function getDBInfo($vo_class){

	require_once "db_connection_user.php";

	$servername = "localhost";
	$databasename = "db_frameworks-extscripting";

	$conn = mysqli_connect($servername,"root","",$databasename);

   switch ($vo_class) {
     case "user": return new user($conn);
     case "newsletter": return new NewsletterDAO($conn);
 	}
}


?>
