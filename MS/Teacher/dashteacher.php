<?php require '../connection.php'; ?>
<?php require '../header.php'; ?>

<!-- code for html structure -->
<?php session_start();

   if( $e = $_SESSION['log'])
   { 
    $sql = 'SELECT * FROM main WHERE EMAIL=:email';
    $statement = $connection->prepare($sql); 
    $statement->execute([':email' =>$e]); 
    $user = $statement->fetch(PDO::FETCH_OBJ);}
    else{
        header("location:../index.php");
    } ?>
<div class="container-fluid main vh-100">
    <div class="container">
<!-- code for html structure -->
    <div class="container row justify-content-center mx-auto">
        <div class="text-end"> 
       <!-- Button trigger modal -->
        <button type="button" class="btn btn-warning my-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Logout
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content text-center">
         <div class="modal-header border-0">
             <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
      <div class="modal-body">
             <h4>Are you sure  ?</h4>
      </div>
      <div class="modal-footer border-0  ">
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
          <a href="../logout.php"> <button type="button"  class="btn btn-danger my-2"> Yes </button></a>
      </div>
    </div>
  </div>
</div>
</div>

        <div class="justify-content-center h my-5 align-items-center row">
        <h1 class="text-center text-success">Welcome Teacher</h1>
            <div class="col-12 col-sm-6">
                
                <div class="col-5">
                    <img
                        class="img-fluid rounded-5"
                        src="../uploads/<?= $user->PHOTO ?>"
                    />
                </div>
            </div>

            <div class="col-12 col-sm-6 row text-center">
                <div class="row text-start d-flex">
                    
                    <h1><?php echo $user->NAME; ?> &nbsp;<?php echo  $user->EMAIL; ?></h1>
                
                </div>
            </div>
        </div>
    </div>

    <?php 
if(isset($_POST['log'])) {
    $pdf = $_FILES['pic']['name'];
    $temp = $_FILES['pic']['tmp_name'];
    $batch=$_POST['batch'];

    // Move the PDF file to the uploads folder
    $target = "../uploads/" . basename($pdf);
    $move_pdf = move_uploaded_file($temp, $target);

    // Insert the file path into the database
    $sql = 'INSERT INTO STATUS (PDF, BATCH)
    VALUES (:url,:E)';
    $statement = $connection->prepare($sql); 
    if ($statement->execute([':url' =>$pdf,':E' =>
    $batch])) 
    { echo "PDF file uploaded successfully."; } 
    else 
    { echo "Error uploading PDF file."; } } 

     { // Display the form to upload a PDF file
    echo '
    <form method="post" enctype="multipart/form-data">
        <div class="form-input container justify-content-center py-2">
            <div class="row col-12 ">
                <div class="col-6">
                    <input
                        type="file"
                        required
                        class="form-control my-2"
                        name="pic"
                        placeholder="PDF"
                        accept=".pdf"
                    />
                    <input
                        type="text"
                        required
                        class="form-control my-2"
                        name="batch"
                        placeholder="Which batch"
                       
                    />
                </div>
                <div class="col-6">
                    <button class="btn btn-success" name="log">Submit</button>
                </div>
            </div>
        </div>
    </form>
    '; } ?>
    


    <?php require '../footer.php'; ?>
</div>
