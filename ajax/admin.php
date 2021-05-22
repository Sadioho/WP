
<div class="container-fluid mt-5">
    <div class="row">

        <ul class="list-group col-sm-2 mt-5">
            <li class="list-group-item active">Menu</li>
            <li class="list-group-item"><a href="index.php?page=list_user" class="text-success">
                    Danh Sách Nhân Viên
                </a></li>
            <li class="list-group-item"><a href="index.php?page=profile" class="text-success">
                    Chi tiết
                </a></li>
            <li class="list-group-item"><a href="index.php?page=changepass" class="text-success">
                    Đổi mật khẩu
                </a></li>
            <li class="list-group-item">Vestibulum at eros</li>
        </ul>


        <?php

        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'list_user':
                    require_once 'list_user.php';
                    break;
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