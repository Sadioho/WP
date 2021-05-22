<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:index.php");
}
include 'db.php';
$id = $_SESSION['id'];
$currentpass = $_POST['currentpass'];
$newpass = $_POST['newpass'];

$hash_newpass = password_hash($newpass, PASSWORD_DEFAULT);

//truy van
$sql_pass = "select * from acount where id=$id";
$query_pass = mysqli_query($conn, $sql_pass);
$row_pass = mysqli_fetch_assoc($query_pass);

$checkpass = password_verify($currentpass, $row_pass['password']);


$checkpassnew = password_verify($currentpass, $hash_newpass);

if ($checkpass == $checkpassnew) {
    echo "false2";
} else {
    if ($checkpass == 1) {
        $sql_change = "update acount set password='$hash_newpass' where id='$id'";
        $query_change = mysqli_query($conn, $sql_change);
        echo "true";
    } else {
        echo "false";
    }
}
