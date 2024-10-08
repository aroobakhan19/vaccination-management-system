<?php
require '../Connection/config.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location: ../Login/userlogin.php');
    exit();
}

// Handle appointment updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_id = $_POST['appointment_id'];

    if (isset($_POST['approve'])) {
        // Update appointment status to approved
        $update_query = "UPDATE appointment SET status = 'approved' WHERE id = '$appointment_id'";
        mysqli_query($con, $update_query);

        // Optionally, you could send an email notification or trigger another action here

    } elseif (isset($_POST['reject'])) {
        // Update appointment status to rejected with a reason
        $rejection_reason = $_POST['rejection_reason'];
        $update_query = "UPDATE appointment SET status = 'rejected', rejection_reason = '$rejection_reason' WHERE id = '$appointment_id'";
        mysqli_query($con, $update_query);

        // Optionally, you could send an email notification or trigger another action here
    }

    // Redirect back to the hospital dashboard or show a success message
    header('location: appointmanage.php'); // Adjust to your hospital dashboard file
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Admin</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user me-2"></i>Manage Users</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="usermanage.php" class="dropdown-item">Users</a>
                            <a href="hospitalmanage.php" class="dropdown-item">Hospitals</a>
                            <a href="appointmanage.php" class="dropdown-item">Appointments</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['username']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="userprofile.php" class="dropdown-item">My Profile</a>
                            <a href="../Login/logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container">
                <?php
                $SELECTQUERY = 'SELECT * FROM `appointment`';
                $validateselec = mysqli_query($con, $SELECTQUERY);
                $s_no = 1;

                if (mysqli_num_rows($validateselec) > 0) {
                ?>
                    <table id="myTable" class="table display">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Child Name</th>
                                <th scope="col">Child Age</th>
                                <th scope="col">Hospital</th>
                                <th scope="col">Vaccine</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Approved</th>
                                <th scope="col">Rejected</th>
                                <th scope="col">Reasopn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($validateselec)) {
                                $var = $row['parent_id'];
                                $hos =  $row['hospital'];
                                $vac = $row['vaccine'];

                                $SELECTQUERY2 = "SELECT * FROM `users` WHERE `id` = '$var'";
                                $validateselec2 = mysqli_query($con, $SELECTQUERY2);
                                $row2 = mysqli_fetch_assoc($validateselec2);


                                $SELECTQUERY3 = "SELECT * FROM `hospital` WHERE `id` = '$hos'";
                                $validateselec3 = mysqli_query($con, $SELECTQUERY3);
                                $row3 = mysqli_fetch_assoc($validateselec3);


                                $SELECTQUERY4 = "SELECT * FROM `vaccines` WHERE `Vac_id` = '$vac'";
                                $validateselec4 = mysqli_query($con, $SELECTQUERY4);
                                $row4 = mysqli_fetch_assoc($validateselec4);



                            ?>
                                <tr>
                                    <td><?php echo $s_no++; ?></td>
                                    <td><?php echo $row2['Users_Name']; ?></td>
                                    <td><?php echo $row['child_name']; ?></td>
                                    <td><?php echo $row['child_age']; ?></td>
                                    <td><?php echo $row3['Hospital_Name']; ?></td>
                                    <td><?php echo  $row4['Vaccine_Name']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td><?php echo ucfirst($row['status']); ?></td>
                                    <td>
                                        <?php if ($row['status'] == 'pending') { ?>
                                            <form method="POST" action="appointmanage.php" style="display:inline;">
                                                <input type="hidden" name="appointment_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="approve" class="btn btn-success">Approve</button>
                                            </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="appointmanage.php" style="display:inline;">
                                            <input type="hidden" name="appointment_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                                           
                                    </td>
                                    <td>
                                    <input type="text" name="rejection_reason" placeholder="Rejection Reason" required>
                                        </form>
                                    <?php } ?>
                                    </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>


            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#myTable').DataTable();
                });
            </script>
        </div>
    </div>
</body>

</html>