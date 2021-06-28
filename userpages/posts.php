<?php
session_start();
include "../partials/_dbconnect.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
     header("location: login.php");
     exit;
}

$display = "SELECT * FROM userupload ORDER BY id DESC";
$result = mysqli_query($conn, $display);
$num = mysqli_num_rows($result);


?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="css/user.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <title>Welcome - <?php echo $_SESSION['username'] ?></title>
</head>

<body class="bg-light">
     <?php require '../partials/_nav.php' ?>
     <div class="container">
          <main>
               <div class="row g-5 fixed ">
                    <div class="col-md-5 col-lg-4 order-md-last">
                         <h4 class="d-flex justify-content-between align-items-center mb-3">
                              <span>Find Artists</span>
                              <!-- <span class="badge bg-primary rounded-pill">3</span> -->
                         </h4>
                         <form class="card p-2">
                              <div class="input-group">
                                   <input type="text" class="form-control" placeholder="Serch Name">
                                   <button type="submit" class="btn btn-1">Search</button>
                              </div>
                         </form>
                         <!-- <ul class="list-group mb-3">
                              <li class="list-group-item d-flex justify-content-between lh-sm">
                                   <div>
                                        <h6 class="my-0">Product name</h6>
                                   </div>
                                   <span class="text-muted">$12</span>
                              </li>
                         </ul> -->
                    </div>
                    <div class="col-md-6 col-lg-8">
                         <h4 class="my-5 text-decoration-underline">Recents Posts</h4>
                         <?php
                         while ($row = mysqli_fetch_array($result)) {
                              echo "<div class='card mb-3'>
                              <div class='card-header p-3 fw-bold'>", $row['username'], "</div>
                              <div class='card-body'>
                              <img src='", $row['image'], "' class='card-img-top p-3'>
                              <div class='d-flex my-3'>
                              <i class='far fa-heart fs-3 mx-2'></i>
                              <i class='far fa-comment fs-3 mx-2'></i>
                              </div>    
                                   <p class='card-text mx-2'>",
                              $row['dec'], "</p>

                                   <p class='card-text mx-2'><small class='text-muted'>",
                              $row['dt'], "</small></p>
                              </div>
                         </div>";
                         }
                         ?>
                    </div>

               </div>
          </main>

          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>