<?php 
session_start();
include 'db.php';

if(isset($_SESSION['position'])){
    $checkposition=$_SESSION['position'];
}else{
    $checkposition=null;
}

$id=$_POST['id'];
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


$sql_edit="select * from acount where id='$id'";
$query_edit=mysqli_query($conn,$sql_edit);
$row_edit=mysqli_fetch_assoc($query_edit);

//sql xu li email
    $sql_email="select * from acount where email='$email'";
    $query_email=mysqli_query($conn,$sql_email);

    if(!empty($email) && !empty($birthday) && !empty($job) && !empty($countries) && !empty($gender)&& !empty($username) && !empty($password)){
        //kiem tra trung email
        if($email==$row_edit['email']){
            $email=$row_edit['email'];
            // echo "Email giu nguyen";
        }else {
            $sql_email="select * from acount where email='$email'";
            $query_email=mysqli_query($conn,$sql_email);
            if(mysqli_num_rows($query_email)>0){
                echo "email_err";
                exit();
            }
            else{
                $email=$_POST['email'];
            }
        }
        $sql_insert = "update acount SET 
        email='$email',
        birthday='$birthday',
        job='$job',
        countries='$countries',
        gender='$gender'
        where id='$id'
        ";
         mysqli_query($conn, $sql_insert);

        echo "true";
    }else{
       echo "false";
    }

?>