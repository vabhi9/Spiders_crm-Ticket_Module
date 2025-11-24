<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Ticket/style.css">
</head>
<body>
    <!-- Login Form -->
    <?php 
    // if(!isset($_SESSION['username'])){
        include("./client/authentication/loginform.php")
        // }
        ?>
    <!-- Register Form -->
    <?php include("./client/authentication/registerform.php")?>
</body>
</html>