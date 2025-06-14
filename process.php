<!-- process.php -->
<?php
require_once 'config/db.php';
require_once 'config/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['action']) {
        case 'addToQueue':
            $patientName = $_POST['patientName'];
            $departmentId = $_POST['departmentId'];
            if (addToQueue($patientName, $departmentId)) {
                header("Location: get-queue-ticket.php?success=1");
            } else {
                header("Location: get-queue-ticket.php?error=1");
            }
            break;

        case 'callPatient':
            $ticketId = $_POST['ticketId'];
            if (updateTicketStatus($ticketId, 'called')) {
                header("Location: current-queue-status.php?success=2");
            } else {
                header("Location: current-queue-status.php?error=2");
            }
            break;

        case 'completeTicket':
            $ticketId = $_POST['ticketId'];
            if (updateTicketStatus($ticketId, 'completed')) {
                header("Location: current-queue-status.php?success=3");
            } else {
                header("Location: current-queue-status.php?error=3");
            }
            break;
    }
}
?>