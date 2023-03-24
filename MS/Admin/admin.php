<?php require '../connection.php'; ?>
<?php require '../header.php'; ?>

<div class='container-fluid main vh-100 '>
    <div class='container'> 
        <div class='justify-content-center h  align-items-center row'>
        <div class="col-12  row text-center">
            <div class="row">
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
                <h1 class="p-5  text-success">Welcome Admin</h1>
                <?php
             session_start();
             if($e = $_SESSION['log'])
                {
                
                   if($sql = 'SELECT * FROM main WHERE STATUS=:status') 
                   {
                    $statement = $connection->prepare($sql);
                    $statement->execute([':status' => '']);
                    $user = $statement->fetch(PDO::FETCH_OBJ);
                    if($user)
                    {
                    $e=$user->EMAIL;
                    echo "<div class='row container-fluid justify-content-start '>";
                    echo "<div class='col-12 py-3 text-start '>";
                    
                        echo "<h1 class='text-danger my-4'>Pending request </h1>";
                    echo "<div class='col-12 d-flex  my-2'>";
                       
                    echo "<h3>".$user->NAME." &nbsp; ".$user->EMAIL."</h3>";
                    session_start();
                    $_SESSION["user"] = $e;
                    echo "<a href='../reject.php'><button class='mx-4 btn btn-success my-3'>Reject</button></a>" ;
                   
                    echo "<a href='../confirm.php'><button class='mx-4 btn btn-success my-3'>Confirm</button></a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    }
                    else 
                    echo "<h3> no pending </h3>";
                   }
                else 
                echo 'no pending';
                }
                else{
                    header("location:../index.php");
                }
              
            
                ?>   
            </div>
        </div>
        </div>
    </div>
</div>
 
<?php require '../footer.php'; ?>