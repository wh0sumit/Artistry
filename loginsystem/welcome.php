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
          $destinationfile = '../imgupload' . $filename;
          move_uploaded_file($filetmp, $destinationfile);
          $sql = "INSERT INTO `userupload`(`username`, `image`, `dec`) VALUES ('$username', '$destinationfile', '$dec')";
          $query = mysqli_query($conn, $sql);
     }
}

?>
<!doctype html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <title>Welcome - <?php $_SESSION['username'] ?></title>
</head>

<body>
     <?php require '../partials/_nav.php' ?>

     <div class="container my-3">
          <div class="alert alert-success" role="alert">
               <h4 class="alert-heading">Welcome - <?php echo $_SESSION['username'] ?></h4>
               <p>Hey how are you doing? Welcome to iSecure. You are logged in as <?php echo $_SESSION['username'] ?>. Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
               <hr>
               <p class="mb-0">Whenever you need to, be sure to logout <a href="/loginsystem/logout.php"> using this link.</a></p>
               <p class="mb-0">Profile<a href="profile.php"> Profile.</a></p>
          </div>
     </div>


     <div class="container my-4">

          <form action="welcome.php" method="post" enctype="multipart/form-data">
               <div class="form-group p-3">
                    <label for="file">file</label>
                    <input type="file" class="form-control" id="file" name="file">
               </div>
               <div class="form-group p-3">
                    <label for="dec">Description</label>
                    <textarea class="form-control" id="dec" name="dec"></textarea>
               </div>
               <button type="submit" class="btn btn-primary mx-3 ">Upload</button>
          </form>
     </div>
     <!-- Optional JavaScript -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>