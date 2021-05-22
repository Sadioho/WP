<?php



?>




<?php
session_start();
include 'connection.php';
$id=$_GET['id'];

//load
$sql_select = "select * from acount where id='$id'";
$query_select = mysqli_query($mysqli, $sql_select);
$row_select = mysqli_fetch_assoc($query_select);

if(isset($_POST['editPass'])){
    $password=$_POST['password'];
    echo $password;
    echo "<br/>";
    $password1=$_POST['password1'];
    $password2=$_POST['password2'];
    $checkpass=password_verify($password,$row_select['password']);

    if($password1!=$password2 || $password1=='' || $password2==''){
        $err_pass='Khong duoc de trong , Nhap lai dung mat khau moi';
        echo 'Khong duoc de trong , Nhap lai dung mat khau moi';
    }else{
       $password=password_hash($password1,PASSWORD_DEFAULT);
       if($checkpass){
        mysqli_query($mysqli, "update acount SET password='$password' where id='$id'");
        echo $password;
        echo "update duoc";
        $err_pass='Doi pass thanh cong!';
    }else{
        $err_pass='Nhap pass hien tai sai!';
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
    <title>Update pass</title>
</head>

<body>



    <div class='container-fluid'>
        <h1 class="text-center">Đổi mật khẩu</h1>
        <form method="POST" class="col-sm-3 m-auto">
            <div class="form-group">
                <label for="exampleInputPassword1">Old Password</label>
                <input type="password"  class="form-control" name="password" placeholder="enter old password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">New Password </label>
                <input type="password"  class="form-control" name="password1"  placeholder="Enter New Password ">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password Repeat</label>
                <input type="password"  class="form-control" name="password2"  placeholder="Enter Password Repeat">
            </div>
            <?php
                if(isset($err_pass)){
                   ?> 
                <p style="color: green;"> <?php echo $err_pass;?>  </p>

            <?php }?>
            <a href="sanpham.php" class="btn btn-primary">Quay lại</a>
            <button type="submit" name="editPass" class="btn btn-success">Lưu lại</button>
        </form>
    </div>

    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


</body>

</html>