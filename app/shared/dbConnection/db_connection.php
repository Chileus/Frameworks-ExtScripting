<?php

function getDBInfo($vo_class){

	require_once "db_connection_user.php";
	require_once "db_connection_project.php";
	require_once "db_connection_task.php";

	$servername = "localhost";
	$databasename = "db_frameworks-extscripting";

	$conn = mysqli_connect($servername,"root","",$databasename);

	/*$servername = "localhost";
	$username = "331218";
	$password = "aPs2KXZ6";
	$dbname = "331218_frameworks_extscripting";*/

	//$conn = mysqli_connect($servername,$username,$password,$dbname);

   switch ($vo_class) {
     case "user": return new user($conn);
     case "project": return new project($conn);
		 case "task": return new task($conn);
 	}
}

?>
