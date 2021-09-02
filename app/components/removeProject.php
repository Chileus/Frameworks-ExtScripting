<?php

  $destination = $_SERVER['DOCUMENT_ROOT'];

  require_once "../shared/dbConnection/db_connection.php";

  session_start();

  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);

  $userInfo = getDBInfo("project");
  $userInfo->delete($request);

  $projectresult = $userInfo->getProjectUserId($_SESSION['userId']);

	header('Content-Type: application/json');
	$json = json_encode($projectresult);

  if($json){
    echo $json;
  }else{
    echo '[]';
  }


?>
