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

			function sort($temp){
					$i = 0;
					$arr = [];

					while ($row = $temp->fetch_object()) {
						$arr[$i] = $row;
						$i++;
					}
					return $arr;
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
				$this->excecuteQuery("INSERT INTO `projects-users`(`ProjectID`, `UserID` ,`Admin`) VALUES (LAST_INSERT_ID(), '$userId', 1)");
			}

			function update($id,$name,$password){
				$this->excecuteQuery("UPDATE `users` SET `Username`=$name,`Password`=$password WHERE UserID = $id");
			}

			function delete($id){
				$this->excecuteQuery("DELETE FROM `projects` WHERE ProjectID = $id");
				$this->excecuteQuery("DELETE FROM `projects-users` WHERE ProjectID = $id");
				$this->excecuteQuery("DELETE FROM `tasks` WHERE ProjectID = $id");
			}

			function selectByName($name){
				return $this->excecuteQuery("SELECT ProjectID FROM users WHERE Name = $name");
			}

			function login($name,$password){
				return $this->excecuteQuery("SELECT Username, Password FROM users WHERE Username = '$name' AND Password = '$password'");
			}
			function getProjectUserId($userId){
				$temp = $this->excecuteQuery("SELECT `ProjectID` FROM `projects-users` WHERE UserID = '$userId'");
				return $this->sort($this->excecuteQuery("SELECT * FROM `projects` INNER JOIN `projects-users` ON
																		`projects`.`ProjectID` = `projects-users`.`ProjectID` WHERE `projects-users`.`UserID` = '$userId'"));
			}
			function getProjectId($email){
				return $this->excecuteQuery("SELECT `ProjectID` FROM `projects` WHERE `Name` = '$email' ORDER BY `ProjectID` DESC LIMIT 1");
			}
			function getProjectInfo($projectId){
				//return $this->excecuteQuery("SELECT * FROM `projects` WHERE `ProjectID` = '$projectId'");
				return $this->sort($this->excecuteQuery("SELECT * FROM `projects` INNER JOIN `tasks` ON
																		`projects`.`ProjectID` = `tasks`.`ProjectID` WHERE `projects`.`ProjectID` = '$projectId'"));
			}
			function assignMember($name, $id, $board){
				$this->excecuteQuery("UPDATE `tasks` SET `UserID`= '$name' WHERE TasksID = '$id'" );
				return $this->excecuteQuery("SELECT * FROM `tasks` WHERE ProjectID='$board'");
			}
			function addMembers($memberName,$boardId){
				$temp = $this->excecuteQuery("SELECT `UserID` FROM `users` WHERE `Username` = '$memberName'");
				$row = mysqli_fetch_assoc($temp);
				$temp = $row['UserID'];
				//return $this->excecuteQuery("INSERT INTO `projects-users`(`UserID,`ProjectID`) VALUES ('$temp', '$boardId')");
				$this->excecuteQuery("INSERT INTO `projects-users`(`ProjectID`, `UserID`, `Admin`) VALUES ('$boardId', '$temp' , 0)");
			}
			function removeMembers($memberName,$boardId){
				$temp = $this->excecuteQuery("SELECT `UserID` FROM `users` WHERE `Username` = '$memberName'");
				$row = mysqli_fetch_assoc($temp);
				$temp = $row['UserID'];
				//return $this->excecuteQuery("INSERT INTO `projects-users`(`UserID,`ProjectID`) VALUES ('$temp', '$boardId')");
				//$this->excecuteQuery("SELECT `Admin` FROM `projects-users` WHERE `UserID` = '$temp' AND `ProjectID` = '$boardId'");
					$this->excecuteQuery("DELETE FROM `projects-users` WHERE UserID = '$temp'");
			}
			function leave($id,$userid){
				$this->excecuteQuery("DELETE FROM `projects-users` WHERE ProjectID = $id AND UserID = $userid");
			}
		}
 ?>
