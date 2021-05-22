<?php

if (!isset($_SESSION)) {
    session_start();
}
if(!isset($_SESSION['username'])){
    header("location:index.php");
}
include 'db.php';


$email = $_POST["email"];
$username = $_POST["username"];
$birthday = $_POST['birthday'];
$job = $_POST['job'];
$countries = $_POST['countries'];
$gender = $_POST['gender'];
$password = $_POST['password'];

$position = 1;
$active = 1;
$code = uniqid(true);
$password_hash = password_hash($password, PASSWORD_DEFAULT);


//sql xu li email
$sql_email = "select * from acount where email='$email'";
$query_email = mysqli_query($conn, $sql_email);

//sql xu li username
$sql_username = "select * from acount where username='$username'";
$query_username = mysqli_query($conn, $sql_username);
//
if ($row = mysqli_fetch_assoc($query_email)) {
    if ($email === $row['email']) {
        echo "email_err";
        exit();
    }
}
if ($row_username = mysqli_fetch_assoc($query_username)) {
    if ($username === $row_username['username']) {
        echo "user_err";
        exit();
    }
}

$sql_insert = "INSERT INTO acount(email,avatar,birthday,job,countries,gender,username,password,code,position,active) 
        values ('$email','','$birthday','$job','$countries','$gender','$username','$password_hash','$code','$position','$active')";
mysqli_query($conn, $sql_insert);
echo "ok";
