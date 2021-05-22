<?php 
    session_start();
    include 'db.php';
    $id=$_SESSION['id'];
    $currentpass=$_POST['currentpass'];
    $newpass=$_POST['newpass'];

    $hash_newpass=password_hash($newpass,PASSWORD_DEFAULT);

    //truy van
    $sql_pass="select * from acount where id=$id";
    $query_pass=mysqli_query($conn,$sql_pass);
    $row_pass=mysqli_fetch_assoc($query_pass);

    $checkpass=password_verify($currentpass,$row_pass['password']);

    if($checkpass){
        $sql_change="update acount set password='$hash_newpass' where id='$id'";
        $query_change=mysqli_query($conn,$sql_change);
        echo "Password changed successfully";
    }else{
        echo "The current password is not correct";
    }
