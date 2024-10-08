<?php

require '../Connection/config.php';

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
    header('location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome <?php echo $_SESSION['hosname']. $_SESSION['hosemail']. $_SESSION['hoscnic'] . $_SESSION['hosadd'] . $_SESSION['hosnum']?></h1>
    <a href="logout.php" id="logout">Log Out</a>
    

    <!-- <script>
        let logoout =document.querySelector("#logout");
        logoout.addEventListener('click', ()=>{
   
                // session_unset();
                // session_destroy();
                // header('location: login.php');
                // // exit;
                // 
        })
    </script> -->
</body>
</html>