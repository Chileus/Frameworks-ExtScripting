<?php
class user{
			private $conn;

			function __construct($conn){
				$this->conn = $conn;
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

			function selectById($id){
				return $this->excecuteQuery("SELECT Username, Password FROM users WHERE UserID = $id");
			}

			function login($name,$password){
				return $this->excecuteQuery("SELECT Username, Password FROM users WHERE Username = '$name' AND Password = '$password'");
			}
			function getMembers($ProjectId){
				return $this->excecuteQuery("SELECT david.Username, noud.Admin FROM users as david, `projects-users` as noud WHERE noud.ProjectID = '$ProjectId' AND david.UserID = noud.UserID ");
			}
			function checkAdmin($UserId,$ProjectId){
				return $this->excecuteQuery("SELECT * FROM `projects-users` WHERE UserID = '$UserId' AND ProjectID = $ProjectId");
			}

		}
 ?>
