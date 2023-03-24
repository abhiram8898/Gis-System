<?php require '../CHF/connection.php'; ?>
<?php require '../CHF/header.php'; ?>

<?php    

    $sql = 'SELECT * FROM user';
    $statement = $connection->prepare($sql); 
    $statement->execute(); 
    $users = $statement->fetchAll(PDO::FETCH_OBJ);



if (isset($_POST['log'])) {
                         $ID = $_POST['userid'];
                       
							 
                         $sql = 'DELETE FROM user WHERE ID=:id';
                         $statement = $connection->prepare($sql);
                         $statement->execute([':id' => $ID]);
                         $depart_name = $statement->fetch(PDO::FETCH_OBJ);
                        }
                     ?>
		<div
    class="container-fluid m-0 p  min-vh-100 row justify-content-center py-5"
>
    <div class="col-12 container p2 rounded-3 col-sm-10  px-5  text-white">
			<!-- navbar -->


		<nav class="navbar navbar-expand-lg navbar-light mb-5">
            <div class="container-fluid p-0 ">
			<a class="navbar-brand" href="#"> <h4 class="text-white ">
        TravelBliss
           
        </h4></a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a
                                class="nav-link active text-white"
                                aria-current="page"
                                href="index.php"
                                >Home</a
                            >
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="#"
                                >About</a
                            >
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link active text-white"
                                href="../Sign/logout.php"
                                >Login/Signup</a
                            >
                        </li>
                    </ul>                  
                </div>
            </div>
        </nav>

			<div class="container  col-10 col-md-6 ustify-content-center ">
				<div class="row  justify-content-center">
					<div class="col-12 col-md-10  text-white text-center">
						<h2 class="my-5">Edit user</h2>

                       
						<form action="" method="post" class="">


                        <select class="form-select" name="userid" aria-label="Default select example">
                            <option selected >Select the users.</option>
                            <?php foreach ($users as $user) : ?>
                                <option value="<?= $user->ID; ?>"><?= $user->FNAME; ?></option>
                            <?php endforeach ?>
                        </select>

							
														
							<div class="text-center">
								<button
									type="Submit"
									name="log"
									class="btn btn-success my-5"
								>
									Delete
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php require '../CHF/footer.php'; ?>		
