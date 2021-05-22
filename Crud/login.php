<?php
session_start();
include './connection.php';
$err['login']='';
if(isset($_POST['login'])){
    $username=mysqli_real_escape_string($mysqli, $_POST['username']);
    $password=mysqli_real_escape_string($mysqli, $_POST['password']);
    $sql_login="select * from acount where username='$username'";
    $query_login=mysqli_query($mysqli,$sql_login);

    if(empty($username)||empty($password)){
        $err['login']="Either username or password field is empty.";
    }elseif($row_login=mysqli_fetch_assoc($query_login)){
        // $row_login=mysqli_fetch_assoc($query_login);
            $checkpass=password_verify($password,$row_login['password']);
            // echo "Password trong db". $row_login['password'];
            if($username===$row_login['username'] && $checkpass){
                $_SESSION['username']=$row_login['username'];
                $_SESSION['id']=$row_login['id'];
                $_SESSION['position']=$row_login['position'];
               var_dump($row_login['position']);
               if($row_login['position']==='0'){
                header('location:sanpham.php');
               }else{
                   header('location:home.php');
               }

            }
            else{
                $err['login']="Username and Password does not exist";
 
            }
        }
        else{
            $err['login']="Account does not exist";
            
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

    <h1 class='mt-5 text-center'>LOGIN</h1>
    <div class='col-sm-4 m-auto'>
        <form class='mt-5' method='POST'>
            <div class='mb-3'>
                <label for='exampleInputEmail1' class='form-label'>Usename</label>
                <input type='text' class='form-control' name="username" placeholder="Enter Usename"
                value="<?php if(!empty($username))
                            { echo $username ;} 
                            ?>">
            </div>
            <div class='mb-3'>
                <label for='exampleInputPassword1' class='form-label'>Password</label>
                <input type='password' name='password' class='form-control' placeholder="Password" >
            </div>
            <p style="color: red;">
                <?php if(!empty($err['login']) ){
                    echo $err['login'];
                } ?>
            </p>
            <button type='submit' name='login' class='btn btn-primary'>Login</button>
            <a class='btn btn-success' href='register.php'>Register</a>
            <div> 
               <span>Forget Password ? </span> <a href="recovery_email.php">Click Here</a>
            </div>
            
        </form>

    </div>


  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


</body>

</html>