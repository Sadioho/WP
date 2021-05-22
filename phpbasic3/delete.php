<?php 
    session_start();
    include 'db.php';
    if(isset($_POST['del_id'])){
        $id=$_POST['del_id'];
        if($_SESSION['id']===$id){
            echo "false";
            exit();
        }else{
            $sql_dlt="update acount set active='0' where id='$id'";
            $query_dlt=mysqli_query($conn,$sql_dlt);
            echo "true";
            exit();
        }
    }


?>