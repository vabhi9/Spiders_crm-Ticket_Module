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
                <li id="logoutBtn">Logout</li>
            </ul>
        </div>

        <div class="sect-2">
            <div class="hamburger" onclick="toggleMenu()">&#9776;</div>
            <div class="top-box"> Hii <?php echo $_SESSION["fullname"]?></div>
            <div class="bottom-box">
                <div id="ticketContainer">
                    <?php include('ticket.php')?>
                </div>
        </div>
    </div>
    <script>
        const logoutBtn = document.querySelector("#logoutBtn");
        logoutBtn.addEventListener('click', () => {
            window.location.href = '../../server/admin/logout.php';
        });

function toggleMenu() {
    const menu = document.querySelector('.sect-1');
    const overlay = document.getElementById('overlay');

    menu.classList.toggle('activeMenuSlide');
    overlay.classList.toggle('show');
}

function closeMenu() {
    document.querySelector('.sect-1').classList.remove('activeMenuSlide');
    document.getElementById('overlay').classList.remove('show');
}

    </script>
</body>
</html>