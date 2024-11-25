<?php
require_once 'config.php';
require_once 'functions.php';

?>

<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Queue System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Hospital Queue System</h1>
        
        <!-- New Patient Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Get Queue Ticket</h5>
            </div>
            <div class="card-body">
                <form action="process.php" method="POST">
                    <div class="mb-3">
                        <label for="patientName" class="form-label">Patient Name</label>
                        <input type="text" class="form-control" id="patientName" name="patientName" required>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select" id="department" name="departmentId" required>
                            <option value="">Select Department</option>
                            <?php
                            $stmt = $pdo->query("SELECT * FROM departments");
                            while ($row = $stmt->fetch()) {
                                echo "<option value='{$row['id']}'>{$row['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="action" value="addToQueue">Get Ticket</button>
                </form>
            </div>
        </div>

        <!-- Current Queue Display -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Current Queue Status</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Ticket Number</th>
                                <th>Patient Name</th>
                                <th>Status</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $departmentId = $_GET['department'] ?? 1; // Default to department 1
                            $queue = getQueueStatus($departmentId);
                            foreach ($queue as $ticket) {
                                echo "<tr>";
                                echo "<td>{$ticket['ticket_number']}</td>";
                                echo "<td>{$ticket['patient_name']}</td>";
                                echo "<td>{$ticket['status']}</td>";
                                echo "<td>" . date('H:i', strtotime($ticket['created_at'])) . "</td>";
                                echo "<td>";
                                if ($ticket['status'] == 'waiting') {
                                    echo "<form action='process.php' method='POST' style='display:inline;'>";
                                    echo "<input type='hidden' name='ticketId' value='{$ticket['id']}'>";
                                    echo "<button type='submit' name='action' value='callPatient' class='btn btn-sm btn-primary'>Call</button>";
                                    echo "</form>";
                                } elseif ($ticket['status'] == 'called') {
                                    echo "<form action='process.php' method='POST' style='display:inline;'>";
                                    echo "<input type='hidden' name='ticketId' value='{$ticket['id']}'>";
                                    echo "<button type='submit' name='action' value='completeTicket' class='btn btn-sm btn-success'>Complete</button>";
                                    echo "</form>";
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>