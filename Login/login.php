<?php
require '../Connection/config.php';
session_start();

if (isset($_POST['submit'])) {
    $text = $_POST['text']; // User input for hospital license or email
    $pass = $_POST['pass']; // User input for password

    // Simple SQL query to check hospital login
    $sql = "SELECT * FROM `hospital` WHERE Hospital_License = '$text' AND Hospital_Password = '$pass'";
    $validate = mysqli_query($con, $sql);

    if ($validate) {
        $num = mysqli_num_rows($validate);
        echo "Rows found: " . $num; // Check if rows are returned
    
        if ($num == 1) {
            $hosdata = mysqli_fetch_assoc($validate);
    
            // Debug: Output all fetched data
            echo "Fetched data: ";
            var_dump($hosdata); // Check what data is being returned
            
            // Set session variables
            session_start(); // Ensure session is started before setting session variables
    
            // Set the hosid from the fetched data
            $_SESSION['hosid'] = $hosdata['id'];
    
            // Set other session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['role'] = "Hospital";
            $_SESSION['hosname'] = $hosdata['Hospital_Name'];
            $_SESSION['hosemail'] = $hosdata['Email_id'];
            $_SESSION['hoslic'] = $hosdata['Hospital_License'];
            $_SESSION['hosadd'] = $hosdata['Hospital_Address'];
            $_SESSION['hosnum'] = $hosdata['Hospital_Number'];
    
            header('location: ../Admin/userprofile.php');
            exit();
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "Query failed: " . mysqli_error($con); // Output any SQL errors
    }
    
    
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hospital Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12"></div>
            <div class="logo">
                <img src="../img/Untitled design.png" alt="">
            </div>
            <form action="login.php" method="post">
                <h1 class="h1">Hospital Login</h1>
                <div class="mb-3 d-flex">
                    <img src="../img/icons8-user-24.png" alt="" style="width:30px; height:30px;">
                    <input type="text" class="form-control" name="text" placeholder="Enter your email or LIC" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                <div class="mb-3 d-flex">
                    <img src="../img/icons8-lock-25.png" alt="" style="width:30px; height:30px;">
                    <input type="password" class="form-control" name="pass" placeholder="Password" id="exampleInputPassword1">
                </div>
                <input name="submit" type="submit" class="btn mt-2" id="button">

                <a href="userlogin.php" class="btn btn-md mt-2" id="button">Login as Parent</a>
                <a href="H_register.php" class="btn btn-md mt-2" id="button">Registered as Hospital</a>

            </form>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>