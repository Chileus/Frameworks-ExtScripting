<?php
        
		$servername = "localhost";
		$databasename= "frameworks/extscripting";

		// Create connection
		$conn=mysql_connect($servername,"root","");
		
		mysql_select_db($databasename);
		
		$user = "SELECT Naam FROM person WHERE PersonID=0";
	
		$userresult	= mysql_query($user,$conn);
		
		
		
        require_once "vo_person.inc.php";
        $person = new Person();
		
		while ($row = mysql_fetch_assoc($userresult)) {
			$person->firstName=$row['Naam'];
		}
        $person->lastName="doedel";
		
		echo json_encode($person);
 ?>
