<?php

   $destination = $_SERVER['DOCUMENT_ROOT'];
   require_once "$destination/Frameworks-extscripting/app/shared/dbConnection/db_connection.php";

   session_start();


    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$email = "$request->email";
    @$pass = $request->pass;


    $userInfo = getDBInfo("user");
    if($userInfo->login($pass, $email)){

      $user_id = $userInfo->excecuteQuery("SELECT `UserID` FROM `users` WHERE Username = '$email' AND Password = '$pass'");

      $row = mysqli_fetch_assoc($user_id);
      $_SESSION['userId'] = $row['UserID'];
      echo $_SESSION['userId'];

    };

?>
