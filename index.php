<?php
session_start();
require_once 'config/db.php';
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

    <style>
        .get-ticket-button {
            background-color: #0C0A09;
            /* Button background color */
            color: #F97F2B;
            /* Text color */
            border: none;
            /* Remove border */
            border-radius: 5px;
            /* Rounded corners */
            padding: 12px 80px;
            /* Padding for better appearance */
            cursor: pointer;
            /* Pointer cursor on hover */
            transition: background-color 0.3s;
            /* Smooth transition */
        }

        .get-ticket-button:hover {
            background-color: #F97F2B;
            color: #0C0A09;

            /* Darker shade on hover */
        }

        .call-button {
            background-color: #0C0A09;
            /* Button background color */
            color: #F97F2B;
            /* Text color */
            border: none;
            /* Remove border */
            border-radius: 5px;
            /* Rounded corners */
            /* Padding for better appearance */
            cursor: pointer;
            /* Pointer cursor on hover */
            transition: background-color 0.3s;
            /* Smooth transition */
        }

        .call-button:hover {
            background-color: #F97F2B;
            color: #0C0A09;
        }

        .complete-button {
            background-color: #F97F2B;
            /* Button background color */
            color: #0C0A09;
            /* Text color */
            border: none;
            /* Remove border */
            border-radius: 5px;
            /* Rounded corners */
            /* Padding for better appearance */
            cursor: pointer;
            /* Pointer cursor on hover */
            transition: background-color 0.3s;
            /* Smooth transition */
        }

        .complete-button:hover {
            background-color: #0C0A09;
            color: #F97F2B;
        }

        @media (min-width: 768px) {
            .responsive-title {
                font-size: 56px !important;
                /* Font size for larger screens */
            }
        }

        body {
            font-family: 'Bricolage Grotesque', sans-serif !important;
            /* Change font to Bricolage Grotesque */
            font-size: 15px !important;
            /* Adjust the font size as needed */
            background-color: #FFF8EF !important;
            color: #0C0A09;
        }
    </style>

    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="src/img/logo/rovergigs_logo.png">

    <!-- For the font -->
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400;700&display=swap" rel="stylesheet">
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
                    <button type="submit" class="btn get-ticket-button" name="action" value="addToQueue">Get Ticket</button>
                </form>
            </div>
        </div>

        <!-- Current Queue Display -->
        <div class="card">
            <div class="card-header">
                <?php
                /*
                   * When you filter, it should remain the same even when the page reloads
                   * The key is to persist the selected department value. Here are the necessary changes         
                   * Get department ID from URL parameter or session, defaulting to 1
                */
                $departmentId = isset($_GET['department']) ? $_GET['department'] : (isset($_SESSION['selected_department']) ? $_SESSION['selected_department'] : 1);
                // Store the department ID in session
                $_SESSION['selected_department'] = $departmentId;

                $stmt = $pdo->prepare("SELECT name FROM departments WHERE id = ?");
                $stmt->execute([$departmentId]);
                $departmentName = $stmt->fetchColumn();
                ?>
                <h5 class="card-title">Current Queue Status - <span class="text-muted"><?php echo htmlspecialchars($departmentName); ?></span></h5>
            </div>
            <div class="card-body">
                <!-- Add department filter -->
                <form class="mb-3">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <label for="queueDepartment" class="form-label mb-0">Filter by Department:</label>
                        </div>
                        <div class="col-auto">
                            <select class="form-select" id="queueDepartment" name="department" onchange="this.form.submit()">
                                <?php
                                $stmt = $pdo->query("SELECT * FROM departments");
                                while ($row = $stmt->fetch()) {
                                    $selected = ($row['id'] == $departmentId) ? 'selected' : '';
                                    echo "<option value='{$row['id']}' {$selected}>{$row['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
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
                            // Update the queue retrieval to use the stored department ID
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
                                    echo "<button type='submit' name='action' value='callPatient' class='btn btn-sm call-button'>Call</button>";
                                    echo "</form>";
                                } elseif ($ticket['status'] == 'called') {
                                    echo "<form action='process.php' method='POST' style='display:inline;'>";
                                    echo "<input type='hidden' name='ticketId' value='{$ticket['id']}'>";
                                    echo "<button type='submit' name='action' value='completeTicket' class='btn btn-sm complete-button'>Complete</button>";
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