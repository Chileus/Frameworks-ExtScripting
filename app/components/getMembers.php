<?php

  $destination = $_SERVER['DOCUMENT_ROOT'];

  require_once "../shared/dbConnection/db_connection.php";

  session_start();

  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);

  $userInfo = getDBInfo("user");

  $projectresult = $userInfo->getMembers($request);
  $admin = $userInfo->checkAdmin($_SESSION['userId'],$request);

  $i = 0;
  $arr = array();

  while ($row = $projectresult->fetch_object()) {
    $arr[$i] = $row;
    $i++;
  }
  //$arr[$i+1] = $admin;
  $json = json_encode($arr);

  echo $json;

?>
