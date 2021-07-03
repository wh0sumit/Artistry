<?php
session_start();
include "../partials/_dbconnect.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
     header("location: login.php");
     exit;
}
$notempty = false;
if (isset($_POST['btn1'])) {

     $searchname = $_POST['name'];
     if ($searchname != "") {
          $notempty = true;
          $sql = "Select * from users where username='$searchname'";
          $result_1 = mysqli_query($conn, $sql);
          $num_1 = mysqli_num_rows($result_1);

          if ($num_1 == 1) {
               $_SESSION['searchname'] = $searchname;
               $searchnameAlert = true;
          } else {
               $showError = "No such user.";
          }
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
               <div class="row g-5 ">
                    <div class="col-md-5 col-lg-4 order-md-last">
                         <h4 class="d-flex justify-content-between align-items-center ">
                              <span class="mt-5">Find Artists</span>
                              <!-- <span class="badge bg-primary rounded-pill">3</span> -->
                         </h4>
                         <form class="card p-2" action="posts.php" method="post" name="form-1">

                              <div class="input-group">
                                   <input type="text" class="form-control" placeholder="Serch UserName" name="name">
                                   <button type="submit" class="btn btn-1" name="btn1">Search</button>
                              </div>
                         </form>
                         <?php if ($notempty) {
                              while ($row_1 = mysqli_fetch_array($result_1)) {
                                   echo "
                                   <ul class='list-group my-3'>
                                   <a class='my-0 text-decoration-none' href='userpage.php'>
                                        <li class='list-group-item d-flex justify-content-between lh-sm my-2 rounded-3'>
                                        ", $row_1['username'], "
                                        </li>
                                   </a>
                              </ul>";
                              }
                         } ?>

                    </div>
                    <div class="col-md-6 col-lg-8">
                         <h4 class="my-5 text-decoration-underline">Recents Posts</h4>
                         <?php
                         while ($row = mysqli_fetch_array($result)) {
                              echo "<div class='card mb-3'>
                              <div class='card-header p-3 fw-bold bg-dark text-light'>", $row['username'], "</div>
                              <div class='card-body p-0'>
                              <img src='", $row['image'], "' class='card-img-top p-3'>
                              <div class='card-footer bg-dark text-light'>   
                                   <p class='card-text mx-2'>",
                              $row['dec'], "</p>

                                   <p class='card-text mx-2'><small class='text-muted'>",
                              $row['dt'], "</small></p>
                              </div>
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