<?php
include('../../connectionDB.php');
$sql = "SELECT ticket_name, created_at, assigned_to, assigned_at, status FROM ticket WHERE created_by = '{$_SESSION['fullname']}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<script>alert('all good')</script>";
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='ticketStructure'>
            <p>Username:{$row['ticket_name']}</p>
            <p>created by:{$_SESSION['fullname']}</p>
            <p>created at{$row['created_at']}</p>
            <p>assigned to: {$row['assigned_to']}</p>
            <p class='statusBtn'>Status: {$row['status']}</p>
        </div>
    ";
    }
}else{
    echo "<script>alert('An issue occurring while Fetching the Data')</script>";
}
?>
<div class='statusContainer'>
    <select name="status" id="" class="statusSelect">
        <option value="pending">Pending</option>
        <option value="incomplete">Incomplete</option>
        <option value="completed">Completed</option>
        <option value="onhold">On Hold</option>
    </select>
</div>

<script>
    const statusBtns = document.querySelectorAll('.statusBtn');
    const statusContainer = document.querySelector('.statusContainer');
    const status = document.getElementsByName('status');
    console.log(status);

    statusBtns.forEach(statusBtn => { 
        statusBtn.addEventListener('click', ()=>{
            statusContainer.classList.toggle('statusContainerToggle');
        });
    });

     const statusSelects = document.querySelectorAll('.statusSelect');

    statusSelects.forEach(select => {
        select.addEventListener('change', (e) => {
            const newStatus = e.target.value;
            alert('Status Changed Successfully');
        });
    });
</script>