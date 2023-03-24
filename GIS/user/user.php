<?php session_start(); 
require '../CHF/connection.php';
require '../CHF/header.php'; ?>
<style>
    body {
        margin: 0;
    }
    #map {
        width: 100%;
        height: 70vh;
        margin: 0;
        padding: 0;
    }
</style>

<?php
if (!isset($_SESSION["user"])) {
    header("location:../Sign/sign.php");
} else {

    $e = $_SESSION['user'];
    $sql = 'SELECT * FROM user WHERE EMAIL=:email';
    $statement = $connection->prepare($sql); $statement->execute([':email'=>$e]); 
    $user = $statement->fetch(PDO::FETCH_ASSOC); }?>

<!-- closed -->

<video id="background-video" autoplay loop muted poster="Images/2.jpeg">
    <source src="../Images/1.MP4" type="video/mp4" />
</video>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <h4 class="nav-link">TravelBliss</h4></a
        >
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
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a
                        class="nav-link"
                        aria-current="page"
                        href="../Sign/logout.php"
                        >Logout</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- navbar closing -->
<div
    class="container-fluid align-content-center justify-content-center gap-4 row m-0 p-0"
>
    <h2 class="text-center">It's a big world out there go explore.</h2>
    <div
        class="row col-11 col-md-3 my-5 align-items-center text-center mx-1 bg-light bg-opacity-50 for2 p-3 bg-opacity-50 rounded-4"
    >
        <h3 class="text-secondary">
            Hey
            <?php echo $user["FNAME"] ?>, Where would you like to Go ? </h3>
        
        <h4 id="p">Name of the Building</h4>
        <div class="col-12 justify-content-center">
            <button
                class="btn btn-success col-5 text-center"
                type="submit"
                id="submit"
            >
                Search
            </button>
           <a href="details.php
           "> <button
                class="btn btn-success col-5 text-center"
                type="submit"
                id="submit2"
                
            >
                Know
            </button></a>
            
        </div>
    </div>
    <div
        class="col-12 col-sm-7 bg-light bg-opacity-50 for2 rounded-4 row align-items-center mt-5"
        id="div1"
    >
        <div class="col-8" id="viewDiv" class="rounded-5"></div>
    </div>
</div>

<!-- code for gis -->

<?php require '../CHF/footer.php'; ?>
