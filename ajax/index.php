<?php
session_start();
include 'db.php';




?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Shop</title>
</head>

<body>



    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">SHOPEE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php?page_layout=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">Detail</a>
                </li>
            </ul>
        </div>







        <?php if (isset($_SESSION['username']) || isset($_SESSION['user_name'])) {
        ?>
            <span class="text-success">Xin Chao: </span>
            <span class="text-danger mr-5"> <?php
           if(!empty($_SESSION['username'])){
            echo $_SESSION['username'] ;
           }
           if(!empty($_SESSION['user_name'])){
            echo $_SESSION['user_name'];
           }
            
            
             ?> </span>
            <a href="logout.php" class="btn btn-success my-lg-0">
                Logout
            </a>
        <?php } else {
        ?>
            <a href="login.php" class="btn btn-success my-lg-0 mr-3">
                Login
            </a>
            <a class="btn btn-success my-lg-0">
                Register
            </a>
        <?php } ?>

    </nav>

         












    <?php
    if (isset($_SESSION['username']) && $_SESSION['position'] === '1') {
        require_once 'admin.php';
    }
    if (isset($_SESSION['username']) && $_SESSION['position'] === '0') {
        require_once 'View.php';
    }
    //neu login bang fb 
    if(isset($_SESSION['user_name'])){
        require_once 'View.php';
    }
    ?>



<?php

if (isset($_GET['page_layout'])) {
    switch ($_GET['page_layout']) {
        case 'home':
            require_once 'home.php';
            break;
        default:
            require_once 'index.php';
            break;
    }
}

?>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>