<?php

		session_start();

		$destination = $_SERVER['DOCUMENT_ROOT'];
  	require_once "../shared/dbConnection/db_connection.php";

		$i = 0;

		$arr = [];

		$db_conn = getDBInfo('project');

		$projectresult	= $db_conn->getProjectUserId($_SESSION['userId']);


		header('Content-Type: application/json');
		$json = json_encode($projectresult);
		echo $json;
 ?>
