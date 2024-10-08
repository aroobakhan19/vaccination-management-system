<?php
require '../Connection/config.php';

if (isset($_GET['deleteid'])) {
    $getID = $_GET['deleteid'];

    // First, delete from the related table
    $deleteRelatedQuery = "DELETE FROM `avail_vaccines` WHERE `Vac_id` = '$getID'";
    mysqli_query($con, $deleteRelatedQuery);

    // Now delete the main record
    $deletequery = "DELETE FROM `vaccines` WHERE `Vac_id` = '$getID'";
    $validate = mysqli_query($con, $deletequery);

    if ($validate) {
        header('location: index.php');
    } else {
        echo "Error deleting row: " . mysqli_error($con);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" >
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />


</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header('location: ../Login/userlogin.php');
        exit();
    }

    $insert =  false;
    if (isset($_POST['add'])) {
        $Vaccine_Name = $_POST['vac-name'];
        $Vaccine_Desc = $_POST['vac-desc'];


        // query validate
        $sql = "INSERT INTO `vaccines`(`Vaccine_Name`, `Vaccine_Desc`) VALUES ('$Vaccine_Name','$Vaccine_Desc')";
        $validate = mysqli_query($con, $sql);
        if ($validate) {
            $insert = true;
        }
    }
    ?>
    <?php include_once '../Components/navbar.php'; ?>


    <?php
    if ($insert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Added!</strong> New Vaccine has been Added! 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    ?>

    <!-- <h1 class="container">Hello <?php echo $_SESSION['username'] ?></h1> -->
    <a href="userprofile.php">Profile</a>
    <div class="container">
        <div class="head text-center">
            <p class="display-6 fw-bold">Add Vaccines</p>
        </div>
        <form action="index.php" method="post" class="container">

            <div class="mb-3">
                <label for="vac_title" class="form-label">Vaccine Name</label>
                <input type="Text" name="vac-name" class="form-control" id="vac_title" placeholder="Vaccines Name">
            </div>
            <div class="mb-3">
                <label for="txtarea" class="form-label">Vaccine Description</label>
                <textarea class="form-control" name="vac-desc" id="txtarea" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary btn-md" name="add">Add</button>
            </div>

        </form>
    </div>


    <?PHP
    $SELECTQUERY = 'SELECT * FROM `vaccines`';
    $validateselec = mysqli_query($con, $SELECTQUERY);
    $s_no = 1;

    if (mysqli_num_rows($validateselec) > 0) {
    ?>
        <div class="container ">
            <div class="head text-center">
                <p class="display-6 fw-bold">Vaccines</p>
            </div>
            <table id="myTable" class="table display">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Names</th>
                        <th scope="col">Description</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
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
                                <a href="edit.php?editid=<?php echo $row['Vac_id']; ?>">
                                    <button class="btn btn-md btn-success">Edit</button>
                                </a>
                            </td>
                            <td>
                                <a href="index.php?deleteid=<?php echo $row['Vac_id']; ?>">
                                    <button class="btn btn-md btn-danger">Delete</button>
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