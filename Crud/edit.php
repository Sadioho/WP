<?php
session_start();
include 'connection.php';

 

$id = $_GET['id'];

$sql_edit="select * from acount where id='$id'";
$query_edit=mysqli_query($mysqli,$sql_edit);
$row_edit=mysqli_fetch_assoc($query_edit);

if (isset($_POST['edit'])) {
    //check email update
    $id_up=$row_edit['id'];
    $edit_email = $_POST['email'];
    if($edit_email==$row_edit['email']){
        $edit_email=$row_edit['email'];
        // echo "Email giu nguyen";
    }else {
        $sql_haha="select * from acount where email ='$edit_email'";
        $queryhaha=mysqli_query($mysqli,$sql_haha);
        if(mysqli_num_rows($queryhaha)>0){
            // echo "Email da ton tai";
            $erros['email']="Email da ton tai ";
        }
        else{
            $edit_email=$_POST['email'];
            // echo "Chinh sua email thanh cong";
        }
    }

//check avatar
    if($_FILES['img']['name']==''){
        $avatar=$row_edit['avatar'];
    }else{
        $avatar_tmp = $_FILES['img']['tmp_name'];
        $avatar = $_FILES['img']['name'];
        move_uploaded_file($avatar_tmp, 'img/' . $avatar);     
         
    }
//check date update
    //ngày nhập vào
    $birthday = $_POST['editbirthday'];
    $datenow= date("Y-m-d"); 
    $datetime1 = date_create($birthday);
    $datetime2 = date_create($datenow);
    $interval = date_diff($datetime1, $datetime2);
    $check_date_edit= (int) $interval->format('%y');

    if($check_date_edit<15){
        //bằng lại ngày trong db
        $birthday = $row_edit['birthday'];
        // echo "Chỉnh sửa ngày sinh không thành công!";
        // $erros['birthday']="Chỉnh sửa ngày sinh thất bại";
    }else{
        $birthday=$_POST['editbirthday'];
        // echo "chỉnh sửa ngày sinh thành công";
    }
     $job = $_POST['job'];
     $countries = $_POST['countries'];
     $gender = $_POST['radio'];

//check username
    $edit_username = $_POST['username'];
    if($edit_username==$row_edit['username']){
        $edit_username=$row_edit['username'];
        // echo "Giữ nguyên username cũ";
    }else {
        $sql_username="select * from acount where username ='$edit_username'";
        $query_username=mysqli_query($mysqli,$sql_username);
        if(mysqli_num_rows($query_username)>0){
            // echo "Username da ton tai";
            $erros['username']="Username da ton tai";
        }
        else
        {
        $edit_username=$_POST['username'];
        // echo "đã thay đổi username thành công";
        } 
    }
   //check password
     $password = $_POST['password'];
    if($password==$row_edit['password']){
        $password=$row_edit['password'];
        // echo "Pass giu nguyen";
    }else{
        // echo "pass duoc thay doi";
        $password_up=password_hash($password, PASSWORD_DEFAULT);
         $password=$password_up;
    
    }

    

    if(isset($erros['username']) ||isset($erros['email'])  ){
        $erros['errcharacter']="username or email da ton tai!";
    }else{
      mysqli_query($mysqli, 
      "update acount SET 
      email='$edit_email' ,
      avatar='$avatar',
      birthday='$birthday',
      job='$job',
      countries='$countries',
      gender='$gender',
      username='$edit_username',
      password='$password'
      where id='$id_up'
      ");
      $erros['editsuccess']="Edit thanh cong!";
      header('location:home.php');


    }

}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>LOGIN</title>
</head>

<body>

    <h1 class="mt-5 text-center">EDIT</h1>
    <div class="col-sm-6 m-auto">
        <form class="mt-5" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $row_edit['email']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Avatar</label>
                <input type="file" name="img" class="form-control">
                <?php if (isset($erros['img'])) { ?>
                    <i style="color:red"><?php echo $erros['img']; ?></i>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label class="form-label">EditBirthDay</label>
                <input type="date" name="editbirthday" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">BirthDay</label>
                <input type="text" name="birthday" class="form-control"  value="<?php echo $row_edit['birthday']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Job</label>
                <input type="text" name="job" class="form-control" placeholder="Enter Job" value="<?php echo $row_edit['job'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Countries</label>
                <select class="form-select" aria-label="Default select example" name="countries">
                    <option value="0">Countries</option>
                    <option value="USA" <?php if ($row_edit['countries'] === "USA") {
                                            echo "selected";
                                        } ?>>USA</option>
                    <option value="China" <?php if ($row_edit['countries'] === "China") {
                                                echo "selected";
                                            } ?>>China</option>
                    <option value="England" <?php if ($row_edit['countries'] === "England") {
                                                echo "selected";
                                            } ?>>England</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio" value="Male" id="flexRadioDefault1" checked>
                    <label class="form-check-label">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio" value="Female" id="flexRadioDefault2" <?php
                                                                                                                    if ($row_edit['gender'] === 'Female') {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                    ?>>
                    <label class="form-check-label">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio" value="Bisexuality" id="flexRadioDefault2" <?php if ($row_edit['gender'] === 'Bisexuality') {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                    <label class="form-check-label">
                        Bisexuality
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?php echo $row_edit['username']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $row_edit['password'] ?>">
            </div>
           
            <p style="color: red;">
                <?php if (!empty($erros['errcharacter']))
                    echo $erros['errcharacter']; ?>
            </p>
            <p style="color: green;">
                <?php if (!empty($erros['editsuccess']) ) {
                        echo  $erros['editsuccess'];

                } ?>
            </p>
            <button type="submit" class="btn btn-success" name="edit">Update</button>

        </form>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


</body>

</html>