<?php
session_start();
include "../partials/_dbconnect.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
     header("location: login.php");
     exit;
}

$username = $_SESSION['username'];

$insert = false;
$update = false;

$sql = "SELECT * from `userupload` where username='$username'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {


     $fname = $_POST["fname"];
     $lname = $_POST["lname"];

     $editsql = "SELECT * from `userprofile` WHERE 'username' = '$username'";
     $editresult = mysqli_query($conn, $editsql);
     $editnum = mysqli_num_rows($editresult);

     if ($editnum >= 0) {
          $updatesql = "UPDATE `userprofile` SET `username`='$username',`fname`='$fname',`lname`='$lname' WHERE 'username'= '$username'";
          $updateresult = mysqli_query($conn, $updatesql);

          if ($updateresult) {
               $update = true;
          }
     } else {
          $insertsql = "INSERT INTO `userprofile` ( `username`, `fname`,`lname`,`dt`) VALUES ('$username', '$fname','$lname', current_timestamp())";
          $insertresult = mysqli_query($conn, $insertsql);
          if ($insertresult) {
               $insert = true;
          }
     }
}


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
     <title>Welcome - <?php echo  $username ?> </title>
</head>

<body class="bg-light">
     <?php require '../partials/_nav.php' ?>


     <div class="container">
          <main>
               <div class="p-5 text-center">
                    <h2>Edit Profile</h2>

                    <?php
                    if ($insert) {
                         echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Profile has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
                    }
                    ?>
                    <?php
                    if ($update) {
                         echo "<div class='alert alert-dark alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Profile has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
                    }
                    ?>
               </div>

               <div class="row g-5">
                    <div>
                         <form action="profile.php" class=" d-flex justify-content-center" method="post">
                              <div class="row g-3">
                                   <div class="col-sm-6">
                                        <label for="firstName" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="firstName" name="fname" required>
                                        <div class="invalid-feedback">
                                             Valid first name is required.
                                        </div>
                                   </div>

                                   <div class="col-sm-6">
                                        <label for="lastName" class="form-label">Last name</label>
                                        <input type="text" class="form-control" id="lastName" name="lname" required>
                                        <div class="invalid-feedback">
                                             Valid last name is required.
                                        </div>
                                   </div>

                                   <div class="col-12">
                                        <label for="username" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                             <span class="input-group-text">@</span>
                                             <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                             <div class="invalid-feedback">
                                                  Your username is required.
                                             </div>
                                        </div>
                                   </div>
                                   <button class=" btn btn-dark btn-lg" type="submit">Save Changes</button>
                         </form>
                    </div>
               </div>
          </main>
          <div class="album py-5 ">
               <div class="container bg-dark text-light my-4 rounded-3 p-5 ">
                    <h4 class="alert-heading my-4 text-center">Your Artwork</h4>
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
                    </div>
               </div>
          </div>

          <!-- Optional JavaScript -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>