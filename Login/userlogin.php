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
    <?php
    session_start();
    require '../Connection/config.php';
    if (isset($_POST['submit'])) {
        $text = $_POST['text'];
        $pass = $_POST['pass'];


        // Validating USer
        $sql = "SELECT * FROM `users` WHERE Email_id = '$text' AND Users_Password = '$pass' ";
        $uservalidate = mysqli_query($con, $sql);





        // Admin Login
        if ($text == "admin@gmail.com" && $pass == "admin123") {
            // Set session for admin
            $_SESSION['loggedin'] = true;
            $_SESSION['role']= "admin";
            $_SESSION['username'] = "Admin";  // Set admin name
            $_SESSION['useremail'] = "admin@gmail.com";  // Store admin Email
            $_SESSION['usercnic'] = "42201-4631523-1";  // Store admin CNIC
            $_SESSION['useradd'] = "49th Street University Place, Washington(WA),";  // Store admin Address
            $_SESSION['usernum'] = "(253) 851-4256";  // Store admin Number

            // Redirect to Admin page
            header('Location: ../Admin/index.php');
            exit();  // Stop script execution after redirect
        }
        // Admin Login

        $userdata = mysqli_fetch_assoc($uservalidate);

        if ($uservalidate) {
            $unum = mysqli_num_rows($uservalidate);

            if ($unum == 1) {
                // Fetch user details
                // Fetch Name column

                // Set session variables
                $_SESSION['loggedin'] = true;
                $_SESSION['role']= "user";
                $_SESSION['userid'] = $userdata['id'];  // Store id
                $_SESSION['username'] = $userdata['Users_Name'];  // Store Name
                $_SESSION['useremail'] = $userdata['Email_id'];  // Store Email
                $_SESSION['usercnic'] =  $userdata['Users_CNIC'];  // Store CNIC
                $_SESSION['useradd'] = $userdata['Uses_Address'];  // Store Address
                $_SESSION['usernum'] =$userdata['Users_Number'];  // Store Number (Phone)

                // Redirect to wel.php
                header('Location: ../Admin/userprofile.php');
                exit();  // Stop script execution after redirect
            } else {
                // Invalid login
                echo "Login failed. Invalid credentials.";
            }

            // Check if it's an admin login

        } else {
            // Handle query failure
            echo "Error in query: " . mysqli_error($con);
        }
    }
    ?>


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="logo">
                    <img src="../img/Untitled design.png" alt="">
                </div>
                <form action="userlogin.php" method="POST" id="contact-form">
                    <h1 class="h1">User Login</h1>
                    <div class="mb-3 d-flex">
                        <img src="../img/icons8-user-24.png" alt="" style="width:30px; height:30px;">
                        <input type="email" class="form-control" name="text" placeholder="Enter your email" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    <div class="mb-3 d-flex">
                        <img src="../img/icons8-lock-25.png" alt="" style="width:30px; height:30px;">
                        <input type="password" class="form-control" name="pass" placeholder="Password" id="exampleInputPassword1">
                    </div>
                    <input name="submit" type="submit" class="btn mt-2" id="button">
                    <a href="p_register.php" class="btn btn-md mt-2" id="button">Registered as Parent</a>

                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>