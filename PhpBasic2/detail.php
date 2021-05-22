<?php
include 'connection.php';
$img_err = "";
$img_succ = "";
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['username'] == '') {
    header('location:index.php?page=login');
}
if (isset($_POST['upload'])) {
    $id = $_SESSION['id'];
    $avatar_tmp = $_FILES['image']['tmp_name'];

    //tách đuôi ảnh tên ảnh
    $linkimg_source = explode(".", $_FILES['image']['name']);
    //định dạng lại tên ảnh
    $linkimg_format = 'IMG-' . rand(1, 99999) . '.' . end($linkimg_source);

    //kiểm tra nếu mà không chọn ảnh
    if ($linkimg_source[0] == '') {
        $img_err = "Bạn phải chọn ảnh!";
    }
    //Trùng thì random tên lại
    $sql_select = "select * from acount";
    $query_img = mysqli_query($mysqli, $sql_select);
    while ($row_img = mysqli_fetch_assoc($query_img)) {
        if ($linkimg_format === $row_img['avatar']) {
            $linkimg_format = 'IMG-' . rand(1, 99999) . '.' . end($linkimg_source);
        }
    }

    // check img
    if ($_FILES['image']['name']) {
        if (($_FILES['image']['size'] <= (1024 * 1024))
            && ($_FILES['image']['type'] == "image/jpeg")
            || ($_FILES['image']['type'] == "image/png")
            || ($_FILES['image']['type'] == "image/jpg")
        ) {
            move_uploaded_file($avatar_tmp, 'img/' . $linkimg_format);
        } else {
            $img_err = "File img <1MB format jpeg,png,jpg";
        }
    }


    if (empty($img_err)) {
        $sql_img = "update acount set avatar='$linkimg_format' where id='$id'";
        $query_img = mysqli_query($mysqli, $sql_img);
        $img_succ = "Cập nhập avatar thành công !";
    }
}

if (isset($_SESSION['username'])) {
    $id = $_SESSION['id'];
    $sql_detail = "select * from acount where id='$id'";
    $query_detail = mysqli_query($mysqli, $sql_detail);
    $row = mysqli_fetch_assoc($query_detail);
?>












    <div class="col-sm-6 m-auto">
        <h1 class="text-center text-success">Chi tiết</h1>
        <div class="card m-auto" style="width: 20rem;">
            <img class="card-img-top" src="./img/<?php echo $row['avatar'] ?>" alt="Card image cap">

            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" id="upload-box">
                    <div class="form-group">
                        <label>Cập nhật ảnh đại diện</label>
                        <input type="file" id='file' name="image" class="form-control-file">
                        <button type="submit" id="upload" name="upload" class='mt-1 btn btn-success'>Cập nhật</button>
                    </div>
                    <p class="text-danger"><?php echo $img_err; ?></p>
                    <p class="text-success"><?php echo $img_succ; ?></p>
                </form>
                <h5 class="card-title">Username : <?php echo $row['username']; ?> </h5>
                <p class="text-info">Email: <span class="text-dark"> <?php echo $row['email']; ?></span> </p>
                <p class="text-info">BirthDay: <span class="text-dark"> <?php echo $row['birthday']; ?></span> </p>
                <p class="text-info">Job: <span class="text-dark"> <?php echo $row['job']; ?></span> </p>
                <p class="text-info">Countries: <span class="text-dark"> <?php echo $row['countries']; ?></span> </p>
                <p class="text-info">Gender: <span class="text-dark"> <?php echo $row['gender']; ?></span> </p>





            </div>
        </div>
    </div>



<?php } ?>