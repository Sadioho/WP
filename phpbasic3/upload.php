<?php 
    session_start(); 
    include 'db.php';
    if(!isset($_SESSION['username'])){
        header("location:index.php");
    }

    $id=$_SESSION['id'];

    //tách đuôi ảnh tên ảnh
    $linkimg_source = explode(".", $_FILES['image']['name']);
 
    //định dạng lại tên ảnh
    $linkimg_format = 'IMG-' . time() . '.' . end($linkimg_source);
    
   //ĐUÔI
   $ext=pathinfo($linkimg_format,PATHINFO_EXTENSION);
//    echo $ext;

   if($ext!="jpg" && $ext!="jpeg" && $ext!="png"){
       echo "Only JPG and PNG files are allowed!";
      
   }elseif($_FILES['image']['size']>2097152){
       echo "File size too big!";
       
   }elseif(file_exists($linkimg_format)){
       echo "File is already uploaded";
      
   }elseif(move_uploaded_file($_FILES['image']['tmp_name'],'img/' .$linkimg_format)){
       $sql_img="update acount set avatar='$linkimg_format' where id='$id'";
       $query_img=mysqli_query($conn,$sql_img);
       echo "1";
   
     
   }else{
       echo "Failed to upload!";
     
   }
?>