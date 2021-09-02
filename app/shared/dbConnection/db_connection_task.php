<?php
class task{
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

		function insert($name,$description,$date,$projectId, $state){
			$this->excecuteQuery("INSERT INTO `tasks`(`Name`, `Text`, `Date` ,ProjectID, Importance) VALUES ('$name','$description' ,'$date','$projectId', '$state')");
			return $this->excecuteQuery("SELECT * FROM `tasks` WHERE ProjectID='$projectId'");
		}
		function update($id,$board){
			$this->excecuteQuery("UPDATE `tasks` SET Importance='$board' WHERE TasksID='$id'");
		}
		function delete($id,$projectId){
			$this->excecuteQuery("DELETE FROM `tasks` WHERE TasksID = '$id' AND ProjectID='$projectId'");
			return $this->excecuteQuery("SELECT * FROM `tasks` WHERE ProjectID='$projectId'");
		}
	}
 ?>
