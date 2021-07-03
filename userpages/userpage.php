<?php
session_start();
include "../partials/_dbconnect.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
     header("location: login.php");
     exit;
}

$searchname = $_SESSION['searchname'];

$usersql = "SELECT * from `userupload` where username='$searchname'";
$userresult = mysqli_query($conn, $usersql);
$usernum = mysqli_num_rows($userresult);


?>

<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="./css/user.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <title>Welcome - <?php echo  $searchname ?> </title>
</head>

<body class="bg-light">
     <?php require '../partials/_nav.php' ?>


     <div class="album py-5 ">
          <div class="bg-dark text-light my-4 rounded-3 p-5 m-5 ">
               <h4 class="alert-heading my-4 text-center"><?php echo ucfirst($searchname) ?> Artwork</h4>
               <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 ">
                    <?php
                    while ($row = mysqli_fetch_array($userresult)) {
                         echo "            <div class='col'>
                         <img src='", $row['image'], "' class='img-fluid p-3' data-bs-toggle='modal' data-bs-target='#exampleModal' >
                         <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                              <div class='modal-dialog modal-dialog-centered'>
                                   <div class='col'>
                                        <div class='card shadow-sm rounded-3'>
                                             <img src='", $row['image'], "' class='card-img-top'/>
                                             <div class='card-body bg-dark text-light rounded-3' >",
                         $row['dec'],
                         "</div>
                                        </div>
                                   </div>
                              </div>
                       </div>
                       
                       </div>";
                    } ?>
               </div>
          </div>


          <!-- Optional JavaScript -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>