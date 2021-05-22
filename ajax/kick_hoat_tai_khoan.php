<?php 
    session_start();
    include 'db.php';
    $code=uniqid(true);
    $email= $_GET['email'];
    $username= $_GET['username'];
    $password= $_GET['password'];
    $password_hash=password_hash($password,PASSWORD_DEFAULT);
    $job= $_GET['job'];
    $countries= $_GET['countries'];
    $gender= $_GET['gender'];
    $birthday= $_GET['birthday'];
    $position=0;
    $active=1;

//sql xu li email
$sql_email="select * from acount where email='$email'";
$query_email=mysqli_query($conn,$sql_email);

//sql xu li username
$sql_username="select * from acount where username='$username'";
$query_username=mysqli_query($conn,$sql_username);
//

    if(!empty($email) && !empty($username)){
        if($row=mysqli_fetch_assoc($query_email)){
            if($email===$row['email']){
                echo "Bạn đã kích hoạt tài khoản rồi.";
                echo("<a href='login.php'class='text-center text-primary'>Trở lại trang đăng nhập</a>");
                exit();
            }
        }
        if($row_username=mysqli_fetch_assoc($query_username)){
            if($username===$row_username['username']){
                echo "Bạn đã kích hoạt tài khoản rồi.";
                exit();
            }
        }
        $sql_insert = "INSERT INTO acount(email,avatar,birthday,job,countries,gender,username,password,code,position,active) 
        values ('$email','','$birthday','$job','$countries','$gender','$username','$password_hash','$code','$position','$active')";
         mysqli_query($conn, $sql_insert);
         echo("<h1 class='text-center text-success'>Đăng ký tài khoản thành công</h1>");
         echo("<a href='login.php'class='text-center text-primary'>Trở lại trang đăng nhập</a>");
    }else{
        echo "Bạn đã kích hoạt tài khoản rồi.";
    }
   


  
    


?>

