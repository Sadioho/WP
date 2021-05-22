<?php

if(isset($_SESSION['username'])){




$id = $_SESSION['id'];
$sql_detail = "select * from acount where id='$id'";
$query_detail = mysqli_query($conn, $sql_detail);
$row = mysqli_fetch_assoc($query_detail);
?>

<div class="col-sm-9">
    <h1 class="text-center text-success">Chi tiết</h1>
    <div class="card m-auto" style="width: 20rem;">
        <img class="card-img-top" src="<?php echo $row['avatar'] ?>" alt="Card image cap">

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" id="upload-box">
                <div class="form-group">
                    <label>Cập nhật ảnh đại diện</label>
                    <input type="file" id='file' name="image" class="form-control-file">
                    <button type="submit" id="upload" class='mt-1 btn btn-success'>Cập nhật</button>
                </div>
                <p class="text-success" id="succ"></p>
                <!-- <p class="text-danger" id="fail"></p> -->
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
<script>
    $(document).ready(function() {

        $("#upload-box").submit(function(e) {
            e.preventDefault();
            // console.log("hahahaa");
            $.ajax({
                url: 'upload.php',
                method: 'post',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#succ").html(response);
                    
                }
            })
        })


    })
</script>

<?php } else{  ?>



<div class="col-sm-9">
    <h1 class="text-center text-success">Chi tiết</h1>
    <div class="card m-auto" style="width: 20rem;">
        <img class="card-img-top" src="<?php echo $_SESSION["user_image"] ?>" alt="Card image cap">

        <div class="card-body">
            <h5 class="card-title">Username : <?php echo $_SESSION['user_name']; ?> </h5>
            <p class="text-info">Email: <span class="text-dark"> <?php echo $_SESSION['user_email_address']; ?></span> </p>
            <p class="text-info">BirthDay: <span class="text-dark"> <?php echo $_SESSION['birthday']; ?></span> </p>
            <p class="text-info">Countries: <span class="text-dark"> <?php echo $_SESSION['location']; ?></span> </p>
            <p class="text-info">Gender: <span class="text-dark"> <?php echo $_SESSION['user_gender']; ?></span> </p>
        </div>
    </div>
</div>

<?php } ?>


  

