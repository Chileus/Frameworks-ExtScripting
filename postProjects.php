<?php

   require_once "db_connection.php";

    session_start();

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$email = "$request->email";
    //echo $_SESSION['userId'];

    $userInfo = getDBInfo("project");
    if($userInfo->insert($email, $_SESSION['userId'])){
      header('Location: test.html');
    };

    $projectInfo = $userInfo->getProjectId($_SESSION['userId']);
    $json = json_encode($projectInfo);
    echo $projectInfo->num_rows;


?>
