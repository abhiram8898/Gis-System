<?php require '../CHF/connection.php'; 
require '../CHF/header.php'; 

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    if(isset($_POST['pass'])&&isset(($_POST['cpass']))){
        $pass=md5($_POST['pass']);
        $cpass=md5($_POST['cpass']);
        if($pass!=$cpass){
            echo"Password not same";
        }
        else{
            $pass=$cpass;
            $sql='UPDATE user SET PASSWORD=:pass WHERE TOKEN=:token';
            $statement=$connection->prepare($sql);
            if($statement->execute(['pass'=>$pass,'token'=>$token])){
                echo "Success";
            }
            else{
                echo "Failed";
            }
        }
    }
}
else{
    echo "Token not found";
}
?>

<div class="container-fluid p row justify-content-center">
    <div class="container col-6 justify-content-center my-5 row">
        <form action="" method="post" class="w-50 text-center">      
            <h1 class="text-white">Reset Password</h1>                             
            <div id="pass_div" class="mt-3">
                    <input type="password" placeholder="Password" class="form-control " id="" name="pass">
                    <input type="password" placeholder="Confirm Password" class="form-control mt-2" id="" name="cpass">
                    <input type="submit" value="Submit" class="btn col-4 btn-success d-block mt-3 w-100" />                  
            </div>                                                              
        </form>
    </div>
</div>
<?php require '../CHF/footer.php'; ?>		