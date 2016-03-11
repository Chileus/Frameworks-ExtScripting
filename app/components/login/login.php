<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../../../assets/css/bootstrap.css">
  </head>
  <body>
    <div class="container">
    <h1>Login</h1>
      <form id="login" method="post">
        <div class="form-group">
          <label>Username:
              <input type="text" name="username" id="password" class="form-control" />
          </label><br />
          <label>Password: <input type="password" name="password" id="password" class="form-control" /></label><br />
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-default"/>
      </form>
    </div>
      <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if(empty($_POST['username']))
          {
              return false;
          }
          if(empty($_POST['password'])){
              return false;
          }


          $username = trim($_POST['username']);
          $password = trim($_POST['password']);

          $destination = $_SERVER['DOCUMENT_ROOT'];
          require_once "$destination/Frameworks-ExtScripting/app/shared/dbConnection/db_connection.php";

          $db_conn = getDBInfo('user');



          if(!checklogin($username,$password,$db_conn)){
            return false;
          };
          echo "Succes";

          $user_id = $db_conn->excecuteQuery("SELECT `UserID` FROM `users` WHERE Username = '$username'");
          $row = mysqli_fetch_assoc($user_id);

          session_start();

          $_SESSION['userId']=$row['UserID'];

          header('Location: ../../../index.html');
        }

        function checklogin($username,$password,$db_conn){

          $userResult	= $db_conn->login($username,$password);
          if($userResult->num_rows > 0){
            return true;
          }else{
            echo "Username or password is not correct";
            return false;
          }
        }


        ?>
  </body>
</html>
