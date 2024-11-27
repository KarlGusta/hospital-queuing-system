<?php
session_start();
require_once 'config/db.php';
require_once 'config/functions.php';

// Include the path config. This is to make it easy to manage my URLs when I upload to production, that is cpanel
require_once 'config/paths.php';
?>

<!-- index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Queue System</title>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"> -->

    <style>
        .get-ticket-button {
            background-color: #0C0A09 !important;
            /* Button background color */
            color: #F97F2B !important;
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
            background-color: #F97F2B !important;
            color: #0C0A09 !important;

            /* Darker shade on hover */
        }

        .call-button {
            background-color: #0C0A09 !important;
            /* Button background color */
            color: #F97F2B !important;
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
            background-color: #F97F2B !important;
            color: #0C0A09 !important;
        }

        .complete-button {
            background-color: #F97F2B !important;
            /* Button background color */
            color: #0C0A09 !important;
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
            background-color: #0C0A09 !important;
            color: #F97F2B !important;
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
            color: #0C0A09 !important;
        }
    </style>

    <!-- CSS files -->
    <link href="<?php echo path('assets', 'dist'); ?>css/tabler.min.css" rel="stylesheet" />
    <link href="<?php echo path('assets', 'dist'); ?>css/tabler-flags.min.css" rel="stylesheet" />
    <link href="<?php echo path('assets', 'dist'); ?>css/tabler-payments.min.css" rel="stylesheet" />
    <link href="<?php echo path('assets', 'dist'); ?>css/tabler-vendors.min.css" rel="stylesheet" />
    <link href="<?php echo path('assets', 'dist'); ?>css/demo.min.css" rel="stylesheet" />

    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="src/img/logo/rovergigs_logo.png">

    <!-- For the font -->
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="page">
        <!-- The right side navigation bar -->
        <aside class="navbar navbar-vertical navbar-right navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <h1 class="navbar-brand navbar-brand-autodark">
                    <a href=".">
                        <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                    </a>
                </h1>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="navbar-nav pt-lg-3">
                        <li class="nav-item">
                            <a class="nav-link" href="get-queue-ticket.php">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Get Queue Ticket
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="current-queue-status.php">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Current Queue Status
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display-screen.php">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Display Screen(T.V)
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of the right side navigation bar -->

    </div>
    <!-- Libs JS -->
    <script src="<?php echo path('assets', 'dist'); ?>libs/apexcharts/dist/apexcharts.min.js" defer></script>
    <script src="<?php echo path('assets', 'dist'); ?>libs/jsvectormap/dist/js/jsvectormap.min.js" defer></script>
    <script src="<?php echo path('assets', 'dist'); ?>libs/jsvectormap/dist/maps/world.js" defer></script>
    <script src="<?php echo path('assets', 'dist'); ?>libs/jsvectormap/dist/maps/world-merc.js" defer></script>
    <!-- Tabler Core -->
    <script src="<?php echo path('assets', 'dist'); ?>js/tabler.min.js" defer></script>
    <script src="<?php echo path('assets', 'dist'); ?>js/demo.min.js" defer></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>