<?php require 'connection.php'; ?>

<!-- code for reading data -->
<?php 
if(isset($_POST['emp_id'])&&isset($_POST['emp_name'])&&isset($_POST['email'])){
$emp_id=$_POST['emp_id'];


// validation code

$sql= 'SELECT * FROM emp_data WHERE emp_id=:emp_id LIMIT 1';
$stmt = $connection->prepare($sql);
$stmt -> execute([':emp_id' => $emp_id]);
$exist = $stmt->fetch(PDO :: FETCH_ASSOC);
if($exist){
  echo"<script>alert('already entered id')</script>";
}
else{
  $emp_name=$_POST['emp_name'];
$email=$_POST['email'];
$sql= 'SELECT * FROM emp_data WHERE email=:email LIMIT 1';
$stmt = $connection->prepare($sql);
$stmt -> execute([':email' => $email]);
$exist = $stmt->fetch(PDO :: FETCH_ASSOC);
if($exist){
  echo"<scrip>alert('already entered email')</script>";
}
else {
  $sql='INSERT INTO emp_data(emp_id,emp_name,email)VALUES(:id,:name,:email)';
  $statement=$connection->prepare($sql);

    if($statement->execute([':id'=>$emp_id,':name'=>$emp_name,':email'=>$email])){
      echo 
  
      "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>&times;</button>
                      <h4><i class='icon fa fa-check'></i> Alert!</h4>
                     Data successfully recorded
                    </div>";
                    clearstatcache();
    } 
}
}}

// code for getting data to output

$sql='SELECT * FROM emp_data';
$statement=$connection->prepare($sql);
$statement->execute();
$employee=$statement->fetchAll(PDO::FETCH_OBJ);


require 'header.php';
?>

<?php
  if ( isset($_GET['success']) && $_GET['success'] == 1 )
  {
       echo 
  
  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>&times;</button>
                  <h4><i class='icon fa fa-check'></i> Alert!</h4>
                 Update successful
                </div>";
  }

  ?>
  <?php if ( isset($_GET['success']) && $_GET['success'] == 2 )
  {
    echo 
  
    "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>&times;</button>
                    <h4><i class='icon fa fa-check'></i> Alert!</h4>
                   Delete successful
                  </div>";
  } ?>
   
<!-- code for form -->
  <div class="container-fluid col-6 bg-secondary  pt-3 rounded-3 border border-2 border-dark my-5">
     <form action="" method="POST" class="form" onsubmit="return (validate())" >
        <h1>Employee status</h1>
        <div >

        <input type="text" required id="fid"  class="form-control mt-4   border border-2 border-success" name="emp_id" placeholder="emp_id">
        </div>
        
        <div>
      
        <input type="text" id="fname" required class="form-control mt-4 border border-2 border-success" name="emp_name" placeholder="emp_name">
        </div>
        
       <div>

        <input type="email" id="email" required  class="form-control mt-4 border border-2 border-success" name="email" placeholder="email">
       </div>
        
        <div class="py-4">
        <input type="submit" class="btn btn-success" placeholder="Submit">
        </div>
      </form>
      </div>
      <div class="container-fluid col-6 bg-danger bg-gradient  pt-3 rounded-3 border border-2 border-dark my-5 overflow-scroll" style="height: 300px; ">

    
    <table class="table table-bordered ">
      <thead>
        <tr> 
         <th>emp_id</th>
        <th>emp_name</th>
        <th>email</th>
        <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($employee as $emp): ?>
          <tr>
            <td><?=$emp->emp_id;?></td>
            <td><?=$emp->emp_name;?></td>
            <td><?=$emp->email;?></td>
            <td >   <a href="edit.php?id=<?=$emp->id?>" class="btn btn-success">Edit</a></td>
            <td ><a href="delete.php?id=<?=$emp->id?>" class="btn btn-danger" href="#" onclick="confirm('do you want to delete ?')">Delete</a></td>
          </tr>  
        <?php endforeach ?>
         
      </tbody>
    </table>
  </div>


  <?php 
  
 require 'footer.php';?>

