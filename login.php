<html>
  <head>
  </head>
  <body>
    <h1>Login</h1>
      <form id="login" method="post">
        <label>Username: <input type="text" name="username" id="password" /></label><br />
        <label>Password: <input type="password" name="password" id="password" /></label><br />
        <input type="submit" name="submit" value="Submit" />
      </form>
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

          require_once "db_connection.php";

          if(!checklogin($username,$password)){
            return false;
          };
          echo "Succes";

          session_start();
          $_SESSION['username']=$username;
          header('Location: index.php');
        }

        function checklogin($username,$password){

          $db_conn = getDBInfo('user');

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
