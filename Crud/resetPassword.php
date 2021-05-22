<?php

include "connection.php";



if (!isset($_GET["code"])) {
  exit("Can't find page 1");
}

$code = $_GET["code"];

$getEmailQuery = mysqli_query($mysqli, "select email from acount where code='$code'");


if (mysqli_num_rows($getEmailQuery) == 0) {
  exit("Can't find page 2");
}



if (isset($_POST["update"])) {
  $pass = $_POST['password'];
  $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

  //ket noi reset
  $row = mysqli_fetch_array($getEmailQuery);
  $email = $row['email'];
  $code = uniqid(true);
  $sql_demo = "select * from acount where email='$email'";
  $query_demo = mysqli_query($mysqli, $sql_demo);

  if ($row_demo = mysqli_fetch_array($query_demo)) {
      mysqli_query($mysqli, "update acount SET password='$pass_hash' where email='$email'");
      mysqli_query($mysqli, "update acount SET code='$code' where email='$email'");
      echo $row_demo['email'];
      exit("password update");
  } else {
    exit("Somthing went wrong!");
  }
}




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


  <div class="container">
    <div class="row">
      <div class="col-sm-6 m-auto">
        <form method="POST">
          <input type="password" name="password" placeholder="Enter password">
          <input class="btn btn-success" type="submit" name="update">
        </form>

      </div>
    </div>

  </div>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


</body>

</html>