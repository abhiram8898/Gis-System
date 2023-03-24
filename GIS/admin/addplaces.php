<?php session_start();
require '../CHF/connection.php';
require '../CHF/header.php';?>

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
        <!-- navbar end -->

        <div class="row justify-content-center">
            <!-- div for plane image -->
            <div
                class="px-0 col-12 col-lg-6 my-4 my-lg-5 rounded-4 text-center"
            >
                <h2>Add Places</h2>
                <img
                    src="../Images/cover.jpeg"
                    class="img-fluid rounded-4"
                    alt=""
                />
            </div>
            <!-- div for login -->
        </div>
    </div>

    <!-- container-fluid div closed -->
    <?php require '../CHF/footer.php'; ?>
</div>
