<?php
session_start();
include 'connection.php'; 
$err = "";
$mess = "";
$email = "";
$avatar = "";
$birthday = "";
$job = "";
$countries = "";
$username = "";
$gender = "";
if(isset($_SESSION['position'])){
    $checkposition=$_SESSION['position'];
}else{
    $checkposition=null;
}

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $avatar_tmp = $_FILES['img']['tmp_name'];
    $avatar = $_FILES['img']['name'];
    // check img
    if($_FILES['img']['name']){
        if(($_FILES['img']['size'] <= (1024 * 1024)) 
            && ($_FILES['img']['type'] == "image/jpeg") 
            || ($_FILES['img']['type'] == "image/png") 
            || ($_FILES['img']['type'] == "image/jpg"))
            {
            move_uploaded_file($avatar_tmp, 'img/' . $avatar);     
            }else{
                $erros['img']="File img <1MB format jpeg,png,jpg";
            }
    }
//check date

    //ngày nhập vô
    $birthday = $_POST['birthday'];
    //ngày hiện tại
    $datenow= date("Y-m-d"); 
    $datetime1 = date_create($birthday);
    $datetime2 = date_create($datenow);
    $interval = date_diff($datetime1, $datetime2);
    $checkdate=(int) $interval->format('%y');
    if($checkdate<15){
        $birthday = '';
        $erros['errcharacter'] = "Vui lòng chọn đúng ngày sinh";
    }else{
        $birthday = $_POST['birthday'];
    }

    $job = $_POST['job'];
    $countries = $_POST['countries'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $code=uniqid(true);
    $active=0;
    if($checkposition==='1'){
        $position=1;
   }else{
        $position=0;
    }
    //ma hoa pass
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $gender = $_POST['radio'];

    //check ki tu dat biet
    if (!preg_match("/^[a-zA-Z -]*$/", $username) || !preg_match("/^[a-zA-Z -]*$/", $job)) {
        $erros['errcharacter'] = "Job and Username not contains special characters ";
    }

    //kiem tra user name va email trung
    $sql_username = "Select * from acount where email='$email' or username='$username'";
    $query = mysqli_query($mysqli, $sql_username);


    if (empty($email) || empty($avatar)  || empty($job) || empty($countries) || empty($username) || empty($hashed_password) || empty($gender)) {
        $err = "All fields should be filled. Either one or many fields are empty.";
    } elseif ($row = mysqli_fetch_array($query)) { 
        if ($username == $row['username'] || $email == $row['email']) {
            $erros['errcharacter']="Email or Username da ton tai";
        } 
    } 
    else {
        $sql = "INSERT INTO acount(email,avatar,birthday,job,countries,gender,username,password,code,position,active) 
            values ('$email','$avatar','$birthday','$job','$countries','$gender','$username','$hashed_password','$code','$position','$active')";
        mysqli_query($mysqli, $sql);
        $mess = "Register Success ";
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

    <h1 class="mt-5 text-center">REGISTER</h1>
    <div class="col-sm-6 m-auto">
        <form class="mt-5" method="POST" novalidate enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Avatar</label>
                <input type="file" name="img" class="form-control">
                <?php if (isset($erros['img'])) { ?>
                    <i style="color:red"><?php echo $erros['img']; ?></i>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label class="form-label">BirthDay</label>
                <input type="date" name="birthday" max="2002-01-01" class="form-control" value="<?php echo $birthday; ?>">
                <?php if (isset( $erros['date'])) { ?>
                    <i style="color:red"><?php echo  $erros['date']; ?></i>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Job</label>
                <input type="text" name="job" class="form-control" placeholder="Enter Job" value="<?php echo $job; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Countries</label>
                <select class="form-select" aria-label="Default select example" name="countries">
                    <option value="0">Countries</option>
                    <option value="USA" <?php if ($countries === "USA") {
                                            echo "selected";
                                        } ?>>USA</option>
                    <option value="China" <?php if ($countries === "China") {
                                                echo "selected";
                                            } ?>>China</option>
                    <option value="England" <?php if ($countries === "England") {
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
                                                                                                                    if ($gender === 'Female') {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                    ?>>
                    <label class="form-check-label">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio" value="Bisexuality" id="flexRadioDefault2" <?php if ($gender === 'Bisexuality') {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                    <label class="form-check-label">
                        Bisexuality
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?php echo $username; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <p style="color: red;">
                <?php echo $err; ?>
            </p>
            <p style="color: red;">
                <?php if (!empty($erros['errcharacter']))
                    echo $erros['errcharacter']; ?>
            </p>
            <p style="color: green;">
                <?php if (empty($erros['errcharacter']) && empty($err)) {
                    echo $mess;
                } ?>
            </p>
            <button type="submit" class="btn btn-success" name="register">Register</button>
           <?php 
            if($checkposition==='1') {
           ?>
            <a href="home.php" class="btn btn-primary">quay lai</a>
                <?php }
                
                else{
                    ?>
                    <a href="login.php" class="btn btn-primary">Login</a>
                    <?php }?>
        </form>

    </div>

 <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


</body>

</html>