<?php
include('../../connectionDB.php');
$sql = "SELECT S_No, ticket_name, description, created_at, assigned_to, created_by, assigned_at, status FROM ticket WHERE created_by = '{$_SESSION['fullname']}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='ticketStructure'>
    <!-- Row 1 -->
    <div class='field'>
        <label>Ticket Name</label>
        <input name='ticketname' value='{$row['ticket_name']}' readonly>
    </div>

    <div class='field'>
        <label>Status</label>
        <input class='currentStateOfStatus' readonly value={$row['status']}>
        <select class='statusSelect'>
            <option value='pending'>Pending</option>
            <option value='incomplete'>Incomplete</option>
            <option value='completed'>Completed</option>
            <option value='onhold'>On Hold</option>
        </select>
    </div>

    <div class='field'>
        <label>Assigned To</label>
        <input name='assignedTo' value={$row['assigned_to']} readonly>
    </div>

    <!-- Row 2 -->
    <div class='field'>
        <label>Created At</label>
        <input value={$row['created_at']} readonly>
    </div>

    <div class='field'>
        <label>Assigned At</label>
        <input value={$row['assigned_at']} readonly>
    </div>

    <div class='field'>
        <label>Ticket Number</label>
        <input value={$row['S_No']} readonly>
    </div>

    <!-- Row 3 -->
    <div class='field full-width'>
        <label>Created By</label>
        <input name='role' value={$row['created_by']} readonly>
    </div>

    <!-- Row 4 -->
    <div class='field full-width'>
        <label>Description</label>
        <textarea readonly>{$row['description']}></textarea>
    </div>

    <div class='actionBtns'>
        <p class='editBtn' data-id={$row['S_No']}>Edit</p>
        <p class='deleteBtn' data-id={$row['S_No']}>Delete</p>
        <p class='saveBtn' style='display:none' data-id={$row['S_No']}>Save</p>
    </div>
</div> ";
    }
}else{
    echo "<script>alert('An issue occurring while Fetching the Data');</script>";
}
?>


<script>
    const editBtns = document.querySelectorAll('.editBtn');
    const saveBtns = document.querySelectorAll('.saveBtn');
    const deleteBtns = document.querySelectorAll('.deleteBtn');

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
        // const form = card.querySelector('Form');

        // Read updated values
        const name = card.querySelector('input[name="ticketname"]').value;
        const assignedTo = card.querySelector('input[name="assignedTo"]').value;
        const updatedStatus = card.querySelector('.statusSelect').value;

        const formData = new FormData();
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

deleteBtns.forEach(deleteBtn => {
    deleteBtn.addEventListener('click', (e) => {
        const ticketId = e.target.dataset.id;
        const card = e.target.closest('.ticketStructure');

        if (!confirm("Are you sure you want to delete this ticket?")) {
            return;
        }

        const formData = new FormData();
        formData.append("id", ticketId);

        fetch('../../server/admin/deleteTicket.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            alert("Ticket Deleted Successfully!");

            // Remove card smoothly
            card.style.transition = "0.3s ease";
            card.style.opacity = "0";
            card.style.transform = "scale(0.95)";

            setTimeout(() => {
                card.remove();
            }, 300);
        });
    });
});


</script>