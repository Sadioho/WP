<?php 




    // $localhost='localhost';
    // $dbname='anhhx';
    // $dbusername='anhhx';
    // $dbpass='vfftech123';



    $localhost='localhost';
    $dbname='crud';
    $dbusername='root';
    $dbpass='';

    $conn=mysqli_connect($localhost,$dbusername,$dbpass,$dbname);
    mysqli_set_charset($conn, 'utf8');


?>