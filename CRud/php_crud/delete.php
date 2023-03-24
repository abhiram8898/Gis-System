<?php require 'connection.php'; ?>
<?php require 'header.php'; ?>

<!-- code for getting id -->


<?php $id=$_GET['id'];

// code for getting values from database using id

$sql='DELETE FROM emp_data WHERE id=:id';
$statment = $connection->prepare($sql);
if($statment -> execute([':id' => $id]))
{
    header('Location: index.php?success=2');
}


