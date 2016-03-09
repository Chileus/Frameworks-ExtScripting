<?php

   require_once "db_connection.php";

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

    //$projectInfo = $userInfo->getProjectId($email,$_SESSION['userId']);

     $projectresult = $userInfo->getProjectUserId($_SESSION['userId']);

		while ($row = $projectresult->fetch_object()) {
			$arr[$i] = $row;
			$i++;
		}

		$json = json_encode($arr);
		echo $json;


    /*while($row = mysqli_fetch_assoc($projectInfo))
    $results[] = $row;
    $json = json_encode($results);
    echo $json;*/


?>
