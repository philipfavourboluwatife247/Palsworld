<?php
    include("classes/connect.php");
    include("classes/signup.php");

    $username = "";
    $email = "";

     if($_SERVER['REQUEST_METHOD'] == 'POST')
         {

          $signup = new Signup();
          $result = $signup->evaluate($_POST);
          
          
          if($result != ""){

            echo "<div style='background-color: red; color:white; text-align:center; font-size: 12px; font-weight:bold'>";
            echo "The following errors occured!<br>";
            echo $result;
            echo "</div>";
        }

        else{

            header("Location: login.php");
            die;
        }

   
          $username = $_POST['username'];
          $email = $_POST['email'];
   
   
        } 

       




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup-style.css">
    <title>Sign Up for Palsworld</title>
</head>
<body>
    <div class="signup-container">
        <img src="logo.png" alt="Palsworld Logo" class="logo">

        <form id="signupForm" method="post" action="">
            <label for="username">Username</label>
            <input value="<?php echo $username ?>" type="text" id="username" name="username" required >

            <label for="email">Email</label>
            <input value="<?php echo $email ?>" type="email" id="email" name="email" required >

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required >

            <button type="submit">Sign Up</button>
        </form>

        <p class="or-divider">or</p>

        <button id="googleSignup" class="google-button">Sign Up with Google</button>

        <p class="login-link">Already have an account? <a href="login.php">Log in</a></p>
    </div>

    <script src=""></script>
</body>
</html>

