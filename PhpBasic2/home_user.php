<?php
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['username'] == '') {
    header('location:index.php?page=login');
}


?>


Trang nguoi dung