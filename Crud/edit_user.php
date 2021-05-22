<?php
session_start();
include 'connection.php';

$id = $_GET['id'];
$sql_edit = "select * from acount where id='$id'";
$query_edit = mysqli_query($mysqli, $sql_edit);
$row_edit = mysqli_fetch_assoc($query_edit);

if (!isset($_SESSION['username']) && $_SESSION['position'] != '0' ) {
    header('location:login.php');
}
    

if (isset($_POST['save'])) {
    $id_up=$row_edit['id'];

    // echo "save";
    if ($_FILES['img']['name'] == '') {
        $avatar = $row_edit['avatar'];
        // echo "avatar cu";
    } else {
        $avatar_tmp = $_FILES['img']['tmp_name'];
        $avatar = $_FILES['img']['name'];
        move_uploaded_file($avatar_tmp, 'img/' . $avatar);     
        // echo "avatar new";
    }

    //check email update
    $edit_email = $_POST['email'];
    if ($edit_email == $row_edit['email']) {
        $edit_email = $row_edit['email'];
        // echo "Email giu nguyen";
    } else {
        $sql_haha = "select * from acount where email ='$edit_email'";
        $queryhaha = mysqli_query($mysqli, $sql_haha);
        if (mysqli_num_rows($queryhaha) > 0) {
            // echo "Email da ton tai";
            $erros['email'] = "Email da ton tai ";
        } else {
            $edit_email = $_POST['email'];
            // echo "Chinh sua email thanh cong";
        }
    }


    $job = $_POST['job'];
    $countries = $_POST['countries'];
    $gender = $_POST['radio'];
    $birthday=$_POST['birthday'];



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
      gender='$gender'
      where id='$id_up'
      ");

      $erros['editsuccess']="Edit thanh cong!";
     header('Refresh:1');
    
      


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
    <title>Detail</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container-fluid">
        <h1 class="text-center">Detail</h1>
        <div class="card m-auto" style="width: 18rem;">
            <img class="card-img-top" src="./img/<?php echo $row_edit['avatar'] ?>" alt="Card image cap">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label class="form-label">Avatar New</label>
                        <input type="file" name="img" class="form-control">

                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?php echo $row_edit['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Day of birth</label>
                        <input type="date" name="birthday" class="form-control" max='2004-01-01' value="<?php echo $row_edit['birthday'] ?>">
                    </div>

                    <div class="form-group">
                        <label>Job</label>
                        <input type="job" name="job" class="form-control" placeholder="Enter job" value="<?php echo $row_edit['job'] ?>">
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
                            <input class="form-check-input" type="radio" name="radio" value="Female" id="flexRadioDefault2" 
                            <?php
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

                    <p style="color: red;">
                        <?php if (!empty($erros['errcharacter']))
                            echo $erros['errcharacter']; ?>
                    </p>
                    <p style="color: green;">
                        <?php if (!empty($erros['editsuccess'])) {
                            echo  $erros['editsuccess'];
                        } ?>
                    </p>
                    <a class="btn btn-primary" href="home.php">Quay lai</a>
                    <button type="submit" name="save" class="btn btn-success">Save</button>
                </form>


            </div>

        </div>





    </div>








    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


</body>

</html>