<?php require '../CHF/connection.php'; ?>
<?php require '../CHF/header.php'; ?>

<div class="container-fluid m-0 p min-vh-100 row justify-content-center py-5">
    <div class="col-12 container rounded-3 p2 col-sm-10 px-5 mx-5 text-white">
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid p-0">
                <a class="navbar-brand" href="#">
                    <h4 class="text-white">TravelBliss</h4></a
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
                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a
                                class="nav-link active text-white"
                                aria-current="page"
                                href="../Sign/sign.php"
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

        <div><h1 class="text-white my-5">Welcome Admin</h1></div>
        <div class="container justify-content-center row">
            <div
                class="row col-11 justify-content-center container for text-center text-white"
            >
                <div
                    class="col-10 col-lg-3 mx-2 admin2 rounded-3 border border-2 border-success"
                >
                    <a href="edit users.php">
                        <div class="text-dark"><h4>EDIT USERS</h4></div></a
                    >
                </div>
                <div
                    class="col-10 admin1 rounded-3 mx-2 col-lg-3 border border-2 border-success"
                >
                    <a href="addplaces.php">
                        <div><h4 class="text-black">ADD PLACES</h4></div></a
                    >
                </div>
                <div
                    class="col-10 col-lg-3 rounded-3 mx-2 admin3 border border-2 border-success"
                >
                    <a href="update places.php">
                        <div class="text-dark">
                            <h4>UPDATE PLACES</h4>
                        </div></a
                    >
                </div>
            </div>
        </div>
    </div>

    <?php require "../CHF/footer.php"; ?>
</div>
