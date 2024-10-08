<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
require '../Connection/config.php';
session_start();

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get data from form inputs
    $parent_id = $_SESSION['userid']; // Assumes session is set with parent ID
    $c_name = $_POST['child_n'];
    $c_age = $_POST['child_age'];
    $hospital = $_POST['hospitalId'];
    $vac = $_POST['vaccine'];
    $date = $_POST['date'];

    // Insert the appointment into the database
    $insertquery = "INSERT INTO `appointment`(`parent_id`, `child_name`, `child_age`, `hospital`, `vaccine`, `date`) 
                    VALUES ('$parent_id','$c_name','$c_age','$hospital','$vac','$date')";
    $validate = mysqli_query($con, $insertquery);

    // Check if the query was successful
    if ($validate) {
        echo "Appointment booked successfully!";
    } else {
        echo "Failed to book the appointment: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VMS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">



    <style>
        body {
            background-color: #f4f4f9;
            /* A soft neutral background */
            font-family: 'Arial', sans-serif;
            /* Professional font */
        }

        .card {
            border-radius: 8px;
            /* Slightly rounded corners for a modern feel */
        }

        .form-control,
        .form-select {
            border: 1px solid #007bff;
            /* Subtle blue border */
            border-radius: 4px;
            /* Slightly rounded corners */
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0056b3;
            /* Darker blue on focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            /* Soft shadow on focus */
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Darker blue on hover */
        }

        .card-header {
            background-color: #007bff;
            /* Header color */
            border-top-left-radius: 8px;
            /* Rounded top corners */
            border-top-right-radius: 8px;
            /* Rounded top corners */
        }
    </style>
</head>


<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar -->
    <?php include('../Components/nav.php'); ?>




    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Appointment</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Appointment</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->




    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow border-0">
                        <div class="card-header text-white text-center py-3">
                            <h3>Make An Appointment</h3>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="appointment.php">
                                <div class="mb-3">
                                    <label for="parent_name" class="form-label">Parent Name</label>
                                    <input type="text" class="form-control" name="parent_name" value="<?php echo $_SESSION['username'] ?? 'Parent\'s name'; ?>" readonly>

                                </div>

                                <div class="mb-3">
                                    <label for="parent_email" class="form-label">Parent Email</label>
                                    <input type="email" class="form-control" name="parent_email" value="<?php  echo $_SESSION['useremail'] ?? 'parent\'s email'; ?>" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="child_n" class="form-label">Child Name</label>
                                    <input type="text" name="child_n" class="form-control" placeholder="Enter Child Name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="child_age" class="form-label">Child Age</label>
                                    <select class="form-select" name="child_age" required>
                                        <option selected disabled>Please select your child's age</option>
                                        <option value="1">Under 6 months</option>
                                        <option value="2">6 months to 1 year</option>
                                        <option value="3">1 year</option>
                                        <option value="4">2 years</option>
                                        <option value="5">3 years</option>
                                        <option value="6">4 years</option>
                                        <option value="7">5 years</option>
                                        <option value="8">6 years and above</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="hospital" class="form-label">Select Hospital</label>
                                    <select class="form-select" id="hospital" name="hospitalId" required>
                                        <option value="">Select a hospital</option>
                                        <?php
                                        $hospitalQuery = "SELECT id, Hospital_Name FROM hospital";
                                        $hospitalResult = mysqli_query($con, $hospitalQuery);
                                        while ($hospital = mysqli_fetch_assoc($hospitalResult)) {
                                            echo '<option value="' . $hospital['id'] . '">' . $hospital['Hospital_Name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="vaccine" class="form-label">Approved Vaccines</label>
                                    <select class="form-select" id="vaccine" name="vaccine" required>
                                        <option value="">Select a hospital first</option>
                                    </select>
                                </div>


                                <div class="mb-3">
                                    <label for="datePicker" class="form-label">Appointment Date</label>
                                    <input type="date" class="form-control" id="datePicker" name="date" required>
                                    <script>
                                        const today = new Date().toISOString().split('T')[0];
                                        document.getElementById("datePicker").setAttribute("min", today);
                                    </script>
                                </div>

                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Book Appointment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Address</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 street Gulberg Karachi</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+92432-258585</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>VMS.official@mail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social rounded-circle" href="https://www.twitter.com"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href="https://www.youtube.com"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href="https://www.linkedin.com"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Services</h5>
                    <a class="btn btn-link" href="">Pediatric Vaccinology</a>
                    <a class="btn btn-link" href="">Immunology Services</a>
                    <a class="btn btn-link" href="">Preventive Health Services</a>
                    <a class="btn btn-link" href="">Health Vaccination Programs</a>
                    <a class="btn btn-link" href="">Travel Vaccination Services</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Newsletter</h5>
                    <p>Stay informed and up-to-date with the latest news in pediatric vaccinations and health tips</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">VMS.com</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // AJAX to fetch vaccines based on hospital selection
        $(document).ready(function() {
            $('#hospital').on('change', function() {
                var hospitalId = $(this).val();
                if (hospitalId) {
                    $.ajax({
                        type: 'POST',
                        url: 'fetch_vaccines.php',
                        data: {
                            hospitalId: hospitalId
                        },
                        success: function(html) {
                            $('#vaccine').html(html);
                        }
                    });
                } else {
                    $('#vaccine').html('<option value="">Select a hospital first</option>');
                }
            });
        });
    </script>

</body>

</html>