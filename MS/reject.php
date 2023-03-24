<?php require 'connection.php';?>
<?php require 'header.php'; ?>

<?php
session_start();
$s = $_SESSION["user"];
$sql = 'UPDATE main SET STATUS = :status WHERE EMAIL = :email';
$statement = $connection->prepare($sql);
if ($statement->execute([':status' => 'no', ':email' => $s])) {
  header("location:Admin/admin.php");
}
?>
<?php require 'footer.php'; ?>