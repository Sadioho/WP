<?php 
    session_start();
    include 'db.php';
    // print_r($_FILES);
    $id=$_SESSION['id'];
    // echo $id;
   $target="img/".basename($_FILES['image']['name']);
//    echo $target;
   //ĐUÔI
   $ext=pathinfo($target,PATHINFO_EXTENSION);
//    echo $ext;

   if($ext!="jpg" && $ext!="jpeg" && $ext!="png"){
       echo "Only JPG and PNG files are allowed!";
      
   }elseif($_FILES['image']['size']>2097152){
       echo "File size too big!";
       
   }elseif(file_exists($target)){
       echo "File is already uploaded";
      
   }elseif(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
       $sql_img="update acount set avatar='$target' where id='$id'";
       $query_img=mysqli_query($conn,$sql_img);
       echo "File uploaded successfully!";
     
   }else{
       echo "Failed to upload!";
     
   }
?>