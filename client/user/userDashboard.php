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
    <div class= "userDash">
        <div class="sect-1">
            <h1>Menu</h1>
            <ul>
                <li id="currentTicket" class="activeMenu">Tickets Assigned</li>
            </ul>
        </div>

        <div class="sect-2">
            <div class="top-box"> Hii <?php echo $_SESSION["fullname"]?></div>
            <div class="bottom-box">
                <div id="ticketContainer">
                    <?php include('ticket.php')?>
                </div>
        </div>
    </div>
</body>
</html>