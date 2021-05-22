<?php 
    session_start();
    include 'connection.php';
    $id=$_GET['id'];
     $active=1; 
    $sql="update acount set active='$active' where id='$id'";
    $query=mysqli_query($mysqli,$sql);
    header('location:home.php');


?>