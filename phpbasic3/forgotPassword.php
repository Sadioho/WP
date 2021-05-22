<?php

include "db.php";

if (!isset($_GET["code"])) {
    exit("Can't find page 1");
}

$code = $_GET["code"];

$getEmailQuery = mysqli_query($conn, "select email from acount where code='$code'");

$pass_err = "";
$pass_repeat_err="";
$success = "";


if (mysqli_num_rows($getEmailQuery) == 0) {
    exit("<p style='color:red'>Can't find page 2</p>");
}

if (isset($_POST["forgot"])) {
    $pass = $_POST['password'];
    $r_pass=$_POST['repeatpassword'];

    if (empty($_POST['password']) || empty($_POST['repeatpassword'])) {
        if(empty($_POST['password'])){
            $pass_err = "Không được để trống";

        }
        if(empty($_POST['repeatpassword'])){
            $pass_repeat_err = "Không được để trống";

        }

    } else{
        if (strlen($pass) < 5) {
            $pass_err = "Mật khẩu phải lớn hơn 6 ký tự!";
        }
        if (strlen($r_pass) < 5) {
            $pass_repeat_err = "Mật khẩu phải lớn hơn 6 ký tự!";
        }elseif($pass!=$r_pass){
            $pass_repeat_err = "Mật khẩu không khớp !";
        }
    }
  

    
    


    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

    //ket noi reset
    $row = mysqli_fetch_array($getEmailQuery);
    $email = $row['email'];
    $code = uniqid(true);
    $sql_demo = "select * from acount where email='$email'";
    $query_demo = mysqli_query($conn, $sql_demo);

    if (empty($pass_err) && empty($pass_repeat_err)) {
        if ($row_demo = mysqli_fetch_array($query_demo)) {
            mysqli_query($conn, "update acount SET password='$pass_hash' where email='$email'");
            mysqli_query($conn, "update acount SET code='$code' where email='$email'");
            // exit("password update");
            $success="Success Forget Password";
        } else {
            exit("Somthing went wrong!");
        }
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
    <title>Forgot Password</title>
</head>

<body>


    <div class="container mt-5">

        <div class="row">
            <div class="col-sm-6 m-auto ">
                <form method="POST" class="col-sm-12 border p-4">
                    <h3 class="text-center">Nhập mật khẩu mới</h3>
                    <label >Nhập mật khẩu</label>
                    <input class="col-sm-12 form-control" type="password" name="password" placeholder="Enter password">
                    <p class="text-danger"><?php echo $pass_err; ?></p>

                    <label >Nhập lại mật khẩu</label>
                    <input class="col-sm-12 form-control" type="password" name="repeatpassword" placeholder="Enter repeat password">
                    <p class="text-danger"><?php echo $pass_repeat_err; ?></p>

                    <p class="text-success"><?php echo $success; ?></p>
                    <button class="btn btn-success col-sm-12 mt-2" type="submit" name="forgot">Gữi</button>
                    <?php if(!empty($success)){ ?>
                        <a href="index.php?page=login">Đăng nhập</a>

                    <?php } ?>
                </form>
                
            </div>


        </div>
    </div>

    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


</body>

</html>