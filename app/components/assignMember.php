<?php

$destination = $_SERVER['DOCUMENT_ROOT'];
require_once "../shared/dbConnection/db_connection.php";

  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);
  @$name = "$request->name";
  @$id = "$request->id";
  @$board = "$request->board";

  $userInfo = getDBInfo("project");

  $taskInfo = $userInfo->assignMember($name,$id,$board);

  $i = 0;
  $arr = [];

  while ($row = $taskInfo->fetch_object()) {
    $arr[$i] = $row;
    $i++;
  }

  $json = json_encode($arr);
  echo $json;

?>
