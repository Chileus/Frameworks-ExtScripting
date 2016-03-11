<?php

  $destination = $_SERVER['DOCUMENT_ROOT'];

  require_once "$destination/Frameworks-ExtScripting/app/shared/dbConnection/db_connection.php";

    session_start();

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$email = "$request->email";

    $i = 0;
		$arr = [];

    $userInfo = getDBInfo("project");
    if($userInfo->insert($email, $_SESSION['userId'])){
      header('Location: test.html');
    };

    $projectresult = $userInfo->getProjectUserId($_SESSION['userId']);

		while ($row = $projectresult->fetch_object()) {
			$arr[$i] = $row;
			$i++;
		}

		$json = json_encode($arr);
		echo $json;

?>
