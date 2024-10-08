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
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Service</a>
                
                <!-- Moved Appointment Link Here -->
                <a href="appointment.php" class="nav-item nav-link">Appointment</a>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown">Login</a>
                    <div class="dropdown-menu">
                        <a href="../Login/userlogin.php" class="dropdown-item">Login As Parents</a>
                        <a href="../Login/login.php" class="dropdown-item">Login as Hospital</a>
                    </div>
                </div>

                <a href="contact.php" class="nav-item nav-link">Contact</a>
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
        <a href="index.php" class="navbar-brand d-flex align-items-center">
            <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>VMS</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Service</a>
                
                <!-- Moved Appointment Link Here -->
                <a href="appointment.php" class="nav-item nav-link">Appointment</a>

                <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/team-1.jpg" alt="Profile" class="rounded-circle" style="width: 30px; height: 30px;">
                        </a>
                        <div class="dropdown-menu">
                            <a href="../Admin/profile.php" class="dropdown-item">Profile</a>
                            <a href="../Login/logout.php" class="dropdown-item">Logout</a>
                        </div>
                    </div>

                <a href="contact.php" class="nav-item nav-link">Contact</a>
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
        <a href="index.php" class="navbar-brand d-flex align-items-center">
            <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>VMS</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Service</a>
                
                <!-- Moved Appointment Link Here -->
                <a href="appointment.php" class="nav-item nav-link">Appointment</a>

                <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/team-1.jpg" alt="Profile" class="rounded-circle" style="width: 30px; height: 30px;">
                        </a>
                        <div class="dropdown-menu">
                            <a href="../Admin/userprofile.php" class="dropdown-item">Profile</a>
                            <a href="../Login/logout.php" class="dropdown-item">Logout</a>
                        </div>
                    </div>

                <a href="contact.php" class="nav-item nav-link">Contact</a>
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
        <a href="index.php" class="navbar-brand d-flex align-items-center">
            <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>VMS</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Service</a>
                
                <!-- Moved Appointment Link Here -->
                <a href="appointment.php" class="nav-item nav-link">Appointment</a>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown">Login</a>
                    <div class="dropdown-menu">
                        <a href="../Login/userlogin.php" class="dropdown-item">Login As Parents</a>
                        <a href="../Login/login.php" class="dropdown-item">Login as Hospital</a>
                    </div>
                </div>

                <a href="contact.php" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->';
}
?>