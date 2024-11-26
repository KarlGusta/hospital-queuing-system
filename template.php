<?php
// Include the path config. This is to make it easy to manage my URLs when I upload to production, that is cpanel
require_once 'config/paths.php';

// For meta tags reusability
require_once 'meta-tags.php';
$metaTags = new MetaTags();
echo $metaTags->generateMetaTags('home'); // or 'about' or any other page ID
?>

<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta10
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SVPMVGBZ4Q"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-SVPMVGBZ4Q');
    </script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>RoverGigs - Home</title>
    <!-- Custom CSS -->
    <style>
        .text-muted {
            border: 1px solid #ccc;
            /* Adjust the color and style as needed */
            border-radius: 5px;
            /* Adjust the radius for roundness */
            display: inline-block;
            /* Ensures the border fits the text */
            padding: 2px 4px;
            /* Optional: adds some padding for better appearance */
            background-color: white;
            /* Set background color to white */
        }

        .job-title {
            /* Assuming the job title has this class */
            font-weight: bold;
            /* Make the font bold */
            font-size: 18px;
            /* Set font size to 12px */
        }

        .company-title {

            /* Make the font bold */
            font-size: 18px;
            /* Set font size to 12px */
        }

        .card:hover .apply-button {
            visibility: visible;
            /* Show button on card hover */
        }

        .apply-button {
            visibility: hidden;
            /* Hide button by default */
            background-color: #fe7470;
            /* Button background color */
            color: white;
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

        .apply-button:hover {
            background-color: #fe7470;
            /* Darker shade on hover */
        }

        /* Remove the blur effect */
        .offcanvas-backdrop {
            display: none !important;
            /* Hide the dark overlay */
        }

        .subscribe-button {
            background-color: #fe7470;
            /* Button background color */
            color: white;
            /* Ensure text color is white */
            border: none;
            /* Remove border */
            border-radius: 5px;
            /* Rounded corners */
            padding: 10px 20px;
            /* Adjust padding for better appearance */
            cursor: pointer;
            /* Pointer cursor on hover */
        }

        .subscribe-button:hover {
            color: white;
            /* Keep text color white on hover */
            text-decoration: none;
            /* Ensure no underline on hover */
            opacity: 0.9;
            /* Optional: add a hover effect */
        }

        .trusted-logo {
            filter: grayscale(100%) opacity(0.5);
            /* Adjusted opacity */
            width: 90px;
            /* Set a fixed width */
            height: auto;
            /* Maintain aspect ratio */
            margin: 0 10px;
            /* Added margin for spacing */
        }

        .cloudflare-logo {
            width: 50px;
            /* Reduced size for Cloudflare logo */
        }

        .ibm-logo {
            width: 70px;
            /* Reduced size for IBM logo */
        }

        .trusted-by-title {
            color: grey;
            /* Set text color to grey */
            opacity: 0.7;
            /* Match opacity with logos */
            font-size: 10px;
            /* Set font size to a very small value */
        }

        .responsive-title {
            font-size: 36px !important;
            /* Default font size for mobile */
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
            background-color: #FFD015 !important;
            /* Change background color to #212121 */
            color: #0B090A;
            /* Change text color to #CFCFCF */
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
        <header class="navbar navbar-expand-md navbar-light d-print-none" style="background-color: #FFD015;">
            <div class="container-xl">
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="." style="text-decoration: none;">
                        Rover Gigs
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item me-3">
                        <div class="btn-list">
                            <a href="<?php echo path('post_a_job') ?>" class="btn d-none d-md-block" style="background-color: #F1F2F6; color:#0B090A;" target="_blank"
                                rel="noreferrer">
                                Post a remote job
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-wrapper">
            <div class="container-xl">
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">

                        <!--Front Banner-->
                        <div class="col-12">
                            <div class="card card-md" style="background-color: #FFD015; color:#0B090A;">
                                <div class="card-stamp card-stamp-lg">
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-10">
                                            <h1 class="h1 text-center responsive-title">ROVER GIGS</h1>
                                            <h3 class="h1 text-center d-none d-md-block">Find remote jobs <span
                                                    style="color: grey;">fast—work from anywhere, anytime. 🏆 #1
                                                    Rover Job Board.</span></h3>
                                            <div class="mt-3 text-center">
                                                <a href="<?php echo path('post_a_job') ?>" class="btn" style="background-color: #F1F2F6; color:#0B090A;"
                                                    target="_blank" rel="noopener">Post a remote job</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Trusted By Section -->
                        <div class="col-12 text-center my-4 d-none d-md-block">
                            <h2 class="trusted-by-title">trusted by</h2>
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <img src="<?php echo path('assets', 'sponsor_images') ?>microsoft.png" alt="Microsoft" class="trusted-logo">
                                </div>
                                <div class="col-auto">
                                    <img src="<?php echo path('assets', 'sponsor_images') ?>amazon.png" alt="Amazon" class="trusted-logo">
                                </div>
                                <div class="col-auto">
                                    <img src="<?php echo path('assets', 'sponsor_images') ?>cloudflare.png" alt="Cloudflare"
                                        class="trusted-logo cloudflare-logo">
                                </div>
                                <div class="col-auto">
                                    <img src="<?php echo path('assets', 'sponsor_images') ?>github.png" alt="GitHub" class="trusted-logo">
                                </div>
                                <div class="col-auto">
                                    <img src="<?php echo path('assets', 'sponsor_images') ?>ibm.png" alt="IBM" class="trusted-logo ibm-logo">
                                </div>
                                <div class="col-auto">
                                    <img src="<?php echo path('assets', 'sponsor_images') ?>scale-ai.png" alt="Scale AI" class="trusted-logo">
                                </div>
                                <div class="col-auto">
                                    <img src="<?php echo path('assets', 'sponsor_images') ?>shopify.png" alt="Shopify" class="trusted-logo">
                                </div>
                                <!-- Add more logos as needed -->
                            </div>
                        </div>
                        <!-- Job listing -->
                        <div class="col-12">
                            <div class='row row-cards'>
                                <div class='space-y'>
                                    <!--Connection to the database-->
                                    <?php
                                    require_once 'config/db.php';

                                    // Create connection to the database
                                    $connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                                    // Check if the connection is established correctly or not
                                    if ($connection->connect_error) {
                                        die("Connection failed: " . $connection->connect_error);
                                    }

                                    /**
                                     * Else, the connection is good, we can read the data
                                     * Read all row from the database table
                                     */
                                    $sql = "SELECT * FROM jobs where featured = 'Yes' and status = 'Approved' ORDER BY jobId DESC";
                                    $result = $connection->query($sql);

                                    // Update SQL to join with job tags
                                    $jobTagsSql = "SELECT j.*, GROUP_CONCAT(t.tag_name) as tags 
                                                                        FROM jobs j 
                                                                        LEFT JOIN job_tags t ON j.jobId = t.job_id 
                                                                        WHERE j.featured = 'Yes' AND j.status = 'Approved' 
                                                                        GROUP BY j.jobId 
                                                                        ORDER BY j.jobId DESC LIMIT 10";
                                    $result = $connection->query($jobTagsSql);

                                    // If the query does not execute correctly
                                    if (!$result) {
                                        die("Invalid query: " . $connection->error);
                                    }

                                    // Otherwise, we read the data using the while loop
                                    while ($row = $result->fetch_assoc()) {
                                        // Check if the job is featured
                                        // $rowColor = $row['featured'] === 'Yes' ? 'background-color: #FFF38F;' : 'background-color: #FFFFFF;'; // Change color if featured
                                        $companyNameDisplay = $row['valueMemberOnly'] === 'Yes' ? $row['companyName'] : '🔒<em>(Value Members Only)</em>'; // Check valueMemberOnly
                                        $companyLogoDisplayFirstTwoLetters = substr($row['companyName'], 0, 2); // Get the first two letters of the company name
                                        $companyLogoDisplay = $row['valueMemberOnly'] === 'Yes' ? $companyLogoDisplayFirstTwoLetters : $companyLogoDisplayFirstTwoLetters; // Check valueMemberOnly
                                        // $jobTypeDisplay = $row['valueMemberOnly'] === 'Yes' ? $row['jobType'] : ''; // Check valueMemberOnly
                                        $redirectUrl = $row['valueMemberOnly'] === 'Yes' ? path('apply') . "?id=" . $row['jobId'] : path('value_membership'); // Redirect based on membership type

                                        // When the job was posted
                                        $post_date = new DateTime($row['post_date']);
                                        $now = new DateTime();
                                        $interval = $post_date->diff($now);

                                        if ($interval->y > 0) {
                                            $time_ago = $interval->y . " y";
                                        } elseif ($interval->m > 0) {
                                            $time_ago = $interval->m . " mo";
                                        } elseif ($interval->d > 0) {
                                            $time_ago = $interval->d . " d";
                                        } elseif ($interval->h > 0) {
                                            $time_ago = $interval->h . " h";
                                        } elseif ($interval->i > 0) {
                                            $time_ago = $interval->i . " min";
                                        } elseif ($interval->s > 0) {
                                            $time_ago = $interval->s . " sec";
                                        } else {
                                            $time_ago = "Just now";
                                        }

                                        // Get the job tags and limit to 3
                                        $tags = $row['tags'] ? explode(',', $row['tags']) : []; // Split tags into an array
                                        $limitedTags = array_slice($tags, 0, 3); // Limit to 3 tags

                                        echo "
                            <div class='card' style='cursor: pointer; background-color: #FFD015; color:#0B090A;' onclick=\"window.location='$redirectUrl';\">
                                <div class='row g-0'>
                                    <div class='col-auto'>
                                        <div class='card-body'>
                                            <div class='avatar-md'>
                                              <span class='me-2 d-none d-md-block' style='font-size: 36px; width: 60px; height: 60px;'><strong>$companyLogoDisplay</strong></span>  
                                                </div>
                                        </div>
                                    </div>
                                    <div class='col'>
                                        <div class='card-body ps-0'>
                                            <div class='row'>
                                                <div class='col'>
                                                    <h3 class='mb-0'><a href='#'>$row[jobTitle]</a></h3>
                                                </div>
                                                <div class='col-auto fs-3 text-green d-none d-md-block'>$$row[minimum_salary] – $$row[maximum_salary] USD</div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-md'>
                                                    <div class='mt-3 list-inline list-inline-dots mb-0 text-secondary'>
                                                        <div class='list-inline-item'>
                                                            $companyNameDisplay
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='col-md-auto'>
                                                    <div class='mt-3 badges d-none d-md-block'>
                                                        <!-- Display job tags as badges -->
                                                        " . implode('', array_map(fn($tag) => "<a href='#' class='badge badge-outline text-secondary fw-normal badge-pill' style='margin-right: 5px;'>$tag</a>", $tags)) . "
                                                        <a href='#' class='badge badge-outline text-secondary fw-normal badge-pill'>+4</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='row'>
                                             <div class='col-md'>
                                                    <div class='mt-3 list-inline list-inline-dots mb-0 text-secondary'>
                                                        <div class='list-inline-item'>
                                                            $row[jobType]
                                                        </div>
                                                        <div class='list-inline-item'>
                                                            🌍 $row[location]
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-auto'>
                                        <div class='card-body'>
                                            <p class='text-secondary'>$time_ago</p>
                                        </div>
                                    </div>
                                    <div class='col-auto d-none d-md-block'>
                                        <div class='card-body'>
                                            <button class='apply-button' style='background-color: #F1F2F6; color:#0B090A;'><strong>Apply</strong></button>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            ";
                                    }

                                    // Show the message check back soon on table if there is no data to display
                                    if (mysqli_num_rows($result) == 0) {
                                        echo "
                          <tr style='background-color: #FFFFE0;'>
                              <td>
                                <h3 class='text-center'>No Full Stack Engineering jobs at the moment.</h3>
                              </td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                          ";
                                    }
                                    ?>
                                </div>
                                <!-- End of job listing -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cookie banner -->
    <div class="container-xl d-none d-md-block">
        <div class="offcanvas offcanvas-bottom h-auto show" style='background-color: #FFD015; color:#0B090A;' data-bs-scroll="true" tabindex="-1" id="offcanvasBottom"
            aria-modal="true" role="dialog">
            <div class="offcanvas-body">
                <div class="container text-center">
                    <!-- Centering the content -->
                    <div class="row align-items-center justify-content-center">
                        <!-- Centering the row -->
                        <div class="col" style="font-weight: bold; font-size: 16px;"><strong>Get new jobs
                                sent to
                                you</strong>📥</div>
                        <div class="col-auto">
                            <!-- To submit the subscribers email to Google sheets -->
                            <form method="POST" action="">
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control form-control-rounded mb-2 w-100" type="email"
                                            id="email" name="email" placeholder="Type Your Email..."
                                            style="font-weight: bold; font-size: 16px; color: black;" required>
                                    </div>
                                    <div class="col">
                                        <input type="submit" class="subscribe-button w-100" style="background-color: #F1F2F6; color:#0B090A;" id="subscribe-button"
                                            value="Subscribe">
                                    </div>
                                </div>
                            </form>
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $data = [
                                    'email' => $_POST['email']
                                ];

                                $url = 'https://script.google.com/macros/s/AKfycbw-m_ZMXkvYottK2UVBlgiy0Sn2DJsuBAMktqS0NLW_0UyjJTIMGLAk749NFZhjvDUBOA/exec'; // Replace with your Apps Script URL
                                $options = [
                                    'http' => [
                                        'header' => "Content-type: application/json\r\n",
                                        'method' => 'POST',
                                        'content' => json_encode($data),
                                    ],
                                ];
                                $context = stream_context_create($options);
                                $result = file_get_contents($url, false, $context);
                                // Handle the response if needed
                            }
                            ?>
                            <!-- End of to submit the subscribers email to Google sheets -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of cookie banner -->
    </div>
    <!--This is where the footer should be-->
    <footer class="footer footer-transparent d-print-none">
        <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
                <div class="col-lg-auto ms-lg-auto">
                    <ul class="list-inline list-inline-dots mb-0">
                        <li class="list-inline-item">
                            <a href="https://twitter.com/weareremoteokay" target="_blank" class="link-secondary"
                                rel="noopener">
                                <!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c-.002 -.249 1.51 -2.772 1.818 -4.013z" />
                                </svg>
                                Twitter
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.linkedin.com/company/we-are-remote-okay/" target="_blank"
                                class="link-secondary" rel="noopener">
                                <!-- Download SVG icon from http://tabler-icons.io/i/brand-linkedin -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <rect x="4" y="4" width="16" height="16" rx="2" />
                                    <line x1="8" y1="11" x2="8" y2="16" />
                                    <line x1="8" y1="8" x2="8" y2="8.01" />
                                    <line x1="12" y1="16" x2="12" y2="11" />
                                    <path d="M16 16v-3a2 2 0 0 0 -4 0" />
                                </svg>
                                LinkedIn
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                    <ul class="list-inline list-inline-dots mb-0">
                        <li class="list-inline-item">
                            Copyright &copy;
                            <script type="text/javascript">
                                document.write(new Date().getFullYear());
                            </script>
                            <a href="www.rovergigs.com" class="link-secondary">Rover Gigs</a>.
                            All rights reserved.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    </div>
    </div>
    <!-- Libs JS -->
    <script src="<?php echo path('assets', 'dist'); ?>libs/apexcharts/dist/apexcharts.min.js" defer></script>
    <script src="<?php echo path('assets', 'dist'); ?>libs/jsvectormap/dist/js/jsvectormap.min.js" defer></script>
    <script src="<?php echo path('assets', 'dist'); ?>libs/jsvectormap/dist/maps/world.js" defer></script>
    <script src="<?php echo path('assets', 'dist'); ?>libs/jsvectormap/dist/maps/world-merc.js" defer></script>
    <!-- Tabler Core -->
    <script src="<?php echo path('assets', 'dist'); ?>js/tabler.min.js" defer></script>
    <script src="<?php echo path('assets', 'dist'); ?>js/demo.min.js" defer></script>

    <!-- Custom Script for Subscribe Button -->
    <script>
        // Check if the user has already subscribed
        if (localStorage.getItem('subscribed')) {
            document.getElementById('offcanvasBottom').style.display = 'none'; // Hide the banner
        }

        // Add click event to the subscribe button
        document.getElementById('subscribe-button').addEventListener('click', function() {
            localStorage.setItem('subscribed', 'true'); // Set the subscribed flag
            document.getElementById('offcanvasBottom').style.display = 'none'; // Hide the banner
        });
    </script>
</body>

</html>