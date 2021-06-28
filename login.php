<?php
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     include 'partials/_dbconnect.php';
     $username = $_POST["username"];
     $password = $_POST["password"];


     // $sql = "Select * from users where username='$username' AND password='$password'";
     $sql = "Select * from users where username='$username'";
     $result = mysqli_query($conn, $sql);
     $num = mysqli_num_rows($result);
     
     if ($num == 1) {
          while ($row = mysqli_fetch_assoc($result)) {
               if (password_verify($password, $row['password'])) {
                    $login = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    header("location: userpages/welcome.php");
               } else {
                    $showError = "Password dosen't match";
               }
          }
     } else {
          $showError = "Invalid Credentials.";
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
     <title>Login</title>
</head>

<body>
     <?php require "partials/_indexnav.php" ?>
     <div class="container col-xl-10 col-xxl-8 px-4 py-5">
          <?php
          if ($login) {
               echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
          }
          if ($showError) {
               echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Error! </strong>' . $showError . '
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div> ';
          }
          ?>
          <div class="row align-items-center g-lg-5 py-5">
               <div class="col-lg-6 text-center text-lg-start">
                    <h1 class=" fs-3 fw-bolder mb-4">Vertically centered hero sign-up form</h1>
                    <p class="fs-4">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
               </div>
               <div class="col-md-10 mx-auto col-lg-5 ">
                    <form class="p-4 p-md-5 border rounded-3 shadow-sm bg-light" action="login.php" method="post">
                         <div class="mb-3">
                              <input type="username" class="form-control" placeholder="Enter Username" name="username">

                         </div>
                         <div class=" mb-3">

                              <input type="password" class="form-control" placeholder="Password" name="password">

                         </div>
                         <div class="checkbox mb-3">
                              <label>
                                   <input type="checkbox" value="remember-me"> Remember me
                              </label>
                         </div>
                         <button class="w-100 btn btn-lg btn-dark" type="submit">Login</button>
                         <hr class="my-4">
                         <p class="text-center">By clicking Sign up, you agree to the terms of use.</p>
                    </form>
               </div>
          </div>
     </div>


     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>