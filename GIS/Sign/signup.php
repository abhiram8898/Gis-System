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
								echo "<div class='alert alert-danger m-0 alert-dismissible fade show' role='alert'>
								<strong>Already Exist</strong>
								<button type='button' class='btn-close m-0' data-bs-dismiss='alert' aria-label='Close'></button>
							   </div>";
                              } 							
					        else {
								$sql = 'INSERT INTO user(EMAIL,PHONE_NUMBER	,PASSWORD,FNAME,LNAME,CREATED_BY,UPDATED_BY)VALUES(:email,:phone,:pass,:fname,:lname,:fname,:fname)';
                                $statement = $connection->prepare($sql);
                                if ($statement->execute([':email' => $email, ':phone'=> $Phone, ':fname' => $first_name, ':lname' => $last_name, ':pass' => $password])) {

									echo "<div class='alert alert-success mb-0 p-0 alert-dismissible fade show' role='alert'>
        <strong>Data Registered</strong>
        <button type='button' class='btn-close m-0' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
                                                                  
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
                                href="logout.php"
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
						<h2>Where to Go ?</h2>
						<form action="" onsubmit="return validate()" method="post" class="">
							<div class="pb-4 mt-5">
								<input
									type="text"
									placeholder="First name"
									id="fname"
									class="form-control"
									name="fname"
								
								/>
							</div>
							<div class="pb-4">
								<input
									type="text"
									placeholder="Last name"
									id="lname"
									class="form-control"
									name="lname"
								
								/>
							</div>
							<div class="pb-4">
								<input
									type="email"
									placeholder="Email"
									id="email"
									class="form-control"
									name="email"
									
								/>
							</div>
							<div class="pb-4">
								<input
									type="number"
									placeholder="Phone"
									id="phone"
									class="form-control"
									name="phone"
									
								/>
							</div>
							<div class="pb-4">
								<input
									type="password"
									placeholder="Password"
									id="password"
									class="form-control"
									name="password"
								
								/>
							</div>
							<div class="pb-4">
								<input
									type="password"
									placeholder="Confirm-password"
									id="c_password"
									class="form-control"
									name="password2"
							
								/>
							</div>
							
							</div>							
							<div class="text-center">
								<button
									type="Submit"
									name="log"
									class="btn btn-success mb-5"
								>
									Submit
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php require '../CHF/footer.php'; ?>		
