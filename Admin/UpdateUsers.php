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
    $query = "SELECT * FROM users WHERE id = '$getid'";
    $validate = mysqli_query($con, $query);

    if (mysqli_num_rows($validate) > 0) {
        while ($value = mysqli_fetch_assoc($validate)) {
    ?>
            <form action=" " method="POST" class="container">

                <div class="mb-3">
                    <input class="form-control" type="hidden" name="editid" id="" value="<?PHP echo $value['id']; ?>"></p>
                    <label for="vac_title" class="form-label">User Name</label>
                    <input type="Text" name="user_name" value="<?php echo $value['Users_Name'] ?>" class="form-control" id="vac_title" placeholder="Vaccines Name">
                </div>
                <div class="mb-3">
                    <label for="txtarea" class="form-label">Vaccine Description</label>
                    <input type="Text" name="user_email" value="<?php echo $value['Email_id'] ?>" class="form-control" id="txtarea" placeholder="User Email">
                    
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
        $n = $_POST['user_name']; // User name
        $p = $_POST['user_email']; // User description

        // Debugging: Echo values to make sure they are being captured
        echo "ID: " . $i . "<br>";
        echo "Name: " . $n . "<br>";
        echo "Description: " . $p . "<br>";

        // Correct the SQL query with single quotes around string values
        $updatequery = "UPDATE `users` SET `Users_Name` = '$n', `Email_id` = '$p' WHERE `id` = $i";

        // Execute the query
        $validate = mysqli_query($con, $updatequery);

        // Check if the query was successful
        if ($validate) {
            header("location: usermanage.php");
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    }
    ?>

</body>

</html>