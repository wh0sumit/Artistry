<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <title>Index</title>
</head>

<body>
     <?php require 'partials/_indexnav.php' ?>
     <div class="container col-xxl-8 px-4 py-5">
          <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
               <div class="col-10 col-sm-8 col-lg-6">
                    <img src="./assets/hero.png" class="d-block mx-lg-auto img-fluid" alt="#" width="700" height="500" loading="lazy">
               </div>
               <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3">Want To Share Your Artwork ?</h1>
                    <p class="lead">So this is your chance to explore more about different art.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                         <a href="./loginsystem/login.php" class="btn btn-dark px-4 me-md-2">Login </a>
                         <a href="./loginsystem/signup.php" class="btn btn-outline-secondary px-4">Join Now</a>
                    </div>
               </div>
          </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>