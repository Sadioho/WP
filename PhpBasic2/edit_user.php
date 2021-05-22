<?php 
include 'connection.php';

$email_err = "";
$success = "";
$fail = "";
$job_err = "";
$countries_err = "";


    if (!isset($_SESSION)) {
        session_start();
    }
    if (empty($_SESSION['username']) && empty($_SESSION['position'])) {
        header('location:index.php?page=home');
    }elseif($_SESSION['position']==='1'){
        header('location:index.php');
    }

    if(isset($_SESSION['id'])){
        $id=$_SESSION['id'];
        $sql_edit="select * from acount where id='$id'";
        $query_edit=mysqli_query($mysqli,$sql_edit);
        $row_edit=mysqli_fetch_assoc($query_edit);
    }

    if(isset($_POST['edit'])){

            $email_edit=$_POST['email'];
            $birthday_edit=$_POST['birthday'];
            $job_edit=$_POST['job'];
            $countries_edit=$_POST['countries'];
            $radio_edit=$_POST['radio'];

           if( $email_edit === $row_edit['email'] 
           && $birthday_edit === $row_edit['birthday']
           && $job_edit === $row_edit['job'] 
           && $countries_edit === $row_edit['countries']
           && $radio_edit === $row_edit['gender']
           
           ){
            $fail= "  <p class='text-danger ml-4 alert alert-danger'>Bạn chưa thay đổi gì hết !</p>  ";
           }

           //check email

           if($email_edit === $row_edit['email'] ){
            $email_edit = $row_edit['email'];
           }else{
            $sql_email="select * from acount where email ='$email_edit'";
            $query_email=mysqli_query($mysqli,$sql_email);
            if(mysqli_num_rows($query_email)>0){
                // echo "trung email";
                $email_err="Email Này đã tồn tại!";
            }else{
                // $success= "Chỉnh sửa thành công! ";
                $email_edit=$_POST['email'];
            }
           }

           if (!filter_var($email_edit, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Email vừa rồi bạn nhập không hợp lệ !";
        }

            if(empty($job_edit) || empty($countries_edit)){
                if(empty($job_edit)){
                    $job_err="Bạn không được để trống !";
                }
                if(empty($countries_edit)){
                    $countries_err="Bạn không được để trống !";
                }
            }

           if(empty($email_err) && empty($fail) && empty($job_err) && empty($countries_err)){
            mysqli_query($mysqli, 
            "update acount SET 
            email='$email_edit' ,
            birthday='$birthday_edit',
            job='$job_edit',
            countries='$countries_edit',
            gender='$radio_edit'
            where id='$id'
            ");
            $success=" <p class='ml-4 text-success alert alert-success '>Bạn đã chỉnh sửa thành công !</p> ";
            header("Refresh:2");
           }

    }

?>

<div class=" col-sm-12 col-xl-6 m-auto row border p-2">
<form class=" d-flex flex-wrap " novalidate method="POST" enctype="multipart/form-data">
    <h3 class="text-center col-sm-12 mb-4">Chỉnh sửa</h3>
    <div class="col-sm-6">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $row_edit['email'] ?>">
            <p class="text-danger"><?php echo $email_err ?></p>

        </div>
        <div class="mb-3">
            <label class="form-label">BirthDay</label>
            <input type="date" name="birthday" max="2003-01-01" class="form-control" value="<?php echo $row_edit['birthday'] ?>">
            

        </div>
        <div class="mb-3">
            <label class="form-label">Job</label>
            <input type="text" name="job" class="form-control" placeholder="Enter Job" value="<?php echo $row_edit['job'] ?>">
            <p class="text-danger"><?php echo $job_err ?></p>
      

        </div>

        <div class="mb-3 ">
            <label class="form-label">Countries</label>
            <label class="form-label">countries</label>
            <input type="text" name="countries" class="form-control" placeholder="Enter countries" value="<?php echo $row_edit['countries'] ?>">
            <p class="text-danger"><?php echo $countries_err ?></p>
       

        </div>
    </div>
    <div class=" col-sm-6 ">

        <div class=" mb-3">
            <label class="form-label">Gender</label>

            <div class="form-check">
                <input class="form-check-input " type="radio" name="radio" value="Male" checked>
                <label class="form-check-label">
                    Male
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input " type="radio" name="radio" value="Female" <?php
                                                                                            if ($row_edit['gender'] === 'Female') {
                                                                                                echo "checked";
                                                                                            }
                                                                                            ?>>
                <label class="form-check-label">
                    Female
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input " type="radio" name="radio" value="Bisexuality"  <?php
                                                                                            if ($row_edit['gender'] === 'Bisexuality') {
                                                                                                echo "checked";
                                                                                            }
                                                                                            ?>>
                <label class="form-check-label">
                    Bisexuality
                </label>
            </div>


        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?php echo $row_edit['username'] ?>" readonly>
         

        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Password" value="<?php echo $row_edit['password'] ?>" readonly>
          

        </div>

    </div>
   
    <?php echo $success ?>
    <?php echo $fail ?>
  
    <button type="submit" class="btn btn-success m-auto col-sm-6 " name="edit">Lưu lại</button>
</form>
</div>
