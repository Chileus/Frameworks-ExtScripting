<?php
class project{
			private $conn;

			function __construct($conn){
				$this->conn = $conn;
			}
			function excecuteQuery($queryString){
				return $this->conn->query($queryString);
			}

			function user($id,$delete){
				if($id == 0 && $delete == false){
					$this->insert($name);
				}else if($delete == false){
					$this->update($id,$name,$password);
				}else{
					$this->delete($id);
				}
			}

			function insert($name){
				$this->excecuteQuery("INSERT INTO `users`(`Name`) VALUES ('$name')");
			}

			function update($id,$name,$password){
				$this->excecuteQuery("UPDATE `users` SET `Username`=$name,`Password`=$password WHERE UserID = $id");
			}

			function delete($id){
				$this->excecuteQuery("DELETE FROM `users` WHERE UserID = $id");
			}

			function selectById($id){
				return $this->excecuteQuery("SELECT Username, Password FROM users WHERE UserID = $id");
			}

			function login($name,$password){
				return $this->excecuteQuery("SELECT Username, Password FROM users WHERE Username = '$name' AND Password = '$password'");
			}

		}
 ?>
