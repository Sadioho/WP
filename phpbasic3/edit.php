<?php 

    session_start();
    include 'db.php';
    if(isset($_POST['edit_id'])){
        $id=$_POST['edit_id'];
        $sql_select="select * from acount where id='$id'";
        $query_select=mysqli_query($conn,$sql_select);
        $row=mysqli_fetch_assoc($query_select);
        echo json_encode($row);

    }
?>