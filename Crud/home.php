<?php 
session_start();
include 'connection.php';
$username="";



if (isset($_SESSION['username']) && $_SESSION['position']==='1') {
$username="<p class='nav-item' style='color:green'> 
<a class='nav-link' href='#'>Username : " . $_SESSION['username'] . "
</a>
</p> 
<a class='btn btn-success' href='logout.php'>Logout</a>";

} else{
  header('location:sanpham.php');
}

//load
    $sql_select="select * from acount";
    $query_select=mysqli_query($mysqli,$sql_select);

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



  <div class='container-fluid'>

    <nav class='navbar navbar-expand-lg navbar-light bg-light'>
      <a class='navbar-brand' href='#'>Navbar</a>
      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>

      <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <ul class='navbar-nav mr-auto'>
          <li class='nav-item active'>
            <a class='nav-link' href='#'>Home <span class='sr-only'>(current)</span></a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='#'>Link</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link disabled' href='#'>Disabled</a>
          </li>
        </ul>
        <?php echo $username;?>
      

      </div>
    </nav>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Email</th>
      <th scope="col">Avatar</th>
      <th scope="col">Birthday</th>
      <th scope="col">Job</th>
      <th scope="col">Countries</th>
      <th scope="col">Gender</th>  
      <th scope="col">Username</th>
      <th scope="col">Position</th>
      <th scope="col">Status</th>
      <th scope="col">Function</th>
    </tr>
  </thead>
  <tbody>
    <?php 


    if(isset($_SESSION['username'])  ){

   
     while($row_select=mysqli_fetch_assoc($query_select)){  ?>

  <tr>
        <th scope="row"> <a href="detail.php?id=<?php echo $row_select['id']?>"> <?php echo $row_select['id'] ?>   </a>  </th>
        <td><?php echo $row_select['email'] ?> </td>
        <td> <img style="width: 30px;" src="<?php echo $row_select['avatar'] ?>" alt=""></td>  
       
        <td><?php echo $row_select['birthday'] ?> </td>
        <td><?php echo $row_select['job'] ?> </td>
        <td><?php echo $row_select['countries'] ?> </td>
        <td><?php echo $row_select['gender'] ?> </td>
        <td><?php echo $row_select['username'] ?> </td>
        <td><?php echo $row_select['position'] ?> </td>
        <td><?php if($row_select['active']==1){
          echo "Da bi xoa";
        }else{
          echo "Dang hoat dong";
        } ?></td>
        <td>
        <a href="delete.php?id=<?php echo $row_select['id']?>" class="btn btn-danger">Delete</a>
        <a href="edit.php?
        id=<?php echo $row_select['id']?>
        
        "
        class="btn btn-warning">Edit</a>
        
        </td>
      </tr>

<?php }
 }?>

 
  </tbody>
</table>


<a href="./register.php" class="btn btn-success">Thêm tài khoản Admin</a>







  </div>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


</body>

</html>