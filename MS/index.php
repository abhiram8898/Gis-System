<?php require 'connection.php';?>
<?php require 'header.php'; ?>

<?php if(isset($_POST['log']))
{
        $email=$_POST['email'];
        $pass=md5($_POST['pass']);
        $sql = "SELECT * FROM main WHERE EMAIL = :email";
                    $statement = $connection->prepare($sql);
                    $statement->execute([':email' => $email]);
                    $user = $statement->fetch(PDO::FETCH_ASSOC);
                        if ($user !== false) 
                        {
                            $p = $user['PASSWORD'];
                            $u = $user['USERTYPE'];
                            $s=$user['STATUS'];
                            if ($pass== $p) {
                                if($s=='yes')
                                {
                                session_start();
                                $_SESSION["log"]=$email;
                                if($u=="student")
                                { 
                                header("Location:./student/dashstudent.php ");
                                }
                                else if($u=="teacher")
                                {
                                    header("Location:./teacher/dashteacher.php ");
                                }
                                else {
                                    header("Location:./Admin/admin.php ");
                                }
                            }
                            else{
                                echo "<div class='alert alert-danger'>Admin not authorised</div>";
                            }
                            }
                            else{
                                echo "<div class='alert alert-danger'>Invalid password</div>";
                            }
                        } 
                        else {
                          echo "<div class='alert alert-danger'>Invalid user </div>";
                        }
                    }   
?>


<div class="container-fluid main vh-100 ">
    <div class="container">
        <div class="justify-content-center h  align-items-center row">
            <!-- image div -->
        
            <!-- form div -->
            <div class="col-12 col-sm-6 ">
                <h1 class="text-center mb-4 text-white">Login</h1>
<form method="Post" action="" class="form">
<div >

    <input type="email" required class="form-control my-2" name="email" placeholder="Email">
</div>
<div>

    <input type="password" required class="form-control my-2" name="pass" placeholder="Enter your Password">
</div>
<div>
    <input type="submit" class="form-control my-2 btn btn-primary" name="log" value="Login">
</div>
<div class="row">
<div class="col-6">
    <a href="./Student/registerstudent.php"><input type="text" class="form-control my-2 btn btn-success text-white" name="create" value="Signup as STUDENT"></a>
</div>
<div class="col-6">
    <a href="./teacher/registerteacher.php"><input type="text" class="form-control my-2 btn btn-success text-white" name="create" value="Signup as TEACHER"></a>
</div>
</div>

<div>
    <a href="reset.php">
    <button type="button" class="btn btn-outline-none text-decoration-underline text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Forgot password
    </button></a>
</div>
</form>
            </div>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>