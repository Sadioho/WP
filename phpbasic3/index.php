<?php
include 'db.php';
session_start();
?>


<!doctype html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />

    <title>AJAX</title>
</head>

<body>

    <div class='container-fluid'>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">AJAX</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?page=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="index.php?page=contact">Contact</a>
                    </li>
                    <?php if (isset($_SESSION['username']) && $_SESSION['position'] === '1') {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link " href="index.php?page=manage">Manage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="index.php?page=profile">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="index.php?page=passwordchange">PassWord Change</a>
                        </li>
                    <?php } ?>



                    <?php if (isset($_SESSION['username']) && $_SESSION['position'] === '0') {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link " href="index.php?page=profile">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="index.php?page=passwordchange">PassWord Change</a>
                        </li>
                    <?php } ?>




                </ul>
                <?php if (isset($_SESSION['username'])) { ?>
                    <p class=" text-info m-0 mr-3">Xin Chào <?php echo $_SESSION['username'] ?> </p>
                    <a href="logout.php" class="btn btn-info mr-4">Đăng xuất</a>

                <?php } else { ?>

                    <a href="index.php?page=login" class="btn btn-success mr-4">Đăng Nhập</a>
                <?php  } ?>
            </div>
        </nav>
        <div class="row">
            <div class="col-sm-12 m-auto">

                <?php
                if (isset($_GET['page'])) {
                    switch ($_GET['page']) {
                        case 'about':
                            require_once './view/about.php';
                            break;
                        case 'contact':
                            require_once './view/contact.php';
                            break;
                        case 'login':
                            if (isset($_SESSION['username'])) {
                                require_once './view/home.php';
                                break;
                            } else {
                                require_once './view/login.php';
                                break;
                            }
                            break;
                        case 'manage':
                            require_once './page/manage.php';
                            break;

                        case 'profile':
                            require_once './page/profile.php';
                            break;
                        case 'passwordchange':
                            require_once './page/password_change.php';
                            break;


                        default:
                            require_once './view/home.php';
                            break;
                    }
                } else {
                    require_once './view/home.php';
                }
                ?>
            </div>
        </div>
    </div>








    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


</body>

</html>