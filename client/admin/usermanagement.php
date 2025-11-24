<?php
include('../../connectionDB.php');

$sql = "SELECT * FROM users WHERE role='user'";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "
    <div class='userStructure'>
        <p>Username:</p>
        <p class='username'>{$row['username']}</p>
        <p class='fullname'>Full Name: {$row['full_name']}</p>
        <p>You Joined at: {$row['timestamps']}</p>
        <p>as : {$row['role']}</p>
        <button class='createTicketButton'>Create Ticket</button>
    </div>";
    echo '<br>';
}

?>
<div  class='createTicketForm'>
    <p class='crossBtn'>X</p>
    <h1>Create Ticket</h1>
    <form action='/ticket/server/admin/user.php' method='POST'>
        <!-- <p class='selectedUser'>Hii</p> -->
        <input type='text' name='selectedUser' value='' class='selectedUser' readonly>
        <input type='text' name='ticketname'  placeholder='Enter Ticket Name'>
        <input type='text' name='description'  placeholder='Enter Description'>
        <button type='submit' class='issueticket'>Issue Ticket</button>
    </form>
    <script>
        let username;
        let fullname;
        const createTicketButtons = document.querySelectorAll('.createTicketButton');
        const createTicketForm = document.querySelector('.createTicketForm');

        createTicketButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                createTicketForm.style.display = 'block';

                const card = e.target.closest(".userStructure");
                username = e.target.closest(".userStructure").querySelector('.username').textContent;
                fullname = card.querySelector('.fullname').textContent;

                console.log(username, fullname);

                const selectedUser = document.querySelector('.selectedUser');
                const selectedUse = document.getElementsByName('selectedUser');
                console.log('selected User is:',selectedUser);
                console.log('selected Use is:',selectedUse);
                selectedUser.value = username;
            });
        });

        const crossBtns = document.querySelectorAll('.crossBtn');
        console.log(crossBtns);
        crossBtns.forEach(
            button=>{
                button.addEventListener('click', ()=>{
                    createTicketForm.style.display= 'none';
                });
            })
    </script>
</div>
