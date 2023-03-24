<?php session_start(); 
require 'connection.php';
require 'header.php'; 

 if (isset($_POST['log'])) 
                             {  $email = $_POST['email'];
                                $password = md5($_POST['pass']);
                                // selecting data from database
                                $sql = "SELECT * FROM user WHERE EMAIL = :email";
                                $statement = $connection->prepare($sql);
                                $statement->execute([':email' => $email]);
                                $user = $statement->fetch(PDO::FETCH_ASSOC);
                             
            
                                if ($user !== false) {
                                    $a = $user['STATUS'];
                                    $u = $user['ID'];
                                    $p = $user['PASSWORD'];
                                    if ($password == $p) {
                                      if ($a == 'USER') {
                                        $_SESSION["uid"] = $u;
                                        $_SESSION["user"] = $email;
                                        echo "<script>window.location.href='dash.php'</script>";
                                      } else if ($a == 'ADMIN') {
                                       
                                        $_SESSION["user"] = $email;
                                        echo "<script>window.location.href='admin.php'</script>";
                                      }
                                    } else {
                                      echo "<div class='alert alert-danger'>Invalid password</div>";
                                    }
                                  } else {
                                    echo "<div class='alert alert-danger'>Invalid user</div>";
                                  }
                                }?> 

    
        <div class="container-fluid row p justify-content-center align-items-center p-0 m-0">
            <div class="justify-content-center row ">
               
            <div class="col-7 row justify-content-center">
                <div class="col-10 ">
                <img src="Images/index.gif " class="img-fluid rounded-4" alt="">
                </div>
            </div>
                <div
                    class="col-5 row align-items-center justify-content-center  text-white rounded-4 "
                >
                <div class="col-10">

                    <h1 class="text-center mb-4">Login to Search</h1>
                    <form method="Post" action="" class="form">
                       
                        <!-- html for changing password -->
                        <div>
                            <input
                                type="email"
                                required
                                class="form-control my-2"
                                name="email"
                                placeholder="Email"
                            />
                        </div>
                        <div>
                            <input
                                type="password"
                                required
                                class="form-control my-2"
                                name="pass"
                                placeholder="Enter your Password"
                            />
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="register.php"
                                    ><input
                                        type="submit"
                                        class="form-control my-2 btn btn-primary text-white"
                                        name="create"
                                        value=" New Account"
                                /></a>
                            </div>
                            <div class="col-6">
                                <input
                                    type="submit"
                                    class="form-control my-2 btn btn-primary text-white"
                                    name="log"
                                    value="Login"
                                />
                            </div>
                        </div>
                        <div>
                        <div class="col-6 text-start">
                        <button
                            type="button"
                            class="border-0 p2 text-white  text-decoration-underline"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                        >
                            Forgot password
                        </button>
                    </div>

                           <a href="signup.php"><button
                                type="button"
                                class="btn btn-outline-none text-decoration-underline text-dark"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal"
                            >
                                Sign up
                            </button></a> 

                        </div>
                    </form>
                    
                </div>
                </div>
            </div>
            <?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$token = bin2hex(random_bytes(32));

if(isset($_POST['password-reset-token']) && $_POST['email'])
{
    $email_address = $_POST['email'];
    $query = $connection->prepare("UPDATE user SET TOKEN=:token WHERE EMAIL=:email");
    $query->execute(array(':token' => $token, ':email' => $email_address));
    $reset_url = "http://localhost/Group/AIRLINE/reset-password.php?token=" . $token;
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'arfsairline@gmail.com';                     //SMTP username
        $mail->Password   = 'gaycnpamyrhohkbr';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
        $mail->setFrom('arfsairline@gmail.com', 'PurpleFly');
        $mail->addAddress($email_address);     //Add a recipient
       
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'password reset';
        $mail->Body    = 'To reset your password, please click the following link:'.$reset_url;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        echo '<script>alert("Message sent");</script>';
    } catch (Exception $e) {
        echo '<script>alert("Message not sent");</script>';
    }
}
?>
<!-- Modal -->
<div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Forgot Password
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="modal-body border-0">
                    <div class="container">
                        <div class="card">
                            
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Email address</label
                                        >
                                        <input
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            id="email"
                                            aria-describedby="emailHelp"
                                        />
                                        <small
                                            id="emailHelp"
                                            class="form-text text-muted"
                                            >We'll never share your email.</small
                                        >
                                    </div>
                                    <input
                                        type="submit"
                                        name="password-reset-token"
                                        class="btn btn-success"
                                    />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>          
        </div>
    </div>
        </div>
   
        <?php require "footer.php"; ?>