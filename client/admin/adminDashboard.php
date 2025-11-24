<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Module</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class= "adminDash">
        <div class="sect-1">
            <h1>Menu</h1>
            <ul>
                <li id="currentTicket" class="activeMenu">Ticket Creation</li>
                <li id="userManagenent">User management</li>
            </ul>
        </div>

        <div class="sect-2">
            <div class="top-box"> Hii <?php echo $_SESSION["fullname"]?></div>
            <div class="bottom-box">
                <div id="ticketContainer">
                    <?php include('ticket.php')?>
                </div>
                <div id="userConatiner">
                    <?php include('usermanagement.php')?>
                </div>
        </div>
    </div>
    <script>
        const userManagement = document.querySelector("#userManagenent");
        const currentTicket = document.querySelector("#currentTicket");

        const ticket = document.querySelector("#ticketContainer");
        const users = document.querySelector("#userConatiner");

        userManagement.addEventListener("click", () => {
            ticket.style.display = "none";
            users.style.display = "block";
            userManagement.classList.add('activeMenu');
            currentTicket.classList.remove("activeMenu");
        });

        currentTicket.addEventListener("click", () => {
            ticket.style.display = "block";
            users.style.display = "none";
            currentTicket.classList.add("activeMenu");
            userManagement.classList.remove("activeMenu");
        });
    </script>
</body>
</html>