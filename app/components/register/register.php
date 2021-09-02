<?php

   $destination = $_SERVER['DOCUMENT_ROOT'];
   require_once "$destination/Frameworks-extscripting/app/shared/dbConnection/db_connection.php";

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$email = $request->email;
    @$pass = $request->pass;

    $userInfo = getDBInfo("user");

    $user_id = $userInfo->insert($email,$pass);

    echo $email;

?>
