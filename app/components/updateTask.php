<?php

  $destination = $_SERVER['DOCUMENT_ROOT'];

require_once "../shared/dbConnection/db_connection.php";

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$id = "$request->id";
    @$board = "$request->board";

    echo $board;

    $i = 0;
		$arr = [];

    $userInfo = getDBInfo("task");
    $userInfo->update($id, $board);
?>
