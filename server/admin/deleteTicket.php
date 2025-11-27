<?php
include('../../connectionDB.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM ticket WHERE S_No = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
