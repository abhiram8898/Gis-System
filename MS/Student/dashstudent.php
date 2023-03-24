<?php require '../connection.php'; ?>
<?php require '../header.php'; ?>

<!-- code for html structure -->
<?php 




    session_start();
    if($e = $_SESSION['log'])
{ 
    $sql = 'SELECT * FROM main WHERE EMAIL=:email';
    $statement = $connection->prepare($sql);
$statement->execute([':email'=>$e]); $user = $statement->fetch(PDO::FETCH_OBJ);
$b=$user->BATCH;
}
else{
header("location:../index.php");
}
?>
<div class="container-fluid main vh-100">
    <div class="container-fluid main vh-100">
        <div class="container">
            <!-- code for html structure -->
            <div class="container row justify-content-center mx-auto">
                <div class="text-end">
                    <!-- Button trigger modal -->
                    <button
                        type="button"
                        class="btn btn-warning my-1"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal"
                    >
                        Logout
                    </button>
                    <!-- Modal -->
                    <div
                        class="modal fade"
                        id="exampleModal"
                        tabindex="-1"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content text-center">
                                <div class="modal-header border-0">
                                    <h1
                                        class="modal-title fs-5"
                                        id="exampleModalLabel"
                                    ></h1>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>
                                </div>
                                <div class="modal-body">
                                    <h4>Are you sure ?</h4>
                                </div>
                                <div class="modal-footer border-0">
                                    <button
                                        type="button"
                                        class="btn btn-dark"
                                        data-bs-dismiss="modal"
                                    >
                                        Close
                                    </button>
                                    <a href="../logout.php">
                                        <button
                                            type="button"
                                            class="btn btn-danger my-2"
                                        >
                                            Yes
                                        </button></a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div
                        class="justify-content-center h align-items-center row"
                    >
                        <h1 class="text-success py-4 mb-5 text-center">
                            Welcome Student
                        </h1>
                        <div class="col-2 py-4">
                            <div>
                                <img
                                    class="img-fluid rounded-5"
                                    src="../uploads/<?= $user->PHOTO ?>"
                                />
                            </div>
                        </div>

                        <div class="col-4 row text-center">
                            <div class="row text-start">
                                <h3>
                                    Hello
                                    <?php echo $user->NAME; ?>
                                </h3>
                                <h3><?php echo  $user->EMAIL; ?></h3>
                                <h3>
                                    your batch is
                                    <?php echo  $user->BATCH; ?>
                                </h3>
                            </div>
                        </div>

                        <?php
        $sql = 'SELECT * FROM STATUS WHERE BATCH=:b';
        $statement = $connection->prepare($sql); $statement->execute([':b'
                        =>$b]); $user = $statement->fetch(PDO::FETCH_OBJ); ?>

                        <div class="col-6 row text-center">
                            <iframe src="../uploads/<?= $user->PDF ?>"></iframe
                            >;
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
<?php require '../footer.php'; ?>
