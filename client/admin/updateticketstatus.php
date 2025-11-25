<?php
include('../../connectionDB.php');

$status = $_GET['status'];
$id = $_GET['id'];

// Debug check
echo "STATUS: " . $status . "<br>";
echo "ID: " . $id . "<br>";

// Basic validation
if(!$status || !$id){
    die("Missing status or id!");
}

// FIX: Add quotes for status (string)
$sql = "UPDATE ticket SET status = '$status' WHERE S_No = $id";

if($conn->query($sql)){
    echo "Updated Successfully";
    echo "<script>window.location.href = './adminDashboard.php'</script>";
} else {
    echo "Error: " . $conn->error;
}
?>
