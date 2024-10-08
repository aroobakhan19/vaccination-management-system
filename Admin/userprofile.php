<?PHP
include '../Connection/config.php';

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location: Login/userlogin.php');
    exit();
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
        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 2px dashed #007bff;
            object-fit: cover;
            cursor: pointer;
        }

        .hidden {
            display: none;
        }

        h2,
        h4 {
            color: #009CFF;

        }

        .btn {
            background-color: #009CFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: rgb(61, 57, 57);
        }
    </style>
</head>

<body>

<!-- Topbar Start -->
<div class="container-fluid bg-light p-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-map-marker-alt text-primary me-2"></small>
                <small>123 street Gulberg Karachi</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center py-3">
                <small class="far fa-clock text-primary me-2"></small>
                <small>Mon - Fri : 09.00 AM - 09.00 PM</small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-phone-alt text-primary me-2"></small>
                <small>+92432-258585</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center">
                <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href=""><i class="fab fa-twitter"></i></a>
                <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-sm-square rounded-circle bg-white text-primary me-0" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->





<?php

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    echo '<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand d-flex align-items-center">
            <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>VMS</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="../clinic-website-template/index.php" class="nav-item nav-link">Home</a>
                <a href="../clinic-website-template/about.php" class="nav-item nav-link">About</a>
                <a href="../clinic-website-template/service.php" class="nav-item nav-link">Service</a>
                
                <!-- Moved Appointment Link Here -->
                <a href="../clinic-website-template/appointment.php" class="nav-item nav-link">Appointment</a>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown">Login</a>
                    <div class="dropdown-menu">
                        <a href="../Login/userlogin.php" class="dropdown-item">Login As Parents</a>
                        <a href="../Login/login.php" class="dropdown-item">Login as Hospital</a>
                    </div>
                </div>

                <a href="../clinic-website-template/contact.php" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->';
}

// Check if the user role is hospital
else if (isset($_SESSION['role']) && $_SESSION['role'] === 'Hospital') {
    echo '<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top">
    <div class="container-fluid">
        <a href="../clinic-website-template/index.php" class="navbar-brand d-flex align-items-center">
            <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>VMS</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="../clinic-website-template/index.php" class="nav-item nav-link">Home</a>
                <a href="../clinic-website-template/about.php" class="nav-item nav-link">About</a>
                <a href="../clinic-website-template/service.php" class="nav-item nav-link">Service</a>
                
                <!-- Moved Appointment Link Here -->
                <a href="../clinic-website-template/appointment.php" class="nav-item nav-link">Appointment</a>

                <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/team-1.jpg" alt="Profile" class="rounded-circle" style="width: 30px; height: 30px;">
                        </a>
                        <div class="dropdown-menu">
                            <a href="../Admin/profile.php" class="dropdown-item">Profile</a>
                            <a href="../Login/logout.php" class="dropdown-item">Logout</a>
                        </div>
                    </div>

                <a href="../clinic-website-template/contact.php" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->';
} 
else if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
    echo '<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top">
    <div class="container-fluid">
        <a href="../clinic-website-template/index.php" class="navbar-brand d-flex align-items-center">
            <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>VMS</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="../clinic-website-template/index.php" class="nav-item nav-link">Home</a>
                <a href="../clinic-website-template/about.php" class="nav-item nav-link">About</a>
                <a href="../clinic-website-template/service.php" class="nav-item nav-link">Service</a>
                
                <!-- Moved Appointment Link Here -->
                <a href="../clinic-website-template/appointment.php" class="nav-item nav-link">Appointment</a>

                <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/team-1.jpg" alt="Profile" class="rounded-circle" style="width: 30px; height: 30px;">
                        </a>
                        <div class="dropdown-menu">
                            <a href="../Admin/userprofile.php" class="dropdown-item">Profile</a>
                            <a href="../Login/logout.php" class="dropdown-item">Logout</a>
                        </div>
                    </div>

                <a href="../clinic-website-template/contact.php" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->';
}
else if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    echo '<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top">
    <div class="container-fluid">
        <a href="../clinic-website-template/index.php" class="navbar-brand d-flex align-items-center">
            <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>VMS</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="../clinic-website-template/index.php" class="nav-item nav-link">Home</a>
                <a href="../clinic-website-template/about.php" class="nav-item nav-link">About</a>
                <a href="../clinic-website-template/service.php" class="nav-item nav-link">Service</a>
                
                <!-- Moved Appointment Link Here -->
                <a href="../clinic-website-template/appointment.php" class="nav-item nav-link">Appointment</a>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown">Login</a>
                    <div class="dropdown-menu">
                        <a href="../Login/userlogin.php" class="dropdown-item">Login As Parents</a>
                        <a href="../Login/login.php" class="dropdown-item">Login as Hospital</a>
                    </div>
                </div>

                <a href="../clinic-website-template/contact.php" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->';
}





    if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']); // Clear the message after displaying it
    }

    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']); // Clear the error after displaying it
    } ?>
    <div class="container mt-5">
        <h2>Your Profile</h2>
        <!-- <a href="Login/logout.php"><button class="btn btn-ms btn-primary">LogOut</button></a> -->

        <?php

        $selectquery = "SELECT * FROM `users`";
        $validate = mysqli_query($con, $selectquery);

        if (mysqli_num_rows($validate) > 0) {

            $row = mysqli_fetch_assoc($validate)



        ?>
            <div class="card mb-4">
                <div class="card-body text-center">

                    <h4 id="fullName"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : $_SESSION['hosname']; ?></h4>
                    <p id="email"><?php echo isset($_SESSION['useremail']) ? $_SESSION['useremail'] : $_SESSION['hosemail']; ?></p>
                    <p id="cnic"><?php echo "CNIC: " . (isset($_SESSION['usercnic']) ? $_SESSION['usercnic'] : $_SESSION['hoslic']); ?></p>
                    <p id="address"><?php echo "Address: " . (isset($_SESSION['useradd']) ? $_SESSION['useradd'] : $_SESSION['hosadd']); ?></p>
                    <p id="phone"><?php echo "Number: " . (isset($_SESSION['usernum']) ? $_SESSION['usernum'] : $_SESSION['hosnum']); ?></p>

                </div>
            </div>
        <?php } ?>


        <!-- Displaying according to login -->

        <!-- Admin or Hospital Dashboard Based on Role -->
        <?php
        // // Check if the user role is admin
        // if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        //     echo '
        //     <h4>Admin Dashboard</h4>
        //     <ul class="list-group">
        //         <a class="link-secondary" href="userManagement.php">
        //             <li class="list-group-item">Manage Users</li>
        //         </a>
        //         <a class="link-secondary" href="manage.php">
        //             <li class="list-group-item">View All Vaccination Records</li>
        //         </a>
        //         <a class="link-secondary" href="manage.php">
        //             <li class="list-group-item">Update Vaccine Availability</li>
        //         </a>
        //     </ul>
        //     <div class="mt-4">
        //         <a href="admin-profile.html" class="btn">Edit Admin Profile</a>
        //         <a href="admin-records.html" class="btn">Manage Records</a>
        //         <a href="../Login/logout.php" class="btn">Logout</a>
        //     </div>';
        // }


        if (isset($_GET['approveid'])) {
            $appid = $_GET['approveid'];
            $hospitalid = $_SESSION['hosid'];

            // Check if this combination already exists
            $checkquery = "SELECT * FROM `avail_vaccines` WHERE `Vac_id` = '$appid' AND `Hosp_Name` = '$hospitalid'";
            $checkresult = mysqli_query($con, $checkquery);

            if (mysqli_num_rows($checkresult) > 0) {
                $_SESSION['message'] = "This vaccine has already been approved for this hospital.";
                header("Location: userprofile.php");
                exit();
            } else {
                $insertquery = "INSERT INTO `avail_vaccines`(`Vac_id`, `Hosp_Name`) VALUES ('$appid','$hospitalid')";
                $validate = mysqli_query($con, $insertquery);

                if ($validate) {
                    $_SESSION['message'] = 'Vaccine approved for the hospital successfully.';
                    header("Location: userprofile.php");
                    exit();
                } else {
                    $_SESSION['error'] = 'Error: ' . mysqli_error($con);
                    header("Location: userprofile.php");
                    exit();
                }
            }
        } elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'Hospital') {
            echo '
            <h4>APPOINTMENT</h4>
        
            <div class="container mb-5">
                <div class="head text-center">
                    <p class="display-6 fw-bold">Vaccines</p>
                </div>
                <table id="myTable" class="table display">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Names</th>
                            <th scope="col">Description</th>
                            <th scope="col">Approved</th>
                            <th scope="col">Disapproved</th>
                        </tr>
                    </thead>
                    <tbody>
            ';

            $SELECTQUERY = "SELECT * FROM `vaccines`";
            $validateselec = mysqli_query($con, $SELECTQUERY);
            $s_no = 0;

            if (mysqli_num_rows($validateselec) > 0) {
                while ($row = mysqli_fetch_assoc($validateselec)) {
                    $s_no++;
                    echo '
                        <tr>
                            <td>' . $s_no . '</td>
                            <td>' . $row["Vaccine_Name"] . '</td>
                            <td>' . $row["Vaccine_Desc"] . '</td>
                            <td>
                                <a href="userprofile.php?approveid=' . $row["Vac_id"] . '">
                                    <button class="btn btn-md btn-success">Approved</button>
                                </a>
                            </td>
                            <td>
                                <a href="userprofile.php?deleteid=' . $row["Vac_id"] . '">
                                    <button class="btn btn-md btn-danger">Disapproved</button>
                                </a>
                            </td>
                        </tr>
                    ';
                }
            }

            echo '
                    </tbody>
                </table>
            </div>
        
            <div class="mt-4">
                <a href="hospital-profile.html" class="btn">Edit Hospital Profile</a>
                <a href="hospital-records.html" class="btn">View Records</a>
                <a href="../Login/logout.php" class="btn">Logout</a>
            </div>';
        } else if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
            echo '
            <div class="container">
                <h4>Appointments</h4>
            ';
            $selectquery = "SELECT * FROM `appointment` WHERE `parent_id` = '" . $_SESSION['userid'] . "'";
            $validate = mysqli_query($con, $selectquery);
            if (mysqli_num_rows($validate) > 0) {
                echo '
                <table id="userTable" class="table display">
                    <thead>
                        <tr>
                            <th scope="col">Child Name</th>
                            <th scope="col">Hospital</th>
                            <th scope="col">Vaccine</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                ';

                while ($row = mysqli_fetch_assoc($validate)) {
                    $hosp = $row['hospital'];
                    $vacc = $row['vaccine'];

                    $SELECTQUERY2 = "SELECT * FROM `hospital` WHERE `id` = '$hosp'";
                    $validateselec2 = mysqli_query($con, $SELECTQUERY2);
                    $row3 = mysqli_fetch_assoc($validateselec2);

                    $SELECTQUERY3 = "SELECT * FROM `vaccines` WHERE `Vac_id` = '$vacc'";
                    $validateselec3 = mysqli_query($con, $SELECTQUERY3);
                    $row4 = mysqli_fetch_assoc($validateselec3);

                    echo '
                        <tr>
                            <td>' . htmlspecialchars($row["child_name"]) . '</td>
                            <td>' . htmlspecialchars($row3["Hospital_Name"]) . '</td>
                            <td>' . htmlspecialchars($row4["Vaccine_Name"]) . '</td>
                            <td>' . htmlspecialchars($row["date"]) . '</td>
                            <td>' . ucfirst(htmlspecialchars($row["status"])) . '</td>
                        </tr>
                    ';
                }

                echo '
                    </tbody>
                </table>
                <a href="download.php" class="btn btn-md btn-info">Save Appointment</a>
                ';
            } else {
                echo '<p>No appointments found.</p>';
            }

            echo '
                </div>
            ';
        } else {
            echo 'No user is logged in.';
        }
        ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable();
        });
    </script>

</body>

</html>