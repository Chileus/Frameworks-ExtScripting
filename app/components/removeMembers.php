<?php

  $destination = $_SERVER['DOCUMENT_ROOT'];

  require_once "../shared/dbConnection/db_connection.php";

  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);
  @$name = "$request->name";
  @$board = "$request->board";

  $userInfo = getDBInfo("project");

  $userInfo->removeMembers($name,$board);

  $userInfo = getDBInfo("user");

  $projectresult = $userInfo->getMembers($board);

  $i = 0;
  $arr = array();

  while ($row = $projectresult->fetch_object()) {
    $arr[$i] = $row;
    $i++;
  }

  $json = json_encode($arr);
  echo $json;

?>
