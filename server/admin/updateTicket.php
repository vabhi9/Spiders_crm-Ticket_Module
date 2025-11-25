<?php
include('../../connectionDB.php');

$id = $_POST['id'];
$ticketname = $_POST['ticketname'];
$assignedTo = $_POST['assignedTo'];
$status = $_POST['status'];

$sql = "UPDATE ticket SET 
        ticket_name = '$ticketname',
        assigned_to = '$assignedTo',
        status = '$status'
        WHERE S_No = $id";

if ($conn->query($sql)) {
    echo "success";
} else {
    echo "error";
}
?>
