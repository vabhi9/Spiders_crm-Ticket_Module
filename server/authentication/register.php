<?php
    include('../../connectionDB.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
        $name = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $checkSql = "SELECT username FROM users WHERE username = '$username'";
        $result = $conn->query($checkSql);

        if($result->num_rows>0){
            echo "<script>alert('Sorry User with this User Name Already Existed Please Select any other unique Username')</script>";
            exit();
        }

        $sql = "INSERT INTO `users` (`full_name`, `username`, `password`, `role`, `timestamps`) VALUES ('$name', '$username', '$password','$role', NOW())";
        $conn->query($sql);
    }
    echo "<script>alert('Register successfully')</script>";
?>
