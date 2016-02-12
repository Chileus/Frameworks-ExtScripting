<?php
        class db_conn{
			public $servername;
			public $username;
			public $databasename;
			public $password;
			private $conn;
			
			function __construct($servername,$databasename){
				$this->conn = mysqli_connect($servername,"root","",$databasename);
			}
			function excecuteQuery($queryString){
				return $this->conn->query($queryString);
			}
		}
 ?>
