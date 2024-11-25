<!-- process.php -->
<?php
require_once 'config.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['action']) {
        case 'addToQueue':
            $patientName = $_POST['patientName'];
            $departmentId = $_POST['departmentId'];
            if (addToQueue($patientName, $departmentId)) {
                header("Location: index.php?success=1");
            } else {
                header("Location: index.php?error=1");
            }
            break;

        case 'callPatient':
            $ticketId = $_POST['ticketId'];
            if (updateTicketStatus($ticketId, 'called')) {
                header("Location: index.php?success=2");
            } else {
                header("Location: index.php?error=2");
            }
            break;

        case 'completeTicket':
            $ticketId = $_POST['ticketId'];
            if (updateTicketStatus($ticketId, 'completed')) {
                header("Location: index.php?success=3");
            } else {
                header("Location: index.php?error=3");
            }
            break;
    }
}
?>