<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?></title>

    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/shards.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom-style.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<body>
    <header class="sticky-top bg-white">
        <div class="top-bar">
            <a class="navbar-brand" href="<?php echo site_url(); ?>home">
                <img src="<?php echo base_url(); ?>assets/img/logo/thrift_logo_fixbgt.png" width="45" height="45" alt="">
            </a>
            <form class="form-inline mx-auto my-lg-0">
                <div class=" input-group input-group-seamless">
                    <input class="form-control form-control-sm my-2" type="text" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <button type="submit" style="background-color: transparent; border: unset;"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- <i class="fas fa-shopping-cart"></i> -->
            <?php if ($this->session->userdata('logged_in')) : ?>
                <div class="logged-in-dropdown ml-3" data-toggle="dropdown">
                    <img src="<?php echo base_url(); ?>assets/img/profile-pictures/<?php echo $user['user_image']; ?>" width="40" height="40" alt="">
                    <i class="fas fa-caret-down"></i>
                </div>
                <div class="dropdown-menu dropdown-menu-right mt-2">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Order</a>
                    <a class="dropdown-item" href="#">Waiting Payment</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo site_url(); ?>auth/logout">Logout</a>
                </div>
            <?php else : ?>
                <a class="btn btn-outline-primary btn-sm login-button ml-3" href="<?php echo site_url(); ?>auth">Login</a>
            <?php endif; ?>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">What's New</a>
                    </li>
                    <?php foreach ($category as $c) : ?>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#"><?php echo $c['category_name']; ?></a>
                        </li>
                    <?php endforeach; ?>
                    <!-- <li class="nav-item mx-2 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            All Product
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="nav-link" href="#">Test</a>
                            <a class="nav-link" href="#">Test</a>
                            <a class="nav-link" href="#">Test</a>
                        </div>
                    </li> -->
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <section id="hero-section">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/thriftporium-bg/bg-six.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/thriftporium-bg/bg-four.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/thriftporium-bg/bg-five.jpg" alt="Second slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>

        <section id="category-section">
            <div class="container">
                <h1>Hello</h1>
            </div>
        </section>
    </main>

    <footer>

    </footer>
    <!-- Optional JavaScript -->
    <!-- JavaScript Dependencies: jQuery, Popper.js, Bootstrap JS, Shards JS -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/shards.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom-script.js"></script>
</body>

</html>