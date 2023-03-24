<?php require '../CHF/connection.php'; ?>
<?php require '../CHF/header.php'; ?>

<?php if (isset($_POST['log'])) {
                        $first_name = $_POST['fname'];
                        $last_name = $_POST['lname'];
                        $email = $_POST['email'];
						$Phone=$_POST['phone'];
                        $password = md5($_POST['password']);
                        $password1 = md5($_POST['password2']);
                        // $pic = $_FILES['pic']['name'];
                        // $temp = $_FILES['pic']['tmp_name'];                      
                        $errors = array();
                        // validation
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            array_push($errors, "Email is not valid");
                        }
                        if (count($errors) > 0) {
                            foreach ($errors as $error) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        }
                        if ($password != $password1) {
                            session_start();
                            $_SESSION['status'] = "password no matching";
                            $_SESSION['status_code'] = "warning";
                            $_SESSION['message'] = "oops..";
                            $_SESSION['page'] = "../index.php";
                        } 						
						else {
                            $sql = 'SELECT * FROM user WHERE EMAIL=:email';
                            $statement = $connection->prepare($sql);
                            $statement->execute([':email' => $email]);
                            $user = $statement->fetch(PDO::FETCH_OBJ);
                            if ($user) {
                                echo "<div class='alert alert-success'>user already exits</div>";
                            } 							
							else {

                                $sql = 'INSERT INTO user(EMAIL,PHONE_NUMBER	,PASSWORD,FNAME,LNAME,CREATED_BY,UPDATED_BY)VALUES(:email,:phone,:pass,:fname,:lname,:fname,:fname)';
                                $statement = $connection->prepare($sql);
                                if ($statement->execute([':email' => $email, ':phone'=> $Phone, ':fname' => $first_name, ':lname' => $last_name, ':pass' => $password])) {

									echo "<div class='alert alert-danger'>Data Registered</div>";
                                                                  
                                }
                            }
                        }
                    } ?>
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

			<div class="container  col-10 col-md-10 ustify-content-center ">
				<div class="row  justify-content-center">
					<div class="col-12 col-md-10  text-white text-center">
						<h2 class="mb-5">Reviews</h2>
						
<div class="row justify-content-center">
    
<!-- <div class="col-10 col-md-6 justify-content-center"><img src="../Images/shop.jpg"class=
"img-fluid rounded-3" alt=""></div> -->

<div class="col-10 col-md-6 justify-content-center">
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../Images/shop.jpg" class="rounded-4 img-fluid d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="../Images/shop.jpg" class="rounded-4 img-fluid d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="../Images/shop.jpg" class="rounded-4 img-fluid d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
                </div>

<div class=" col-10 col-md-6 justify-content-center">
<h2 class="mb-4 text-start">Name of the shop </h2>
<h2 class="mb-4 text-start">Star Rating </h2>
<input type="text" class="form-control" placeholder="Your thoughts about the place">
</div>
<div ><h2  class="my-5">Reviews and Ratings</h2></div>

</div>
					</div>
				</div>
			</div>
		</div>
		<?php require '../CHF/footer.php'; ?>		
