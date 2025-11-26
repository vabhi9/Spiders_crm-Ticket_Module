<?php
include('../../connectionDB.php');
$sql = "SELECT S_No, ticket_name, created_at, assigned_to, assigned_at, status FROM ticket WHERE created_by = '{$_SESSION['fullname']}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='ticketStructure'>
        <form>
            <p>Ticket Name:</p>
            <br>
            <input value='{$row['ticket_name']}' name='ticketname' readonly>

            <p>Assigned by:</p>
            <input value='{$_SESSION['fullname']}' name='adminField' readonly>

            <p>Created At</p>
            <input value='{$row['created_at']}' name='createdAt' readonly>

            <p>Assigned To: </p>
            <input value='{$row['assigned_to']}' name='assignedTo' readonly>

            <p class='statusBtn' data-id={$row['S_No']}>Status:<p>
            <input type='text' readonly class='currentStateOfStatus' name='status' value='{$row['status']}'>

                <select name='status' class='statusSelect'>
                    <option value='pending'>Pending</option>
                    <option value='incomplete'>Incomplete</option>
                    <option value='completed'>Completed</option>
                    <option value='onhold'>On Hold</option>
                </select>


            <p class='editBtn' data-id='{$row['S_No']}'>Edit</p>
            <p class='saveBtn' style='display:none' data-id='{$row['S_No']}'>Save</p>

        </form>
        </div>";
        }
        // <a href='editTicket.php?id={$row['S_No']}'>Edit</a>
}else{
    echo "<script>alert('An issue occurring while Fetching the Data')</script>";
}
?>

<script>
    const editBtns = document.querySelectorAll('.editBtn');
    const saveBtns = document.querySelectorAll('.saveBtn');

    editBtns.forEach(editBtn => {
        editBtn.addEventListener('click', (e) => {
            const card = e.target.closest('.ticketStructure');

        // Input fields to make editable
            const editableInputs = card.querySelectorAll(
                'input[name="ticketname"], input[name="assignedTo"]'
            );

            editableInputs.forEach(inp => inp.removeAttribute('readonly'));

            const statusInput = card.querySelector('.currentStateOfStatus');
            const statusSelect = card.querySelector('.statusSelect');

            statusInput.style.display = 'none';
            statusSelect.style.display = 'block';
            statusSelect.value = statusInput.value;

            editBtn.style.display = 'none';
            card.querySelector('.saveBtn').style.display = 'block';
    });
});


saveBtns.forEach(saveBtn => {
    saveBtn.addEventListener('click', (e) => {
        const ticketId = e.target.dataset.id;
        const card = e.target.closest('.ticketStructure');
        const form = card.querySelector('form');

        // Read updated values
        const name = form.querySelector('input[name="ticketname"]').value;
        const assignedTo = form.querySelector('input[name="assignedTo"]').value;
        const updatedStatus = card.querySelector('.statusSelect').value;

        const formData = new FormData(form);
        formData.append("id", ticketId);
        formData.append("status", updatedStatus);

        // Send update
        fetch('../../server/admin/updateTicket.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            alert("Ticket Updated Successfully!");

            // Lock fields again
            card.querySelectorAll('input').forEach(inp => inp.setAttribute('readonly', true));

            // Update displayed status
            const statusInput = card.querySelector('.currentStateOfStatus');
            statusInput.value = updatedStatus;

            // Reset visibility
            card.querySelector('.statusSelect').style.display = 'none';
            statusInput.style.display = 'block';
            card.querySelector('.saveBtn').style.display = 'none';
            card.querySelector('.editBtn').style.display = 'block';
        });
    });
});

</script>