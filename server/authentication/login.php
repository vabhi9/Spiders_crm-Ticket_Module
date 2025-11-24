
<?php
    session_start();
    include('../../connectionDB.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $_POST['username'];
        $password = $_POST['password'];


        $sql = "
            SELECT username, password
            FROM users
            WHERE username = '$username' AND password = '$password'
        ";

        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            $_SESSION["username"] = $username;

            $sql2 = "SELECT full_name from users WHERE username = '$username'";
            $res2 = $conn->query($sql2);
            $row2 = $res2->fetch_assoc();

            $_SESSION["fullname"] = $row2['full_name'];
            echo "<script>alert('Login Successful Broo!')</script>";
            echo "<script>window.location.href= '/ticket/client/admin/adminDashboard.php'</script>";
            echo "Login Successful!";
        } else {
            echo "Invalid Username or Password";
        };
    }
?>
