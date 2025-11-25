<?php
session_start();
include('../../connectionDB.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql1 = "
        SELECT username, password 
        FROM users 
        WHERE username = '$username' AND password = '$password'
    ";

    $result = $conn->query($sql1);

    if ($result->num_rows === 1) {

        $row = $result->fetch_assoc();

        $_SESSION["username"] = $row['username'];

        $sql2 = "SELECT full_name, role FROM users WHERE username = '$username'";
        $res2 = $conn->query($sql2);
        $row2 = $res2->fetch_assoc();

        $_SESSION["fullname"] = $row2['full_name'];
        $role = $row2['role'];

        echo "<script>alert('Login Successful Broo!')</script>";

        if ($row2['role'] === 'admin') {
            echo "<script>window.location.href='/ticket/client/admin/adminDashboard.php'</script>";
        } 
        else {
            echo "<script>window.location.href='/ticket/client/user/userDashboard.php'</script>";
        }

    } else {
        echo "<script>alert('Invalid Username or Password')</script>";
    }
}
?>
