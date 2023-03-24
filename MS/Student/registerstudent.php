<?php require '../connection.php'; ?>
<?php require '../header.php'; ?>
<!-- code for form -->

<div class="container-fluid main vh-100">
    <div class="container ">
        <div class="justify-content-center  vh-100 align-items-center row">
        
            <div class="col-12 col-md-6">
                <form method="POST" action="" class="form" enctype="multipart/form-data">
                    <h1 class="text-center text-white mb-4">Register</h1>
                    <!-- code for getting values -->
                    <?php if (isset($_POST['log'])) {
                        $name = $_POST['name'];
                        $batch=$_POST['batch'];
                        $phone=$_POST['phone'];
                        $pic = $_FILES['pic']['name'];
                        $temp = $_FILES['pic']['tmp_name'];
                        $email = $_POST['email'];
                        $password = md5($_POST['pass']);
                        $password1 = md5($_POST['pass1']);
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
                           echo "not matching";
                        } 
                        else {
                            $sql = 'SELECT * FROM main WHERE EMAIL=:email';
                            $statement = $connection->prepare($sql);
                            $statement->execute([':email' => $email]);
                            $user = $statement->fetch(PDO::FETCH_OBJ);
                            if ($user) {
                                echo "<div class='alert alert-danger'>user already exits</div>";
                            } else {

                                $sql = 'INSERT INTO main(PHOTO,EMAIL,BATCH,PHONE,PASSWORD,NAME,USERTYPE,STATUS)VALUES(:url,:email,:batch,:phone,:pass,:name,:usertype,:s)';
                                $statement = $connection->prepare($sql);
                                if ($statement->execute([':email' => $email,':url' => $pic,':batch'=>$batch, ':phone'=>$phone, ':name' => $name, ':pass' => $password, ':usertype' => 'student', ':s'=>''])) {
                                    $target = "../uploads/" . basename($pic);
                                    $move_pic = move_uploaded_file($temp, $target);
                                    session_start();
                                    $_SESSION['status']=$email;
                                    echo "<div class='alert alert-danger'>Data recorded</div>";             
                                }
                            }
                        }
                    } ?>
                    <!-- html form for regristration -->
                   <div>
                        <input type="text" class="form-control my-2" name="name" placeholder="Name">
                    </div>
                    <div>
                        <input type="text" class="form-control my-2" name="batch" placeholder="Batch">
                    </div>
                    <div>
                        <input type="text" required class="form-control my-2" name="phone" placeholder="Phone">
                    </div>
                    <div>
                        <input type="file" required class="form-control my-2" name="pic" placeholder="Photo">
                    </div>
                    <div>
                        <input type="email" required class="form-control my-2" name="email" placeholder="Email">
                    </div>
            
                    <div>
                        <input type="password" required class="form-control my-2" name="pass" placeholder="Password">
                    </div>
                    <div>
                        <input type="password" required class="form-control my-2" name="pass1" placeholder="Confirm Password">
                    </div>
                    
                    
                    <div>
                        <input type="submit" class="form-control my-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" name="log" value="Submit">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<?php require '../footer.php'; ?>