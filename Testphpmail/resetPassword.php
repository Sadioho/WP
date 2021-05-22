

<?php 
include "connection.php";
if(!isset($_GET["code"])){
    exit("Can't find page");
}

$code=$_GET["code"];

$getEmailQuery=mysqli_query($mysqli,"select email from resetpasswords where code='$code'");


if(mysqli_num_rows($getEmailQuery)==0){
    exit("Can't find page");
}



if(isset($_POST["update"])){
    $pass=$_POST['password'];
    $pass_hash=password_hash($pass,PASSWORD_DEFAULT);

    //ket noi reset
    $row=mysqli_fetch_array($getEmailQuery);
    $email=$row['email'];
    $sql_demo="select * from acount";
    $query_demo=mysqli_query($mysqli,$sql_demo);

    if($row_demo=mysqli_fetch_array($query_demo)){
        if($email=$row_demo['email']){
          mysqli_query($mysqli,"update acount SET password='$pass_hash'");
        //   mysqli_query($mysqli,"delete from resetpasswords where code='$code'");
          exit("password update");
        }else{
            exit("Somthing went wrong!");
        }
    }

}




?>







<form  method="POST">
    <input type="password" name="password" placeholder="Enter password">
    <input type="submit" name="update">
</form>