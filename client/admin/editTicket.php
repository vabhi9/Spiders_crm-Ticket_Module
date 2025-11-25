<?php
include('../../connectionDB.php');

$id = $_GET['id'];

$sql = "SELECT * FROM ticket WHERE S_No = $id";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>

<form action="updateTicket.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $data['S_No']; ?>">
    <h1>Update Values</h1>
    <label>Status</label>
    <input type="text" name="status" value="<?php echo $data['status']; ?>">

    <button type="submit">Update</button>
</form>
