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

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-auth-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="<?php echo site_url(); ?>auth/register" method="post" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user <?php echo (form_error('first_name')) ? 'is-invalid' : ''; ?>" name="first_name" id="first_name" placeholder="First Name" value="<?php echo set_value('first_name'); ?>" autofocus>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('first_name', '<div class="pl-2">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user <?php echo (form_error('last_name')) ? 'is-invalid' : ''; ?>" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo set_value('last_name'); ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('last_name', '<div class="pl-2">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user <?php echo (form_error('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" placeholder="Email Address" value="<?php echo set_value('email'); ?>">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('email', '<div class="pl-2">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user <?php echo (form_error('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Password">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('password', '<div class="pl-2">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user <?php echo (form_error('repeat_password')) ? 'is-invalid' : ''; ?>" name="repeat_password" id="repeat_password" placeholder="Repeat Password">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('repeat_password', '<div class="pl-2">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                                <a href="<?php echo $google_url; ?>" class="btn btn-light btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?php echo site_url(); ?>auth">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Optional JavaScript -->
        <!-- JavaScript Dependencies: jQuery, Popper.js, Bootstrap JS, Shards JS -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/shards.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/custom-script.js"></script>
</body>

</html>