<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
 <?php 
 include_once '../Connection/config.php';
    $query = "SELECT * FROM `avail_vaccines`";
    $validate = mysqli_query($con , $query);

    
    

    while ($r = mysqli_fetch_assoc($validate)) {
        # code...
        $Vac_id =  $r['Vac_id'];
        $Hosp_id =  $r['Hosp_Name'];
        
        $hospquery = "SELECT * FROM `hospital` WHERE id = $Hosp_id";
        $hospvalid = mysqli_query($con , $hospquery);
        $h = mysqli_fetch_assoc($hospvalid);
        
        $vacquery = "SELECT * FROM `vaccines` WHERE Vac_id = $Vac_id";
        $vacvalid = mysqli_query($con , $vacquery);
        $v = mysqli_fetch_assoc($vacvalid);
 ?>
 
 
 <div class="card m-4" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><?php  echo $h['Hospital_Name']?></h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
    <p class="card-text"><?php echo $v['Vaccine_Name']?></p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>
<?php }?>
</body>
</html>