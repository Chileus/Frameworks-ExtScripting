<?php
        
		$servername = "localhost";
		$databasename= "db_frameworks-extscripting";

		// Create connection
		$conn=mysql_connect($servername,"root","");
		
		mysql_select_db($databasename);
		
		$user = "SELECT UserName, UserPass FROM users";
	
		$userresult	= mysql_query($user,$conn);
		
		
        require_once "vo_person.inc.php";
        $person = new Person();
		
		while ($row = mysql_fetch_assoc($userresult)) {
			$person->firstName=$row['UserName'];
		}
        $person->lastName="doedel";
		
		header('Content-Type: application/json');
		$json = json_encode($person);
		echo $json;
 ?>
