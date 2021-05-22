<?php 
session_start();
include 'connection.php';
$username="";
if (isset($_SESSION['username'])) {
  $usernames=$_SESSION['username'];
$username="<p class='nav-item' style='color:green'> 
 
<a class='nav-link' href='#'>Username : " . $_SESSION['username'] . "
</a>
</p> 
<a class='btn btn-success' href='logout.php'>Logout</a>";

} else{
  header('location:login.php');
}

//load
    $sql_select="select * from acount where username='$usernames'";
    $query_select=mysqli_query($mysqli,$sql_select);
    $row_select=mysqli_fetch_assoc($query_select);
   


?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <title>LOGIN</title>
</head>

<body>



  <div class='container-fluid'>

    <nav class='navbar navbar-expand-lg navbar-light bg-light'>
      <a class='navbar-brand' href='#'>Trang sản phẩm</a>
      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>

      <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <ul class='navbar-nav mr-auto'>
          <li class='nav-item active'>
            <a class='nav-link' href='#'>Home <span class='sr-only'>(current)</span></a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href="edit_user.php?id=<?php echo $row_select['id']?>">Profile</a>
          </li>
          <li class='nav-item'>
          <?php if($_SESSION['position']==='0'){

        ?>
            <a class='nav-link' href="edit_pass_user.php?id=<?php echo $row_select['id']?>"  >Đổi mật khẩu</a>
         <?php } ?>
          </li>
        </ul>
        <?php echo $username;?>
      

      </div>
    </nav>


  </div>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


</body>

</html>