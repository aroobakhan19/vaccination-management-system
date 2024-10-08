<?php
require '../Connection/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if hospital ID is passed via POST
if (isset($_POST['hospitalId'])) {
    $hospitalId = $_POST['hospitalId'];

    // Fetch available vaccines for the selected hospital
    $vaccineQuery = "SELECT vaccines.Vac_id, vaccines.Vaccine_Name 
                     FROM avail_vaccines 
                     INNER JOIN vaccines ON avail_vaccines.Vac_id = vaccines.Vac_id 
                     WHERE avail_vaccines.Hosp_Name = '$hospitalId'";

    $vaccineResult = mysqli_query($con, $vaccineQuery);

    // Check if any vaccines are available
    if (mysqli_num_rows($vaccineResult) > 0) {
        echo '<option value="">Select a vaccine</option>';
        while ($vaccine = mysqli_fetch_assoc($vaccineResult)) {
            echo '<option value="' . $vaccine['Vac_id'] . '">' . $vaccine['Vaccine_Name'] . '</option>'; // Use Vac_id here
        }
    } else {
        echo '<option value="">No approved vaccines available</option>';
    }
}
?>
