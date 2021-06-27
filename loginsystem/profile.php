<?php
session_start();
include "../partials/_dbconnect.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
     header("location: login.php");
     exit;
}
$username = $_SESSION['username'];

$sql = "Select * from `userupload` where username='$username'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);


?>
<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <title>Welcome - <?php echo  $username ?> </title>
</head>

<body>
     <?php require '../partials/_nav.php' ?>

     <div class="container my-3">
          <div class="alert alert-success" role="alert">
               <h4 class="alert-heading">Welcome - <?php echo $username ?></h4>
               <p>Hey how are you doing? Welcome to iSecure. You are logged in as <?php echo $_SESSION['username'] ?>. Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
               <hr>
               <p class="mb-0">Whenever you need to, be sure to logout <a href="/loginsystem/logout.php"> using this link.</a></p>
          </div>
     </div>
     <div class="album py-5 bg-transparent">
          <div class="container ">

               <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 ">
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                         echo "
                         <img src='", $row['image'], "' class='img-fluid img-thumbnail w-25' data-bs-toggle='modal' data-bs-target='#exampleModal' width='200'>
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
                       </div>";
                    } ?>

                    <!-- Optional JavaScript -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>