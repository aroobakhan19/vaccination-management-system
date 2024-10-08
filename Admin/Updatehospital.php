<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <?PHP
    require '../Connection/config.php';
    $getid = $_GET['editid'];
    $query = "SELECT * FROM hospital WHERE id = '$getid'";
    $validate = mysqli_query($con, $query);

    if (mysqli_num_rows($validate) > 0) {
        while ($value = mysqli_fetch_assoc($validate)) {
    ?>
            <form action=" " method="POST" class="container">

                <div class="mb-3">
                    <input class="form-control" type="hidden" name="editid" id="" value="<?PHP echo $value['id']; ?>"></p>
                    <label for="Hospital_Name" class="form-label">hospital Name</label>
                    <input type="Text" name="Hospital_Name" value="<?php echo $value['Hospital_Name'] ?>" class="form-control" id="Hospital_Name" placeholder="Hospital Name">
                </div>
                <div class="mb-3">
                    <label for="txtarea" class="form-label">Hospital Email</label>
                    <input type="Text" name="Hospital_Email" value="<?php echo $value['Email_id'] ?>" class="form-control" id="txtarea" placeholder="Hospital Email">
                    
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Hospital Liscense</label>
                    <input type="Text" name="Hospital_LIC" value="<?php echo $value['Hospital_License'] ?>" class="form-control" id="mail" placeholder="Hospital LIC">
                    
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Hospital Number</label>
                    <input type="Text" name="Hospital_Number" value="<?php echo $value['Hospital_Number'] ?>" class="form-control" id="mail" placeholder="Hospital Number">
                    
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary btn-md" name="update">Update</button>
                </div>

            </form>
    <?PHP      }
    } ?>

    <?php
    if (isset($_POST['update'])) {
        // Fetching the values from the form
        $i = $_POST['editid'];   // Assume this is an integer (vaccine ID)
        $n = $_POST['Hospital_Name']; // User name
        $p = $_POST['Hospital_Email']; // User description
        $q = $_POST['Hospital_LIC']; // User description
        $r = $_POST['Hospital_Number']; // User description

        // Debugging: Echo values to make sure they are being captured
        echo "ID: " . $i . "<br>";
        echo "Name: " . $n . "<br>";
        echo "Description: " . $p . "<br>";

        // Correct the SQL query with single quotes around string values
        $updatequery = "UPDATE `hospital` SET  `Hospital_Name`='$n', `Hospital_License`='$q',`Email_id`='$p',  `Hospital_Number`='$r' WHERE `id` = $i";

        // Execute the query
        $validate = mysqli_query($con, $updatequery);

        // Check if the query was successful
        if ($validate) {
            header("location: userManagement.php");
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    }
    ?>

</body>

</html>