<?php

		session_start();

		require_once "vo_person.inc.php";
		require_once "db_connection.php";

		$i = 0;

		$arr = [];

		$db_conn = getDBInfo('project');


		$projectresult	= $db_conn->getProjectUserId($_SESSION['userId']);

		while ($row = $projectresult->fetch_object()) {
			$arr[$i] = $row;
			$i++;
		}

		header('Content-Type: application/json');
		$json = json_encode($arr);
		echo $json;
 ?>
