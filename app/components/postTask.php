<?php

  $destination = $_SERVER['DOCUMENT_ROOT'];

  require_once "../shared/dbConnection/db_connection.php";

    session_start();

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$email = "$request->email";
    @$board = "$request->board";
    @$state = "$request->state";
    @$description = "$request->description";
    @$date = "$request->date";

    $i = 0;
		$arr = [];

    $userInfo = getDBInfo("task");
    $taskInfo = $userInfo->insert($email,$description,$date, $board, $state);

		while ($row = $taskInfo->fetch_object()) {
			$arr[$i] = $row;
			$i++;
		}

		$json = json_encode($arr);
		echo $json;

?>
