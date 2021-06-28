<?php
session_start();
include "../partials/_dbconnect.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
     header("location: login.php");
     exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

     $username = $_SESSION['username'];
     $dec = $_POST['dec'];
     $files = $_FILES["file"];

     $filename = $files['name'];
     $fileerror = $files['error'];
     $filetmp = $files['tmp_name'];

     $fileext = explode('.', $filename);
     $filecheck = strtolower(end($fileext));

     $fileextstored = array('png', 'jpg', 'jpeg');

     if (in_array($filecheck, $fileextstored)) {
          $destinationfile = '../imgupload/upload' . $filename;
          move_uploaded_file($filetmp, $destinationfile);
          $sql = "INSERT INTO `userupload`(`username`, `image`, `dec`) VALUES ('$username', '$destinationfile', '$dec')";
          $query = mysqli_query($conn, $sql);
     }
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
               <div class="py-5 text-center">

                    <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
               </div>

               <div class="row g-5">
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
                    <div class="col-md-7 col-lg-8">
                         <h4 class="mx-3">Post Your ArtWork</h4>

                         <form action="welcome.php" method="post" enctype="multipart/form-data">
                              <div class="form-group p-3">
                                   <input type="file" class="form-control" id="file" name="file">
                              </div>
                              <div class="form-floating m-3">
                                   <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="dec"></textarea>
                                   <label for="floatingTextarea2">Add Description</label>
                              </div>
                              <button type="submit" class="btn btn-dark mx-3 ">Upload</button>
                         </form>
                    </div>
               </div>
          </main>

          <main>

               <section class="py-5 text-center container">
                    <div class="row py-lg-5">
                         <div class="col-lg-6 col-md-8 mx-auto">
                              <h1 class="fw-light">Explore Artwork</h1>
                              <p class="lead text-muted">Click on cards to know more about artwork</p>
                         </div>
                    </div>
               </section>
               <div class="album py-5 bg-transparent">

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 ">

                         <?php
                         $count = 0;
                         while ($row = mysqli_fetch_array($result)) {
                              echo "
                                   <div class='col'>
                         <div class='card'>
                         <img src='", $row['image'], "' class='card-img-top w-30 shadow-sm p-3' data-bs-toggle='modal' data-bs-target='#exampleModal-$count' >
                         </div>
                         <div class='modal fade' id='exampleModal-$count' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                              <div class='modal-dialog modal-dialog-centered'>
                                   <div class='col'>
                                        <div class='card shadow-sm rounded-3'>
                                        <div class='card-header'>",
                              $row['username'],
                              "</div>
                                             <img src='", $row['image'], "' class='card-img-top'/>
                                             <div class='card-body' >",
                              $row['dec'],
                              "</div>
                                        </div>
                                   </div>
                              </div>
                       </div>  </div>";
                              $count++;
                         } ?>


                    </div>
               </div>
          </main>


          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>