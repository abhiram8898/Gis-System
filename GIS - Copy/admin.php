<?php require 'connection.php'; ?>
<?php require 'header.php'; ?>


<nav class="navbar navbar-expand-lg bg-success bg-opacity-75">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">WHERE TO GO ?</a>
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
                        class="nav-link active"
                        aria-current="page"
                        href="logout.php"
                        >Logout</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#">Action</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Another action</a>
                        </li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <a class="dropdown-item" href="#"
                                >Something else here</a
                            >
                        </li>
                    </ul>
                </li>
            </ul>
            <div>
                <form class="d-flex" role="search">
                    <button class="btn btn-outline-success" type="submit">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
<div class="container-fluid p vh-100 jusitfy-content-center row align-items-center ">
    <div class="container justify-content-center row">
        <div class="row col-8 container for text-center  text-white">
        <div class="col-10 col-lg-3 border border-2 border-success mx-4">
            <div><h4>ADD PLACES</h4></div>
        </div>
        <div class="col-10 col-lg-3 border border-2  border-success mx-4">
            <div><h4>EDIT USERS</h4></div>
        </div>
        <div class="col-10 col-lg-3 border border-2  border-success mx-4">
            <div><h4>UPDATE PLACES</h4></div>
        </div>
    </div></div>
    
</div>

<?php require "footer.php"; ?>