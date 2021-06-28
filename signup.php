<?php
$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     include 'partials/_dbconnect.php';

     $username = $_POST["username"];
     $password = $_POST["password"];
     $cpassword = $_POST["cpassword"];
     // $exists=false;

     // Check whether this username exists
     $existSql = "SELECT * FROM `users` WHERE username = '$username'";
     $result = mysqli_query($conn, $existSql);
     $numExistRows = mysqli_num_rows($result);
     if ($numExistRows > 0) {
          // $exists = true;
          $showError = "Username Already Exists";
     } else {
          // $exists = false; 
          if (($password == $cpassword)) {
               $hash = password_hash($password, PASSWORD_DEFAULT);
               $sql = "INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
               $result = mysqli_query($conn, $sql);
               if ($result) {
                    $showAlert = true;
               }
          } else {
               $showError = "Passwords do not match";
          }
     }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="./css/index.css">
     <title>SignUp</title>
</head>

<body>
     <?php require 'partials/_indexnav.php' ?>

     <div class="container col-xl-10 col-xxl-8 px-4 py-5">
          <div class="row align-items-center g-lg-5 py-5">
               <div class="col-lg-6 text-center text-lg-start">
                    <h1 class=" fs-3 fw-bolder mb-4">Vertically centered hero sign-up form</h1>
                    <p class="fs-4">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
               </div>
               <div class="col-md-10 mx-auto col-lg-5">
                    <?php
                    if ($showAlert) {
                         echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
                    }
                    if ($showError) {
                         echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
                    }
                    ?>
                    <form class="p-4 p-md-5 border rounded-3 bg-light shadow-sm" action="signup.php" method="post">
                         <div class=" mb-3">
                              <input type="text" class="form-control" placeholder="Enter Username" name="username">

                         </div>
                         <div class="mb-3">
                              <input type="password" class="form-control" placeholder="Password" name="password">

                         </div>
                         <div class="mb-3">
                              <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword">

                         </div>
                         <button class="w-100 btn btn-lg btn-dark" type="submit">Sign Up</button>
                         <hr class="my-4">
                         <p class="text-center">By clicking Sign up, you agree to the terms of use.</p>
                    </form>
               </div>
          </div>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>