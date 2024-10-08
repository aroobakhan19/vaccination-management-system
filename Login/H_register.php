<?php
require '../Connection/config.php';

    if (isset($_POST["Register"])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $uname = $_POST['uname'];
        $num = $_POST['num'];
        $lic = $_POST['lic'];
        $address = $_POST['address'];
        // Errors

        // Anti Duplication query
        $antiquery = "SELECT Hospital_Name FROM hospital WHERE Hospital_License = '$lic'";
        $antiValidate = mysqli_query($con , $antiquery);
        // Anti Duplication query

        $errors = array();
        
        if (empty($email)) {
            $errors['em'] = "Email Requires";
        }
        if (empty($pass)) {
            $errors['pass'] = "Password Requires";
        }
        if (empty($uname)) {
            $errors['un'] = "Username Requires";
        }
        if (empty($num)) {
            $errors['num'] = "Number Requires";
        }
        if (empty($lic)) {
            $errors['LIC'] = "LIC Requires";
        }else if (mysqli_num_rows($antiValidate) > 0) {
            $errors['LIC'] = "Hospital Already Registered";
        }
        if (empty($address)) {
            $errors['add'] = "Address Requires";
        }
        
        // Errors


       if(count($errors)==0) {
        $insertquery = "INSERT INTO `hospital`(`Hospital_Name`, `Hospital_License`, `Hospital_Password`, `Email_id`, `Hospital_Address`, `Hospital_Number`) VALUES ('$uname','$lic','$pass','$email','$address','$num')";
        $validate = mysqli_query($con , $insertquery);
        if ($validate) {
            include '../Components/regsuc.php';
        }
        else{
            include '../Components/regnot.php';
           
        }
    }
    
    }
    ?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hospital Registration</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
   
<div class="container-fluid">
    <div class="row">
    <div class="col-12">
    <div class="logo">
           <img src="../img/Untitled design.png" alt="">
        </div>
        <form method="post" action="H_register.php"><h1 class="h1">Hospital Registration</h1>
            <div class="row">
                <div class="col">
                
                    <label for="inputAddress">Hospital Name</label>
                    <input type="text" name="uname" class="form-control" placeholder="Hospital Name Acc to Papers">
                    <p class="text-danger"><?php if (isset($errors['un'])) echo $errors['un']?></p>
                </div>
                <div class="col">
                    <label for="inputAddress">Licsence</label>
                    <input type="text" name="lic" class="form-control" placeholder="LIC Number">
                    <p class="text-danger"><?php if (isset($errors['LIC'])) echo $errors['LIC']?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address </label>
                <input type="text" name="address" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                <p class="text-danger"><?php if (isset($errors['add'])) echo $errors['add']?></p>
            </div>
            <div class="form-group">
                <label for="inputAddress2">Phone Number </label>
                <input type="text" name="num" class="form-control" id="inputAddress2" placeholder="Enter your Number">
                <p class="text-danger"><?php if (isset($errors['num'])) echo $errors['num']?></p>
            </div>
            <div class="form-group">
                <label for="inputAddress">Email</label>
                <input type="text" name="email" class="form-control" id="inputAddress" placeholder="Enter your Active Email">
                <p class="text-danger"><?php if (isset($errors['em'])) echo $errors['em']?></p>
            </div>
            <div class="form-group">
                <label for="inputAddress2">Password </label>
                <input type="text" name="pass" class="form-control" id="inputAddress2" placeholder="Must be atleast 8 character">
                <p class="text-danger"><?php if (isset($errors['pass'])) echo $errors['pass']?></p>
            </div>
            <button type="submit" name="Register" class="btn btn-md" id="button">Register</button>            <a href="login.php" class="btn btn-md " id="button">Login Hospital</a>
        </form>
        </div>
        </div>
        </div>
    </div>
</body>

</html>