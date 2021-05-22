<?php 
session_start();
include 'db.php';

if(isset($_SESSION['position'])){
    $checkposition=$_SESSION['position'];
}else{
    $checkposition=null;
}

$email=$_POST['email'];
$birthday=$_POST['birthday'];
$job=$_POST['job'];
$countries=$_POST['countries'];
$gender=$_POST['gender'];
$username=$_POST['username'];
$password=$_POST['password'];
//trạng thái để xem đã bị xóa hay chưa 
$active=1;
//tạo cái code để forgot pass qua email
$code=uniqid(true);

//mã hóa password
$password_hash=password_hash($password,PASSWORD_DEFAULT);

//kiểm tra thêm tài khoản admin=1 hay là user=0
if($checkposition==='1'){
    $position=1;
}else{
    $position=0;
}

//sql xu li email
    $sql_email="select * from acount where email='$email'";
    $query_email=mysqli_query($conn,$sql_email);

//sql xu li username
    $sql_username="select * from acount where username='$username'";
    $query_username=mysqli_query($conn,$sql_username);
//

    if(!empty($email) && !empty($birthday) && !empty($job) && !empty($countries) && !empty($gender)&& !empty($username) && !empty($password)){
        //kiem tra trung email
        if($row=mysqli_fetch_assoc($query_email)){
            if($email===$row['email']){
                echo "email_err";
                exit();
            }
        }
        if($row_username=mysqli_fetch_assoc($query_username)){
            if($username===$row_username['username']){
                echo "user_err";
                exit();
            }
        }
        $sql_insert = "INSERT INTO acount(email,avatar,birthday,job,countries,gender,username,password,code,position,active) 
        values ('$email','','$birthday','$job','$countries','$gender','$username','$password_hash','$code','$position','$active')";
         mysqli_query($conn, $sql_insert);

        echo "true";
    }else{
       echo "false";
    }

?>