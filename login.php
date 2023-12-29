<?php
    
    include("classes/autoload.php");

    $username = "";
    $password = "";

     if($_SERVER['REQUEST_METHOD'] == 'POST')
         {

          $login = new Login();
          $result = $login->evaluate($_POST);
          
          
          if($result != ""){

            echo "<div style='background-color: red; color:white; text-align:center; font-size: 12px; font-weight:bold'>";
            echo "The following errors occured!<br>";
            echo $result;
            echo "</div>";
        }

        else{

            header("Location: " . ROOT . "profile");
            die;
        }

   
          $username = $_POST['username'];
          $password = $_POST['password'];
   
   
        } 

       




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-style.css">
    <title>Login to Palsworld</title>
</head>
<body>
    <div class="login-container">
        <img src="logo.png" alt="Palsworld Logo" class="logo">

        <form id="loginForm" method="post">
            <label for="username">Username</label>
            <input value="<?php echo $username ?>" type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input value="<?php echo $password ?>" type="password" id="password" name="password" required>

            <div class="form-links">
                <button type="submit">Login</button>
                <a href="forgot-password.php" class="forgot-password-link">Forgot Password?</a>
            </div>
        </form>

        <p class="signup-link">Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>

    <script src=""></script>
</body>
</html>

