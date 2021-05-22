
<?php

if (!isset($_SESSION)) {
    session_start();
}
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql_login = "select * from acount where username='$username' or email='$username' ";
$query_login = mysqli_query($conn, $sql_login);

// Nếu thông tin đăng nhập chính xác, trả về giá trị là 1
if ($username != ''  && $password != '') {
    if ($row_login = mysqli_fetch_assoc($query_login)) {
        $checkpass = password_verify($password, $row_login['password']);
    
        if (($username === $row_login['username'] || $username === $row_login['email']) && $checkpass && $row_login['active']==='1') {
            $_SESSION['username'] = $row_login['username'];
            $_SESSION['position'] = $row_login['position'];
            $_SESSION['id'] = $row_login['id'];
            echo 1;
            
        }
    }
}
