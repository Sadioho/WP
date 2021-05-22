<?php
require_once 'db.php';
$db = new Database();

if (isset($_POST['action']) && $_POST['action'] == 'view') {
    $output = '';
    $data = $db->read();
    if ($db->totalRowCount() > 0) {
        $output .= '
            <table class="table table-striped table-sm table-bordered">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>E-Mail</th>
                    <th>Phone</th>
                    <th>Aciton</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($data as $row) {
            $output .= '  <tr class="text-center text-secondary">
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['first_name'] . '</td>
                    <td>' . $row['last_name'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['phone'] . '</td>
                    <td>
                    <a href="#" title="View Detail" class="text-success">
                        <i class="fas fa-info-circle"></i>
                    </a>
                    <a href="#" title="Delete" class="text-danger">
                        <i class="fas fa-eraser"></i>
                    </a>
                    <a href="#" title="Edit" class="text-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                </tr>';     
        }
        $output .= '</tbody>
        </table>';
    echo $output;
    } else {
        echo '<h3 class="text-center text-secondary mt-5"> :( NO any user present in the database! </h3>';
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'insert'){
    $fname=$_POST['first_name'];
    $lname=$_POST['last_name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $db->insert($fname,$lname,$email,$phone);

 
}




?>