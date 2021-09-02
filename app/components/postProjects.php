<?php

  $destination = $_SERVER['DOCUMENT_ROOT'];

  require_once "../shared/dbConnection/db_connection.php";

    session_start();

    $postdata = file_get_contents("php://input");

    $userInfo = getDBInfo("project");
    $userInfo->insert($postdata, $_SESSION['userId']);

    $projectresult = $userInfo->getProjectUserId($_SESSION['userId']);

		$json = json_encode($projectresult);
		echo $json;

?>
