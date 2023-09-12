<?php
    
    session_start();
    
    if(isset($_SESSION['id'])){
       
        header("location: welcome.php");
        exit;
    }
 
   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "users";

    
    $conn = new mysqli($servername, $username, $password, $db_name);

    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login system</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div id="main">
    <div id="header">
      <h1>User Login</h1>
    </div>
    <div id="content">
      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <div class="form-group">
          <label>Username</label>
          <input  type="text" name="username" autocomplete="off" />
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" />
        </div>
        <input type="submit" class="btn" name="login" id="submit" value="Submit" />
        <p>click to register <a href="register.php">Register</a>.</p>
      
      </form>



      <?php
        if(isset($_POST['login'])){

          if(!isset($_POST['username']) || $_POST['username'] == ''){

            echo '<div class="message error">Please Fill All The Fields.</div>';

          }
          else if(!isset($_POST['password']) || $_POST['password'] == ''){

            echo '<div class="message error">Please Fill All The Fields.</div>';
          }
          else{
            $username = $_POST["username"];
            $password = $_POST["password"];

            $sql = "Select * FROM users WHERE username='$username' AND password='$password'";
          
            $result=$conn->query($sql);

            if($result->num_rows>0){ 
              while($row = $result->fetch_assoc()){
              session_start();
              
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;                            
              
              header("location: welcome.php");              
            }
          }else{
                echo "<div class='message error'>Email and Password Not Matched.</div>";
            }
          }
        }
                       
        $conn->close();
      ?>
    </div>
  </div>
</body>
</html>
