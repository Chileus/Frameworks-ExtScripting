<?php
        
		require_once "vo_person.inc.php";
		require_once "db_connection.php";
		
		$servername = "localhost";
		$databasename= "db_frameworks-extscripting";
		
		$i = 0;
		
		$arr = [];
		
		$db_conn = new db_conn($servername,$databasename);
	
		$userresult	= $db_conn->excecuteQuery("SELECT Username, Password FROM users");
		
        $person = new Person();
		$person->firstName = "noud";
		$person->password = "admin";
		
		while ($row = $userresult->fetch_object()) {
			$arr[$i] = $row;
			$i++;
		}
		
		/*while ($row = $userresult->fetch_object()) {
			$arr[$i] = $row;
			printf("%s (%s)\n",$arr[$i]->Username,$arr[$i]->Password);
			$i++;
		}*/
		
		header('Content-Type: application/json');
		$json = json_encode($arr);
		echo $json;
 ?>
