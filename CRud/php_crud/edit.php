
<!-- conection header -->

<?php require 'connection.php'; ?>
<?php require 'header.php'; ?>

<!-- code for getting id -->

<?php $id=$_GET['id'];

// code for getting values from database using id

$sql='SELECT * FROM emp_data WHERE id=:id';
$statment = $connection->prepare($sql);
$statment -> execute([':id' => $id]);
$employee=$statment->fetch(PDO::FETCH_OBJ);

//  code for reading data

if(isset($_POST['emp_id'])&&isset($_POST['emp_name'])&&isset($_POST['email'])){
    $emp_id=$_POST['emp_id'];
    $emp_name=$_POST['emp_name'];
    $email=$_POST['email'];

// update query

    $sql='UPDATE emp_data SET emp_id=:emp_id, emp_name=:emp_name, email=:email WHERE id=:id';
    $statement=$connection->prepare($sql);

    if($statement->execute([':emp_id'=>$emp_id,':emp_name'=>$emp_name,':email'=>$email,':id' => $id])){
      // echo "<script>alert('Updated');document.location='index.php'</script>";
      header('Location: index.php?success=1');
      // header("Location: index.php");
      // echo"<div class='alert alert-info'>Data recorded successfully</div>";
  }
  
}
?>

<!-- code for form -->
<div class="container-fluid col-6 bg-secondary  pt-3 rounded-3 border border-2 border-dark my-5">
<form action="" method="post" class="form text-center" onsubmit="return (validate())" >
        <h1>Edit status</h1>
        <div >
        <input type="text" required id="fid"  class="form-control mt-4   border border-2 border-success" name="emp_id" value="<?= $employee->emp_id ?>" ></div>
        <div><input type="text" id="fname" required class="form-control mt-4 border border-2 border-success" name="emp_name" value="<?= $employee->emp_name ?>" >
        <div>
        <div><input type="email" id="email" required  class="form-control mt-4 border border-2 border-success" name="email" value="<?= $employee->email?>" >
        </div>
        <div class="py-4">
        <input type="submit" class="btn btn-success" placeholder="Update">
        </div>
</form>
      </div>  
<?php require 'footer.php';?>