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
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-auth-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    <?php if ($this->session->flashdata('danger_alert')) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo $this->session->flashdata('danger_alert'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($this->session->flashdata('success_alert')) : ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php echo $this->session->flashdata('success_alert'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <form class="user" action="<?php echo site_url(); ?>auth" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user <?php echo (form_error('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." value="<?php echo set_value('email'); ?>" autofocus />
                                            <div class="invalid-feedback">
                                                <?php echo form_error('email', '<div class="pl-2">', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user <?php echo (form_error('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Password" />
                                            <div class="invalid-feedback">
                                                <?php echo form_error('password', '<div class="pl-2">', '</div>'); ?>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" />
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div> -->
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <!-- <hr />
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with
                                            Facebook
                                        </a> -->
                                    </form>
                                    <hr />
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo site_url(); ?>auth/register">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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