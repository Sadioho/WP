

<div class="container-fluid mt-5">
    <div class="row">

        <ul class="list-group col-sm-2 mt-5">
            <li class="list-group-item active">Menu</li>
            <li class="list-group-item"><a href="index.php?page=profile" class="text-success">
                    Chi tiết
                </a></li>

    <?php if(!isset($_SESSION['user_name'])){
     ?>
                <li class="list-group-item"><a href="index.php?page=changepass" class="text-success">
                    Đổi mật khẩu
                </a></li>
           
        </ul>
<?php }; ?>

        <?php

        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'profile':
                    require_once 'profile.php';
                    break;
                case 'changepass':
                    require_once 'changepass_admin.php';
                    break;
                default:
                    require_once 'index.php';
                    break;
            }
        }

        ?>




    </div>

</div>