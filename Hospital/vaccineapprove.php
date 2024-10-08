<?php
require '../Connection/config.php';
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location: ../Login/login.php');
    exit();
}

if (isset($_GET['approveid'])) {
    $appid = $_GET['approveid'];
    $hospitalid = $_SESSION['hosid'];

    // Check if this combination already exists
    $checkquery = "SELECT * FROM `avail_vaccines` WHERE `Vac_id` = '$appid' AND `Hosp_Name` = '$hospitalid'";
    $checkresult = mysqli_query($con, $checkquery);

    if (mysqli_num_rows($checkresult) > 0) {
        echo "This vaccine has already been approved for this hospital.";
    } else {
        // Proceed with the insert if no duplicates found
        $insertquery = "INSERT INTO `avail_vaccines`(`Vac_id`, `Hosp_Name`) VALUES ('$appid','$hospitalid')";
        $validate = mysqli_query($con, $insertquery);

        if ($validate) {
            echo 'Vaccine approved for the hospital successfully.';
        } else {
            echo 'Error: ' . mysqli_error($con); // Add error handling for failed inserts
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Approved Vaccine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />


</head>

<body>

    <?PHP
    $SELECTQUERY = 'SELECT * FROM `vaccines`';
    $validateselec = mysqli_query($con, $SELECTQUERY);
    $s_no = 1;

    if (mysqli_num_rows($validateselec) > 0) {
    ?>
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
                    <?php
                    $s_no = 0; // Initialize the serial number
                    while ($row = mysqli_fetch_assoc($validateselec)) {
                        $s_no++;
                    ?>
                        <tr>
                            <td><?php echo $s_no; ?></td>
                            <td><?php echo $row['Vaccine_Name']; ?></td>
                            <td><?php echo $row['Vaccine_Desc']; ?></td>
                            <td>
                                <a href="vaccineapprove.php?approveid=<?php echo $row['Vac_id']; ?>">
                                    <button class="btn btn-md btn-success">Approved</button>
                                </a>
                            </td>
                            <td>
                                <a href="vaccineapprove.php?deleteid=<?php echo $row['Vac_id']; ?>">
                                    <button class="btn btn-md btn-danger">Disapproved</button>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    <?PHP  } ?>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>


    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>


</body>

</html>