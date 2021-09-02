<?php

  $destination = $_SERVER['DOCUMENT_ROOT'];

  require_once "../shared/dbConnection/db_connection.php";

  $i = 0;

  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);

  $userInfo = getDBInfo("project");
  $projectresult = $userInfo->getProjectInfo($request);

  $json = json_encode($projectresult);
  echo $json;



?>
