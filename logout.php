<?php

session_start();

$_SESSION['palsworld_userid']=NULL; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="logout-style.css">
    <title>Logout - Palsworld</title>
</head>
<body>
    <div class="logout-container">
        <img src="logo.png" alt="Palsworld Logo" class="logo">
        <h2>Logout</h2>
        <p>You have been successfully logged out.</p>
        <p>For security reasons, please close your browser.</p>
        <p>Thank you for using Palsworld!</p>
       <p class="login-link"><a href="login.php">Return to Login</a></p>

    </div>
</body>
</html>

