<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql_login = "select * from acount where username='$username' ";
$query_login = mysqli_query($conn, $sql_login);

// Nếu thông tin đăng nhập chính xác, trả về giá trị là 1
if ($username != ''  && $password != '') {
	if($row_login=mysqli_fetch_assoc($query_login)){
		$checkpass=password_verify($password,$row_login['password']);
		if($username===$row_login['username'] && $checkpass){
			$_SESSION['username']=$row_login['username'];
			$_SESSION['position']=$row_login['position'];
			$_SESSION['id']=$row_login['id']; 
			echo '1';
			exit();
		}else{
			echo '0';
			exit();
		}

	}

} 
	// echo "hahahaha";
