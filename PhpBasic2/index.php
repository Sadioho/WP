<?php
include 'connection.php';
if (!isset($_SESSION)) {
  session_start();
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <title>LOGIN</title>
</head>

<body>

  <div class='container-fluid'>

    <nav class='navbar navbar-expand-lg navbar-light bg-light'>
      <a class='navbar-brand' href='#'>Navbar</a>
      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>

      <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <?php if (empty($_SESSION['username'])) { ?>


          <ul class='navbar-nav mr-auto'>
            <li class='nav-item active'>
              <a class='nav-link' href='#'>Home</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='#'>About</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link ' href='#'>Contact</a>
            </li>
          </ul>
        <?php } else {
          $username = $_SESSION['username'];
          $sql_detail = "select * from acount where username='$username'";
          $query_detail = mysqli_query($mysqli, $sql_detail);
          $row_detail = mysqli_fetch_assoc($query_detail);

        ?>

          <ul class='navbar-nav mr-auto'>


            <?php if ($_SESSION['position'] === '1') { ?>
              <li class='nav-item active'>
                <a class='nav-link' href='index.php?page=home'>Quản lý nhân viên </a>
              </li>
              <li class='nav-item active'>

                <a class='nav-link' href='index.php?page=add_account'>Thêm nhân viên </a>
              </li>

            <?php } else { ?>
              <li class='nav-item active'>
                <a class='nav-link' href='index.php?page=home'>Home </a>
              </li>
              <li class='nav-item active'>
                <a class='nav-link' href='index.php?page=edit_user'>Chỉnh sửa </a>
              </li>
            <?php } ?>


            <li class='nav-item'>
              <a class='nav-link' href='index.php?page=detail&id=<?php echo $row_detail['id'] ?>'>Detail</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link ' href='index.php?page=change_pass'>Đổi mật khẩu</a>
            </li>
          </ul>

        <?php }
        if (isset($_SESSION['username'])) {
        ?>
          <p class='text-warning'> Hello: <?php echo $_SESSION["username"] ?> </p>
          <a class='btn btn-success mr-3' href='logout.php'>Đăng xuất</a>


        <?php } else { ?>

          <a class='btn btn-success mr-3' href='index.php?page=login'>Login</a>
          <a class='btn btn-success' href='index.php?page=register'>Register</a>
        <?php } ?>


      </div>
    </nav>

  </div>

  <div class="container-fluid">

    <div class="row">
      <div class="col-sm-12 m-auto">

        <?php
        if (isset($_GET['page'])) {
          switch ($_GET['page']) {
            case 'login':
              require_once 'check_login.php';
              break;
            case 'home':
              if (isset($_SESSION['username']) && $_SESSION['position'] === '0') {
                require_once 'home_user.php';
                break;
              }
              if (isset($_SESSION['username']) && $_SESSION['position'] === '1') {
                require_once 'home_admin.php';
                break;
              }
              break;
            case 'register':
              require_once 'check_register.php';
              break;

            case 'forgotpass':
              require_once 'forgot_password.php';
              break;
            case 'detail':
              if (isset($_SESSION['username'])) {
                require_once 'detail.php';
                break;
              }
              break;
            case 'change_pass':
              if (isset($_SESSION['username'])) {
                require_once 'change_pass.php';
                break;
              }
              break;
            case 'add_account':
              if (isset($_SESSION['username'])) {
                require_once 'add_account.php';
                break;
              }
              break;

              case 'edit_user':
                if (isset($_SESSION['username'])) {
                  require_once 'edit_user.php';
                  break;
                }
                break;

            default:
              require_once 'index.php';
              break;
          }
        }
        ?>

      </div>


    </div>
  </div>











  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


</body>

</html>