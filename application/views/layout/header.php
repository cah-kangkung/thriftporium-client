<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?></title>
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/logo/thrift_logo_fixbgt.png">

    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/shards.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom-style.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="floating-customer-service">
        <a class="" href="https://lin.ee/TWMKzwC" target="_blank"><img height="70" border="0" src="<?php echo base_url(); ?>assets/img/logo/line-logo.png"></a>
    </div>
    <header id="header" class="sticky-top bg-white">
        <div class="top-bar">
            <a class="navbar-brand" href="<?php echo site_url(); ?>home" style="height: 100%;">
                <img src="<?php echo base_url(); ?>assets/img/logo/thrift_logo_fixbgt.png" width="45" height="45" alt="">
            </a>
            <form class="form-inline mx-auto my-lg-0" action="<?php echo site_url(); ?>products/search" method="GET">
                <div class=" input-group input-group-seamless">
                    <input class="form-control form-control-sm my-2" type="text" name='name' id='name' placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <button type="submit" style="background-color: transparent; border: unset;"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <?php if ($this->session->userdata('logged_in')) : ?>
                <a class="cart-icon" href="<?php echo site_url(); ?>cart">
                    <i class="fas fa-shopping-cart fa-lg"></i>
                </a>
                <div class="logged-in-dropdown" data-toggle="dropdown">
                    <img src="<?php echo base_url(); ?>assets/img/profile-pictures/<?php echo $user['user_image']; ?>" width="40" height="40" alt="">
                    <i class="fas fa-caret-down ml-1"></i>
                </div>
                <div class="dropdown-menu dropdown-menu-right mt-2">
                    <a class="dropdown-item" href="<?php echo site_url(); ?>profile/edit/<?php echo $user['id']; ?>">Profile</a>
                    <a class="dropdown-item" href="<?php echo site_url(); ?>order/order_list">Order</a>
                    <a class="dropdown-item" href="<?php echo site_url(); ?>payment/payment_list">Waiting Payment</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo site_url(); ?>auth/logout">Logout</a>
                </div>
            <?php else : ?>
                <a class="btn btn-outline-primary btn-sm login-button" href="<?php echo site_url(); ?>auth">Login</a>
            <?php endif; ?>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="<?php echo site_url(); ?>products/latest">What's New</a>
                    </li>
                    <?php foreach ($category as $c) : ?>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="<?php echo site_url(); ?>products/category/<?php echo $c['category_name'] ?>"><?php echo $c['category_name']; ?></a>
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