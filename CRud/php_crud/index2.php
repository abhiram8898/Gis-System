<?php require 'connection.php'; ?>
<?php 
 require 'header.php';
?>

<?php
// code for inputs
    if(isset($_POST['emp_id'])&&isset($_POST['emp_name'])&&isset($_POST['email'])){
    $emp_id=$_POST['emp_id'];

// data from index
    $id=$_GET['id1'];
    $name=$_GET['name'];
    $email=$_GET['email'];
    $i=$_GET['id'];


// updating
    $sql = "UPDATE emp_data SET emp_id=:id ,emp_name=:name, email=:email WHERE id=:i";
    $stmt= $connection->prepare($sql);
    if($stmt->execute(['id'=>$id,'name'=>$name,'email'=> $email])){
      echo "updated";
    }
    else{
      echo'not updated';
    }
  ?> 
  <div class="container-fluid col-6 bg-secondary  pt-3 rounded-3 border border-2 border-dark my-5">
     <form action="" method="get" class="form" onsubmit="return (validate())" >
        <h1>Employee status</h1>
        <div >

        <input type="text" required id="fid"  class="form-control mt-4   border border-2 border-success" name="emp_id" value="<?php echo $id ?>"></div>
        
        <div>
      
            <input type="text" id="fname" required class="form-control mt-4 border border-2 border-success" name="emp_name" value="<?php echo $name ?>">
        <div>
        <div>
             <input type="email" id="email" required  class="form-control mt-4 border border-2 border-success" name="email" value="<?php echo $email ?>">
        </div>
        
        <div class="py-4">
        <input type="submit" class="btn btn-success" placeholder="Submit">
        </div>
      </form>
      </div>
     

     
<?php require 'footer.php';?>

