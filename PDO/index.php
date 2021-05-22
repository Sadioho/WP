<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <title>Document</title>
</head>

<body>


    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#"><i class="fas fa-dog"></i> Xanh</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center text-danger font-weight-normal my-3">
                    CRUD App PHP-OOP, PDO-MySQL, Ajax
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-log-6">
                <h4 class="mt-2 text-primary">All users in database!</h4>
            </div>
            <div class="col-log-6">
                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#addModal"><i class="fas fa-user-plus"></i> Add new user</button>
                <a href="#" class="btn btn-success "><i class="fas fa-file-excel"></i> Excel</a>
            </div>
        </div>

        <hr class='my-1'>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" id="showUser">

                </div>
            </div>
        </div>


    </div>

    <!-- modal -->

    <!-- The Modal -->
    <div class="modal" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Users</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" id="form-data">
                        <div class="form-group">
                            <label>Firt Name</label>
                            <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" required>

                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required>

                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" required>

                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="number" min="0" name="phone" class="form-control" placeholder="Enter Phone" required>

                        </div>
                        <div class="form-group">

                            <input type="submit" name="insert" id="insert" value="Add User" class="btn btn-success btn-block">

                        </div>

                    </form>
                </div>




            </div>
        </div>
    </div>

    <!-- end modal -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>
    <!-- jQuery library -->

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            showAllUsers();
            //ajax
            function showAllUsers() {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        action: "view"
                    },
                    success: function(response) {
                        $("#showUser").html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                })
            }

            $("#insert").click(function(e) {
                if ($("#form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#form-data").serialize() + "&action=insert",
                        success: function(response) {
                            // console.log(response);
                            Swal.fire({
                                icon: 'success',
                                title: 'Your work has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            })

                            $("#addModal").modal('hide');
                            $("#form-data")[0].reset();
                            showAllUsers();
                        }
                    })
                }
            })
        });
    </script>
</body>

</html>