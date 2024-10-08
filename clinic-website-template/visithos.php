<?php
require_once "../Connection/config.php";

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VMS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>

        /* Custom CSS for enhancing card design */
        .custom-card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            margin: 2rem;
        }

        .custom-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .custom-card-title {
            font-weight: bold;
            color: #007bff;
        }

        .custom-card-text {
            color: #555;
        }

        .custom-card .btn {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .custom-card .btn:hover {
            background-color: #0056b3;
        }

        /* Section padding */
        .container {
            padding-top: 20px;
            padding-bottom: 20px;

        }

        /* Adjust heading and paragraph */
        .heading-section h2 {
            color: #333;
            font-weight: bold;
        }

        .heading-section p {
            color: #777;
        }

        .custom-hr {
            border: 0;
            /* Remove default border */
            height: 4px;
            /* Set the height (thickness) of the line */
            background-color: #007bff;
            /* Set the desired color (Bootstrap primary blue) */
            margin: 20px 0;
            /* Add some vertical spacing */
            border-radius: 5px;
            /* Optional: Rounded edges for the line */
        }


        .hospital-info {
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            /* White background for a cleaner look */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            /* Slightly stronger shadow */
            transition: transform 0.3s;
            /* Scale effect on hover */
            height: 11rem;
        }

        .hospital-info:hover {
            transform: scale(1.02);
            /* Slightly zoom in on hover */
        }

        .hospital-description {
            color: #666;
            /* Softer dark gray for description */
            font-style: italic;
            /* Italic style for emphasis */
            margin-top: 10px;
            /* Spacing above the description */
        }

        .contact-info {
            background-color: #f7f9fc;
            /* Light blue-gray background for contrast */
            border: 1px solid #007bff;
            /* Border color */
            border-radius: 10px;
            /* Rounded corners */
            padding: 20px;
            /* Padding for better spacing */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            /* Stronger shadow for depth */
            transition: transform 0.3s;
            /* Scale effect on hover */
        }

        .contact-info:hover {
            transform: scale(1.02);
            /* Slightly zoom in on hover */
        }

        .contact-info h5 {
            color: #007bff;
            /* Blue color for contact header */
            margin-bottom: 15px;
            /* Spacing below header */
            font-weight: bold;
            /* Make header bold */
        }

        .contact-info p {
            color: #444;
            /* Darker gray for text for better readability */
            margin-bottom: 10px;
            /* Spacing between paragraphs */
            line-height: 1.5;
            /* Increased line height for readability */
        }

        .contact-info a {
            color: #007bff;
            /* Link color */
            text-decoration: none;
            /* No underline */
            font-weight: 600;
            /* Semi-bold text for links */
            transition: color 0.3s;
            /* Smooth transition */
        }

        .contact-info a:hover {
            color: #0056b3;
            /* Darker shade of blue on hover */
            text-decoration: underline;
            /* Underline on hover for emphasis */
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->
    <!-- Spinner End -->


    <?php
    include('../Components/nav.php');

    ?>

    <div class="container-fluid  bg-light p-0 wow fadeIn">


        <!-- PHP to Fetch Vaccine Data -->
        <?php
        if (isset($_GET['vishos'])) {
            $get =  $_GET['vishos'];
            $Query = "SELECT * FROM `avail_vaccines` WHERE `Hosp_Name` = '$get'";
            $result = mysqli_query($con, $Query);

            if (mysqli_num_rows($result) > 0) {
        ?>
                <!-- Vaccine Cards Section -->
                <div class="container">
                    <?php
                    $selectquery = "SELECT * FROM `hospital` WHERE ID = $get";
                    $validate = mysqli_query($con, $selectquery);

                    if (mysqli_num_rows($validate) > 0) {
                        $hos = mysqli_fetch_assoc($validate);
                    ?>
                        <div class="row align-items-center mb-5">
                            <!-- Left Side: Additi text-center">
                                <div class="hospitonal Information or Image -->
                            <div class="col-md-8al-info">
                                    <h1 class="text-primary"><?php echo htmlspecialchars(string: $hos['Hospital_Name']); ?></h1>
                                    <p class="hospital-description">
                                        Your health is our priority! We provide quality medical care and dedicated services to all patients.
                                    </p>
                                </div>
                            </div>

                            <!-- Right Side: Contact Details -->
                            <div class="col-md-4">
                                <div class="contact-info p-3 text-right">
                                    <h5>Contact Us</h5>
                                    <p><strong>Address:</strong> <?php echo htmlspecialchars($hos['Hospital_Address']); ?></p>
                                    <p><strong>Phone:</strong> +<?php echo htmlspecialchars($hos['Hospital_Number']); ?></p>
                                    <p><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($hos['Email_id']); ?>"><?php echo htmlspecialchars($hos['Email_id']); ?></a></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>


                <!-- Hospital Details Section -->
                <div class="text-center mb-5 heading-section p-3">
                    <h2 style="color:#009CFF;">Approved Vaccines for Our Hospital</h2>
                    <p>Here you can find all the vaccines that have been approved by our hospital. Check out the details below.</p>
                    <p>
                        Our hospital is committed to providing top-notch healthcare services, and we ensure that all the vaccines offered here are thoroughly reviewed and approved for patient safety. We prioritize your health and well-being, offering a wide range of vaccines to help protect you and your loved ones from various diseases. Explore our approved vaccines below and feel free to visit us for more information or to schedule your vaccination. Your health is our priority, and we are here to serve you with the best care possible.
                    </p>
                    <hr class="custom-hr w-50 mx-auto">
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                    while ($f = mysqli_fetch_assoc($result)) {
                        $row = $f['Vac_id'];
                        $VacQuery = "SELECT * FROM `vaccines` WHERE `Vac_id` = '$row'";
                        $vacresult = mysqli_query($con, $VacQuery);
                        if (mysqli_num_rows($vacresult) > 0) {
                            $v = mysqli_fetch_assoc($vacresult);
                    ?>
                            <!-- Single Vaccine Card -->
                            <div class="col">
                                <div class="card h-auto custom-card">
                                    <div class="card-body">
                                        <h5 class="card-title custom-card-title"><?php echo htmlspecialchars($v['Vaccine_Name']); ?></h5>
                                        <p class="card-text custom-card-text"><?php echo htmlspecialchars($v['Vaccine_Desc']); ?></p>
                                        <a href="../clinic-website-template/service.php" class="btn btn-primary">More</a>
                                    </div>
                                </div>
                            </div>
                    <?php
                        } else {
                            echo "<p class='text-danger'>No vaccine found for Vac_id: $row</p>"; // Debug line for empty vacresult
                        }
                    }
                    ?>
                </div>
        <?php
            } else {
                echo "<p class='text-warning'>No vaccines available for the selected hospital.</p>"; // Debug line for empty result
            }
        }
        ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>


</html>