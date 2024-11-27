<?php
// display_screen.php
require_once 'config/db.php';

// Function to get the most recently called ticket
function getCurrentCalledTicket($departmentId = null)
{
    global $pdo;
    $sql = "
        SELECT qt.ticket_number, d.name as department_name 
        FROM queue_tickets qt
        JOIN departments d ON qt.department_id = d.id
        WHERE qt.status = 'called'";
    
    $params = [];
    if ($departmentId) {
        $sql .= " AND qt.department_id = ?";
        $params = [$departmentId];
    }
    
    $sql .= " ORDER BY qt.created_at DESC LIMIT 6"; // Get last 6 called tickets
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// If you want to create a real-time update mechanism, you could add:
// 1. WebSocket implementation
// 2. Server-Sent Events
// 3. Long polling

// Example of getting current called ticket via AJAX
if (isset($_GET['department_id'])) {
    $departmentId = intval($_GET['department_id']);
    $calledTickets = getCurrentCalledTicket(); // Remove departmentId parameter

    if ($calledTickets) {
        echo json_encode($calledTickets);
    } else {
        echo json_encode(['error' => 'No tickets called']);
    }
    exit;
}

// Get the currently called ticket and display on the screen
$defaultDepartmentId = 1; // Set your default department ID
$initialTickets = getCurrentCalledTicket();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hospital Queue Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            text-align: center;
        }

        .display-container {
            background-color: #ffffff;
            padding: 20px;
            width: 90%;
            max-width: 1400px;
            margin: 20px auto;
        }

        #ticketsContainer {
            display: grid;
            grid-template-rows: 1fr 1fr;  /* Two rows */
            grid-template-columns: repeat(3, 1fr);  /* Three columns */
            gap: 20px;
            margin-bottom: 20px;
        }

        .ticket-row {
            background-color: #ffffff;
            border: 5px solid #0066cc;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 250px; /* Fixed height for consistent card size */
        }

        /* Adjust font sizes for better fit */
        .ticket-number {
            font-size: 80px;  /* Slightly smaller */
            color: #0066cc;
            font-weight: bold;
            margin: 10px 0;
        }

        .department {
            font-size: 32px;  /* Slightly smaller */
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .timestamp {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
        }

        /* Add media query for smaller screens */
        @media (max-width: 1200px) {
            #ticketsContainer {
                grid-template-rows: repeat(3, 1fr);  /* Three rows */
                grid-template-columns: repeat(2, 1fr);  /* Two columns */
            }
        }

        @media (max-width: 768px) {
            #ticketsContainer {
                grid-template-rows: repeat(6, 1fr);  /* Six rows */
                grid-template-columns: 1fr;  /* One column */
            }
        }
    </style>
</head>

<body>
    <div class="display-container">
        <div id="ticketsContainer">
            <?php foreach ($initialTickets as $ticket): ?>
                <div class="ticket-row">
                    <div class="department"><?php echo htmlspecialchars($ticket['department_name']); ?></div>
                    <div class="ticket-number">
                        <?php
                        echo htmlspecialchars(substr($ticket['ticket_number'], 0, 2) . '...' . substr($ticket['ticket_number'], -3));
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="timestamp" id="currentTime"></div>
    </div>

    <script>
        // Function to update the display
        function updateDisplay(tickets) {
            const container = document.getElementById('ticketsContainer');
            container.innerHTML = '';
            
            tickets.forEach(ticket => {
                const formattedTicket = ticket.ticket_number !== 'None'
                    ? ticket.ticket_number.substring(0,2) + '...' + ticket.ticket_number.slice(-3)
                    : ticket.ticket_number;
                    
                const ticketRow = `
                    <div class="ticket-row">
                        <div class="department">${ticket.department_name}</div>
                        <div class="ticket-number">${formattedTicket}</div>
                    </div>
                `;
                container.innerHTML += ticketRow;
            });
            updateTime();
        }

        // Function to update current time
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
            document.getElementById('currentTime').textContent = timeString;
        }

        // Initial time update
        updateTime();

        // Update time every second
        setInterval(updateTime, 1000);

        // Replace the mock update with real AJAX calls
        function fetchCurrentTicket() {
            fetch('display-screen.php?department_id=1') // The department_id is now ignored
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        updateDisplay([]);
                    } else {
                        updateDisplay(data);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Call initially and then every 5 seconds
        fetchCurrentTicket();
        setInterval(fetchCurrentTicket, 5000);

        // Comment out or remove the mockDisplayUpdate function and its interval
        // ... rest of the existing code ...
    </script>
</body>

</html>