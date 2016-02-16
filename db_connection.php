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

			function user($id,$delete){
				if($id == 0 && $delete == false){
					$this->insert($name,$password);
				}else if($delete == false){
					$this->update($id,$name,$password);
				}else{
					$this->delete($id);
				}
			}

			function insert($name,$password){
				$this->excecuteQuery("INSERT INTO `users`(`Username`, `Password`) VALUES ('$name','$password')");
			}

			function update($id,$name,$password){
				$this->excecuteQuery("UPDATE `users` SET `Username`=$name,`Password`=$password WHERE UserID = $id");
			}

			function delete($id){
				$this->excecuteQuery("DELETE FROM `users` WHERE UserID = $id");
			}

			function SelectById($id){
				return $this->excecuteQuery("SELECT Username, Password FROM users WHERE UserID = $id");
			}

			function Login($name,$password){
				return $this->excecuteQuery("SELECT Username, Password FROM users WHERE Username = '$name' AND Password = '$password'");
			}

		}
 ?>
