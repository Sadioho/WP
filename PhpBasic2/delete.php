<?php 
include 'connection.php';
    if (!isset($_SESSION)) {
        session_start();
    }
    if (empty($_SESSION['username']) && empty($_SESSION['position'])) {
        header('location:index.php?page=home');
    }elseif($_SESSION['position']==='0'){
        header('location:index.php');
    }


    if(isset($_GET['id'])){
        $id=$_GET['id'];
        if($id===$_SESSION['id']){
            $_SESSION['err']="Bạn không thể xóa chính bạn";
            header('location:index.php?page=home');      
        }else{
            $sql_delete="Update acount set active=0 where id='$id'";
            $query_delete=mysqli_query($mysqli,$sql_delete);
            $_SESSION['succ']="Xoá thành công!";
            header('location:index.php?page=home');
        }

       
    }
    



?>