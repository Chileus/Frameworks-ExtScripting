<?php
class project{
			private $conn;

			function __construct($conn){
				$this->conn = $conn;
			}

			function excecuteQuery($queryString){
				$temp = $this->conn->query($queryString);
				if (!$temp) {
  				die($this->conn->error);
				}else{
					return $temp;
				}
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

			function insert($name,$userId){
				$this->excecuteQuery("INSERT INTO `projects`(`Name`) VALUES ('$name')");
				$this->excecuteQuery("INSERT INTO `projects-users`(`ProjectID`) SELECT `ProjectID` FROM `projects` WHERE Name='$name'");
				$temp = $this->excecuteQuery("SELECT `ProjectID` FROM `projects` WHERE Name='$name'");
				$row = mysqli_fetch_assoc($temp);
				$projectId = $row['ProjectID'];

				$this->excecuteQuery("UPDATE `projects-users` SET `UserID`='$userId' WHERE ProjectID='$projectId'");
			}

			function update($id,$name,$password){
				$this->excecuteQuery("UPDATE `users` SET `Username`=$name,`Password`=$password WHERE UserID = $id");
			}

			function delete($id){
				$this->excecuteQuery("DELETE FROM `users` WHERE UserID = $id");
			}

			function selectByName($name){
				return $this->excecuteQuery("SELECT ProjectID FROM users WHERE Name = $name");
			}

			function login($name,$password){
				return $this->excecuteQuery("SELECT Username, Password FROM users WHERE Username = '$name' AND Password = '$password'");
			}
			function getProjectUserId($userId){
				$temp = $this->excecuteQuery("SELECT `ProjectID` FROM `projects-users` WHERE UserID = '$userId'");
				return $this->excecuteQuery("SELECT * FROM `projects` INNER JOIN `projects-users` ON
																		`projects`.`ProjectID` = `projects-users`.`ProjectID` WHERE `projects-users`.`UserID` = '$userId'");
			}
			function getProjectId($email){
				return $this->excecuteQuery("SELECT `ProjectID` FROM `projects` WHERE `Name` = '$email' ORDER BY `ProjectID` DESC LIMIT 1");
			}
		}
 ?>
