<?php
require '../Connection/config.php';

    if (isset($_POST["Register"])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $uname = $_POST['uname'];
        $num = $_POST['num'];
        $cnic = $_POST['cnic'];
        $address = $_POST['address'];
        // Errors

        // Anti Duplication query
        $antiquery = "SELECT Email_id FROM users WHERE  Email_id = '$email'";
        $antiValidate = mysqli_query($con , $antiquery);
        // Anti Duplication query

        $errors = array();
        
        if (empty($email)) {
            $errors['em'] = "Email Requires";
        }
        if (mysqli_num_rows($antiValidate) > 0) {
            $errors['em'] = "Email Already Found";
            
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
        if (empty($cnic)) {
            $errors['cnic'] = "Cnic Requires";
        }
        if (empty($address)) {
            $errors['add'] = "Address Requires";
        }
        
        // Errors


       if(count($errors)==0) {
        $insertquery = "INSERT INTO `users`(`Users_Name`, `Users_Password`, `Users_Number`, `Uses_Address`, `Users_CNIC`, `Email_id`) VALUES ('$uname','$pass','$num','$address','$cnic','$email')";
        $validate = mysqli_query($con , $insertquery);
        if ($validate) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                 <strong>SUCCESS!</strong> Your Account has been Successfully Creates
                 <a href="login.php">Login Your Account</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>SUCCESS!</strong> Fatal error
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>'; 
        }}
    
    }
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
   
<div class="container-fluid">
    <div class="row">
    <div class="col-12">
    <div class="logo">
           <img src="../img/Untitled design.png" alt="">
        </div>
        <form method="post" action="p_register.php" id="contact-form"> 
            <h1 class="h1">Parents Registration</h1>
            <div class="row">
                <div class="col">
                    <label for="inputAddress">Name</label>
                    <input type="text" name="uname" class="form-control" placeholder="Full Name">
                    <p class="text-danger"><?php if (isset($errors['un'])) echo $errors['un']?></p>
                </div>
                <div class="col">
                    <label for="inputAddress">CNIC</label>
                    <input type="text" name="cnic" class="form-control" placeholder="CNIC Number dont include -">
                    <p class="text-danger"><?php if (isset($errors['cnic'])) echo $errors['cnic']?></p>
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
            <button type="submit" name="Register" class="btn btn-md" id="button">Register</button>
        </form>
    </div>
    </div>
    </div>
</body>

</html>