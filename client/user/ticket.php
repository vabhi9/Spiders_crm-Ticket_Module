<?php
include('../../connectionDB.php');
$sql = "SELECT S_No, ticket_name, created_by, created_at, status, assigned_at, uploaded_files FROM ticket WHERE assigned_to = '{$_SESSION['username']}'";
$result = $conn->query($sql);
// echo "<script>alert('{$}')</script>"

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='ticketStructure'>
        <form>
            <p>Ticket Name:</p>
            <br>
            <input value='{$row['ticket_name']}' name='ticketname' readonly>

            <p>Assigned by:</p>
            <input value='{$row['created_by']}' name='adminField' readonly>

            <p>Created At</p>
            <input value='{$row['created_at']}' name='createdAt' readonly>

            <p>Assigned To: </p>
            <input value='{$_SESSION['fullname']}' name='assignedTo' readonly>

            <label>Download File</lable>
            <a href='../../server/admin/download.php?file={$row['uploaded_files']}' class='downloadLink'>Download File</a>

            <p class='statusBtn' data-id={$row['S_No']}>Status:<p>
            <input type='text' readonly class='currentStateOfStatus' name='status' value='{$row['status']}'>
            <p class='editBtn' data-id='{$row['S_No']}'>Edit</p>
            <p class='saveBtn' style='display:none' data-id='{$row['S_No']}'>Save</p>

            <div class='statusContainer'>
                <select name='status' class='statusSelect'>
                    <option value='completed'>Completed</option>
                    <option value='inProgress'>In Progress</option>
                </select>
            </div>
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
                'input[name="status"]'
            );

            editableInputs.forEach(inp => inp.removeAttribute('readonly'));

            // --- STATUS HANDLING (using existing classes) ---
            const statusInput = card.querySelector('.currentStateOfStatus');
            const statusSelect = card.querySelector('.statusSelect');
            const statusContainer = card.querySelector('.statusContainer');

            // Hide old input, show dropdown inside same container
            statusInput.style.display = 'none';
            statusContainer.classList.add('statusContainerToggle'); 
            statusSelect.style.display = 'block';
            statusSelect.value = statusInput.value;

            // Show Save button
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