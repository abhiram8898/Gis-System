<?php require 'connection.php'; ?>

<!-- code for reading data -->
<?php 
if(isset($_POST['stud_id'])&&isset($_POST['stud_name']))
{
$stud_id=$_POST['stud_id'];

// validation code

$sql= 'SELECT * FROM student_data WHERE stud_id=:stud_id LIMIT 1';
$stmt = $connection->prepare($sql);
$stmt -> execute([':stud_id' => $stud_id]);
$exist = $stmt->fetch(PDO :: FETCH_ASSOC);
if($exist){
  echo"<script>alert('already entered id')</script>";
}

else {
  $stud_name=$_POST['stud_name'];
  $sql='INSERT INTO student_data(stud_id,stud_name)VALUES(:id,:name,)';
  $statement=$connection->prepare($sql);

    if($statement->execute([':id'=>$stud_id,':name'=>$stud_name])){
      echo 
  
      "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>&times;</button>
                      <h4><i class='icon fa fa-check'></i> Alert!</h4>
                     Data successfully recorded
                    </div>";
                    clearstatcache();
    } 
}
}
// code for getting data to output
$sql='SELECT * FROM student_data';
$statement=$connection->prepare($sql);
$statement->execute();
$students=$statement->fetchAll(PDO::FETCH_OBJ);


require 'header.php';
?>
<!-- for showing alert -->

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
        <h1>Student status</h1>
        <div >

        <input type="text" required id="fid"  class="form-control mt-4   border border-2 border-success" name="emp_id" placeholder="stud_id">
        </div>
        
        <div>
      
        <input type="text" id="fname" required class="form-control mt-4 border border-2 border-success" name="emp_name" placeholder="stud_name">
        </div>
        
        <div class="py-4">
        <input type="submit" class="btn btn-success" placeholder="Submit">
        </div>
      </form>
      </div>
      <div class="container-fluid col-6 bg-danger bg-gradient  pt-3 rounded-3 border border-2 border-dark my-5 overflow-scroll" style="height: 300px; ">

 <!-- code for showing output    -->

    <table class="table table-bordered ">
      <thead>
        <tr> 
         <th>Stud_id</th>
        <th>Stud_name</th>
        <th colspan="2">Action</th>
        </tr>
      </thead>
       <tbody>

       <!-- code for getting data to show -->

        <?php foreach($students as $stud): ?>
          <tr>
            <td><?=$stud->stud_id;?></td>
            <td><?=$stud->stud_name;?></td>
            <td >   <a href="edit.php?id=<?=$stud->id?>" class="btn btn-success">Edit</a></td>
            <td ><a href="delete.php?id=<?=$stud->id?>" class="btn btn-danger" href="#" onclick="confirm('do you want to delete ?')">Delete</a></td>
          </tr>  
        <?php endforeach ?>  
      </tbody>
    </table>
  </div>


  <?php 
  
 require 'footer.php';?>

