<?php require 'connection.php'; ?>

<?php
if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $pic = $_FILES['pic']['name'];
  $temp = $_FILES['pic']['tmp_name'];
  echo "$title";
  echo "$pic";
  $target = "uploads/" . basename($pic);
  $sql = 'INSERT INTO img_data(name,url)VALUES(:name,:url)';
  $statement = $connection->prepare($sql);
  $statement->execute([':name' => $title, ':url' => $pic]);
  $move_pic = move_uploaded_file($temp, $target);
  if ($move_pic) {
    echo "success";
  } else {
    echo "failed";
  }
}
?>
<?php require 'header.php'; ?>


<div class="container ">
  <form action="" method="POST" class="form-control bg-secondary" enctype="multipart/form-data">
    <div>
      <input type="text" class="form-control my-2" name=title placeholder="title name">
    </div>
    <div>
      <input type="file" class="form-control my-2" name="pic" placeholder="Choose file">

    </div>
    <div>
      <input type="submit" class="form-control my-2" name="submit" placeholder="submit">
    </div>

  </form>
</div>

<?php
$sql = 'SELECT * FROM img_data';
$statement = $connection->prepare($sql);
$statement->execute();
$images = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<?php foreach ($images as $image) : ?>

  <img src="uploads/<?= $image->url ?>">

<?php endforeach ?>

<?php require 'footer.php'; ?>