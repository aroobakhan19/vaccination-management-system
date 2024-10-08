<?php
require '../Connection/config.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location: ../Login/userlogin.php');
    exit();
}

// Handle vaccine addition
$insert = false;
if (isset($_POST['add'])) {
    $Vaccine_Name = $_POST['vac-name'];
    $Vaccine_Desc = $_POST['vac-desc'];

    // Validate and insert query
    $sql = "INSERT INTO `vaccines`(`Vaccine_Name`, `Vaccine_Desc`) VALUES ('$Vaccine_Name','$Vaccine_Desc')";
    if (mysqli_query($con, $sql)) {
        $insert = true; 
    }
}

// Handle vaccine deletion
if (isset($_GET['deleteid'])) {
    $getID = $_GET['deleteid'];

    // First, delete from the related table
    $deleteRelatedQuery = "DELETE FROM `avail_vaccines` WHERE `Vac_id` = '$getID'";
    mysqli_query($con, $deleteRelatedQuery);

    // Now delete the main record
    $deletequery = "DELETE FROM `vaccines` WHERE `Vac_id` = '$getID'";
    if (mysqli_query($con, $deletequery)) {
        header('location: index.php');
        exit();
    } else {
        echo "Error deleting row: " . mysqli_error($con);
    }
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
    $SELECTQUERY = 'SELECT * FROM `users`';
    $validateselec = mysqli_query($con, $SELECTQUERY);
    $s_no = 1;

    if (mysqli_num_rows($validateselec) > 0) {
    ?>
        <table id="myTable" class="table display">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Names</th>
                    <th scope="col">Email</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($validateselec)) {
                    ?>
                    <tr>
                        <td><?php echo $s_no++; ?></td>
                        <td><?php echo htmlspecialchars($row['Users_Name']); ?></td>
                        <td><?php echo htmlspecialchars($row['Email_id']); ?></td>
                        <td>
                            <a href="UpdateUsers.php?editid=<?php echo $row['id']; ?>">
                                <button class="btn btn-md btn-success">Edit</button>
                            </a>
                        </td>
                        <td>
                            <a href="usermanage.php?dltuser=<?php echo $row['id']; ?>">
                                <button class="btn btn-md btn-danger">Delete</button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
    <?php
    if (isset($_GET['dltuser'])) {
        $getID = $_GET['dltuser']; // Get the ID from the URL
        
        // Simple validation (ensure it's a number)
        if (is_numeric($getID)) {
            // Create a DELETE query
            $deleteQuery = "DELETE FROM users WHERE id = $getID";
            
            // Execute the query
            if (mysqli_query($con, $deleteQuery)) {
                echo "Record deleted successfully.";
            } else {
                echo "Error deleting record: " . mysqli_error($con);
            }
        } else {
            echo "Invalid ID.";
        }
    }
    ?>

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