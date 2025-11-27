<?php
    include('../../connectionDB.php');
    include('./uploadfile.php');
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
        $ticketname = $_POST['ticketname'];
        
        $description = $_POST['description'];
        $selectedUser = $_POST['selectedUser'];
        $fullname = $_SESSION['fullname'];
        $filename = uploadFile('uploadedfile');

        $sql = "INSERT INTO ticket (ticket_name, description, created_by ,created_at, assigned_to, assigned_at, uploaded_files) 
        VALUES ('$ticketname', '$description', '$fullname', NOW() , '$selectedUser', NOW(), '$filename')";
        $result = $conn->query($sql);
        echo "
        <script>
                alert('Ticket Created Successfully');
                window.location.href='/ticket/client/admin/adminDashboard.php'
        </script>";
        exit();
    }
?>
