
<?php
    include('../../connectionDB.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $_POST['username'];
        $password = $_POST['password'];

        // Correct SQL query
        $sql = "
            SELECT username, password
            FROM users
            WHERE username = '$username' AND password = '$password'
        ";

        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            echo "Login Successful!";
        } else {
            echo "Invalid Username or Password";
        }
    }
    ?>
