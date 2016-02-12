<?php
class db_conn{
			public $servername;
			public $username;
			public $databasename;
			public $password;
			private $conn;

			function __construct(){

        $this->servername = "localhost";
        $this->databasename = "db_frameworks-extscripting";

				$this->conn = mysqli_connect($this->servername,"root","",$this->databasename);
			}
			function excecuteQuery($queryString){
				return $this->conn->query($queryString);
			}
		}
 ?>
