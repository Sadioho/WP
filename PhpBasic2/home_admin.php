
<?php 
include 'connection.php';
if(!isset($_SESSION)){
    session_start();
}
    if($_SESSION['username']==''){
        header('location:index.php?page=login');
    }
   if($_SESSION['position']==='0'){
       header('location:index.php?page=home');
   }
   $sql_select="select * from acount";
   $query_select=mysqli_query($mysqli,$sql_select);
?>

<h3 class="text-danger text-center">
 <?php if(isset($_SESSION['err'])){
   echo $_SESSION['err'];
   unset($_SESSION['err']);
 } ?>
</h3>

<h3 class="text-success text-center">
 <?php if(isset($_SESSION['succ'])){
   echo $_SESSION['succ'];
   unset($_SESSION['succ']);

 } ?>
</h3>
<div class="container-fluid">
   <div class="row">


<div class="col-sm-9 m-auto">
<table class="table table-striped">

<?php 

if(isset($_GET['id_edit'])){
  require_once 'edit.php';
}  else {?> 



  <thead>
    <tr>
    <th scope="col">ID</th>
      <th scope="col">Email</th>
      <th scope="col">Birthday</th>
      <th scope="col">Job</th>
      <th scope="col">Countries</th>
      <th scope="col">Gender</th>  
      <th scope="col">Username</th>
      <th scope="col">Position</th>
      <th scope="col">Function</th>
    </tr>
  </thead>
  <tbody>
    <?php 


    if(isset($_SESSION['username'])  ){

   
     while($row_select=mysqli_fetch_assoc($query_select)){  ?>

  <tr>

        <?php if($row_select['active']==1) {
            
            ?>

        <th scope="row">  <?php echo $row_select['id'] ?> </th>
        <td><?php echo $row_select['email'] ?> </td> 
        <td><?php echo $row_select['birthday'] ?> </td>
        <td><?php echo $row_select['job'] ?> </td>
        <td><?php echo $row_select['countries'] ?> </td>
        <td><?php echo $row_select['gender'] ?> </td>
        <td><?php echo $row_select['username'] ?> </td>
        <td><?php echo $row_select['position'] ?> </td>
        <td>
        <a href="delete.php?id=<?php echo $row_select['id']?>" class="btn btn-danger">Delete</a>
        <a href="index.php?page=home&id_edit=<?php echo $row_select['id']?>
        
        "
        class="btn btn-warning">Edit</a>
        
        </td>
      </tr>

<?php }}
 }
 }?>

 
  </tbody>
</table>



</div>
   </div>

</div>





