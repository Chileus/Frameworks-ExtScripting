<?php

  $destination = $_SERVER['DOCUMENT_ROOT'];

  require_once "../shared/dbConnection/db_connection.php";

    session_start();

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$id = "$request->id";
    @$projectId = "$request->board";

    $userInfo = getDBInfo("task");
    $taskInfo = $userInfo->delete($id,$projectId);

    $i = 0;
    $arr = [];

		while ($row = $taskInfo->fetch_object()) {
			$arr[$i] = $row;
			$i++;
		}

		$json = json_encode($arr);
		echo $json;

?>
